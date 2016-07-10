<?php 
include_once 'controller/functions.php';
  // var_dump($ret);  
   $activities=$mplusu->loadCurrentActivities();
   
 $data = $mplusu->loadFile("traffic");
if(isset($_POST['activity_type'])){
//var_dump($_POST['activity_type']);
$_SESSION['activity_type']=$_POST['activity_type'];
//$activities=$mplusu->loadActivitiesByType($_POST['activity_type']);
}
if(isset($_SESSION['activity_type'])){
$activities=$mplusu->loadActivitiesByType($_SESSION['activity_type']);
}
if(isset($_POST['map_act'])){
$_SESSION['activate_map']=$_POST['map_act'];
//var_dump($_SESSION['activate_map']); exit;
}

?>

<script>
addEventListener("DOMContentLoaded",enableMap,false);
function changeMap(){
var act = sessionStorage.getItem("map_enabled");

if(act=='false'){
sessionStorage.setItem("map_enabled",true);
}else{
sessionStorage.setItem("map_enabled",false);
}
window.location.reload();
//document.forms['activate_form'].submit();
}

//alert(en);
</script>

<div class="wrapper wrapper-style2">
<br/><br/><br/><br/><br/><br/><br/>
 <form name="activate_form" method="post" action="" >
  <input type="hidden" name="map_act"  value="true" >
    </form> 
<div id="my_op" style="width:100%; border-bottom:1px dotted #CCCCCC; padding-left:7%; "  ><a href="#" onClick="activate_activity('all');" style="border-left:1px dotted #CCCCCC;"  class="<?php if(!isset($_SESSION['activity_type']) || $_SESSION['activity_type']==NULL || $_SESSION['activity_type']=="all"){ ?>active_btn<?php } ?>"  role="button" id="opp2"   title="Click to view all activities">General</a> <a href="#" onClick="activate_activity('traffic');"   class="<?php if(isset($_SESSION['activity_type']) && $_SESSION['activity_type']=="traffic"){ ?>active_btn<?php } ?>"  role="button" id="opp2"   title="Click to view traffic related activities">Traffic</a><a href="#" onClick="activate_activity('event');"  role="button" id="opp2"    class="<?php if(isset($_SESSION['activity_type']) && $_SESSION['activity_type']=="event"){ ?>active_btn<?php } ?>" title="Click to view event related activities">Events</a><a href="#" onClick="activate_activity('disaster');"   role="button" id="opp2"   title="Click to view disaster related activities" class="<?php if(isset($_SESSION['activity_type']) && $_SESSION['activity_type']=="disaster"){ ?>active_btn<?php } ?>" >Disasters</a><a href="#" onClick="changeMap();" style="float:right;  margin-bottom:10px;"  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="opp" title="click to add new activity" ><div id="mapper">Activate Map</div></a><a href="" style="float:right;  margin-bottom:10px;"  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="opp" title="click to add new activity" >Add Activity</a></div>
<br/><br/><br/>

				<article id="work">		
					<div class="row"  >
							<div class="12u" id="top_search_box"><br/>
								<form method="post" action="#" id="search" >
									<div>
										<div class="row half">
											<div class="6u">
												<input type="text" name="searchTextField" id="searchTextField" placeholder="Source" title="type source address" />
											</div>
											<div class="6u">
												<input type="text" name="searchTextField2" id="searchTextField2" placeholder="Destination" title="type destination address" />
											</div>
										</div>
																			<div class="row">
											<div class="8u" style="float:right; padding-top:10px;">
                                            <a href="#" title="click to view opportunity distribution on map" id="go_btn"  class="hh" style="padding-left:50px; padding-right:50px" onClick="initialize('opportunity');">View Oppotunity Distribution</a>
												<a href="#"  id="go_btn" title="click to view activity distribution on map" onClick="initialize('activity');">View Activity Distribution</a>
												
											</div>
										</div>
									</div>
								</form>
							</div>
						</div><br/>
					
					<div class="container">
					
						<div class="row">
                        
                        <div class="8u">
								<section class="box box-style2" id="googleMap" >
									
									
								</section>
                                
                                <section class="box box-style1" style="" id="symbols" >
									
									<h5><center>Symbols</center></h5>

<p style="color:#999999; font-size:12px; ">

<img src="resources/markers/TRAFFIC.png" width="60px" height="50px" alt="Traffic symbol" id="map_icon" style="margin-bottom:10px" title="icon for traffic" />&nbsp;&nbsp;<img src="resources/markers/event.png" width="60px" height="50px" id="map_icon" alt="Event symbol" title="icon for event" style="margin-bottom:10px" />&nbsp;&nbsp;<img src="resources/markers/OPPORTUNITY.png" width="60px" height="50px" title="icon for opportunity" id="map_icon" alt="Others symbol" style="margin-bottom:10px" />&nbsp;&nbsp;<img src="resources/markers/OTHERS.png" width="60px" height="50px" id="map_icon" title="icon for uncategorized activity" alt="Others symbol"  style="margin-bottom:10px" />
</p>
								</section>
							</div>
                        
						<div class="4u" id="activity_box">
								<section class="box box-style1" style=" font-size:13px; padding-left:5px; background:#F7F7F7; padding-right:5px; " id="activity">
									
									<h5><center>Activities</center></h5>
                                    <form method="post" action="#" id="" >
                                    <input type="search" name="activity" placeholder="search activity" value="<?php echo isset($_POST['activity'])?$_POST['activity']:''; ?>" style="border-radius:3px; height:35px" />
                                    <input type="hidden" name="search_activity" value="yes">
                                    </form>
                                    <?php 
								if(isset($_SESSION['activate_map'])){
								//var_dump($_SESSION['activate_map']); exit;
								
								}
									if(isset($_POST['search_activity'])){ 
                  $param=array('activity'=>$_POST['activity']);
                  $activities=$mplusu->searchActivity($param);
                  $_GET['page']=1;
                  }
									
									
									$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                    $limit =5;
                                    $startpoint = ($page * $limit) - $limit; 

									$all=array();
									
									function cb($a, $b) {
                                     return strtotime($b['date']) - strtotime($a['date']);
                                      }
									  
									  
									  if($activities!=NULL){
                                     uasort($activities, 'cb');
									  }
									
									if($activities!=NULL){                
                                     $pagination=pagination4($activities,$limit,$page);
                                     $activities=array_slice($activities,$startpoint,$limit);
                                     }
									
									//uasort($activities, 'cb');
									//krsort($activities);
									
									?>
                                    <?php 
									if(count($activities)<1){
									echo '<center>Not available</center>';
									}else{
									$i=0; foreach($activities as $activity){ $i++;
									$date=explode(",",$activity['date']);
									
									if($activity['type']==NULL || $activity['type']==""){
									$activity['type']="Others";
									}
									
								$non = array("'", "\"");

									 ?>
                                    
									<div id="activiti" style="border-bottom:1px dotted #0099CC; padding-top:10px "><div style="float:left" ><a href=""><img src="<?php echo $activity["image_url"]; ?>"  id="act_img" /></div><p style="line-height:20px; "><b><a href="<?php echo $activity['user_link']; ?>" style="font-size:15px"><?php echo $activity['user'].'</a>:</b>&nbsp;<a href="#" style="text-decoration:underline" onClick="viewActivity('.$activity['id'].');" title="Click to view detail" >'.((strlen($activity['message'])<25)?$activity['message']:substr($activity['message'],0,25)."...") .'.</a><br/><b>'.$activity['type'].'</b>,'.(isset($activity["location"])?(' around '.@$activity['location']." @ ".$date[1].', '.$date[0]):""); ?></p>
                                    <?php
									if($activity['type']=="disaster"){
									?>
                                    <div>Status:<a href="#" style="color:#FF0000">This case has not been reported</a><br/><br/><a href="" id="opp3" title="Report this case to the nearest police or emergency stations" >Report this case</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="" id="opp3" title="View police stations around this location" >Police stations</a><a href="" id="opp3" style="margin-right:0px" title="View emergency stations around this location" >Emergency stations</a></div><br/><br/><br/><br/>
                                    
                                    <?php } ?>
<center><div style="margin-top:-20px; padding-bottom:5px; color: #666666" id="share" >Share...&nbsp;&nbsp;<span id="myB"  class="demo g-interactivepost"
    data-clientid="123185527631-ll204ifgr6fv2p7830nqhnosak9p5di2.apps.googleusercontent.com"
    data-contenturl="http://mapplusyou.com"
    data-calltoactionlabel="INVITE"
    data-calltoactionurl="http://www.mapplusyou.com"
    data-cookiepolicy="single_host_origin"
    data-prefilltext="<?php echo $activity['message'].': '.(isset($activity["location"])?(' around '.@$activity['location']." @ ".$date[1].', '.$date[0]):""); ?>">
  <span class="icon"><img src="resources/images/google_plus_32.png" style=" width:28px; height:28px; border-radius:50%; cursor:pointer; border:1px solid #993300"  title="share on Google Plus"/></span>
  
</span>&nbsp;&nbsp;&nbsp;&nbsp;<a  href="#" onclick='publishWallPost("<?php echo str_replace($non, "", $activity['message']).': '.(isset($activity['location'])?(' around '.@$activity['location'].' @ '.$date[1].', '.$date[0]):''); ?>");'><img src="resources/images/facebook_32.png" style=" width:28px; border-radius:50%; height:28px; border:1px solid  #003366" title="share on facebook" /></a>&nbsp;&nbsp;&nbsp;&nbsp;   
   <a target="_blank" href="http://twitter.com/home?status=<?php echo $activity['message'].': '.(isset($activity["location"])?(' around '.@$activity['location']." @ ".$date[1].', '.$date[0]):""); ?>"><img src="resources/images/twitter_32.png" style=" border:1px solid  #00CCCC; border-radius:50%; width:28px; height:28px" title="share on twitter" /></a></div></center><br/><br/>
   
   
                                    </div>
									<?php  } }?><br/>
                                    <?php  echo isset($pagination)?$pagination:''; ?>
								</section>
								
							</div>
                            
				
							
					</div>
					
				</article>
				<br/><br/><br/>
                
                <form name="activity_form" method="post" action="">
                <input name="activity_type" value="false" type="hidden" />
                </form>
                <form name="view_activity" action="" method="post" >
<input type="hidden" name="link"  />
</form>
			</div>
