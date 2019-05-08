
<?php

defined('BASEPATH') or exit('No direct script access allowed');
include "JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";
include_once "/var/www/html/codeigniter/application/service/NotesService.php";

use \Firebase\JWT\JWT;

class ArchiveService extends CI_Controller
{
    public $client = "";
    public $class;
    public function __construct()
    {
        parent::__construct();
        $this->class = new NoteService();
        $this->client = $this->class->client;
    }

    public function archivednotes($uid)
    {
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "SELECT * from addnote Where userid ='$uid' AND archive = '1' ORDER BY id DESC ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($arr);
    }
    
    public function archive($id)
    {
        $token = $this->client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $uid = $payload->id;

        $query = "UPDATE addnote SET archive = '0'  where id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        if ($res) 
        {
            $this->client->del('notes_'.$uid);
            $data = array(
                "status" => "200",
            );
            return "200";
            print json_encode($data);
        } else {
            $data = array(
                "status" => "204",
            );
            print json_encode($data);
            return "204";
        }
        return $data;
    }
}