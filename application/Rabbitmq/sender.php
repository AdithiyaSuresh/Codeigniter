
<?php
require_once '/var/www/html/codeigniter/application/Rabbitmq/vendor/autoload.php';
include "/var/www/html/codeigniter/application/Rabbitmq/receiver.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * @method sendEmail()
 * @var connection creates the AMPQSTREAMconnection
 * @return void
 */
class SendMail
{

    public function sendEmail($toEmail, $subject, $body)
    {
        
        $RabbitMQConstantsObj = new RabbitMQConstants();
        
        $connection = new AMQPStreamConnection($RabbitMQConstantsObj->host,$RabbitMQConstantsObj->port,$RabbitMQConstantsObj->username,$RabbitMQConstantsObj->password);
        $channel    = $connection->channel();
        
        $channel->queue_declare($RabbitMQConstantsObj->queuename, false, false, false, false);
       
        $data = json_encode(array(
            "from"       => $RabbitMQConstantsObj->senderEmailID,
            "from_email" => $RabbitMQConstantsObj->senderEmailID,
            "to_email"   => $toEmail,
            "subject"    => $subject,
            "message"    => $body,
        ));

        $msg = new AMQPMessage($data, array('delivery_mode' => 2));

        $channel->basic_publish($msg, '',$RabbitMQConstantsObj->queuename );
        
        $obj = new Receiver();

        $obj->receiverMail();
        $channel->close();
        $connection->close();
        return "sent";
    }
}