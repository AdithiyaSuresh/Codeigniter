<?php

require_once '/var/www/html/codeigniter/application/Rabbitmq/vendor/autoload.php';
include "/var/www/html/codeigniter/application/static/RabbitMQConstants.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;


class Receiver
{
    
    public function receiverMail()
    {   
        $RabbitMQConstantsObj = new RabbitMQConstants();
        
        $connection = new AMQPStreamConnection($RabbitMQConstantsObj->host,$RabbitMQConstantsObj->port,$RabbitMQConstantsObj->username,$RabbitMQConstantsObj->password);
        $channel    = $connection->channel();

        $channel->queue_declare($RabbitMQConstantsObj->queuename, false, false, false, false);
        $email=$RabbitMQConstantsObj->senderEmailID;
        $pass=$RabbitMQConstantsObj->senderPassword;
        $callback = function ($msg) {

            $RabbitMQConstantsObj = new RabbitMQConstants();
            $data = json_decode($msg->body, true);

            $to_email   = $data['to_email'];
            $subject    = $data['subject'];
            $message    = $data['message'];
            
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername($RabbitMQConstantsObj->senderEmailID)
                ->setPassword($RabbitMQConstantsObj->senderPassword);
            
            $mailer = new Swift_Mailer($transport);

            
            $message = (new Swift_Message($subject))
                ->setFrom($RabbitMQConstantsObj->senderEmailID)
                ->setTo([$to_email])
                ->setBody($message);
            
            $result = $mailer->send($message);
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $channel->basic_consume($RabbitMQConstantsObj->queuename, '', false, false, false, false, $callback);

        $channel->basic_qos(null, 1, null);

        // while (count($channel->callbacks)) {
        //     $channel->wait();
        // }
    }
}