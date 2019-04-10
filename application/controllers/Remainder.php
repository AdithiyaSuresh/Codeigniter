
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/RemainderService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");


    class Remainder extends CI_Controller 
    {
        private $remainderService = "";

        public function __construct()
        {
            parent::__construct();
            $this->remainderService = new RemainderService();
        }

    
        
        public function addRemainder()
        {
            $title = $_POST['title'];
            $noteContent = $_POST['noteContent'];
            $email = $_POST['email'];
            return $this->remainderService->addRemainder($title,$noteContent,$email);
        }
         
        public function displayRemainder()
        {
            $email = $_POST['email'];
            return $this->remainderService->displayRemainder($email);
        }

        public function deleteRemainder()
        {
            $id = $_POST['id'];
            return $this->remainderService->deleteRemainder($id);
        }
        
    }
        
?>
