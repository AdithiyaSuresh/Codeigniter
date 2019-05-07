
<?php


include '/var/www/html/codeigniter/application/service/JWT.php';
include_once '/var/www/html/codeigniter/application/service/RedisConn.php';

class RedisNote extends CI_Controller
{
    private $refService = "";

    /**
     * @description create an instance of service methods
     */
    public function __construct()
    {
        parent::__construct();
       
    }

    public function fetchNotes()
    {
        $id = $_POST['id'];

        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
        $arr = array('HS256', 'HS384', 'HS512','RS256');
        $secret_key = "abc";
        $payload = JWT::decode($token,$secret_key,$arr);
        $id = $payload->id;

        $query = "SELECT n.id,n.userid,n.title,n.noteContent,n.date,n.color,n.image,n.pin, l.label from addnote n Left JOIn label_note ln ON ln.note_id=n.id left JOIN label l on ln.label_id=l.id where n.userid = '$id' and archive = 0 and trash = 0 ORDER BY n.id DESC";
        $stmt = $this->db->conn_id->prepare($query);
        $res = $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($arr as $notes)
        {
            $title = $notes['title'];
            $noteContent = $notes['noteContent'];
            $date = $notes['date'];
            $color = $notes['color'];
            $image = $notes['image'];
            $label = $notes['label'];
        }

        $noteArr = $query->getScalarResult();
        $encode = json_encode($noteArr);
        $redis = new RedisConn();
        $conn = $redis->connection();
        $redisKey = $conn->exists($uid);


        if($redisKey==1){
            $redisNoteData =  $conn->get($uid);
            print $redisNoteData;
        }
        else{
            $conn->set($uid, $encode);   
            $redisNoteData =  $conn->get($uid);
            print $redisNoteData;     
        }
    

        
        // $res = $noteArr[0];
        // //  print_r($res);
        // $title = $res['n_title'];
        // $desc = $res['n_description'];

        // $data = array(
        //     "title"=>$title,
        //     "description"=>$desc
        // );
        // $ss = json_encode($data);

        print json_encode($noteArr);
    }


    public function removeLabel(){
 


    }

}
