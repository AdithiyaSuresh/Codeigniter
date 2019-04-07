<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/LabelService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");

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
    }

    public function addLabels(){
        $uid = $_POST['uid']; 
        $label = $_POST['label'];
        $this->labelserv->addLabels($uid,$label);
    }

    public function getLabel()
    {
        $uid = $_POST['uid'];
        return $this->labelserv->getLabel($uid);
    }
}