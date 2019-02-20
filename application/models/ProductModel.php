<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class to handle the Product's ProductModel 
 * also act as a controller extends ci controller
 *      
 */
class ProductModel extends CI_Model
{
    /**
     * function to return the data of all the Products from database 
     * @param empty
     * @return void
     */
    public function findall()
    {
       $data = $this->db->query("SELECT * FROM product ")->result();
        foreach ($data as $record) {
            print_r($record->id."   ");
            print_r($record->name."   ");
            print_r($record->price."   ");
            print_r($record->quantity."</br>");
        }
    }
   
    /**
     * function to return the data of all the Product from database 
     * @param  id integer value of user id
     * @return data user data of user 
     */
    public function find($id)
    {
       $data =  $this->db->query("SELECT * FROM product WHERE id = '$id'")->row(); 
        // $this->db->where('id',$id);
        // return $this->db->get('product')->row();
        return $data;
    }

    /**
     * function to insert Product in the database as a new entry in the database
     * @param data new product data
     * @return void return void and trigger query run function
     */
    public function insert($data)
    {
        print_r($data);
        $id = $data[0];
        $name = $data[1];
        $price = $data[2];
        $quantity = $data[3];
        $query = $this->db->query("INSERT INTO product (id,name,price,quantity) VALUES ('" . $id . "','" . $name . "'," . $price . "," . $quantity . ")");
        
        //return void and trigger query run function
        ProductModel::queryRun($query);        
    }

    /**
     * function to update Product details of a saved Product
     * @return void return void and trigger query run function
     */
    public function update($id,$data)
    {
        print_r($data);
        $name = $data[0];
        $price = $data[1];
        $quantity = $data[2];
        $query = $this->db->query("UPDATE product SET name='".$name."', price='".$price."', quantity='".$quantity."' where id='".$id ."'");
        
        //return void and trigger query run function
        ProductModel::queryRun($query); 
    }

    /**
     * funciton to delete user from the data base by id 
     * @param empty
     * @return void
     */
    public function delete($id)
    {
        $query = $this->db->query("DELETE from product where id='".$id ."'  ");
        //return void and trigger query run function
        ProductModel::queryRun($query);
    }

    /**
     * function to run query and return status to the user
     * @param res 
     * @return void
     */
    public function queryRun($res)
    {
        //prints the json data of the sql query 
        if (is_bool($res))
            echo json_encode(array("status" => 200, "message" => "succes"), JSON_PRETTY_PRINT);
        else
            echo json_encode(array("status" => 200, "message" => "fail"), JSON_PRETTY_PRINT);
        
    }
}
?>