<?php 
include 'controller/class.maplusu.php';
$mplusu=new controller(); 
$fp = $mplusu->loadFile("traffic");
//var_dump($fp); exit;
echo $fp;