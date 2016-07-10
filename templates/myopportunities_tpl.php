<?php
$name="";
$url="";
if(!isset($_SESSION['mapplusu_user'])){
echo'<script>alert("You need to login to manage your opportunities");</script>';
echo'<script>window.location="?p=home.php"</script>';
}
/*
if(isset($_POST)){
var_dump($_POST); exit;
}
*/
include_once 'resources/pagination/function.php';
	
	$today=strtotime(date('m/d/Y'));
	//$data = file_get_contents("jobs.txt");
	$myjobs=$mplusu->loadPostedJob($_SESSION['email']);//$_SESSION['email']);
	$active=0;
	$expired=0;
	if(count($myjobs>0)){
	foreach($myjobs as $job){
    $deadline=strtotime($job['deadline']);
	if($deadline>=$today)
	$active++;
	else
	$expired++;
	}
	}
	
	$total=count($myjobs);
	

?>

<script src="resources/js/countries.js"></script>
  <script>



function deleteIt(id){


ret=confirm("Are you sure you want to delete this opportunity?");


if(ret==true){
document.forms['delete_form'].id.value=id;
window.location.reload();
document.forms['delete_form'].submit();
}

}
</script>


<div class="wrapper wrapper-style2">
<br/><br/><br/><br/>



				<article id="work">
                <br/><br/>
                
               <div class="row" style="">
          <br/>
									
							<div class="12u" id="top_search_box">
								<div id="wrap_up" >
										
										<div class="row half">
                                        	<div class="4u"><p style="text-align:left">
                                             <a href="?p=contract.php" ><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a><br/><br/>
												<?php 
												echo "<a href='$url'>Hi ".$name."!</a><br/>";
												if($total>1){ echo 'You have posted '.$total.' opportunities so far!'; }elseif($total==1){ echo 'You have posted 1 opportunity so far'; }else{  echo 'You have not posted any opportunity so far';}?>
                                                <br/><span style=" color:#009900">You have <b><?php echo $active; ?></b> active opportunities</span><br/>
                                               <span style="color:#990000">You have <b><?php echo $expired; ?></b> expired opportunities</span>
											</div>
											
																			<div class="row">
											<div class="4u" style="float:right; ">
										
												<a href="?p=new.php" class="button" id="go_btn" style="padding-left:70px; padding-right:70px" title="add new opportunity">Add New</a>
											</div>
										
									</div>
								</div>
							</div><br/><br/>
						</div>
                
                
					<div class="container">
                    
                 <?php
				 $read_data = $mplusu->loadFile("jobs");//file_get_contents("gs://mapplusyou/jobs.txt");

				 $i=count($read_data)+1;
				 $jobss= $read_data;//(json_decode($read_data,true));
	
				 $jobs=array();
				 $today=strtotime(date('m/d/Y'));

				 try{
				 foreach($jobss as $key=>$job){					 			 
				 $deadline=strtotime($job['deadline']);
				 //var_dump($deadline);
				 $job['id']=$key;
				 if($deadline!=false && ($today<=strtotime($job['deadline']))){
				 $jobs[$key]=$job;
				 }
				 }
				 }catch(Exception $e){ }

				  if(isset($_POST['search_job'])){ 
                  $param=array('title'=>$_POST['title'],'type'=>$_POST['type'],'country'=>$_POST['country']);
                  $jobs=$mplusu->searchJob($param);
 
                  }
				  

/*
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit =6;
$startpoint = ($page * $limit) - $limit; 
*/
if($myjobs!=NULL){                
krsort($myjobs);
 //$pagination=pagination2($myjobs,$limit,$page);
//$jobs=array_slice($myjobs,$startpoint,$limit);
 }


?>
<div id="container">				 
<?php 

if(count($myjobs)>0){

foreach($myjobs as $job){ 
									 $today=strtotime(date('m/d/Y'));
									 $deadline=strtotime($job['deadline']);
									 $status=($today<=$deadline)?'<span style="color:green">Active</span>':'<span style="color:red">Expired</span>';
									 ?>
			
						<div class="row">
							<div class="4u" style="padding-bottom:10px; ">
								<section class="box box-style1" style="padding:5px 2px 2px 2px; ">
									<?php $hangout_set=($job['hangout_date']!="" )?'yes':'no'; ?>
									<h4><?php if(strlen($job['title'])<25) { echo $job['title']; }else{echo substr($job['title'],0,25)."..."; } ?></h4>
									
                                  <p style="padding-bottom:2px"><?php 
									if($job['type']=="FT"){ echo '<span style="background:#006600; color:#fff; border-radius:3px; padding:2px;" >Full Time</span>'; 
									}elseif($job['type']=="PT"){ echo '<span style="background:#003333; color:#fff; border-radius:3px; padding:2px;" >Part Time</span>'; 
									}elseif($job['type']=="IT"){ echo '<span style="background:#CC6600; color:#fff; border-radius:3px; padding:2px;" >Internship</span>';
									 }elseif($job['type']=="SC"){echo '<span style=" color:#fff; border-radius:3px; padding:2px; background:#663333" >Schorlarship</span>';
									 }elseif(($job['type']=="CT")){ echo '<span style="background:#0099FF; color:#fff; border-radius:3px; padding:2px;" >contract</span>';} 
									 ?>&nbsp;@<?php 
									 $location= $job['state'].','.$job['country']; 
									 if(strlen($location)<25) { echo $location; }else{echo substr($location,0,25)."..."; }
									 ?><br/>
                                   
                                     <br/><span style="color:#006666">Deadline: <?php echo $job['deadline'].', '; echo ($deadline>=$today)?'<span style="color:green">Active</span>':'<span style="color:red">Expired</span>'; ?></span></p>
                                     <?php
			   $address=$job['country'].','.$job['state'];
               $prepAddr = str_replace(' ','+',$address);
			   ?>  

<div class="nav" >
<ul class="level-1 white" >
       <li class="diap"><a href="#" onclick="viewJob('<?php echo $job['job_id']; ?>');">Detail</a></li>
       <li class="people"><a href="#" onclick="viewApplicants('<?php echo $job['job_id']; ?>');" >View Applicants</a></li>
         <li class="burst"><a href="#" onclick="editJob('<?php echo $job['job_id']; ?>');">Edit</a></li>
        <li class="bag"><a href="#" onclick="deleteIt('<?php echo $job['job_id']; ?>');">Delete</a></li>
</ul>
</div>
								</section>
							</div>
							
							<?php } }else{  ?>
							<div class="row">
							<div class="12u" style="padding-bottom:10px"><br/>
								<section class="box box-style1" style="padding:10px 5px 10px 5px"><br/><br/>
                                <p>You do not have any opportunity to display<br/><br/>
                                <a href="?p=contract.php"><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a>
                                </p><br/><br/>
                                </section><br/>
                            </div>
                  </div>    
							
							<?php } ?></div>
								
				</article>
                <form name="delete_form" method="post">
                 <input type="hidden" name="delete" value="yes" />
                <input type="hidden" name="id" value="" />
                </form>
                <div id="pagination" ><center><?php  //echo isset($pagination)?$pagination:''; ?>
				</center></div>
			</div>
<form name="view_job" action="?p=job_detail.php" method="post" >
<input type="hidden" name="job_id"  />
</form>
<form name="edit_job" action="?p=edit.php" method="post" >
<input type="hidden" name="job_id"  />
</form>
<form name="applicants" action="?p=applicants.php" method="post" >
<input type="hidden" name="job_id"  />
</form>
<div id="dialog-form" title="Schedule Hangout" style="width:500px">
<form method="post" action="" id="search" name="hangout">
  <fieldset>
    <label for="email">Hangout Date</label>
     <input type="date" name="date" id="searchTextField" placeholder="Select date" style="height:40px" style="padding:0px" /> 
     <label for="email">Hangout Time</label>
     <input type="time" name="time" id="searchTextField" placeholder="Select date" style="height:40px" style=" padding:0px" /> 
     <input type="hidden" name="job_id"  />
     <input type="hidden" name="make_hangout" value="yes"  />   
  </fieldset>
  
  </form>
</div>

</center><br/><br/>
</div>

<?php
if(isset($msg) && $msg['status']=="deleted"){  
echo '<script>alert("The opportunity has been deleted");</script>';
}
?>