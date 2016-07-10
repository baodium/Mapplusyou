<?php
$secret=sha1("mapplusyourules");
if(!$_GET['secret'] || $_GET['secret']!=$secret){
echo '<script>window.location="index.php"; </script>';
}else{


$read_data = $mplusu->loadFile("jobs");//file_get_contents("gs://mapplusyou/traffic.txt");
				// $read_data=(array)(json_decode($read_data;
 $jobs=$read_data;//(json_decode($read_data,true)); 

$result=array();
$today=strtotime(date('m/d/Y'));

//$handle=json_decode(file_get_contents($path),true);
foreach($jobs as $key=>$value){
$deadline=strtotime($value['deadline']);
if($deadline!=false && ($today<=strtotime($value['deadline']))){
$result[$key]=$jobs[$key];
}
}

$data=json_encode($result);
//var_dump($data); exit;
?>
<script>
var value=<?php echo '<mapplsyou_op>'.$data.'</mapplsyou_op>'; ?>
</script>
<?php } ?>

