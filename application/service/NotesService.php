
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


    public function addNote($title,$noteContent,$email,$date,$color)
    {
        $data = [
            'title' => $title,
            'noteContent' => $noteContent,
            'email' => $email,
            'date' => $date,
            'color' => $color
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

            $query = "INSERT into addnote (userid,title,noteContent,email,date,color) values ('$id','$title','$noteContent','$email','$date','$color')";
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
        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $id = $payload->id;

        $query = "SELECT * from addnote WHERE userid = $id and archive != '1' and trash != '1' ORDER BY id DESC ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($arr as $notes)
        {
            $title = $notes['title'];
            $noteContent = $notes['noteContent'];
            $date = $notes['date'];
            $color = $notes['color'];
        }

        // if ($res) 
        // {
        //     $result = array(
        //         "message" => "200",
        //     );
        //     print json_encode($result);
        //     return "200";
        // } 
        // else 
        // {
        //     $result = array(
        //         "message" => "204",
        //     );
        //     print json_encode($result);
        //     return "204";

        // }

        print json_encode($arr);
    }

    public function changeColor($id,$colour)
    {

        $query = "UPDATE addnote SET color = '$colour' WHERE id = '$id'";
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

    public function editNote($id,$Title,$noteContent,$date,$color)
    {
        
        $query = "UPDATE addnote SET title = '$Title',noteContent = '$noteContent',date = '$date',color = '$color' WHERE id = '$id'";
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

    public function changeDate($id,$currentDateAndTime)
    {

        $query = "UPDATE addnote SET date = '$currentDateAndTime' WHERE id = '$id'";
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

    public function archive($id)
    {
        $query = "UPDATE addnote SET archive = '1' where id = '$id'";
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

    public function delNote($id)
    {
        $query = "UPDATE addnote SET trash = '1' where id = '$id'";
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