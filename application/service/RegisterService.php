
<?php
class RegisterService extends CI_Controller
{
    private $connect;
    public function __construct()
    {
        parent::__construct();
       
    }



    public function insertDb($fname,$lname,$email,$password)
    {
        $flag = $this->isEmailPresent($email);
        if($flag == 0)
        {
            $data = [
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email,
                'password'=>$password
            ];
            $query = "INSERT into registeruser (firstname,lastname,email,password) values ('$fname','$lname','$email','$password')";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute($data);
        // return $res;

            if ($res) 
            {
                $result = array(
                    "message" => "200",
                );
                print json_encode($result);
                return "200";
            } 
            else 
            {
                $result = array(
                    "message" => "204",
                );
                print json_encode($result);
                return "204";

            }

            return $result;
        }
        else 
        {
            $result = array(
                "message" => "205",
            );
            print json_encode($result);
            return "205";
        }

    }

    public function isEmailPresent($email)
    {
        $query = "SELECT * FROM registeruser ORDER BY email";
        $statement = $this->db->conn_id->prepare($query);
        $statement->execute();
        $arr = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $titleData) 
        {
            if (($titleData['email'] == $email)) 
            {
                return 1;
            }
        }
        
            //no duplicate not found
            return 0;
           

    }
}
?>