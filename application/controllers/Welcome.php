<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	// public function addtion()
	// {
	// 	echo "addton";
	// }

	// public function sub()
	// {
	// 	echo "sub";
	// }
	
	public function add()
	{
		//$this->load->model('ektreemodel');
		$request= json_decode(file_get_contents('php://input'), TRUE);
		$data1=$this->Ektreemodel->insert_form($request);
		$this->fetchdata();   
	}
	
	public function fetchdata()
	{
		// $data['fetchdata']=$this->ektreemodel->get_users();
		// $this->load->view('fetchangulardata',$data);
		$result=$this->db->get('registration')->result();
		$arr_data=array();
		$i=0;
		foreach($result as $row)
		{
			$arr_data[$i]['user_id']=$row->user_id;
			$arr_data[$i]['firstname']=$row->firstname;
			$arr_data[$i]['lastname']=$row->lastname;
			$arr_data[$i]['emailid']=$row->emailid;
		$i++;  
		}
		
		echo json_encode($arr_data);
		
	
	}

		
}

