
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


    public function addNote($title,$noteContent,$email,$date,$color,$image)
    {
        $data = [
            'title' => $title,
            'noteContent' => $noteContent,
            'email' => $email,
            'date' => $date,
            'color' => $color,
            'image' => $image
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

            $query = "INSERT into addnote (userid,title,noteContent,email,date,color,image) values ('$id','$title','$noteContent','$email','$date','$color','$image')";
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

        $query = "SELECT n.id,n.userid,n.title,n.noteContent,n.date,n.color,n.image,n.pin, l.label from addnote n Left JOIn label_note ln ON ln.note_id=n.id left JOIN label l on ln.label_id=l.id where n.userid = '$id' and archive = 0 and trash = 0 ORDER BY n.id DESC";
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
            $label = $notes['label'];
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

    public function changeColor($id,$colour,$string)
    {
        if($string == 'color')
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
        elseif($string == 'reminder')
        {
            $query = "UPDATE addnote SET date = '' WHERE id = '$id'";
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

    public function addUImageNote($image,$id)
    {
    
        //$query = "UPDATE registeruser SET image = '$image' WHERE id = '$uid'";
            
        $query = "UPDATE addnote SET image = '$image' WHERE id = '$id'";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
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

    public function pinNotes($id,$n)
    {
        if($n == 1)
        {
            $query = "UPDATE addnote SET pin = '1' where id = '$id'";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
        }
        elseif($n == 0)
        {
            $query = "UPDATE addnote SET pin = '0' where id = '$id'";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
        }
        
        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query1 = "SELECT * from addnote Where userid ='$uid' AND pin = '1' ORDER BY id DESC ";
        $stmt = $this->db->conn_id->prepare($query1);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($arr);

        // $query1="SELECT email from notes where id='$id'";
        // $statement1 = $this->connect->prepare($query1);
        // $statement1->execute();
        // $email = $statement1->fetch();
        // $email=$email['email'];
  
        //     $reff      = new NotesControllerService();
        //     $reff->userNotes($email);
       
     

    }


}
?>