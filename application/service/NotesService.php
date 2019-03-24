
<?php
include "JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";


use \Firebase\JWT\JWT;

    class NoteService extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
        }


    public function addNote($title,$noteContent,$email,$date)
    {
        $data = [
            'title' => $title,
            'noteContent' => $noteContent,
            'email' => $email,
            'date' =>$date
        ];
        // $client = new Predis\Client(array(
        //     'host' => '127.0.0.1',
        //     'port' => 6379,
        //     'password' => 'this123@'
        //   ));

        if($date=="undefined")
        {
            $date = "";
        }

        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $id = $payload->id;

        if(JWT::jverify($token))
        {

            $query = "INSERT into addnote (userid,title,noteContent,email,date) values ('$id','$title','$noteContent','$email','$date')";
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
        }
    }

    public function displayNote($id)
    {
        $query = "SELECT * from addnote WHERE userid = '$id' ORDER BY id DESC ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($arr as $notes)
        {
            $title = $notes['title'];
            $noteContent = $notes['noteContent'];
            $date = $notes['date'];
        }
        print json_encode($arr);
    }

    public function delNote($id)
    {
        $query = "DELETE from addnote WHERE id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
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
    }

}
?>