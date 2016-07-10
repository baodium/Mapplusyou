<?php
if(!isset($_POST['submit_job']) || $_POST['submit_job']!="yes"){
header("location:index.php");
}
$type=$_POST['cv_type'];
if($type=="0"){
include("cv.php");
}elseif($type=="1"){
include("cv2.php");
}elseif($type=="2"){
include ("cv3.php");
}

?>