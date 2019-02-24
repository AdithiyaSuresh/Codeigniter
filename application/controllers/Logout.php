<?php

//logout.php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Logout extends CI_Controller 
    {
        public function logoff()
        {
            session_start();

            session_destroy();

            header("location:http://localhost/codeigniter/AngularJs/index.php");
        }
    }

?>