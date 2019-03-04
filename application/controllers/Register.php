<?php

/**
 * Register controller 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * class Register that extends CI_Controller
     */
    class Register extends CI_Controller 
    {
        public function __construct(){
            parent::__construct();
        }
    
        /**
         * function signup
         * @param empty
         * @return void
         */
        public function signup()
        {
        
        //initializing variables
        $fname = $_POST['firsname'];
        $name = "";
        $password = "";
        $email = "";
        
        // include('database_connection.php');
        $form_data = json_decode(file_get_contents("php://input"));

        //initializing message and validation error
        $message = '';
        $validation_error = '';

        //validating name
        if(empty($form_data->name))
        {
            $error[] = 'Name is Required';
        }
        else
        {
            //$data[':name'] = $form_data->name;
            $name = $form_data->name;
        }

        //validating email
        if(empty($form_data->email))
        {
            $error[] = 'Email is Required';
        }
        else
        {
            //validating email format
            if(!filter_var($form_data->email, FILTER_VALIDATE_EMAIL))
            {
                $error[] = 'Invalid Email Format';
            }
            else
            {
                //$data[':email'] = $form_data->email;
                $email = $form_data->email;
            }
        }

        //validating password
        if(empty($form_data->password))
        {
            $error[] = 'Password is Required';
        }
        else
        {
           // making password in encrytpted form
            $password = password_hash($form_data->password, PASSWORD_DEFAULT);
        }

        //if no error enters inside
        if(empty($error))
        {
            // //query to insert data
            // $query = "INSERT INTO register (name, email, password) VALUES ('$name', '$email', '$password')";
            
            // //retruns a boolean value
            // $statement = $this->db->query($query);
           
            //if true enters inside
            $this->load->model('Register_model');
            $statement =  $this->Register_model->execute($name,$email,$password);
            //var_dump($statement); 
            if($statement)
            {
            $message = 'Registration Completed';
            }
        }
        //if error is not empty
        else
        {
            $validation_error = implode(", ", $error);
        }

        $output = array(
        'error'  => $validation_error,
        'message' => $message
        );

        //pritning output json string
        echo json_encode($output);

        }
    }
?>
