
<?php
include '/var/www/html/codeigniter/application/vendor/autoload.php';

class FundooApiTest extends TestCase
{
    protected $client;
    
    public function setUp()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost/codeigniter/'], array(
            'request.options' => array(
                'exceptions' => false,
            ),
        ));
    }
   
    public function testRegister(){
        $request = $this->http->post('signup', [
            'form_params' => [
                'firstname'=>'abc',
                'lastname'=>'def',
                'email' => 'abcfzcfsdf@gmail.com',
                'password' => 'abcdef',
            ],
        ]);
        $stream = $request->getBody();
        $contents = json_decode($stream);
        $res = $contents->message;
       
        if($res=="200"){
            
        }
        $this->assertEquals("200", $res,'Email already exists');  
        
        
    }

    public function testlogin(){
        $request = $this->http->post('signin',[
            'form_params' => [
                'email'=>'adithyasuresh58@gmail.com',
                'password'=>'123456789'
            ],
        ]);
        $stream = $request->getbody();
        $contents = json_decode($stream);
        $res = $contents->message;
        $this->assertEquals("400", $res,'password incorrect');
    }
}