
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
            $image = $_POST['image'];
            $res =  $this->noteService->addNote($title,$noteContent,$email,$date,$color,$image);
            return $res;
        }
         
        public function displayNote()
        {
            $id = $_POST['id'];
            $resd = $this->noteService->displayNote($id);
            return $resd;
        }

        public function changeColor()
        {
            $id = $_POST['id'];
            $colour = $_POST['colour'];
            $string = $_POST['string'];
            $resc = $this->noteService->changeColor($id,$colour,$string);
            return $resc;
        }

        public function editNote()
        {
            $id = $_POST['id'];
            $Title = $_POST['Title'];
            $noteContent = $_POST['noteContent'];
            $date = $_POST['date'];
            $color = $_POST['color'];
            return $this->noteService->editNote($id,$Title,$noteContent,$date,$color);
        }

        public function changeDate()
        {
            $id = $_POST['id'];
            $currentDateAndTime = $_POST['currentDateAndTime'];
            return $this->noteService->changeDate($id,$currentDateAndTime);
        }

        public function archive()
        {
            $id = $_POST['id'];
            $resa = $this->noteService->archive($id);
            return $resa;
        }

        public function delNote()
        {
            $id = $_POST['id'];
            $resd = $this->noteService->delNote($id);
            return $resd;
        }

        public function addUImageNote()
        {
            $image = $_POST['image'];
            $id = $_POST['id'];
            $this->noteService->addUImageNote($image,$id);
        }

        public function pinNotes()
        {
            $id = $_POST['id'];
            $n = $_POST['n'];
            $this->noteService->pinNotes($id,$n);
        }

    }
        
?>
