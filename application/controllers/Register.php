<?php

/**
 * Register controller 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/RegisterService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");

    /**
     * class Register that extends CI_Controller
     */
    class Register extends CI_Controller 
    {
        private $refService = "";

        public function __construct()
        {
            parent::__construct();
            $this->refService = new RegisterService();
        }

    
        /**
         * function signup
         * @param empty
         * @return void
         */
        public function signup()
        {
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $res = $this->refService->insertDb($fname,$lname,$email,$password);
            return $res;
        }
    }
        
?>
