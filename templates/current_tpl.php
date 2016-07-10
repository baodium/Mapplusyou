<?php 
if(!isset($_SESSION['mapplusu_user'])){
//echo'<script> alert("Please login to view detail"); </script>';
//echo'<script>window.location="?p=home.php"; </script>';
}

if(isset($_POST['submit_comment'])){

unset($_POST['submit_comment']);
$done=$mplusu->postComment($_POST);
//echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/>';
//var_dump($done); exit;
}
//include_once 'resources/pagination/function.php';
  // var_dump($ret);
  if(isset($_POST['link'])){
  $link=$_POST['link'];
  }  
  
   $activities=$mplusu->loadCurrentActivities();
   //var_dump($activities); 
 $data = $mplusu->loadFile("traffic");
 $comments=$mplusu->loadComments($_POST['link']);//$_GET['link']);
//krsort($comments);

 $current=$mplusu->loadActivity($_POST['link']);

if(!$current || !isset($_POST['link'])){
echo'<script>window.location="?p=home.php"</script>';
}
$link=$_POST['link'];


//var_dump($current);

function pagination4($result, $per_page ,$page,$link, $url = '?'){  

    	$total = count($result);
		//var_dump($total); exit;
        $adjacents = "2"; 
        //$per_page=2;
    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
		//var_dump($per_page);exit;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    $pagination .= "<li class='details'>Page $page of $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$next'>Next</a></li>";
                $pagination.= "<li><a href='{$url}p=current.php&link=$link&page=$lastpage'>Last</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>Next</a></li>";
                $pagination.= "<li><a class='current'>Last</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    }

?>   

<div class="wrapper wrapper-style2">
<br/><br/><br/><br/><br/><br/>
				<article id="work">

		<div class="" style="">
							<div class="12u" id="top_search_box">

							</div>
						</div><br/><br/><br/><br/>
					
					<div class="container">
					
                    
                    
                    <style>
 .section {
padding: 40px 0 40px 20px;
min-height: 170px;
position: relative;
min-height: 180px;
}
 .section-title {
width: 30%;
position: absolute;
top: 40px;
left: 20px;

}
.section-content {
margin-left: 20%;
padding-right: 10px;
}
					</style>
                    
                    
                    
						<div class="row">
                        <div class="8u" style="color:#333333">
								<section class="box box-style" id="" >
                                
                                
                       <div class="">
                        <div style="">
                            <div style="line-height:30px; text-align:justify;"><?php echo '<a href="'.$current[0]['user_link'].'"><img src="'.$current[0]["image_url"].' " />'; ?>&nbsp;<?php echo ''.$current[0]['user']; ?></a>&nbsp; posted this around&nbsp;<b><?php echo $current[0]['location']; ?></b>@&nbsp;<b><?php echo $current[0]['date']; ?></b>.<br/>
                               Activity Type:<b><?php echo ($current[0]['type']!="")?$current[0]['type']:"others"; ?></b><br/><br/>
                               </div></br>
                        </div>
                       
                    </div><br/><br/>
                    <h4 style=" color:#999999">Activity Detail</h4>
                            
                            <p style="background: #E8F9F4; border-radius:3px; border:1px solid #CCCCCC; padding:10px; text-align:left;"><?php echo $current[0]['message']; ?><br/><br/>
                            <?php if(isset($current[0]['video_url']) && $current[0]['video_url']!="" ){ ?><a href="#" onClick="setVideoId('<?php echo $current[0]['video_url']; ?>');" id="watch-video">Watch Activity Video</a><?php }?>
                            </p><br/><br/>
								<div style=" line-height:30px"> 
								<h4 style=" color:#999999">Comments</h4>
                                <div id="comments"  style="">
                                <?php if($comments==NULL){
								echo '<center>No comment</center>';
								}else{?>
                                <?php  foreach($comments as $comment){
								echo '<div style="background:#E8F9F4; border-radius:3px; text-align:left; padding: 6px 10px; background-color: #FAFAFA; border: 1px solid #ccc; "> ';
								echo '<b><a href="'.$comment['link'].'"><img src="'.$comment['img_url'].'" style="width:30px; height:30px"  />&nbsp;&nbsp; '.$comment['name'].'</a> says:</b>';
								echo '&nbsp;&nbsp;'.$comment['comment'].'</div><br/>';
								}
								 ?>	
                                
                                <?php } ?><br/><br/>
                               <p style="text-align:left; width:80%"><b> Add Comment:</b><br/>
                              
                               <form name="comment_form" method="post">
                               <textarea name="comment"  style="text-align-left" placeholder="Your comment"></textarea>
                               <input type="hidden" name="author"  value="<?php echo isset($current[0]['id'])?$current[0]['id']:''; ?>"/>
                               <input type="hidden" name="email" value="<?php echo isset($_SESSION['email'])?$_SESSION['email']:''; ?>" />
                               <input type="hidden" name="name" value="<?php echo isset($_SESSION['mplusu_user'])?$_SESSION['mplusu_user']:''; ?>" />
                               <input type="hidden" name="link" value="<?php echo $link; ?>" />
                                <input type="hidden" name="img_url" value="<?php echo isset($_SESSION['image'])?$_SESSION['image']:''; ?>" />
                                <input type="hidden" name="submit_comment" value="yes" /> 
                               <a href="#" id="go_btn"  class="new" onclick="submitForm('comment_form');">Post Comment</a><br/>
                               </form>
                               </p>
                                </div>
                                 
								</section>
                                
                               
							</div>
							
						<div class="4u">
								<section class="box box-style2" style=" font-size:13px; padding-left:6px; background:#F7F7F7; padding-right:6px; " id="activity">
									
									<h5><center>Activities</center></h5>
                                    <form method="post" action="#" id="" >
                                    <input type="search" name="activity" placeholder="search activity" value="<?php echo isset($_POST['activity'])?$_POST['activity']:''; ?>" style="border-radius:3px; height:35px" />
                                    <input type="hidden" name="search_activity" value="yes">
                                    </form>
                                    <?php 
									
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
									  
									  
									  
                                   // uasort($activities, 'cb');
									
									
									if($activities!=NULL){                
                                     $pagination=pagination4($activities,$limit,$page,$link);
                                     $activities=array_slice($activities,$startpoint,$limit);
                                     }
									
									
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
                                    <div>Status:<a href="#" style="color:#FF0000">This case has not been reported</a>&nbsp;&nbsp;<a href="">Report case</a><br/><br/><a href="" id="opp3" title="View police stations around this location" >View police stations</a><a href="" id="opp3"  title="View emergency stations around this location" >View emergency stations</a></div><br/><br/><br/><br/>
                                    
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
			</div>
<form name="view_activity" action="?p=current.php" method="post" >
<input type="hidden" name="link"  />
</form>
<form name="video_id" action="" method="post" >
<input type="hidden" name="id"  />
</form>
<script>
function setVideoId(id){
document.forms['video_id'].id.value=id;

document.getElementById('video').src="http://www.youtube.com/embed/"+id;
var idd=document.getElementById('video').src="http://www.youtube.com/embed/"+id;
//alert(idd);
return false;
}

//alert();
</script>

  <script>
 // alert(window.innerWidth);
  $(function() {
   
 
   
 
    $( "#dialog-form" ).dialog({
	//if(window.innerWidth/2)
      autoOpen: false,
      modal: true,
	  width:(window.innerWidth/2)>300?(window.innerWidth/2):250,
	  height:(window.innerWidth/2)>300?(window.innerHeight/2+200):400,
      buttons: {
        "Close": function() {
		 $( this ).dialog( "close" );//allFields.val( "" ).removeClass( "ui-state-error" );
 //window.location="?p=location.php";
        }
      },
      close: function() {
       allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#watch-video" )
      .button()
      .click(function() {
	 //window.location="?p=location.php";//document.getElementById('dialog-form').style.visibility="visible";
        $( "#dialog-form" ).dialog( "open" );
      });
  });
  
 //$current[0]['video_url']
  </script>

<script>
function getWidth(){
var width=(window.innerWidth/2)>300?(window.innerWidth/2):250;

return width;


}

function getHeigth(){
var height=(window.innerWidth/2)>300?(window.innerHeight/2+50):250;
return height;
}
var w=getWidth();


function getVideoId(){
var id=document.forms['video_id'].id.value;
//alert id; return false;
console.log(id);
return id;
}
var did=getVideoId();
</script>

<div id="dialog-form" style="width:500px" title="Activity Video"   >
<center><br/><?php 
//$width='<script>getWidth();</script>';
//$video_id='<script>getVideoId();</script>';
?>
                                <iframe name="w_video" id="video" src="http://www.youtube.com/embed/<?php echo $video_id; ?>"  frameborder="3"    style="" allowfullscreen>
                               </iframe>
                                <script >
   var iframeName = document.getElementById('video');
  iframeName.style.width=(window.innerWidth/2)>300?(window.innerWidth/2-100):250-50;
  iframeName.style.height=(window.innerWidth/2)>300?(window.innerHeight/2-50):180;
 </script>
</center><br/><br/>
</div>


