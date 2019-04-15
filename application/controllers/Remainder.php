
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/RemainderService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");


    class Remainder extends CI_Controller 
    {
        private $remainderService = "";

        /**
         * @description create an instance of service methods
         */
        public function __construct()
        {
            parent::__construct();
            $this->remainderService = new RemainderService();
        }

        public function fetchReminder()
        {
            $uid = $_POST['uid'];
            return $this->remainderService->fetchReminder($uid);
        }
    }
        
?>
