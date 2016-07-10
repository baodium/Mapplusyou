<?php
require_once'config.php';

class controller{
public $currentFile;
public $prevFile;
public $nextFile;
public $db;

function  __construct(){;
$this->db=new Db();
}
function get_page(){
if(isset($_GET)){
//try{
$here=@$_GET['p'];//ltrim($_SERVER['PATH_INFO'],'/');
return $here;
//}catch(){
}
//}
}

function get_id(){
if(isset($_GET)){
//try{
$id=@$_GET['id'];//ltrim($_SERVER['PATH_INFO'],'/');
return $id;
//}catch(){
}
}

function load_template($template){
$template=rtrim($template,".php");
$template.='_tpl.php';
if(file_exists('templates/'.$template))
return('templates/'.$template);
return ('templates/home_tpl.php');
}

function setCurrentFile($file){
$this->currentFile=$file;
}

function exeedUploadLimit($file){
if(filesize($file)>VIDEO_UPLOAD_LIMIT)
return true;
return false;
}

function getName($file){
 return substr($file,(strrpos($file,"/")+1),strlen($file));
 }

function getExtension($file){
return substr($file,strrpos($file,".")+1,strlen($file));
}

function getLatitude(){

}

function getLongitude(){

}

function isImage($file){
$ext=$this->getExtension($file);
if($ext=="jpg"||$ext=="png"||$ext=="gif"||$ext=="jpeg")
return true;
return false;
}

function loadStorage(){

}

function loadFile($path){

if($path=="jobs"){
$query="SELECT * FROM {$path} ORDER BY job_id DESC ";
}elseif($path=="traffic"){
$query="SELECT * FROM {$path} ORDER BY YEAR( DATE ) , MONTH( DATE ) , DAY( DATE ) , HOUR( DATE ) , MINUTE( DATE ) , SECOND( DATE ) ";
}else{
$query="SELECT * FROM {$path} ";
}
//var_dump($this->db->query($query)); exit;
return $this->db->query($query);
}

function update($user,$param,$file){

$lon=$param['longitude'];//$_SESSION['mapplusyou_long'];
$lat=$param['latitude'];//$_SESSION['mapplusyou_lat'];
unset($param['latitude']);
unset($param['longitude']);

$geocode_stats = @file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&sensor=false");

$result=json_decode($geocode_stats,true);
$address=$result['results'][0]['formatted_address'];
$address=strip_tags($address);
$param['location']=$address;
$param['image_url']=$_SESSION['image'];
$param['user_link']=$_SESSION['link'];
$param['lat']=$lat;
$param['lon']=$lon;

 //var_dump($param); exit;
$handle=$this->loadFile($file);
if(!isset($handle[$user])){
return $this->addNew($user,$param,$file);// ($status=array('status'=>'Error','message'=>'User does not exist'));
}
$i=1;
$comments=$this->loadFile("comments");
//$comments=json_decode($comments,true);
$ret=array();
foreach($comments as $key=>$value){
$value['author']=rtrim($value['author'],"\/");
if($value['author']!=$_SESSION['email']){
$ret[$i]=$comments[$key];
//unset($comments[$key]);
$i++;
}
}

//echo '<br/><br/><br/><br/><br/>';
//var_dump($comments); exit;
file_put_contents("gs://mapplusyou/comments.txt",json_encode($ret),1);

foreach ($param as $key=>$value){//if($key!='')
$handle[$user][$key]=$value;
}

 //$handle[$user]=$update;//array('id'=>1,'user_link'=>'ayor','lat'=>'80.090','lon'=>'787.0','location'=>'lagere,Ile-Ife','current'=>'Writing code'); 
 if(file_put_contents($file,json_encode($handle),1))
 return (array('status'=>'OK','message'=>'Success!'));
 return (array('status'=>'Error','message'=>'Update is not successful'));
}

function addTraffic($param){

$lon=$param['longitude'];//$_SESSION['mapplusyou_long'];
$lat=$param['latitude'];//$_SESSION['mapplusyou_lat'];
//unset($param['latitude']);
//unset($param['longitude']);
//var_dump($param); exit;
$geocode_stats = @file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&sensor=false");

$result=json_decode($geocode_stats,true);
$address=$result['results'][0]['formatted_address'];
$address=strip_tags($address);
$param['location']=$address;
$param['image_url']=$_SESSION['image'];
$param['user_link']=$_SESSION['link'];
$param['lat']=$lat;
$param['lon']=$lon;
$param['user']=$_SESSION['username'];

$email=$param['email'];
$find=$this->db->query("SELECT * FROM traffic WHERE email='{$email}' ");
if($find!=NULL){
if($this->db->update("UPDATE traffic set location='{$param['location']}', message='{$param['message']}', type='{$param['type']}', date='{$param['date']}', video_url='{$param['video_url']}', lat='{$param['lat']}', lon='{$param['lon']}' WHERE email='{$email}' ")){
return (array('status'=>'OK','message'=>'Success!'));

}else{
return (array('status'=>'Error','message'=>'Update is not successful'));
}
}else{
if($this->db->update("INSERT INTO traffic (user,user_link,location,image_url,date,message,type,video_url,lat,lon,email) VALUES('{$param['user']}', '{$param['user_link']}','{$param['location']}','{$param['image_url']}','{$param['date']}','{$param['message']}','{$param['type']}','{$param['video_url']}','{$param['lat']}','{$param['lon']}','{$param['email']}' )")){
return (array('status'=>'OK','message'=>'Success!'));
 

}else{
 return (array('status'=>'Error','message'=>'Update is not successful'));
}
}
}

function addNew($user,$param,$file){
$handle=$this->loadFile($file);
if(isset($handle[$user])){
return ($status=array('status'=>'Error','message'=>'User already exist'));
}else{
$new=array();
$param['user']=$_SESSION['mplusu_user'];//$user;
//$param['id']=$user;
foreach ($param as $key=>$value){
$new[$key]=$value;
}
$handle[$user]=$new;
if(file_put_contents($file,json_encode($handle),1))
 return ($status=array('status'=>'OK','message'=>'Success!'));
 return ($status=array('status'=>'Error','message'=>'Update is not successful'));

}
}


function deleteUser($param,$user,$file){
$handle=$this->loadFile($file);
if(!$handle)
return ($status=array('status'=>'Error','message'=>$file.' cannot be found'));
if(!isset($handle[$user]))
return ($status=array('status'=>'Error','message'=>'User does not exist'));
unset($handle[$user]);
if(file_put_contents($file,json_encode($handle),1))
 return ($status=array('status'=>'OK','message'=>'Success!'));
 return ($status=array('status'=>'Error','message'=>'Update is not successful'));

}


function addJob($param,$file){
$param['owner']=$_SESSION['email'];
$sql_key='';
$sql_value='';

foreach($param as $key => $value){
$sql_key.=$key.',';
$sql_value.="'".$value."',";
}

$sql_key='('.rtrim($sql_key,',').')';
$sql_value='('.rtrim($sql_value,',').')';
$query="INSERT INTO jobs".$sql_key.' VALUES '.$sql_value;
//var_dump($this->db->update($query)); exit;

if($this->db->update($query)){
return ($status=array('status'=>'OK','message'=>'Success!'));
}else{
return ($status=array('status'=>'Error','message'=>'Update is not successful'));
}

}


function updateJob($param){
$id=$param['id'];

unset($param['id']);
//var_dump($param); exit;
$sql_key='';
$sql_value='';

foreach($param as $key => $value){
$sql_key.=$key."='".$value."',";
//$sql_value.="'".$value."',";
}

$sql_key=rtrim($sql_key,',');
//$sql_value='('.rtrim($sql_value,',').')';
$query="UPDATE jobs SET ".$sql_key." WHERE job_id='".$id."'";
//var_dump($query); exit;
//var_dump($this->db->update($query)); exit;

if($this->db->update($query)){
return ($status=array('status'=>'OK','message'=>'Success!'));
}else{
return ($status=array('status'=>'Error','message'=>'Update is not successful'));
}

}

function doSave($scope,$param){

if($scope=='submit_job'){

        foreach($param as $key=>$value){
		if(strlen(trim($value))<1 && ($key!="url" && $key!="email" && $key!="state" && $key!="address")){
		$msg=$key." field cannot be empty";
		return (array('status'=>'Error','message'=>$msg));
		}
        }
		$today=date('m/d/Y');
		$today=strtotime($today);
		$deadline=strtotime($param['deadline']);
		if($deadline==false){
		$msg="Invalid date format";
		return (array('status'=>'Error','message'=>$msg));
		}
		
		if($deadline<$today){
		$msg="Deadline cannot be less than today";
		return (array('status'=>'Error','message'=>$msg));
		}

		
$address=$param['country'].','.$param['state'];
       $prepAddr = str_replace(' ','+',$address);

	   try{
       $geo=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
       $geo=json_decode($geo,true);
       $latitude=$geo['results'][0]['geometry']['location']['lat'];
       $longitude=$geo['results'][0]['geometry']['location']['lng'];		
		$param['latitude']=$latitude;
		$param['longitude']=$longitude;
		}catch(Exception $e){ }

	$param['title']= mysql_escape_string($param['title']);
	$param['message']= mysql_escape_string($param['message']);
	//var_dump($param); exit;
	
		$param['email'] = $param['email'];

		unset($param['submit_job']);
		$param['link']=isset($_SESSION['link'])?$_SESSION['link']:"";
		$msg=$this->addJob($param,'jobs');
		//exit;
		return $msg;
}elseif($scope=="save_job"){
//var_dump($param); exit;
foreach($param as $key=>$value){
		if(strlen(trim($value))<1 && ($key!="url" && $key!="email")){
		$msg=$key." field cannot be empty";
		return (array('status'=>'Error','message'=>$msg));
		}
        }
		
		//$param['email'] = $param['email'];
		$param['owner']=$_SESSION['email'];

		unset($param['submit_job']);
		$param['link']=isset($_SESSION['link'])?$_SESSION['link']:"";
        $handle=$this->loadFile("jobs");
        $id=$param['id'];
		//unset($param['id']);
	$param['title']= mysql_escape_string($param['title']);
	$param['message']= mysql_escape_string($param['message']);
		unset($param['save_job']);
return ($this->updateJob($param));

        }

}

function loadCurrentActivities(){
$handle=$this->loadFile("traffic");
//var_dump
$return=array();
if(!$handle){
return ($status=array('status'=>'Error','message'=>'File does not exist'));
}
foreach($handle as $key=>$value){
if(isset($handle[$key]['user']) && isset($handle[$key]['image_url']) && isset($handle[$key]['type'])){
$return[$key]=$handle[$key];
}
}
return $return;
}


function loadJobs($path){
$read_data = file_get_contents("gs://mapplusyou/jobs.txt");
				// $read_data=(array)(json_decode($read_data;
 $jobs=(json_decode($read_data,true)); 

$ret=array();
$result=array();
//$handle=json_decode(file_get_contents($path),true);
foreach($jobs as $key=>$value){
$result[$key]=$jobs[$key];
}
$ret[0]=$result;
 return $ret;
}

function searchActivity($param){
if(strlen(trim($param['activity']))<1){
return array();
}
$read_data = $this->loadFile("traffic");
$ret=array();
 $traffics=$read_data;//(json_decode($read_data,true)); 
foreach($traffics as $key=>$value){
if( strpos(strtolower($traffics[$key]['message']),strtolower($param['activity']))!==false && isset($traffics[$key]['user']) && isset($traffics[$key]['image_url']) && isset($traffics[$key]['type'])){
$ret[$key]=$traffics[$key];
}
}
return $ret;
}

function loadJob($id){
$sql="SELECT * FROM jobs WHERE job_id='{$id}'";
return $this->db->query($sql);
}

function searchJob($param){
//echo'<br/><br/><br/><br/>';
//var_dump($param); exit;
//var_dump($param); exit;
$result=array();
$ret=array();
$jobs=$this->loadFile("jobs");

//$read_data = file_get_contents("gs://mapplusyou/jobs.txt");
 $today=strtotime(date('m/d/Y'));
				// var_dump($read_data);
				 $i=0;
				// $read_data=(array)(json_decode($read_data;
				// $jobs=(json_decode($read_data,true)); 

foreach($jobs as $job){
$deadline=strtotime($job['deadline']);
$i++;
if(strlen(trim($param['title']))>0){

if((strpos(strtolower($job['title']),strtolower($param['title']))!==false)){
if($deadline>=$today){
$job['id']=$i;
$result[$i]=$job;

}
}

}else{


if(($param['country']!="") && ($param['type']!="")){
if(($job['country']==$param['country']) && ($job['type']==$param['type'] )){
//$result[$i]=$job;
if($today<=$deadline){
$job['id']=$i;
$result[$i]=$job;
}
}

}elseif(($param['country']!="") && ($param['type']=="")){
if(($job['country']==$param['country'])){
if($today<=$deadline){
$job['id']=$i;
$result[$i]=$job;
}
//$result[$i]=$job;
}
}elseif(($param['country']=="") && ($param['type']!="")){
if($job['type']==$param['type']){
//$result[$i]=$job;
if($today<=$deadline){
$job['id']=$i;
$result[$i]=$job;
}
}

}

}
}
if(count($result)>0){
//var_dump($result); exit;
//$ret[0]=$result;
return $result;
}else{
return NULL;
}
}

function submitToGoogleStorage($bucket,$service,$file){
$StorageService = new Google_StorageService($client);  
$objects = $StorageService->objects;
$postbody = array(file_get_contents($file));
$gso = new Google_StorageObject();
$gso->setName('traffic');
$resp = $objects->insert('maplusyou', $gso ,$postbody);
return $resp;
//print_r($resp);

}


function getStorageFile($bucket,$object,$opt){
//$bucket, $entity
$opt=array('projection'=>'full');
$StorageService = new Google_StorageService($client);  
$objects = $StorageService->objects;
//$postbody = array(file_get_contents($file));
$gso = new Google_StorageObject();
$gso->setName('traffic');
$resp = $objects->get('maplusyou', 'traffic');
return $resp;
}


function uploadToYoutube($youTubeService,$file){
 $snippet = new Google_VideoSnippet();
    $snippet->setTitle("adedayo's video");
    $snippet->setDescription("Test description");
    $snippet->setTags(array("tag1","tag2"));
    $snippet->setCategoryId("22");

    $status = new Google_VideoStatus();
    $status->privacyStatus = "private";

    $video = new Google_Video();
    $video->setSnippet($snippet);
    $video->setStatus($status);

    $error = true;
    $i = 0;

    try {
        $obj = $youTubeService->videos->insert("status,snippet", $video,
                                         array("data"=>file_get_contents('Wildlife.wmv'), 
                                        "mimeType" => "video/mp4"));
										return($obj); 
    } catch(Google_ServiceException $e) {
	/*
        print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage(). " <br>";
        var_dump("Stack trace is ".$e->getTraceAsString());exit;
		*/
    }
  

}

function createGoogleDrive($file){
$file = new Google_DriveFile();
$file->setTitle('Tester');
$file->setDescription('List of Job applicants');
$file->setMimeType('application/vnd.google-apps.spreadsheet');

$data = file_get_contents('traffic.txt');

$createdFile = $service->files->insert($file, array(
      'data' => '',
      'mimeType' => 'application/vnd.google-apps.spreadsheet',
    ));
$permission = new Google_Permission();
$permission->setRole( 'writer' );
$permission->setType( 'anyone' );
$permission->setValue( 'me' );
$service->permissions->insert( $createdFile['id'], $permission );

return $createdFile;
}

function validate($param){
if(!isset($_POST['submit_application'])){
 $msg=array("status"=>"Error","message"=>"");
   return $msg;
}

if(!is_numeric($_POST['phone'])){
 $msg=array("status"=>"Error","message"=>"Phone field must be numeric");
   return $msg;
}
//unset($_POST['submit_application']);
foreach($_POST as $key=>$value){
  if(strlen(trim($value))<1){
  $msg=array("status"=>"Error","message"=>$key." "."field cannot be empty");
   return $msg;
  }
}

return (array('status'=>'OK','message'=>'yes'));

}

function loadPostedJob($user){
$result=array();
$all=$this->loadFile("jobs");
foreach($all as $key=>$value){
if($all[$key]['owner']==$user){
$all[$key]['id']=$key;
$result[]=$all[$key];
}

}
//exit;
return $result;
}

function delete($param){
//var_dump($param); exit;
$id=$param['id'];
$sql="DELETE FROM jobs WHERE job_id='{$id}' ";
   if($this->db->update($sql)){
   return ($status=array('status'=>'deleted','message'=>'Success!'));
   }else{
    return ($status=array('status'=>'Error','message'=>'Sorry the opportunity could not be deleted'));
    }
}

function deleteSub($param){
//var_dump($param); exit;
$id=$param['id'];
$sql="DELETE FROM subscription WHERE id= '{$id}' ";
   if($this->db->update($sql)){
   return ($status=array('status'=>'deleted','message'=>'Success!'));
   }else{
    return ($status=array('status'=>'Error','message'=>'Sorry the subscription could not be deleted'));
  }
}

function updateSub($param){

//var_dump($param); exit;
$id=$param['id'];
 $sq="SELECT * FROM subscription WHERE id='{$id}' ";
 $val=$this->db->query($sq);
 $status=$val[0]['status'];
 if($status=="Active"){
 $status="Inactive";
 }else{
 $status="Active";
 }


//$sql_value='('.rtrim($sql_value,',').')';
$query="UPDATE subscription SET status='{$status}' WHERE id='{$id}'";

   if($this->db->update($query)){
   return ($status=array('status'=>'updated','message'=>'Success!'));
   }else{
    return ($status=array('status'=>'Error','message'=>'Sorry the subscription could not be deleted'));
  }
  
}



function addAlert($param){
unset($param['subscribe_button']);
if(!isset($param['country']) || $param['country']==NULL){
$param['country']="Any";
}

if(!isset($param['state']) || $param['state']==NULL){
$param['state']="Any";
}

if(!isset($param['type']) || $param['type']==NULL){
$param['type']="Any";
}
$user=$_SESSION['email'];//isset($_SESSION['email'])?$_SESSION['email']:'oaadedayo@gmail.com';
return $this->subscribe($param);
}


function subscribe($param){

//var_dump($_POST); exit;
 $param['country']=isset($param['country'])?$param['country']:'Any';
 $param['state']=isset($param['state'])?$param['state']:'Any';
 $param['type']=isset($param['type'])?$param['type']:'Any';
 $param['email']=isset($param['email'])?$param['email']:$_SESSION['email'];


$que="SELECT * FROM subscription WHERE title= '{$param['title']}' AND type='{$param['type']}' AND country='{$param['country']}'  AND email= '{$param['email']}' ";
$result=$this->db->query($que);
if(count($result)>0){
return ($status=array('status'=>'Error','message'=>'You have done this subscription already!'));
}

//$new['owner']=$param['link'];
$param['email']=isset($_SESSION['email'])?$_SESSION['email']:$user;
$param['status']='Active';

$sql="INSERT INTO subscription (title, type, country, email, status, state) VALUES ( '{$param['title']}', '{$param['type']}', '{$param['country']}', '{$param['email']}', '{$param['status']}', '{$param['state']}') ";


if($this->db->update($sql)){
return ($status=array('status'=>'OK','message'=>'Success!'));
}else{
return ($status=array('status'=>'Error','message'=>'Update is not successful'));
}


}

function loadSubscription($email){
$result=array();
$all=$this->loadFile("subscription");
if($all!=NULL){
foreach($all as $key=>$value){
if($all[$key]['email']==$email){
$all[$key]=$value;
$result[]=$all[$key];
}

}
}
return $result;
}

function apply_job($param){
$sql="INSERT INTO applications (job_id, applicant_email, owner_mail, date) VALUES('{$param['job_id']}', '{$param['applicant_email']}', '{$param['owner_email']}', '{$param['date']}' );";
return $this->db->query($sql);
}

function get_applicants($id){
$sql="SELECT * FROM applications jobs WHERE  job_id='$id' ";
return $this->db->query($sql);
}

function loadAttendee($param){
$result=array();
$read_data = $this->loadFile("subscription");
				 $i=0;
				 $subs=$read_data;//(json_decode($read_data,true)); 
//&& ($param['country']==$sub['country'] || $sub['country']=="Any") && ($param['state']==$sub['state'] || $sub['state']=="Any") && ($param['type']==$sub['type'] || $sub['type']=="Any")
foreach($subs as $sub){
$title=strtolower($sub['title']);
$pos = strpos(strtolower($param['title']), $title);

if(($pos!==false) && ($param['country']==$sub['country'] || $sub['country']=="Any") && ($param['state']==$sub['state'] || $sub['state']=="Any") && ($param['type']==$sub['type'] || $sub['type']=="Any") ){
$result[$i]=$sub;

}
$i++;
}
return $result;
}

function loadActivity($id){
$sql="SELECT * FROM traffic WHERE id='$id' ";
return $this->db->query($sql);
}


function loadComments($c_id){
$sql="SELECT * FROM comments WHERE author='$c_id'";
return $this->db->query($sql);
}


function postComment($param){
//var_dump($param); exit;
$sql="INSERT INTO comments (author,user,img_url,comment,email,link,name) VALUES('{$param['author']}', '{$param['name']}','{$param['img_url']}', '{$param['comment']}','{$param['email']}','{$param['link']}','{$param['name']}')";

if($this->db->update($sql)){
return ($status=array('status'=>'OK','message'=>'Success!'));
}else{
return ($status=array('status'=>'Error','message'=>'Update is not successful'));
}

}

function loadActivitiesByType($type){
if($type=="all"){
return $this->db->query("SELECT * FROM traffic ORDER BY id DESC ");
}else{
return $this->db->query("SELECT * FROM traffic WHERE type='{$type}' ");
}

}

function do_hangout($param){
$sql="UPDATE applications SET hangout_date='{$param['date']}', hangout_url='{$param['url']}',hangout_time='{$param['time']}' WHERE id='{$param['applicant_id']}'";
return $this->db->update($sql);
}

function addTestimonial($param){
//var_dump($param); exit;
$name=htmlspecialchars(strip_tags($_POST['name']));
$testimony=htmlspecialchars(strip_tags($_POST['testimonial']));//$_POST['testimonial'];
$date=date('m/d/Y');
return $this->db->update("INSERT INTO testimonial (name,testimony,date) VALUES ('$name','$testimony','$date') ");
}

function loadTestimony(){
return $this->db->query("SELECT * FROM testimonial ORDER BY id DESC");
}

function search($term){
$result=array();
$ret1=array();
$ret2=array();
$today=date("m/d/Y");
$ret1= $this->db->query("SELECT * FROM jobs WHERE  (jobs.title LIKE '%{$term}%' OR jobs.message LIKE '%{$term}%' OR jobs.state LIKE '%{$term}%' OR jobs.country LIKE '%{$term}') AND deadline >= '{$today}' ");
$ret2= $this->db->query("SELECT * FROM traffic WHERE traffic.message LIKE '%{$term}%'  OR traffic.type LIKE '%{$term}%' ");
$result['jobs']=$ret1;
$result['traffic']=$ret2;
return $result;
}

function loadTrendingVideos(){
 $sql= "SELECT * FROM traffic ORDER BY video_url DESC";
 return $this->db->query($sql);
}
}

class Db {
	public $handle;
	public $fileType;
	
	public function __construct() {
	
		if (!$this->handle = mysql_connect(SERVER, USERNAME, PASSWORD)) {
      		exit('Error: Could not establish  connection to database using ' . USERNAME . '@' . SERVER);
    	}

    	if (!mysql_select_db(DATABASE, $this->handle)) {
      		exit('Error: Could not connect to database ' . DATABASE);
    	}
		
		mysql_query("SET NAMES 'utf8'", $this->handle);
		mysql_query("SET CHARACTER SET utf8", $this->handle);
  	}
		
  	public function query($sql) {
	$result=array();
	$resource=mysql_query($sql);
	if(@mysql_num_rows($resource)>0){
	 while($value=mysql_fetch_assoc($resource)){
	 $result[]=$value;
	 }
	 return $result;
	 }
	else return NULL;	
  	}
	
	public function update($squel) {
	    if(mysql_query($squel))
	    return true;
	    return false;	
  	}
		
	public function __destruct() {
	mysql_close($this->handle);
	}
	
	
	
	function login($param){
 $username=htmlspecialchars(strip_tags($param['username']));
 $password=htmlspecialchars(strip_tags($param['password']));
 $sql= "SELECT * FROM users WHERE username='{$username}' AND password= '{$password}' ";
 return $this->query($sql);
}



}
?>