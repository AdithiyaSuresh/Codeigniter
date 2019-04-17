<?php
include "/var/www/html/codeigniter/application/service/JWT.php";
include "/var/www/html/codeigniter/application/jwt/vendor/autoload.php";
include "/var/www/html/codeigniter/application/service/Redis.php";
class A extends CI_Controller
{
   // private $labelserv = "";
    /**
     * @description create an instance of service methods
     */
    public function __construct()
    {
        parent::__construct();
        //$this->labelserv = new LabelService();
        $this->load->library('doctrine');
    }
    public function get()
    {
        $em = $this->doctrine->em;
        $connection = new Redis();
        $client = $connection->connection();
        $token = $client->get('token');
    }
}
?>