
<?php
include "/var/www/html/codeigniter/application/libraries/predis-1.1/autoload.php";

class Redis extends CI_Controller
{
    public function connection()
    {
        $client = new Predis\Client(array(
            'host' => '127.0.0.1',
            'port' => 6379,
            'password' => 'this123@'
        ));
        return $client;
    }
}
?>