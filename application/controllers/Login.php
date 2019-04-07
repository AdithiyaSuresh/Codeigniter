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
        /**
         * @var string $logService LoginService
         */
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
            $res = $this->logService->selectDb($email,$password);
            return $res;
        }

        /**
         * @method forgot() sending resetting password ink to registered mail
         * @return void
         */
        public function forgot()
        {
            $email = $_POST['email'];
            return $this->logService->forgotPassword($email);
        }

        /**
         * @method getEmailId() to get the email id for resetting
         * @return void
         */
        public function getEmailId()
        {
            $token = $_POST['token'];
            return $this->logService->getEmailId($token);
        }

        /**
         * @method resetPassword() resets the password of corresesponding email
         * @return void
         */
        public function resetPassword()
        {
            $token = $_POST["token"];
            $password  = $_POST["password"];
            $password = password_hash($password, PASSWORD_DEFAULT);
            return $this->logService->resetPassword($token, $password);

        }
        
        public function socialLogin()
        {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $this->logService->socialLogin($email,$name);
        }
       
    }
?>
