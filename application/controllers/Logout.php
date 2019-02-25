<?php

/**
 * Logout controller 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * class Logout that extends CI_Controller
     */
    class Logout extends CI_Controller 
    {
        /**
         * function logoff
         * @param empty
         * @return void
         */
        public function logoff()
        {
            session_start();

            session_destroy();

            header("location:http://localhost/codeigniter/AngularJs/index.php");
        }
    }

?>