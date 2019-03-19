<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '/var/www/html/codeigniter/application/service/NotesService.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization");


    class Note extends CI_Controller 
    {
        private $noteService = "";

        public function __construct()
        {
            parent::__construct();
            $this->noteService = new NoteService();
        }

    
        
        public function addNote()
        {
            $title = $_POST['title'];
            $noteContent = $_POST['noteContent'];
            $email = $_POST['email'];
            return $this->noteService->addNote($title,$noteContent,$email);
        }
         
        public function displayNote()
        {
            $email = $_POST['email'];
            return $this->noteService->displayNote($email);
        }

        public function delNote()
        {
            $id = $_POST['id'];
            return $this->noteService->delNote($id);
        }
    }
        
?>
