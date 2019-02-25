
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class to handle the Product's ProductModel 
 * also act as a controller extends ci controller
 *      
 */
class Register_model extends CI_Model
{
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    public function execute($name,$email,$password)
    {
         //query to insert data
         $query = "INSERT INTO register (name, email, password) VALUES ('$name', '$email', '$password')";
            
         //retruns a boolean value
         $statement = $this->db->query($query);
         return $statement;
    }
}