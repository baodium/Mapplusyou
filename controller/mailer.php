<?php
require_once 'google/appengine/api/mail/Message.php';

use google\appengine\api\mail\Message;

$mail_options = [
    "sender" => "Baodium@gmail.com",
    "to" => "ayorthele@gmail.com",
    "subject" => "Application for ",
    "textBody" => "Hi Guys",
	'attachment' => $_FILES['files'],
];

// Create the message
//if(isset($_POST['submit_application'])){
//$mail_options['attachment']=$_FILES['files'];
try {
    $message = new Message($mail_options);
    $message->send();
	var_dump($message); exit;
	
	//exit;
//header("location:?p=contract.php");
} catch (InvalidArgumentException $e) {
     $ret=array('status'=>'Error','message'=>'your message could not be sent');
	 var_dump($ret); exit;
}