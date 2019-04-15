
<?php

include "JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";

    class RemainderService extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function fetchReminder($uid)
        {
            $query = "SELECT * from addnote Where userid ='$uid' AND date <> '' and archive != '1' and trash != '1' ORDER BY id DESC";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($arr as $notes)
            {
                $title = $notes['title'];
                $noteContent = $notes['noteContent'];
                $date = $notes['date'];
                $color = $notes['color'];
                $image = $notes['image'];
            }
            print json_encode($arr);
        }

    // public function addRemainder($title,$noteContent,$email)
    // {
    //     $data = [
    //         'title' => $title,
    //         'noteContent' => $noteContent,
    //         'email' => $email
    //     ];

    //     $query = "INSERT into remainder (title,noteContent,email) values ('$title','$noteContent','$email')";
    //     $stmt = $this->db->conn_id->prepare($query);
    //     $res = $stmt->execute($data);
    //    // return $res;

    //     if ($res) 
    //     {
    //         $result = array(
    //             "message" => "200",
    //         );
    //         print json_encode($result);
    //         return "200";
    //     } 
    //     else 
    //     {
    //         $result = array(
    //             "message" => "204",
    //         );
    //         print json_encode($result);
    //         return "204";

    //     }

    // }

    // public function displayRemainder($email)
    // {
    //     $query = "SELECT * from remainder WHERE email = '$email' ORDER BY id DESC ";
    //     $stmt = $this->db->conn_id->prepare($query);
    //     $res = $stmt->execute();
    //     $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($arr as $notes)
    //     {
    //         $title = $notes['title'];
    //         $noteContent = $notes['noteContent'];
    //     }
    //     print json_encode($arr);
    // }

    // public function deleteRemainder($id)
    // {
    //     $connection = new Redis();
    //     $client = $connection->connection();
    //     $token = $client->get('token');
    //     $arr = array('HS256', 'HS384', 'HS512','RS256');
    //     $secret_key = "abc";
    //     $payload = JWT::decode($token,$secret_key,$arr);
    //     $id = $payload->id;

    //     $query = "DELETE from remainder WHERE id = '$id'";
    //     $stmt = $this->db->conn_id->prepare($query);
    //     $res = $stmt->execute();
    //     if ($res) 
    //     {
    //         $result = array(
    //             "message" => "200",
    //         );
    //         print json_encode($result);
    //         return "200";
    //     } 
    //     else 
    //     {
    //         $result = array(
    //             "message" => "204",
    //         );
    //         print json_encode($result);
    //         return "204";

    //     }
    // }
}
?>