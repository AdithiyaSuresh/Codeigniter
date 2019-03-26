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
            $date = $_POST['date'];
            $color = $_POST['color'];
            return $this->noteService->addNote($title,$noteContent,$email,$date,$color);
        }
         
        public function displayNote()
        {
            $id = $_POST['id'];
            return $this->noteService->displayNote($id);
        }

        public function delNote()
        {
            $id = $_POST['id'];
            return $this->noteService->delNote($id);
        }
    }
        
?>
