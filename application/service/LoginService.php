
<?php

class LoginService extends CI_Controller
{
    private $connect;
    public function __construct()
    {
        parent::__construct();
       
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
}

?>