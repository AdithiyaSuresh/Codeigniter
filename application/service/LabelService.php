
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
    public function addLabels($uid,$label)
    {
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
        $query = "SELECT * from label Where userid ='$uid' ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($arr);
        return $arr;
    }
}