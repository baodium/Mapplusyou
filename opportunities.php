<?php
$secret=sha1("mapplusyourules");
if(!$_GET['secret'] || $_GET['secret']!=$secret){
echo '<script>window.location="index.php"; </script>';
}else{
//$fp = file_get_contents("gs://mapplusyou/traffic.txt");
//$data=$fp;



$read_data = $mplusu->loadFile("job");//file_get_contents("gs://mapplusyou/traffic.txt");
				// $read_data=(array)(json_decode($read_data;
 $traffics=$read_data;//(json_decode($read_data,true)); 

$result=array();

//$handle=json_decode(file_get_contents($path),true);
foreach($traffics as $key=>$value){

if($value['id']!=NULL){
$result[$key]=$traffics[$key];
}
}

$data=json_encode($result);



?>
<script>
var value=<?php echo '<mapplsyou_op>'.$data.'</mapplsyou_op>'; ?>
</script>
<?php } ?>

