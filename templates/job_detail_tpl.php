<?php
$jobs=$mplusu->loadFile('jobs');
//var_dump($_POST); exit;
if(!$_POST['job_id'] || !$jobs=$mplusu->loadJob($_POST['job_id'])){
echo '<script>window.location="index.php"; </script>';
//var_dump(id);exit;
}
$today=strtotime(date('m/d/Y'));
$deadline=strtotime($jobs[0]['deadline']);


if($today>$deadline){
echo '<script>window.location="index.php"; </script>';
}

$job=$jobs[0];
?>

<div class="wrapper wrapper-style2">
<br/><br/><br/>
<br/><br/>
<br/><br/><br/>
				<article id="work">
				
					<div class="container" style="width:62%">
					
				
						<div class="row">
							<div class="12u" style="padding-bottom:10px" >
								<section class="box box-style1" style="padding:50px; text-align:justify">
                                <a href="?p=contract.php"><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a>
									<center><h3>Opportunity Detail</h3></center><br/><br/>
                                    <table>
									<tr><td><b>Title:</b></td><td><?php echo $job['title'] ?></td></tr>
									<tr><td><b>Type:</b></td><td><?php if($job['type']=="FT"){echo "Full Time"; }elseif($job['type']=="PT"){ echo "Full Time"; }elseif($job['type']=="SC"){ echo "Scholarship"; }elseif($job['type']=="CT"){ echo "Contract"; } ?></td></tr>
									<tr><td><b>Location:</b></td><td><?php echo ($job['address'].','.$job['state'].','.$job['country']); ?></td></tr>
                                    <tr><td><b>Application Deadline:&nbsp;&nbsp;</b></td><td><?php echo ($job['deadline']); ?></td></tr>
									</table><br/>
                                    <center><b>Description:</b></center><br/>
									<div style="line-height:2"><?php echo $job['message'] ?></div>
									
		<br/><br/>	<br/><br/><br/>					
<div class="nav" >
<center>

       <?php if(isset($job['url']) && $job['url']!=""){
		        $pos=strpos($job['url'],"http://");
				$pos2=strpos($job['url'],"https://");
		         if($pos===false && $pos2===false)
				 $job['url']="http://".$job['url'];

		       } ?>
               <?php
			   $address=$job['country'].','.$job['state'];
               $prepAddr = str_replace(' ','+',$address);
			   ?>
        </center>
</div>
<div class="nav" >
<center>
<ul class="level-1 white" >

        <li class="folder" ><a href="<?php if(isset($job['url'])&& $job['url']!=""){ echo $job['url']; }else{ echo "#"; } ?>" target="_blank" title="Click to apply" <?php if(isset($job['url'])&& $job['url']==""){ ?>onclick="applyJob('<?php echo $job['job_id']; ?>');" <?php } ?>>Apply</a></li>
        <li class="bookmark"  ><a href="?p=location.php&address=<?php echo $prepAddr; ?>" title="Click to view address on map">Find on map</a></li>
        <li class="people"><a href="<?php echo $job['link']; ?>" title="Click to meet the owner on GPlus">Meet Owner</a></li>
</ul>
</div>
</center>
								</section>
							</div>
							
					
				</article>
				<br/><br/><br/>
			</div>
<form name="apply_job" action="?p=apply.php" method="post" >
<input type="hidden" name="job_id"  />
</form>
