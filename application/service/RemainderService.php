
<?php
    class RemainderService extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
        }


    public function addRemainder($title,$noteContent,$email)
    {
        $data = [
            'title' => $title,
            'noteContent' => $noteContent,
            'email' => $email
        ];

        $query = "INSERT into remainder (title,noteContent,email) values ('$title','$noteContent','$email')";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute($data);
       // return $res;

        if ($res) 
        {
            $result = array(
                "message" => "200",
            );
            print json_encode($result);
            return "200";
        } 
        else 
        {
            $result = array(
                "message" => "204",
            );
            print json_encode($result);
            return "204";

        }

    }

    public function displayRemainder($email)
    {
        $query = "SELECT * from remainder WHERE email = '$email' ORDER BY id DESC ";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($arr as $notes)
        {
            $title = $notes['title'];
            $noteContent = $notes['noteContent'];
        }
        print json_encode($arr);
    }

    public function deleteRemainder($id)
    {
        $query = "DELETE from remainder WHERE id = '$id'";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        if ($res) 
        {
            $result = array(
                "message" => "200",
            );
            print json_encode($result);
            return "200";
        } 
        else 
        {
            $result = array(
                "message" => "204",
            );
            print json_encode($result);
            return "204";

        }
    }
}
?>