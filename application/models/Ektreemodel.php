<?php
class Ektreemodel extends CI_Model
{
   public function insert_form($request)
   {
      $insertStatus=$this->db->insert('registration',array('firstName'=>$request['firstname'],'lastname'=>$request['lastname'],'emailid'=>$request['email'],'password'=>$request['password']));
      return $insertStatus;
   }
}
?>