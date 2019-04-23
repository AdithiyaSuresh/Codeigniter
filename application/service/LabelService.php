
<?php

defined('BASEPATH') or exit('No direct script access allowed');
include "JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";

use \Firebase\JWT\JWT;

class LabelService extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function addLabels($uid,$label,$noteid)
    {
        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "INSERT into label (label,userid) values ('$label','$uid')";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
            if ($res) {
            $data = array(
                "status" => "200",
            );
            print json_encode($data);
        } else {
            $data = array(
                "status" => "204",
            );
            print json_encode($data);
            return "204";
        }
    }
    
    public function getLabel($uid)
    {
        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;
        
        $query = "SELECT * from label Where userid ='$uid' ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($arr);
        return $arr;
    }

    public function deletelname($id)
    {
        $query = "DELETE FROM label WHERE id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        if ($res) {
            $data = array(
                "status" => "200",
            );
            print json_encode($data);
        } else {
            $data = array(
                "status" => "204",
            );
            print json_encode($data);
            return "204";
        }
    }

    public function addLtoN($note_id,$label_id)
    {
        $query = "INSERT into label_note (note_id,label_id) values ('$note_id','$label_id')";

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

    public function labelNoteDis($id)
    {
        $query = "SELECT n.id,n.title,n.noteContent,n.date,n.color,n.image,n.pin,l.label from addnote n JOIN label_note ln ON ln.note_id=n.id JOIN label l on ln.label_id=l.id where l.id=$id";
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

        print json_encode($arr);
    }
}