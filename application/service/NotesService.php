
<?php
include "JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";
include "/var/www/html/codeigniter/application/service/LabelService.php";
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");

use \Firebase\JWT\JWT;

    class NoteService extends CI_Controller
    {
        public $client = "";
        public $connection = "";
        public function __construct()
        {
            parent::__construct();
            $this->connection = new Redis();
            $this->client = $this->connection->connection();
        }


    public function addNote($title,$noteContent,$email,$date,$color,$image,$label)
    {
        $data = [
            'title' => $title,
            'noteContent' => $noteContent,
            'email' => $email,
            'date' => $date,
            'color' => $color,
            'image' => $image,
            'label' => $label
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

        // $connection = new Redis();
        // $client = $connection->connection();
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        if(JWT::jverify($token))
        {

            $query = "INSERT into addnote (userid,title,noteContent,email,date,color,image) values ('$uid','$title','$noteContent','$email','$date','$color','$image')";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute($data);
            // return $res;

            if ($res) 
            {
                $uid;
                $this->client->del('notes_'.$uid);
                $result = array(
                    "message" => "200",
                );
                print json_encode($result);

                if($label != 'undefined')
                {
                    $query = "SELECT LAST_INSERT_ID()";
                    $statement = $this->db->conn_id->prepare($query);
                    $statement->execute();
                    $arr = $statement->fetch(PDO::FETCH_ASSOC);
                    $noteid = $arr['LAST_INSERT_ID()'];

                    $query = "SELECT id from label WHERE label = '$label'";
                    $statement = $this->db->conn_id->prepare($query);
                    $statement->execute();
                    $arr = $statement->fetch(PDO::FETCH_ASSOC);
                    $labelid = $arr['id'];
                    $labelobj = new LabelService();
                    $labelobj->addLtoN($noteid,$labelid);
                }

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
        // $connection = new Redis();
        // $client = $connection->connection();
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $id = $payload->id;

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

        $notes = $this->client->get('notes_'.$id);

        if($notes != "")
        {
            //$notes = $client->get('notes_'.$id);
            print $notes;
        }
        else
        {
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
           
            $array = json_encode($arr);  
            $this->client->set('notes_'.$id, $array); 
           //$notes =  $client->get($id);
            print $array;     
       }
        
    }

    public function changeColor($id,$colour,$string)
    {
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        if($string == 'color')
        {
            $query = "UPDATE addnote SET color = '$colour' WHERE id = '$id'";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
            if ($res) 
                {
                    $this->client->del('notes_'.$uid);
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
                    $this->client->del('notes_'.$uid);
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
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "UPDATE addnote SET title = '$Title',noteContent = '$noteContent',date = '$date',color = '$color' WHERE id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        if ($res) 
            {
                $this->client->del('notes_'.$uid);
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
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "UPDATE addnote SET date = '$currentDateAndTime' WHERE id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        if ($res) 
            {
                $this->client->del('notes_'.$uid);
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
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "UPDATE addnote SET archive = '1' where id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        if ($res) 
        {
            $this->client->del('notes_'.$uid);
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
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "UPDATE addnote SET trash = '1' where id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        if ($res) 
        {
            $this->client->del('notes_'.$uid);
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
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;
        //$query = "UPDATE registeruser SET image = '$image' WHERE id = '$uid'";
            
        $query = "UPDATE addnote SET image = '$image' WHERE id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        // return $res;

        if ($res) 
        {
            $this->client->del('notes_'.$uid);
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
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        if($n == 1)
        {
            $query = "UPDATE addnote SET pin = '1' where id = '$id'";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
            $this->client->del('notes_'.$uid);
        }
        elseif($n == 0)
        {
            $query = "UPDATE addnote SET pin = '0' where id = '$id'";
            $stmt = $this->db->conn_id->prepare($query);
            $res = $stmt->execute();
            $this->client->del('notes_'.$uid);
        }
        
        // $connection = new Redis();
        // $client = $connection->connection();
        // $token = $client->get('token');
        // $arr = array('HS256', 'HS384', 'HS512','RS256');
        // $secret_key = "abc";
        // $payload = JWT::decode($token,$secret_key,$arr);
        // $uid = $payload->id;

        // $query1 = "SELECT * from addnote Where userid ='$uid' AND pin = '1' ORDER BY id DESC ";
        // $stmt = $this->db->conn_id->prepare($query1);
        // $res = $stmt->execute();
        // $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print json_encode($arr);

        // $query1="SELECT email from notes where id='$id'";
        // $statement1 = $this->connect->prepare($query1);
        // $statement1->execute();
        // $email = $statement1->fetch();
        // $email=$email['email'];
  
        //     $reff      = new NotesControllerService();
        //     $reff->userNotes($email);
       
    }

    public function closeLabel($noteid,$label)
    {
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "SELECT id from label WHERE label = '$label'";
        $statement = $this->db->conn_id->prepare($query);
        $statement->execute();
        $arr = $statement->fetch(PDO::FETCH_ASSOC);
        $labelid = $arr['id'];

        $query = "DELETE from label_note WHERE note_id = '$noteid' and label_id = '$labelid'";
        $statement = $this->db->conn_id->prepare($query);
        $res = $statement->execute();
        if ($res) 
        {
            $this->client->del('notes_'.$uid);
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