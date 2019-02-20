<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Demo extends CI_Controller {
    public function index(){
        $this->load->view('index');
    }
   
    public function hi($name){
        $data['result'] = 'hi '.$name;
        $this->load->view('index',$data);
    }
}
?>