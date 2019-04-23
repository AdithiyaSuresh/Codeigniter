<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/LabelService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");
// include "/var/www/html/codeigniter/application/service/JWT.php";
// include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
// include "/var/www/html/codeigniter/application/controllers/Redi.php";

//use \Firebase\JWT\JWT;

class Label extends CI_Controller
{
   private $labelserv = "";
    /**
     * @description create an instance of service methods
     */
    public function __construct()
    {
        parent::__construct();
        $this->labelserv = new LabelService();
        //$this->load->library('doctrine');

       
    }

    public function addLabels(){
         $uid = $_POST['uid']; 
         $label = $_POST['label'];
         $noteid = $_POST['noteid'];
        //  $em = $this->doctrine->em;
         $this->labelserv->addLabels($uid,$label,$noteid);

        // $connection = new Redi();
        // $client = $connection->connection();
        // $token = $client->get('token');
        // $arr = array('HS256', 'HS384', 'HS512','RS256');
        // $secret_key = "abc";
        // $payload = JWT::decode($token,$secret_key,$arr);
        // $uid = $payload->id;

        // $group = new Entity\LabelModel;

        // $group->setLabelName($label);
        // $group->setUserId($uid);

        // $em = $this->doctrine->em;
        //         $em->persist($group);
        // $em->flush();

    }

    public function getLabel()
    {
        $uid = $_POST['uid'];
        return $this->labelserv->getLabel($uid);
    //    $em = $this->doctrine->em;
    //    $query = $em->createQuery("SELECT u.id,u.userId,u.labelname FROM \Entity\LabelModel u WHERE u.userId = '$uid'");
    //    $users = $query->getResult();
    //    print json_encode($users);
    }

    public function deletelname()
    {
        $id = $_POST['id'];
        return $this->labelserv->deletelname($id);
    }

    public function addLtoN()
    {
        $note_id = $_POST['note_id'];
        $label_id = $_POST['label_id'];
        $this->labelserv->addLtoN($note_id,$label_id);
    }

    public function labelNoteDis()
    {
        $id = $_POST['id'];
        $this->labelserv->labelNoteDis($id);
    }
}