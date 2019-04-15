
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
   
    // public function testRegister(){
    //     $request = $this->http->post('signup', [
    //         'form_params' => [
    //             'firstname'=>'abc',
    //             'lastname'=>'def',
    //             'email' => 'dsd@gmail.com',
    //             'password' => 'abcdef',
    //         ],
    //     ]); 
    //     $stream = $request->getBody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
       
    //     if($res=="200"){
            
    //     }
    //     $this->assertEquals("200", $res,'Email already exists');  
        
        
    // }

    // public function testlogin(){
    //     $request = $this->http->post('signin',[
    //         'form_params' => [
    //             'email'=>'adithyasuresh58@gmail.com',
    //             'password'=>'123456789'
    //         ],
    //     ]);
    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
    //     $this->assertEquals("400", $res,'password incorrect');
    // }

    // public function testaddNote()
    // {
    //     $request = $this->http->post('addNote',[
    //         'form_params' => [
    //             'title'=>'dgfds',
    //             'noteContent'=>'dsfsd',
    //             'email' => 'adithyasuresh58@gmail.com',
    //             'date' => '08/04/2019 08:00 PM',
    //             'color' => '#f28b82'
    //         ],
    //     ]);

    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
    //     $this->assertEquals("200", $res,'note adding failed');
    // }

    // public function testdisplayNote()
    // {
    //     $request = $this->http->post('displayNote',[
    //         'form_params' => [
    //             'userid'=>'26'
    //         ],
    //     ]);

    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
    //     $this->assertEquals("200", $res,'displaying note failed');
    // }

    // public function testchangecolor(){
    //     $request = $this->http->post('changeColor',[
    //         'form_params' => [
    //             'id'=>'392',
    //             'colour'=>'#e8eaed'
    //         ],
    //     ]);
    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
    //     $this->assertEquals("200", $res,'changing note color failed');
    // }

    // public function testeditnote(){
    //     $request = $this->http->post('editNote',[
    //         'form_params' => [
    //             'id'=>'392',
    //             'Title'=>'ay',
    //             'noteContent'=>'diash',
    //             'date' => '08/04/2019 08:00 PM',
    //             'color' => '#f28b82'
    //         ],
    //     ]);
    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
    //     $this->assertEquals("200", $res,'editing notes failed');
    // }

    // public function testdelnote(){
    //     $request = $this->http->post('delNote',[
    //         'form_params' => [
    //             'id'=>'388'
    //         ],
    //     ]);
    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
    //     $this->assertEquals("200", $res,'deleting notes failed');
    // }

    // public function testarchivenote(){
    //     $request = $this->http->post('archive',[
    //         'form_params' => [
    //             'id'=>'475'
    //         ],
    //     ]);
    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->message;
    //     $this->assertEquals("200", $res,'archive of notes failed');
    // }

    // public function testunarchivenote(){
    //     $request = $this->http->post('unarchive',[
    //         'form_params' => [
    //             'uid'=>'475'
    //         ],
    //     ]);
    //     $stream = $request->getbody();
    //     $contents = json_decode($stream);
    //     $res = $contents->status;
    //     $this->assertEquals("200", $res,'unarchive of notes failed');
    // }

    public function testtrashnote(){
        $request = $this->http->post('delete',[
            'form_params' => [
                'uid'=>'418'
            ],
        ]);
        $stream = $request->getbody();
        $contents = json_decode($stream);
        $res = $contents->status;
        $this->assertEquals("200", $res,'permanent deletetion of notes failed');
    }
}