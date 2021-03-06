
<?php

include "/var/www/html/codeigniter/application/Rabbitmq/sender.php";
include "/var/www/html/codeigniter/application/static/LinkConstants.php";
include "JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";

use \Firebase\JWT\JWT;
// use Predis\Client as PredisClient;

class LoginService extends CI_Controller
{
    private $connect;
    public $constants = "";
    public static $emailid = "";

    public function __construct()
    {
        parent::__construct();
        $this->constants = new LinkConstants();
       
    }

    /**
     * @method selectDb() to login in to fundo logic
     * @return void
     */
    public function selectDb($email,$password)
    {
        $flag = $this->isPresentRegistered($email,$password);
       

        if ($flag == 1) 
        {
            $query = "SELECT firstname,id FROM registeruser WHERE email = '$email'"; 
            $statement = $this->db->conn_id->prepare($query);
            $statement->execute();
            $arr = $statement->fetch(PDO::FETCH_ASSOC);
            $firstname = $arr['firstname'];
            $id = $arr['id'];

            $secret_key = "abc";

            $data = array(
                "firstname" => $firstname,
                "email" => $email,
                "id" => $id
            );

            $token = JWT::encode($data, $secret_key);

       
        
            $connection = new Redis();
            $client = $connection->connection();

            $client->set('token', $token );
            $response = $client->get('token');

            $data = array(
                "token"   => $token,
                "message" => "400",
            );
            print json_encode($data);
            return "400";


        } else if ($flag == 2) {
            $data = array(
                "message" => "401",
            );
            print json_encode($data);
            return "401";

        } else if ($flag == 3) {
            $data  = array(
                "message" => "200",
            );
            print json_encode($data);
            return "200";

        } 
        return $data;
    }
    
    /**
     * @method isPresentRegistered() check email and password match
     * @return void
     */
    public function isPresentRegistered($email,$password)
    {
        $data[':email'] = $email;
        $query     = "SELECT * FROM registeruser WHERE email = '$email'";
        $statement = $this->db->conn_id->prepare($query);
        if($statement->execute($data))
        {
            $result = $statement->fetchAll();
            if($statement->rowCount() > 0)
            {
                //looping over the row and verifying password
                foreach($result as $row)
                {
                    if(password_verify($password, $row["password"]))
                    {
                        return 1;
                    }
                    else
                    {
                        return 2;
                    }
                }
            }
            else
            {
                return 3;
            }
            
        }
    }

    /**
     * @method forgotPassword() to send reset password link to registered mail
     * @return void
     */
    public function forgotPassword($email)
    {
        if (LoginService::checkEmail($email)) {
            $ref       = new SendMail();
            $token     = md5($email);
            $query     = "UPDATE registeruser SET reskey = '$token' where email = '$email'";
            $statement = $this->db->conn_id->prepare($query);
            $statement->execute();
            $sub      = 'password recovery mail';
            $body     = $this->constants->resetLinkMesssage.$this->constants->resetLink.$token;
            $response = $ref->sendEmail($email, $sub, $body);
            if ($response == "sent") {
                $data = array(
                    "message" => "200",
                );
                print json_encode($data);
                return "200";

            } else {
                $data = array(
                    "message" => "400",
                );
                print json_encode($data);
                return "400";

            }

        } else {
            $data = array(
                "message" => "404",
            );
            print json_encode($data);
            return "404";
        }
            
    }

    /**
     * @method checkEmail() check email is present
     * @return void
     */
    public function checkEmail($email)
    {
        $query     = "SELECT * FROM registeruser ORDER BY id";
        $statement = $this->db->conn_id->prepare($query);
        $statement->execute();
        $arr = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $Data) {
            if ($Data['email'] == $email) 
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @method getEmailId() to get the email id to reset password
     * @return void
     */
    public function getEmailId($token)
    {
        $query     = "SELECT email FROM registeruser where reskey='$token'";
        $statement = $this->db->conn_id->prepare($query);
        $statement->execute();
        $arr = $statement->fetch(PDO::FETCH_ASSOC);
        if ($arr) 
        {
            $data = array(
                'key'     => $arr['email'],
                'session' => 'active',
            );
            print json_encode($data);
            
        } 
        else 
        {
            $data = array(
                'key'     => "\n",
                'session' => 'reset link has been expired',
            );
            print json_encode($data);
            //return "reset link has been expired";
        }
        return $data;

    }

    /**
     * @method resetPassword() resets the pass word of corresesponding email
     * @return void
     */
    public function resetPassword($token, $password)
    {
        $query     = "UPDATE registeruser SET reskey = '$token' where reskey='$token'";
        $statement = $this->db->conn_id->prepare($query);
        $statement->execute();
        $query     = "UPDATE registeruser SET password = '$password' where reskey='$token'";
        $statement = $this->db->conn_id->prepare($query);
        $statement->execute();
        $query     = "SELECT reskey FROM registeruser where  password = '$password'";
        $statement = $this->db->conn_id->prepare($query);
        $statement->execute();
        $arr = $statement->fetch(PDO::FETCH_ASSOC);
        if ($arr['reskey'] == null) {
            $data = array(
                "message" => "304",
            );
            print json_encode($data);
            return "304";
        } 
        else
        {
            $data = array(
                "message" => "200",
            );
            print json_encode($data);
        
            $query     = "UPDATE registeruser SET reskey = null where reskey='$token'";
            $statement = $this->db->conn_id->prepare($query);
            $statement->execute();
            return "200";
        }
    }

    public function socialLogin($email,$name,$image){
        $emailExists = LoginService::checkEmail($email);
        $connection = new Redis();
        $conn = $connection->connection();

        $key = "abc";

        if($emailExists){
            $query = "SELECT * FROM registeruser where email ='$email'";
            $stmt = $this->db->conn_id->prepare($query);
            $stmt->execute();
            $arr = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $arr['id'];
            $resarr  = array(
                "email"=>$email,
                "firstname"=>$name,
                "image"=>$image,
                "id"=>$id
                
            );
            $token = JWT::encode($resarr,$key);


            $connection = new Redis();
            $client = $connection->connection();

            $client->set('token', $token );
            $response = $client->get('token');

            $data  = array(
                "token"   => $token,
                "message" => "200",
            );
            print json_encode($data);
        }else
        {
            $uid = uniqid();
            $query = "INSERT into registeruser (userid,firstname,email) values ('$uid','$name','$email')";

            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
            $arr = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $arr['id'];
            if($res)
            {
                $resarr  = array(
                     "email"=>$email,
                     "firstname"=>$name,
                     "image"=>$image,
                    "id"=>$id
                    
                );
                $token = JWT::encode($resarr,$key);

            $connection = new Redis();
            $client = $connection->connection();

            $client->set('token', $token );
            $response = $client->get('token');

                $data  = array(
                    "token"=>$token,
                    "message" => "200",
                );
                print json_encode($data);
            }
            else{
                $data  = array(
                    "message" => "204",
                );
                print json_encode($data);
            
            }
        }
    }
}

?>