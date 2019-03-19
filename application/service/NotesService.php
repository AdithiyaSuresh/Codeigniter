
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


    public function addNote($title,$noteContent,$email)
    {
        $data = [
            'title' => $title,
            'noteContent' => $noteContent,
            'email' => $email
        ];
        // $client = new Predis\Client(array(
        //     'host' => '127.0.0.1',
        //     'port' => 6379,
        //     'password' => 'this123@'
        //   ));

        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
        
        
            $query = "INSERT into addnote (title,noteContent,email) values ('$title','$noteContent','$email')";
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

    public function displayNote($email)
    {
        $query = "SELECT * from addnote WHERE email = '$email' ORDER BY id DESC ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($arr as $notes)
        {
            $title = $notes['title'];
            $noteContent = $notes['noteContent'];
        }
        print json_encode($arr);
    }

    public function delNote($id)
    {
        $query = "DELETE from addnote WHERE id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
    }

}
?>