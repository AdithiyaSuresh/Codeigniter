<?php

/**
 * Login controller 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/LoginService.php';  
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");

    /**
     * class Login that extends CI_Controller
     */
    class Login extends CI_Controller 
    {
        private $logService = "";

        public function __construct()
        {
            parent::__construct();
            $this->logService = new LoginService();
        }

        /**
         * function signin
         * @param empty
         * @return void
         */
        public function signin()
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            return $this->logService->selectDb($email,$password);
        }

        public function forgot()
        {
            
        }
       

    }
?>
