
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

        if ($res) {
            $result = array(
                "message" => "200",
            );
            print json_encode($result);
            return "200";
        } else {
            $result = array(
                "message" => "204",
            );
            print json_encode($result);
            return "204";

        }

    }
}
    ?>