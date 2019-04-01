
<?php

defined('BASEPATH') or exit('No direct script access allowed');
include "JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";

use \Firebase\JWT\JWT;

class TrashService extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function fetchTrash($uid){
        $query = "SELECT * from addnote Where userid ='$uid' AND trash = '1' ORDER BY id DESC ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($arr);
    }
    
    public function delete($uid){
        $query = "DELETE FROM addnote WHERE id = '$uid'";
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
}