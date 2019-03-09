
<?php
include "/var/www/html/codeigniter/application/Rabbitmq/sender.php";
include "/var/www/html/codeigniter/application/static/LinkConstants.php";

class LoginService extends CI_Controller
{
    private $connect;
    public $constants = "";

    public function __construct()
    {
        parent::__construct();
        $this->constants = new LinkConstants();
       
    }

    public function selectDb($email,$password)
    {
        $flag = $this->isPresentRegistered($email,$password);

        if ($flag == 1) {
            $data = array(
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
            // foreach ($arr as $titleData) 
            // {
            //     if (($titleData['email'] == $email) && (password_verify($password,$titleData['password']))) 
            //     {
            //         return 1;
            //     }
            //     else if (($titleData['email'] == $email) && (!(password_verify($password,$titleData['password'])))) 
            //     {
            //         return 2;
            //     } 
            //     else if (($titleData['email'] != $email) && (password_verify($password,$titleData['password']))) 
            //     {
            //         return 3;
            //     }
            // }
            // return 0;
        }
    }

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

}

?>