
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/TrashService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");

class Trash extends CI_Controller
{
    private $trashService = "";
    /**
     * @description create an instance of service methods
     */
    public function __construct()
    {
        parent::__construct();
        $this->trashService = new TrashService();
    }
    public function fetchTrash(){
        $uid =  $_POST['uid'];
        $this->trashService->fetchTrash($uid);
    }
    public function delete(){
        $uid = $_POST['uid'];
        $this->trashService->delete($uid);
    }
}