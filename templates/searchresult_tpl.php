<?php
if(!isset($_POST['search_m'])){
echo'<script>window.location="?p=home.php"; </script>';

}else{
$term=$_POST['search_m'];
$result=$mplusu->search($term);
}


?>

<div class="wrapper wrapper-style2">
<br/><br/><br/>
<br/><br/><br/><br/><br/>

	<article id="work">
	
					<div class="container" style="width:70%" >
					
						<div class="row">
							<div class="14u" style="padding-bottom:10px; ">
								<section class="box box-style1" style="padding:50px; text-align:justify; line-height:30px">
  
<a href="?p=opportunityalert.php" style="font-size:24px" ><img src="resources/images/back_button.png" style="margin-bottom:-5px;">&nbsp;Go Back</a><br/><br/>
<center><h3>Search result</h3></center><br/><br/>  
 


 <h4>Total opportunities found (<?php echo count($result['jobs']); ?>)</h4>
 <ul>
<?php if($result['jobs']!=NULL){ 
foreach($result['jobs'] as $job){
?>
<li style="list-style:disc" ><a href="#" title="Click to view detail" onclick="viewJob('<?php echo $job['job_id']; ?>');" ><?php echo $job['title'].'&nbsp; &nbsp('.$job['type'].' at '.$job['state'].','.$job['country'].' )'; ?>  </a></li>
<?php 
}
} else {?>
<li>Your search term could not be found</li>
<?php } ?>
</ul>
<br/>
			</section>
            </div>
		</article><br/><br/><br/>
	</div>		

<form name="view_job" action="?p=job_detail.php" method="post" >
<input type="hidden" name="job_id"  />
</form>

