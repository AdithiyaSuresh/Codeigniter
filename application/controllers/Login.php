<?php


//login.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
    public function signin()
    {
        //include('database_connection.php');
        //session_start();
        $form_data = json_decode(file_get_contents("php://input"));
        var_dump($form_data);
        $validation_error = '';
        
        if(empty($form_data->email))
        {
            $error[] = 'Email is Required';
        }
        else
        {
            if(!filter_var($form_data->email, FILTER_VALIDATE_EMAIL))
            {
                $error[] = 'Invalid Email Format';
            }
            else
            {
                $data[':email'] = $form_data->email;
            }
        }
        
        if(empty($form_data->password))
        {
            $error[] = 'Password is Required';
        }
        
        if(empty($error))
        {
            $query = "SELECT * FROM register WHERE email = '$form_data->email'";
            $statement = $this->db->query($query);
            $statement = $this->db->prepare($query);
            print "\n";
            var_dump($data);

           // $res = $this->db->query($query);
            print "\n";
            print "\n";
            var_dump($statement);
            //exit;
            if($statement->execute($data))
            {
                $result = $statement->fetchAll();
                if($statement->rowCount() > 0)
                {
                    foreach($result as $row)
                    {
                        if(password_verify($form_data->password, $row["password"]))
                        {
                            $_SESSION["name"] = $row["name"];
                        }
                        else
                        {
                            $validation_error = 'Wrong Password';
                        }
                    }
                }
                else
                {
                    $validation_error = 'Wrong Email';
                }
            }
        }
        else
        {
            $validation_error = implode(", ", $error);
        }
        
        $output = array(
        'error' => $validation_error
        );
        
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
