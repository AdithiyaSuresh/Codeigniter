<?php

/**
 * Login controller 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * class Login that extends CI_Controller
     */
    class Login extends CI_Controller 
    {
        public function __construct(){
            parent::__construct();
        }

        /**
         * function signin
         * @param empty
         * @return void
         */
        public function signin()
        {
            //session starts here
            session_start();
            $form_data = json_decode(file_get_contents("php://input"));
            //var_dump($form_data);
            $validation_error = '';
            
            //validation for email
            if(empty($form_data->email))
            {
                $error[] = 'Email is Required';
            }
            else
            {
                //validating email
                if(!filter_var($form_data->email, FILTER_VALIDATE_EMAIL))
                {
                    $error[] = 'Invalid Email Format';
                }
                else
                {
                    $data[':email'] = $form_data->email;
                }
            }
            
            //validation for password
            if(empty($form_data->password))
            {
                $error[] = 'Password is Required';
            }

            //if no eror enter inside
            if(empty($error))
            {
                $this->load->model('Login_model');
                $validation_error =  $this->Login_model->execute($form_data->email,$data,$form_data->password);
            }
            else
            {
                //if any errors storing it as string
                $validation_error = implode(", ", $error);
            }
            
            $output = array(
            'error' => $validation_error
            );
            
            //printing the output json string
            echo json_encode($output);
            
        }


        public function queryRun($query)
        {
            if (!($res = $this->db->query($query))) 
            {
                $error = $this->db->error(); // Has keys 'code' and 'message'
                echo json_encode(array("status" => 500, "message" => $error["message"]), JSON_PRETTY_PRINT);
            } 
            else 
            {
            //   var_dump($res);
                if (is_bool($res))
                    echo json_encode(array("status" => 200, "message" => "succes"), JSON_PRETTY_PRINT);
                else
                    echo json_encode(array("status" => 200, "message" => $res->result()), JSON_PRETTY_PRINT);
            }
        }

    }
?>
