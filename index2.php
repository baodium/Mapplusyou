<?php 
session_start();
//session_destroy();
//var_dump($_SESSION); //exit;
require_once 'config.php';
include ("controller/class.maplusu.php");
include ("googleapi/Google_Client.php");
include ("googleapi/contrib/Google_PlusService.php");
include ('googleapi/contrib/Google_StorageService.php');
include ("googleapi/contrib/Google_DriveService.php");
include ("googleapi/contrib/Google_CalendarService.php");
/*
$_SESSION['username']="Heyuler";
$_SESSION['mapplusu_user']="Heyuler";
$_SESSION['email']="oaadedayo@gmail.com";
$_SESSION['url']="google.com";
$_SESSION['image_url']="oaadedayo@gmail.com";
//*/
$access="";
if(!isset($_SESSION['logged_in'])){
header('location:protect.php');
}else{

$mplusu=new controller(); 

if(isset($_POST['submit_application'])){
$name=$_FILES['files']['name'];
$has_applied=$mplusu->get_applicant($_SESSION['email']);
if($has_applied!=NULL){
echo '<script>alert("You have already applied for this opportunity"); </script>'; 
 echo '<script>window.location="index.php?p=contract.php"</script>';
}else{

if($name==""){
 echo '<script>alert("Please select a file"); </script>'; 
 echo '<script>window.location="index.php?p=apply.php"</script>';
}

//$gs_name = $_FILES["files"]['tmp_name'];
$user=isset($_POST['name'])?$_POST['name']:$_SESSION['username'];

$job_id=$_POST['job_id'];
$jobs=$mplusu->loadJob($job_id);
$job=$jobs[0];
$job_title=$job['title'];
$job_email=isset($job['email'])?$job['email']:'oaadedayo@gmail.com';


$attachments = array($_FILES['files']['name'] => file_get_contents($_FILES['files']['tmp_name']));
//$attachment = chunk_split(base64_encode(file_get_contents($_FILES['files']['tmp_name'])));

$mail_options = array(
   "sender" => "gcdc2013-mapplusyou@appspot.gserviceaccount.com",
    "to" => $job_email,//"ayorthele@gmail.com",
    "subject" => "Application For Opportunity",
	'cc' => array('oaadedayo@gmail.com.com', 'baodium@gmail.com'),
    "textBody" => "This mail serves to notify you that ".$user." is interested in the opportunity (".$job_title."). His Curriculum vitae is attached herein." ,
	'attachment' => $attachments);
//$mail_options['attachment']=$_FILES['files'];


 //The form has been submitted, prep a nice thank you fullname

        //Deal with the email
        $to =  $job_email;
        $subject = "Application For Opportunity";

        $body = "This mail serves to notify you that ".$user." is interested in the opportunity (".$job_title."). His Curriculum vitae is attached herein.";//strip_tags($_POST['fullname']);
		//var_dump($body); exit;

        $attachment = chunk_split(base64_encode(file_get_contents($_FILES['files']['tmp_name'])));
        $filename = $_FILES['files']['name'];

        $boundary =md5(date('r', time())); 

        $headers = "From: Mapplusyou@mapplusyou.com\r\nReply-To: webmaster@mapplusyou.com";
        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

        $body="Please find attached.

--_1_$boundary
Content-Type: multipart/alternative; boundary=\"_2_$boundary\"

--_2_$boundary
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$body

--_2_$boundary--
--_1_$boundary
Content-Type: application/octet-stream; name=\"$filename\" 
Content-Transfer-Encoding: base64 
Content-Disposition: attachment 

$attachment
--_1_$boundary--";


try {
    mail($to, $subject, $body, $headers);
	
	$today=date("d-m-Y");
	$par=array('job_id'=>$job_id,'applicant_email'=>$_SESSION['email'],'owner_email'=>$job_email, 'name'=>$_POST['name'],'date'=>$today);
  $applied=	$mplusu->apply_job($par);
	
	echo '<script>alert("your application has been sent"); </script>'; 
    echo'<script>window.location="?p=contract.php"</script>'; 
	//var_dump($message); exit;


} catch (InvalidArgumentException $e) {
     $ret=array('status'=>'Error','message'=>'your message could not be sent');
	 echo '<script>alert("Your application could not be sent, please try agian"); </script>'; 
     echo'<script>window.location="index.php?p=apply.php"</script>'; 
	 //var_dump($ret); exit;
}
}
}


/* load page templates */
$page=$mplusu->get_page();


$idd=$mplusu->get_id();
if($page=='logout.php'){
session_destroy();
echo'<script>window.location="index.php?p=home.php"</script>'; 
}

if(isset($_GET['p'])){
unset($_SESSION['current']);
}


/*  construct google client instance and perform login  */
$client = new Google_Client();
$client->setApplicationName("mapplusyou");
//$client->setApplicationName('Google+ PHP Starter Application');
//$client->setUseObjects(true);
$plus = new Google_PlusService($client);
 //$client->setUseObjects(true);

$cal = new Google_CalendarService($client);

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['access_token'])) {
//echo "Here";
$token=json_decode($_SESSION['access_token'],1);
//var_dump($token); exit;
  $client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken()) {

  $me = $plus->people->get('me');
  $url = filter_var($me['url'], FILTER_VALIDATE_URL);
  $img = filter_var($me['image']['url'], FILTER_VALIDATE_URL);
  $name2 = filter_var($me['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $_SESSION['mplusu_user']=$name2;
  $name=explode(" ",$name2);
  $name=$name[0];
  $personMarkup = "<a rel='me' href='$url' style='color:#006699; height:3px ' ><img src='$img' style='border-radius:50%; width:40px; height:40px; margin-bottom:-10px'  >&nbsp;$name</a>";//would be used to identify logged in user
  //var_dump($me["emails"][0]['value']); exit;
  
  $_SESSION['link']=$url;
  $_SESSION['mapplusu_user']=$personMarkup;
  $_SESSION['username']=$name;
  $_SESSION['image']=$img;
  $_SESSION['email']=$me['emails'][0]['value'];

  if(isset($_SESSION['mpage'])){
  echo'<script>window.location="?p='.$_SESSION['mpage'].'"</script>';
  }
  
if(isset($_GET['get_pos'])){
try{
$geocode_stats = @file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$_GET['latitude'].",".$_GET['longitude']."&sensor=false");

$result=json_decode($geocode_stats,true);
$address=$result['results'][0]['formatted_address'];
$address=strip_tags($address);
$_SESSION['mapplusyou_long']=$_GET['longitude'];
 $_SESSION['mapplusyou_lat']=$_GET['latitude'];

	 }catch(Exception $e){ }
	 //var_dump($update);exit;			   
    }
    $_SESSION['access_token'] = $client->getAccessToken();
     } else {
       $authUrl = $client->createAuthUrl();
     }


  if(isset($_SESSION['mapplusu_user'])){
  }
  

if(isset($msg) && $msg['status']=="OK"){ 
//$page="test.php";
 }
 
 if(isset($_POST['subscribe_button'])){
 if($_POST['subscribe_button']=="yes"){
 $msg=$mplusu->addAlert($_POST);
  }
 }
 
 

if(!isset($_SESSION['mapplusu_user']) && ($page=="new.php" || $page=="location.php" || $page=="apply.php" || $page=="new_activity.php" || $page=="myopportunities.php"  || $page=="opportunityalert.php" || $page=="current.php")){
$_SESSION['current']=$page;
//header('location:'.$authUrl);

}
if(isset($_SESSION['current']) && $_SESSION['current']!=NULL){
$page=$_SESSION['current'];
}

$content=$mplusu->load_template($page);
if(isset($_POST['delete_this_sub'])){
//var_dump($_POST); exit;
$msg=$mplusu->deleteSub($_POST);
}

if(isset($_POST['update_this_sub'])){
//var_dump($_POST); exit;
$msg=$mplusu->updateSub($_POST);
}


if(isset($_POST['submit_job'])){
	//var_dump($_POST); exit;
		$msg=$mplusu->doSave('submit_job',$_POST);
		if($msg['status']=="OK"){
		$attendee=$mplusu->loadAttendee($_POST);
		//var_dump($attendee); exit;
		
	if(count($attendee)>0){	
	$deadline=explode("/",$_POST['deadline']);
	$deadline=$deadline[2].'-'.$deadline[0].'-'.$deadline[1].'T22:59:59.386Z';
	$today=date('m/d/Y');
	$today=explode("/",$today);
	$time= date("H:i:s"); 
	$time=explode(":",$time);
	$time=$time[0].':'.$time[1].':'.$time[2];
	$today=$today[2].'-'.$today[0].'-'.$today[1].'T'.$time.'.386Z';
	//$today+='T10:59:59.59386Z';
	//var_dump($today);
	//echo'<br/>';
	//var_dump($deadline); exit;
	  $event = new Google_Event();
      $event->setSummary(('Opportunity notification from Mapplusyou: '.$_POST['title']));
      $event->setLocation($_POST['state'].','.$_POST['country']);
      $start = new Google_EventDateTime();
      $start->setDateTime($today);
     $event->setStart($start);
      $end = new Google_EventDateTime();
      $end->setDateTime($deadline);//Time('2013-12-12T10:59:55.386Z');
      $event->setEnd($end);
      $event->sendNotifications=true;
	  $attendees=array();
	  $i=0;
     // $event->maxAttendees=2;
	 foreach($attendee as $att){
      $attendees[$i] = new Google_EventAttendee();
      //$attendee2 = new Google_EventAttendee();
     $attendees[$i]->setEmail($att['email']);
   // $attendee2->setEmail("baodium@gmail.com");
    //$attendees = array($attendee1,$attendee2);
	  $i++;
	  }
    $event->attendees = $attendees;	
	
  $reminder = new Google_EventReminders();
  $reminder->setUseDefault(false);
  
  $overrides = array(array("method"=> "sms","minutes" => "0"));//array("method"=> "sms","minutes" =>0);
  $reminder->setOverrides($overrides);
  $event->setReminders($reminder);
  $opt = array("sendNotifications"=>true);

  $createdEvent = $cal->events->insert('primary', $event, $opt);
  $_SESSION['access_token'] = $client->getAccessToken();

	  //var_dump($createdEvent); exit;
		 }
		}
		//var_dump($msg); exit;
		}elseif(isset($_POST['save_job'])){
		$msg=$mplusu->doSave('save_job',$_POST,$name);
		}elseif(isset($_POST['delete'])){
	    $msg=$mplusu->delete($_POST);
		}

if(isset($_SESSION['access_token'])){
 $access= json_decode($_SESSION['access_token'],1);
	  
	 $access=$access['access_token'];
	 }


if(isset($_POST['make_hangout'])){
//var_dump($_POST); exit;
$job=$mplusu->loadJob($_POST['job_id']);
$job=$job[0];
$applicants=$mplusu->get_applicants($_POST['job_id']);
if($job!=NULL){
$emails='';
$time=$_POST['date']."T".$_POST['time'].":00".".000-07:00";
$summary="Hangout notice for the opportunity ".$job['title'];

 $servic = new Google_CalendarService($client);
//$applicants=$mplusu->get_applicants($_POST['job_id']);
 $event = new Google_Event();
$event->setSummary($summary);
$event->setLocation('Online!');
$start = new Google_EventDateTime();
$start->setDateTime($time);
$event->setStart($start);
$end = new Google_EventDateTime();
$end->setDateTime($time);
$event->setEnd($end);


  $attendees=array();
	  $i=0;
	  /*
     // $event->maxAttendees=2;
	 foreach($applicants as $att){
	 $emails.=$att['email'].",";
      $attendees[$i] = new Google_EventAttendee();
     $attendees[$i]->setEmail($att['email']);
	  $i++;
	  }
    $event->attendees = $attendees;	
	*/
$attendee1 = new Google_EventAttendee();
$attendee1->setEmail($_POST['applicant_email']);
$attendees = array($attendee1);
$event->attendees = $attendees;


$createdEvent = $servic->events->insert('primary', $event);
//var_dump($createdEvent['hangoutLink']); exit;
 $ssurl=$createdEvent['hangoutLink'];

 $to      = $_POST['applicant_email'];
$subject = 'Hangout Notice';
$message = "This is to inform you that there will be a hangout session between you and the owner of the opportunity ".$job['title']." on ".$_POST['date'].",".$_POST['time']."< The link for the hangout is  ".$createdEvent['hangoutLink'];
$headers = 'From: mapplusyou@mapplusyou.com' . "\r\n" .
    'Reply-To: webmaster@mapplusyou.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
 //$surl="jdj";
 $par=array('applicant_id'=>$_POST['applicant_id'],'date'=>$_POST['date'],'time'=>$_POST['time'],'url'=>$ssurl);
 $d=$mplusu->do_hangout($par);
 if($d){
 echo'<script>alert("Your hangout has been succesfully scheduled"); </script>';
 }
 }
}

if(isset($_POST['submit_traffic'])){
$time=date('d-m-y,h:i:s A');
unset($_POST['submit_traffic']);

$video_url=(strlen(trim($_POST['video_id']))>0)?$_POST['video_id']:'';
$type=isset($_POST['type'])?$_POST['type']:"Others";
$message=(strlen(trim($_POST['message']))>0)?$_POST['message']:'Idle';
$lat=$_POST['latitude'];
$lon=$_POST['longitude'];

  
$param=array('date'=>$time,'message'=>$message,'type'=>$type,'email'=>$_SESSION['email'],'video_url'=>$video_url,'latitude'=>$lat,'longitude'=>$lon);
 //$user=isset($_SESSION['username'])?$_SESSION['username']:'maplusyou';
//var_dump($param); exit;
 $update=$mplusu->addTraffic($param);
 //$page="location.php";
if($update['status']=="OK"){
echo'<script>window.location="?p=location.php"</script>';
}
}

?>
<script>
 //var value=<?php //echo '<traffic>'.$data.'</traffic>'; ?>
</script>

<!DOCTYPE html>

<html  ><!--<![endif]--><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="keywords" content="opportunities, activities, Activity video, Email and SMS notifications etc.">
  <meta name="description" content="Mapping you with opportunities and activities around you">
  <title>Map Plus You</title>

    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css" />
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqqEjyaKwHduw_26LD6W8HBIEzBFhmZXg&sensor=false&libraries=places">
      </script>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css" />     
		 <script type="text/javascript" src="resources/erg/js/jquery-1.4.2.min.js"></script> 
 <script type="text/javascript" src="resources/js/jquery-1.9.1.min.js">
		<script src="resources/js/config.js" type="text/javascript"></script>		
       
		<script src="resources/js/skel-panels.min.js" type="text/javascript"></script>
		<script src="resources/js2/skel.min.js" type="text/javascript"></script>           

<link href="resources/erg/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="resources/erg/css/coin-slider.css" />


<script type="text/javascript" src="resources/erg/js/script.js"></script>
<script type="text/javascript" src="resources/erg/js/coin-slider.min.js"></script>

<link rel="stylesheet" type="text/css" href="resources/stylesheets/reset.css" />
    <link rel="stylesheet" type="text/css" href="resources/stylesheets/main.css" />       
        <link rel="stylesheet" href="resources/css/style-desktop.css"  type="text/css"/>
	    <link rel="stylesheet" href="resources/css/style.css" type="text/css" />
          <link  rel="favicon" href="resources/images/favicon.ico" >     
        <link rel="stylesheet" href="resources/flickr/jquery-ui-1.8.16.custom.css" type="text/css" />
        <script src="resources/js/modernizr.custom.js" type="text/javascript"></script>	
        <link rel="stylesheet" href="resources/foundation.min.css">
        <link rel="stylesheet" href="resources/style.css">	
        
         
        
 
<link href="resources/temp/anythingslider.css" rel="stylesheet" type="text/css">

   <style>
		#tinyeditor {border:none; margin:0; padding:0; font:14px 'Courier New',Verdana}
.tinyeditor {border:1px solid #bbb; padding:0 1px 1px; font:12px Verdana,Arial}
.tinyeditor iframe {border:none; overflow-x:hidden}
.tinyeditor-header {height:31px; border-bottom:1px solid #bbb; background:url(resources/images/header-bg.gif) repeat-x; padding-top:1px}
.tinyeditor-header select {float:left; margin-top:5px}
.tinyeditor-font {margin-left:12px}
.tinyeditor-size {margin:0 3px}
.tinyeditor-style {margin-right:12px}
.tinyeditor-divider {float:left; width:1px; height:30px; background:#ccc}
.tinyeditor-control {float:left; width:34px; height:30px; cursor:pointer; background-image:url(resources/images/icons.png)}
.tinyeditor-control:hover {background-color:#fff; background-position:30px 0}
.tinyeditor-footer {height:32px; border-top:1px solid #bbb; background:#f5f5f5}
.toggle {float:left; background:url(resources/images/icons.png) -34px 2px no-repeat; padding:9px 13px 0 31px; height:23px; border-right:1px solid #ccc; cursor:pointer; color:#666}
.toggle:hover {background-color:#fff}
.resize {float:right; height:32px; width:32px; background:url(resources/images/resize.gif) 15px 15px no-repeat; cursor:s-resize}
.no-class{}
#editor {cursor:text; margin:10px}
.top-bar-section ul li a:hover{background:#CCCCCC; color:#333; border-radius:10px;}
#title_hover{
color:#FFFFFF;
}
#title_hover a:hover{ color: #99CCFF}
		</style>

<script>
function getAccess(){
var access="<?php echo $access; ?>";
return access;
}

</script>

<script src="resources/js/functions.js" type="text/javascript"></script>	
<script language="JavaScript" type="text/javascript" src="resources/testimonial/jTPS.js"></script>
<link rel="stylesheet" type="text/css" href="resources/testimonial/jTPS.css">
<script type="text/javascript" src="resources/testimonial/cycle.js" ></script>

<script src='http://connect.facebook.net/en_US/all.js'></script>
 
<link href="resources/header/bootstrap.min.css" rel="stylesheet">
<link href="resources/header/docs.min.css" rel="stylesheet">






  
</head>
<body  style="min-width: 100px;" > 
<!--
<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand">Mapplusyou</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
         
        </li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <li class="active">
          <a href="?p=home.php">Home</a>
        </li>
        <li>
          <a href="?p=contract.php">Opportunities</a>
        </li>
        <li>
          <a href="?p=activities.php">Activities</a>
        </li>
        <li><a href="#" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Expo');">Login</a></li>
    
      </ul>
    </nav>
  </div>
</header>

-->



<div id="top" data-magellan-expedition="fixed" style="position: fixed; top: 0px; ">
	<div class="row2" style="">
		<div class="large-12 columns" style="background:transparent">
			<nav class="top-bar" style="background:transparent">
			  <ul class="title-area" style="background:transparent; " id="<?php if($page=='contract.php' || $page=="location.php" || $page=="opportunityalert.php" || $page=="current.php" || $page=="myopportunities.php"){ ?>lfloat<?php } ?>">
			   <li class="logo" style="padding-top:10px; background:transparent">
			      <a href="" id="log_up" style="color: #4e97cc; "><img src="resources/images/logo3.png" style="width:50px; height:50px; margin-bottom:-15px; ">applusyou</a>			    </li>
			    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			  </ul>
			
			  
		  <section class="top-bar-section" style="left: 0%; background:transparent" >
			    <ul class="right" id="menu"  style="margin-top:6px;  padding:2px" >
			      
				<li <?php echo ($page=='home.php' || $page=="")?'class="active"':'' ?>  ><a href="?p=home.php" style="color: #006699;" id="menu-list-a" onClick="loadUrl('home.php');">Home</a></li>
							<li <?php echo ($page=='contract.php')?'class="active"':'' ?>><a href="?p=contract.php" style="color: #006699; " id="menu-list-a" onClick="loadUrl('contract.php');" >Opportunities</a></li> 
                            <li <?php echo ($page=='location.php')?'class="active"':'' ?>><a href="?p=location.php" style="color: #006699; " id="menu-list-a" onClick="loadUrl('location.php');">Activities</a></li>
                            <li <?php echo ($page=='about.php')?'class="active"':'' ?> style="padding-top:0px"  ><form name="search_mf" action="?p=searchresult.php" method="post"  ><input type="search" name="search_m" placeholder="Search mapplusyou" id="search_m"   ></form></li>
                            
                            
                            <li style="font-size:12px; border-top:0px"><?php if(isset($_SESSION['mapplusu_user'])){ echo ''. $_SESSION['mapplusu_user'].'';   ?></li>
                                  <?php   echo '<li style="height:0px; background:transparent"><div class="click-nav">
  <ul class="no-js">
    <li>
      <a href="#" class="clicker"><img src="resources/images/i-3.png" alt="Icon"></a>
      <ul>
        <li><a href="?p=logout.php" style="background:transparent"><img src="resources/images/i-6.png" alt="Icon">&nbspSign out</a></li>
      </ul>
    </li>
  </ul>
</div></li>'; }else{?>

                     <li  id ="log-inn" ><a href="<?php echo $authUrl; ?>" id="menu-list-a" style="color: #006699;" ><img src="resources/images/bio.png" style="width:24px; height:24px; " >&nbsp;Login</a></li>
                                  <?php } ?>
                                  </ul>
                                 
				</ul>
			  </section></nav>
		</div>
	</div>
    
</div>

<div>


<?php 
					if($content!='') { 
					include_once ($content); 
					 }
?>


<div id="fb-root"></div>
<script>						



//facebook: post to wall 
function publishWallPost(msg) {

      FB.ui({
          method: 'feed',
          name: 'Mapplusyou',
          caption: 'Mapping you with opportunities and activities around you.',
          description: msg,
          link: 'http://www.mapplusyou.com',
        },
        function (response) {
          console.log('publishStory response: ', response);
        });
      return false;
}


window.fbAsyncInit = function () {
      FB.init({
        appId: '253776274791852',
        status: true,
        cookie: true,
        xfbml: true
      });
};

(function () {
      var e = document.createElement('script');
      e.async = true;
      e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
      document.getElementById('fb-root').appendChild(e);
}());
	</script>



<script>
function loadUrl(page){
var pg=document.getElementById('page').value;
//alert(pg);
//return false;
window.location="?p="+page;
return true;
}
</script>
<footer style="background:#000000">
	<div class="row2">



		<div class="large-6 columns">
			<ul class="inline-list" style="">
			  <li class="copyright" style="color:#FFFFFF">2013 � Mapplusyou Team. </li><li><img src="resources/app_engine.gif" style="margin-top:8px" /></li>
  			</ul>
		</div>
		<div class="large-6 columns">
			<ul class="inline-list social-media right">
            <li style="color:#FFFFFF" class="copyright">Join us on...</li>
                <li><a href="https://plus.google.com/u/0/b/101151913372769622665/101151913372769622665/posts" class="icon icon-googleplus"></a></li>
				<li><a href="http://www.facebook.com/mapplusyou" class="icon icon-facebook"></a></li>
				<li><a href="https://twitter.com/mapplusyou" class="icon icon-twitter"></a></li>
				
               
			</ul>
		</div>
	</div>
</footer






<!-- Analytics
================================================== -->

<script src="resources/js/jquery-ui-1.8.16.custom.min.js"></script> 
  <script type="text/javascript" src="resources/js/foundation.min.js"></script> 
  <!-- <script src="resources/js/jquery.flexslider.js" type="text/javascript"></script><!-- Flex slider -->
  <!-- <script type="text/javascript" src="resources/js/custom.js"></script>	 -->
<input type="hidden" name="page" id="page" value="<?php //echo file_get_contents("gs://mapplusyou/page.txt"); ?>">	
 <script type="text/javascript">
  (function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = 'https://apis.google.com/js/client:plusone.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();
</script>


<script src="resources/header/bootstrap.min.js"></script>


<script>
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=1;
    js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>

</body></html>

<?php } ?>
