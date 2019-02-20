<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EmpModel extends CI_Model{
    public function viewall(){
        return $this->db->get('emp')->result();
    }
}
?>