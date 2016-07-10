<?php 
include_once 'controller/functions.php';
?>

<script src="resources/js/countries.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
 print_country('country');
 
});
</script>

<link rel="stylesheet" href="resources/diaog/jquery-ui.css">
  
 <style>
#create-user{
padding:5px 30px 5px 30px;
}
 fieldset { padding:0; border:0; margin-top:25px; font-size:14px }
 </style> 


<div class="wrapper wrapper-style2"><br/><br/>
<br/><br/><br/><br/><br/><br/>
<div id="my_op" style="width:100%; border-bottom:1px dotted #CCCCCC; padding-left:7%; "  ><a href="#" style="border-left:1px dotted #CCCCCC; padding:4px"   role="button"   id="search_dialog"   title="Click to view all activities">Search opportunity</a> <a href="?p=myopportunities.php"    role="button" id="opp2"    title="Click to view traffic related activities">Manage your opportunities</a><a href="?p=opportunityalert.php"   role="button" id="opp2"  title="Click to view event related activities">Subscribe for FREE opportunity notification</a><a href="?p=new.php" style="float:right;  margin-bottom:10px;"  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" id="opp" title="click to add new activity" >Add new opportunity</a></div>
                
				<article id="work">
				<br/><br/>
                	<div class="row" style="">
							<div class="12u" id="top_search_box">
								
							</div>
						</div><br/>               
					<div class="container">                   
                 <?php
				 $read_data = $mplusu->loadFile("jobs");//file_get_contents("gs://mapplusyou/jobs.txt");
				// var_dump($read_data[1]);
				// var_dump(file_get_contents("gs://mapplusyou/jobs.txt")); exit;
				 $i=count($read_data)+1;
				 $jobss= $read_data;//(json_decode($read_data,true));
	
				 $jobs=array();
				 $today=strtotime(date('m/d/Y'));

				 try{
				 foreach($jobss as $key=>$value){					 			 
				 $deadline=strtotime($value['deadline']);
				 //var_dump($deadline);
				 $value['id']=$key;
				 //if($deadline!=false && ($today<=strtotime($value['deadline']))){
				 $jobs[$key]=$value;
				 //}
				 }
				 }catch(Exception $e){ }

				  if(isset($_POST['search_job'])){ 
                  $param=array('title'=>$_POST['title'],'type'=>$_POST['type'],'country'=>$_POST['country']);
                  $jobs=$mplusu->searchJob($param);
                  $_GET['page']=1;
                  }
	
if($jobs!=NULL){                
krsort($jobs);
}			  


$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit =8;
$startpoint = ($page * $limit) - $limit; 
//var_dump($routes);
if($jobs!=NULL){                
krsort($jobs);
 $pagination=pagination2($jobs,$limit,$page);
$jobs=array_slice($jobs,$startpoint,$limit);
 }


?>
				 

				
				<?php if(count($jobs)<1){  ?>
                <div class="row">
							<div class="12u" style="padding-bottom:10px"><br/>
								<section class="box box-style1" style="padding:10px 5px 10px 5px"><br/><br/><br/>
                                <p>Sorry! Your search term  cannot be found<br/><br/>
                                <a href="?p=contract.php"><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a>
                                </p><br/><br/><br/><br/><br/>
                                </section>
                            </div>
                  </div>                
                <?php }else{ //$jobs[0]=$jobs; ?>
                
				<?php try { foreach($jobs as $key=>$value){ $i--; 
				if(isset($value['url']) && $value['url']!=""){
		        $pos=strpos($value['url'],"http://");
				$pos2=strpos($value['url'],"https://");
		         if($pos===false && $pos2===false)
				 $value['url']="http://".$value['url'];

		       }
				?>
						<div class="row" id="hov">
							<div class="3u" style="padding-bottom:30px; "  >
								<section class="box box-style1" style="padding:0px 2px 2px 2px; " >
									
									<div style=" <?php 
									if($value['type']=="FT"){ echo 'background:#006600;'; 
									}elseif($value['type']=="PT"){ echo 'background:#003333;'; 
									}elseif($value['type']=="IT"){ echo 'background:#CC6600; ';
									 }elseif($value['type']=="SC"){echo 'background:#663333;';
									 }elseif(($value['type']=="CT")){ echo 'background:#0099FF;';
									 }elseif(($value['type']=="VL")){ echo 'background:#000;';
									 }elseif(($value['type']=="CP")){ echo 'background:#999;';
									 } 
									 ?>; color:#FFFFFF" ><h4 id="title_hover" style="font-size:16px"><a   href="#" onclick="viewJob('<?php echo $value['job_id']; ?>');" ><?php if(strlen($value['title'])<25) { echo $value['title']; }else{echo substr($value['title'],0,25)."..."; } ?></a></h4></div>
									<p style="padding-bottom:2px; font-size:14px"><?php 
									if($value['type']=="FT"){ echo '<span  >Full Time</span>'; 
									}elseif($value['type']=="PT"){ echo '<span  >Part Time</span>'; 
									}elseif($value['type']=="IT"){ echo '<span  >Internship</span>';
									 }elseif($value['type']=="SC"){echo '<span  >Schorlarship</span>';
									 }elseif(($value['type']=="CT")){ echo '<span  >Contract</span>';
									 }elseif(($value['type']=="VL")){ echo '<span  >Volunteer</span>';
									 }elseif(($value['type']=="CP")){ echo '<span  >Competition</span>';
									 } 
									 ?>&nbsp;@ <?php 
									 $location= $value['state'].','.$value['country']; 
									 if(strlen($location)<25) { echo $location; }else{echo substr($location,0,22)."..."; }
									 ?><br/><span style="color:#006666">Deadline: <?php echo $value['deadline'] ?></span></p>
                                     <?php
			   $address=$value['country'].','.$value['state'];
               $prepAddr = str_replace(' ','+',$address);
			   ?>
                                    
<div class="nav" >
<ul class="level-1 white" >
       <li class="diap"  style="width:25%"><a href="#" title="Click to view detail" onclick="viewJob('<?php echo $value['job_id']; ?>');">Detail</a></li>
        <li class="folder" style="width:25%"><a href="<?php if(isset($value['url'])&& $value['url']!=""){ echo $value['url']; }else{ echo "#"; } ?>" title="Click to apply" onclick="applyJob('<?php echo $value['job_id']; ?>');">Apply</a></li>
        <li class="bookmark"  ><a href="?p=location.php&address=<?php echo $prepAddr; ?>" title="Click to view address on map">Find on map</a></li>
        <li class="people"><a href="<?php echo $value['link']; ?>" title="Click to meet the owner on GPlus">Meet Owner</a></li>
</ul>

<center><div style="padding-bottom:5px; color: #666666;"><span id="myB"  class="demo g-interactivepost"
    data-clientid="123185527631-ll204ifgr6fv2p7830nqhnosak9p5di2.apps.googleusercontent.com"
    data-contenturl="http://www.mapplusyou.com"
    data-calltoactionlabel="INVITE"
    data-calltoactionurl="http://www.mapplusyou.com"
    data-cookiepolicy="single_host_origin"
    data-prefilltext="<?php  echo $value['title']." @ ". $location. ". Deadline :".$value['deadline'];?>">
  <span class="icon"><img src="resources/images/google_plus_32.png" style=" width:28px; height:28px; border-radius:50%; cursor:pointer; border:1px solid #993300"  title="share on Google Plus"/></span>
  
</span>&nbsp;&nbsp;&nbsp;&nbsp;<a  href="#" onclick='publishWallPost("<?php  echo $value['title']." @ ". $location. ". Deadline :".$value['deadline'];?>");'><img src="resources/images/facebook_32.png" style=" width:28px; border-radius:50%; height:28px; border:1px solid  #003366" title="share on facebook" /></a>&nbsp;&nbsp;&nbsp;&nbsp;   
   <a target="_blank" href="http://twitter.com/home?status=<?php  echo $value['title']."  @ ". $location. ". Deadline :".$value['deadline'];?>"><img src="resources/images/twitter_32.png" style=" border:1px solid  #00CCCC; border-radius:50%; width:28px; height:28px" title="share on twitter" /></a></div></center>
   


</div>
								</section>
							</div>
							
							<?php }
						 } catch(Exception $e){ } } ?>		
				</article>
                <div id="pagination" ><center><?php echo isset($pagination)?$pagination:''; ?>
				</center></div>
			</div>
            
            <div id="my_op" >

<div id="dialog-form" title="Search opportunities" style="width:500px">
<form method="post" action="" id="search" name="search">
  <fieldset>
    <label for="email">Opportunity Title</label>
 
     <input type="text" name="title" id="searchTextField" placeholder="Opportunity title" style="height:40px" style=" padding:0px" />
    <label for="password">Opportunity Type</label>
    <select  id="type" name ="type" placeholder="Type" style="height:40px" style=" padding:0px" />
                                                <option value="">-- Opportunity Type --</option>
                                                <option <?php if(isset($_POST['type']) && $_POST['type']=='FT'){  echo 'selected'; } ?> value="FT" >Full Time Job</option>
												<option value="PT" <?php if(isset($_POST['type']) && $_POST['type']=='PT'){  echo 'selected'; } ?>   >Part Time Job</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='CT') ?'selected':''); ?> value="CT">Contract</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='SC') ?'selected':''); ?> value="SC">Scholarship</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='IT') ?'selected':''); ?> value="IT">Internship Program</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='VL') ?'selected':''); ?> value="VL">Volunteer</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='CP') ?'selected':''); ?> value="CP">Competition</option>
												</select>  
                                                
           <label for="email">Country</label>
           <select style="height:40px; padding:0px"  id="country" name ="country" placeholder="Location"></select>
										<input type="hidden" name="search_job" value="yes"  />
 

  </fieldset>
  
  </form>
</div>
<form name="view_job" action="?p=job_detail.php" method="post" >
<input type="hidden" name="job_id"  />
</form>
<form name="apply_job" action="?p=apply.php" method="post" >
<input type="hidden" name="job_id"  />
</form>
</center><br/><br/>
</div>
   <script src="resources/diaog/jquery-1.9.1.js"></script>
  <script src="resources/diaog/jquery-ui.js"></script>
  <script>
  document.getElementById('dialog-form').style.visibility="hidden";
  </script>
  
  <script>
  $(function() {
    var type = $( "#type" ),
	  message = $( "#message" ),
      allFields = $( [] ).add( type ).add( message ),
      tips = $( ".validateTips" );

    $( "#dialog-form" ).dialog({
      autoOpen: false,
      modal: true,
	  width:(window.innerWidth/2)>300?(window.innerWidth/3):250,
	  height:(window.innerWidth/2)>300?(window.innerHeight/3+200):400,
      buttons: {
        "Search": function() {
		 document.forms['search'].submit();
		 return false;
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( message, "Activity", 3, 100 );
          if ( bValid ) {
            
           // $( this ).dialog( "close" );
		   document.forms['search'].submit();
          }
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#search_dialog" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
		 document.getElementById('dialog-form').style.visibility="visible";
      });
  });
  </script>