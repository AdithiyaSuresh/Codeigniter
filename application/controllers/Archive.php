
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/ArchiveService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");

class Archive extends CI_Controller
{
    private $archService = "";
    /**
     * @description create an instance of service methods
     */
    public function __construct()
    {
        parent::__construct();
        $this->archService = new ArchiveService();
    }
    public function fetcharchive(){
        $uid =  $_POST['uid'];
        $this->archService->archivednotes($uid);
    }
    public function unarchive(){
        $uid = $_POST['uid'];
        $this->archService->archive($uid);
    }
}