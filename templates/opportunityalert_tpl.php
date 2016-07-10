<?php 
if(!isset($_SESSION['mapplusu_user'])){
echo'<script>alert("You must login to subscribe");</script>';
echo'<script>window.location="?p=home.php"</script>';
}

include 'controller/functions.php';
	//$data = file_get_contents("gs://mapplusyou/subscription.txt");
	$mysubs=$mplusu->loadSubscription($_SESSION['email']);
    $total=count($mysubs);


 ?>

<script src="resources/js/countries.js"></script>
 
<script>
document.addEventListener('DOMContentLoaded', function () {
 print_country('country');
 
});

function send(){
var title=document.forms['subscribe'].title.value;
if(title==""){
alert("Please provide the opportunity title");
document.forms['subscribe'].subscribe_button.value="No";
}else{
submitForm('subscribe');
}

}


function deleteIt(id){
ret=confirm("Are you sure you want to delete this subscription?");
if(ret==true){
document.forms['delete_sub'].id.value=id;
window.location.reload();
document.forms['delete_sub'].submit();
}
}

function activateIt(id){
ret=confirm("Are you sure you want to change the status of this subscription?");
if(ret==true){
document.forms['update_sub'].id.value=id;

window.location.reload();
document.forms['update_sub'].submit();
}

}
</script>

<div class="wrapper wrapper-style2">
<br/><br/><br/><br/><br/><br/>



				<article id="work">
                <br/>
                <h5 style="color:#333333">Recieve free notification for opportunities that match your criteria and add their deadline to your calendar</h5>
                <p>You must enable SMS notification on your Google Calendar to enable this feature.</p>
                <center><div style=" width:48%"><a href="https://www.google.com/calendar" id="go_btn" style="padding-left:40px; padding-right:40px; float:left; margin-left:0px">Enable SMS Notification</a>	
                                            <a href="?p=enablesms.php" id="go_btn" style="padding-left:40px; padding-right:40px; margin-left:5px; float:left">Learn how to enable SMS Notification</a></div></center>
                <br/>
               <div class="row" style="">
							<div class="12u" id="top_search_box">
								<form method="post" action="" id="search" name="subscribe">
									<div>
										<div class="row half">
											<div class="3u">
												<input type="text" name="title" id="searchTextField" placeholder="Opportunity title"  title="Receive notification for any new opportunity that contain this title" style="height:45px" />
											</div>
											<div class="3u">
												<select  id="type" name ="type" placeholder="Type" style="height:45px" title="Receive notification for this type of opportunity" />
                                                <option value="">Opportunity type</option>
                                                <option <?php if(isset($_POST['type']) && $_POST['type']=='FT'){  echo 'selected'; } ?> value="FT" >Full Time Job</option><option value="PT" <?php if(isset($_POST['type']) && $_POST['type']=='PT'){  echo 'selected'; } ?>   >Part Time Job</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='CT') ?'selected':''); ?> value="CT">Contract</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='SC') ?'selected':''); ?> value="SC">Scholarship</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='IT') ?'selected':''); ?> value="IT">Internship Program</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='VL') ?'selected':''); ?> value="VL">Volunteer</option>
                                                </select>
											</div>
                                            <div class="3u">
												<select style="height:45px" title="Receive notification for any new opportunity in this country"  id="country" name ="country" onChange="print_state('state',this.selectedIndex);" placeholder="Location"></select>							
											</div>
                                             <div class="3u">
												<select style="height:45px"  id="state" name ="state" title="Receive notification for any new opportunity in this state" placeholder="Location"></select>
                                     <input type="hidden" name="subscribe_button" value="yes"  />
											</div>
										</div>
																			<div class="row">
											<div class="12u" style="float:right; padding-top:15px;">
                                            
												<a href="#"  id="go_btn" style="padding-left:99px; padding-right:99px" onclick="send();" title="click to subscribe" >Subscribe</a>
										
											</div>
										</div>
									</div>
								</form>
							</div><br/><br/>
						</div>
                
                
					<div class="container">
                    
                 <?php
				

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit =9;
$startpoint = ($page * $limit) - $limit; 
//var_dump($routes);
if($mysubs!=NULL){                
rsort($mysubs);
 $pagination=pagination3($mysubs,$limit,$page);
$mysubs=array_slice($mysubs,$startpoint,$limit);
 }

?>
<div id="container">	
<h6>Here's your subscription list</h6>			 
<?php 
//var_dump($mysubs); exit;
if(count($mysubs)>0){

foreach($mysubs as $sub){  ?>
			
						<div class="row">
							<div class="4u" style="padding-bottom:30px; ">
								<section class="box box-style1" style="padding:10px 2px 2px 22px;  ">
									
									<p style="text-align:left; ">
                                    <b>Title:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(strlen($sub['title'])<25) { echo $sub['title']; }else{echo substr($sub['title'],0,25)."..."; } ?><br/>
                                    <b>Type:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($sub['type']=='FT'){echo '<span style="background:#006600; color:#fff; border-radius:3px; padding:2px;" >Full Time</span>'; }elseif($sub['type']=='PT'){ echo '<span style="background:#003333; color:#fff; border-radius:3px; padding:2px;" >Part Time</span>';}elseif($sub['type']=='SC'){echo '<span style=" color:#fff; border-radius:3px; padding:2px; background:#663333" >Schorlarship</span>';}elseif($sub['type']=='IT'){echo '<span style="background:#CC6600; color:#fff; border-radius:3px; padding:2px;" >Internship</span>';}elseif($sub['type']=='FT'){echo '<span style="background:#0099FF; color:#fff; border-radius:3px; padding:2px;" >contract</span>';}else{echo '<span style="background:#333333; color:#fff; border-radius:3px; padding:2px;" >Any</span>';} ?><br/>
                                    <b>Country:</b><?php echo $sub['country']; ?><br/>
                                    <b>State:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sub['state']; ?><br/>
                                    <b>Status:</b>&nbsp;&nbsp;&nbsp;<?php echo ($sub['status']=='Inactive')?'<span style="color:red">'.$sub['status'].'</span>':'<span style="color:green">Active</span>'; ?>
                                    
                                    </p>
									
                              
                                     <?php
			   $address=$sub['country'].','.$sub['state'];
               $prepAddr = str_replace(' ','+',$address);
			   ?>  

<div class="nav" >
<ul class="level-1 white" >
         <li class="burst"><a href="#" onClick="activateIt('<?php echo $sub['id']; ?>');"><?php echo ($sub['status']=='Active')?'Deactivate': 'Activate'; ?></a></li>
        <li class="bag"><a href="#" onClick="deleteIt('<?php echo $sub['id']; ?>');">Delete</a></li>
</ul>
</div>
								</section>
							</div>
							
							<?php } }else{  ?>
							<div class="row">
							<div class="12u" style="padding-bottom:10px"><br/>
								<section class="box box-style1" style="padding:10px 5px 10px 5px"><br/><br/>
                                <p>You do not have any active subscription<br/><br/>
                                <a href="?p=contract.php"><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a>
                                </p><br/><br/>
                                </section><br/>
                            </div>
                  </div>    
							
							<?php } ?></div>
								
				</article>
                <form name="delete_sub" method="post">
                 <input type="hidden" name="delete_this_sub" value="yes" />
                <input type="hidden" name="id" value="" />
                </form>
                
               
                <div id="pagination" ><center><?php echo isset($pagination)?$pagination:''; ?>
				</center></div>
			</div>
             <form name="update_sub" method="post">
                 <input type="hidden" name="update_this_sub" value="yes" />
                <input type="hidden" name="id" value="" />
                </form>
<?php
if(isset($msg) && $msg['status']=="deleted"){  
echo '<script>alert("The subscription has been deleted!");</script>';

}elseif(isset($msg) && $msg['status']=="updated"){  
echo '<script>alert("Your subscription has been updated!");</script>';

}

if(isset($msg) && $msg['status']=="Error"){
//var_dump($msg); exit;
echo '<script>alert("You have made this subscription already!");</script>';  
 
}elseif(isset($msg) && $msg['status']=="OK"){ 
echo '<script>alert("Done! thank you");</script>';//echo'<script>window.location="?p=myopportunities.php"; 
 }else{
 $msg="";
 }

?>
