<?php
//session_start();
require_once 'google/appengine/api/mail/Message.php';

use google\appengine\api\mail\Message;

if(isset($_POST['submit_application'])){
$name=$_FILES['files']['name'];
if($name==""){
 echo '<script>alert("Please select a file"); </script>'; 
 echo '<script>window.location="http://www.gcdc2013-mapplusyou.appspot.com/index.php?p=apply.php"</script>';
}

$gs_name = $_FILES["files"]['tmp_name'];
$user=isset($_POST['name'])?$_POST['name']:$_SESSION['username'];
$job_id=$_POST['job_id'];
$jobs=$mplusu->loadFile("gs://mapplusyou/jobs.txt");
$job_title=$jobs[$job_id]['title'];
$job_email=isset($job[$job_id]['email'])?$job[$job_id]['email']:'oaadedayo@gmail.com';

$attachments = array($_FILES['files']['name'] => file_get_contents($_FILES['files']['tmp_name']));
//$attachment = chunk_split(base64_encode(file_get_contents($_FILES['files']['tmp_name'])));

$mail_options = array(
   "sender" => "gcdc2013-mapplusyou@appspot.gserviceaccount.com",
    "to" => $job_email,//"ayorthele@gmail.com",
    "subject" => "Application For Opportunity",
	'cc' => array('oaadedayo@gmail.com.com', 'baodium@gmail.com'),
    "textBody" => "This mail serves to notify you that ".$user." is interested in the opportunity (".$job_title.") you posted on Mapplusyou. His Curriculum vitae is attached herein." ,
	'attachment' => $attachments);
//$mail_options['attachment']=$_FILES['files'];
try {
    $message = new Message($mail_options);
	//$message->addAttachment($name,$gs_name);
    $message->send();
	echo '<script>alert("your application has been sent"); </script>'; 
    echo'<script>window.location="http://www.gcdc2013-mapplusyou.appspot.com/index.php?p=contract.php"</script>'; 
	//var_dump($message); exit;

	//exit;
//header("location:?p=contract.php");
} catch (InvalidArgumentException $e) {
     $ret=array('status'=>'Error','message'=>'your message could not be sent');
	 echo '<script>alert("Your application could not be sent, please try agian"); </script>'; 
     echo'<script>window.location="http://www.gcdc2013-mapplusyou.appspot.com/index.php?p=apply.php"</script>'; 
	 //var_dump($ret); exit;
}
}
echo'<script>window.location="http://www.gcdc2013-mapplusyou.appspot.com/index.php"</script>';