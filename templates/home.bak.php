<?php
if(isset($_POST['get_pos'])){
echo '<script>getCurrentPos();</script>';
}

$testimon=$mplusu->loadTestimony();
//$p = file_get_contents("gs://mapplusyou/page.txt");				
//if($p!="home.php"){

//}
$page=='home.php';
$testi0name=$testimon[0]['name'];
$testi0testimony=$testimon[0]['testimony'];

$testi1name=$testimon[1]['name'];
$testi1testimony=$testimon[1]['testimony'];

$testi2name=$testimon[2]['name'];
$testi2testimony=$testimon[2]['testimony'];
$authUrl=isset($_SESSION['mapplusu_user'])?"?p=location.php":$authUrl;
$button_text=isset($_SESSION['mapplusu_user'])?'<a id="go_btn"  href="?p=location.php" style="font-size:16px; float:right;   " >You are logged in, continue</a>':'<a href="'.$authUrl.'" id="go_btn" style="font-size:16px; text-align:center; float:right;" >Login with Google Id</a>';

//if(isset($_SESSION['mapplusu_user'])){ echo "<div style='font-size:22px; margin-bottom:-50px'>".$_SESSION['mapplusu_user']."</div>"; } 
$authUrl=isset($_SESSION['mapplusu_user'])?"?p=location.php":$authUrl;
$htmlBody = <<<END



<header id="header">
<script>
(function($){
$(document).ready(function(){
$('#pi').cycle({fx:'scrollDown',speed:'1000',timeout:5000 });

})
})(jQuery);
</script>

	<div class="row2">
    <br/><br/>	
	<div class="clr"></div>
      <div class="slider" >
        <div id="coin-slider"><a href="#"><img src="resources/erg/images/slide1.png" name="one" id="one" style="width:98%" alt="" /></a> <a href="#"><img src="resources/erg/images/slide2.png" style="width:98%" name="two" id="two"  alt="" /></a> <a href="#"><img src="resources/erg/images/slide3.png" name="three" id="three" style="width:98%" alt="" /></a><a href="#"><img src="resources/erg/images/slide4.png" name="four" style="width:98%" id="four" alt="" /></a><a href="#"><img src="resources/erg/images/slide5.png" name="five" id="five" style="width:98%"  alt="" /></a><a href="#"><img src="resources/erg/images/slide6.png" name="six" style="width:98%" id="six" alt="" /></a></div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>	
	
	</div>
</header>
<center><div style=" width:85%; color:#666666">You don't have a CV? <a href="#" id="cv_creator" style="padding:0px; background:transparent" >Create one here</a></div></center>

<div style="width:85%" id="loggin" >$button_text</div><br/>
<br/><br/>
<center><div id="latest-works" style="border-bottom:1px solid #ccc">
<h5 id="trending"  >Trending Activity videos</h5>
</div></center><br/>
		
	<div class="row2 hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3b" style="border-bottom:1px solid #ccc; border-radius:3px">
		<div class="large-4 columns feature">
			<span class="" style="width:80px; height:80px"></span>
			<h6><a href="#">Connect you with opportunities</a></h6>
<p><iframe name="w_video" id="video" style=" padding:0px; border:2px solid #ccc; border-radius:5px" src="http://www.youtube.com/embed/y7SoTGWNNJs"  frameborder="3"    style="width:220px; height:160px; border-radius:5px; background:transparent; padding:10px" allowfullscreen>
                               </iframe></p>
		</div>
		<div class="large-4 columns feature">
			<span class="" style="width:80px; height:80px"></span>
			<h6><a href="#">Easy to Manage and Update</a></h6>
			<p ><iframe name="w_video" id="video" style=" padding:0px; border:2px solid #ccc; border-radius:5px"  src="http://www.youtube.com/embed/y7SoTGWNNJs"  frameborder="3"    style="width:220px; height:160px; border-radius:5px; background:transparent; padding:10px" allowfullscreen>
                               </iframe></p>
		</div>
		<div class="large-4 columns feature">
			<span class="" style="width:80px; height:80px"></span>
			<h6><a href="#">Mapplusyou Video</a></h6>
			
			<p padding:0px">
                       
					    <iframe name="w_video" style=" padding:0px; border:2px solid #ccc; border-radius:5px" id="video" src="http://www.youtube.com/embed/y7SoTGWNNJs"  frameborder="3"    style="width:220px; height:160px; border-radius:5px; background:transparent; padding:10px" allowfullscreen>
                               </iframe>
                    
			</p>
		</div>
		
		
	</div>
		
		
		
		
		<div class="row2 hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3b" style="background:#e8ebf1; border-bottom:1px solid #ccc ">
		
		<div class="large-6 columns feature">
			<span class="" style="width:160px; height:80px"></span>
			<h6><a href="#" id="test-monia" >Testimonials</a></h6><br/><br/>
			
			<div  style="text-align:left" >
        
             
				
                <div id="pi" style="height:100px" ><p >
                <span style="font-size:18px;">$testi0name:</span>&nbsp;$testi0testimony.<br/><br/><a href="?p=testimonials.php">More testimonial...</a></p>
				<p ><span style="font-size:18px">$testi1name:</span>&nbsp;$testi1testimony<br/><br/><a href="?p=testimonials.php">More testimonial...</a></p>
				<p ><span style="font-size:18px">$testi2name:</span>&nbsp;$testi2testimony <br/><br/><a href="?p=testimonials.php">More testimonial...</a></p>
                <br/></div>
        
            </div>
			
		</div>
		<div class="large-4 columns feature">
			<span class="" style="width:80px; height:80px"></span>
			<h6><a href="#">Our mobile Apps</a></h6>
			
			<div id="clients">
                       
					   <ul  style="height:160px;   margin-bottom:0px; ">
               <li><a href="#"><img src="resources/images/bb.png" style="width:70px; height:70px; margin-top:60px; margin-left:20px "></a></li>
              <li><a href="#"><img src="resources/images/android.png" style="width:70px; height:70px; margin-top:60px; margin-left:20px"></a></li>
              <li><a href="#"><img src="resources/images/win11.png" style="width:70px; height:70px; margin-top:60px; margin-left:30px"></a></li>
               </ul>
                    
			</div>
		</div>
		
		
	</div>
	
	
	
	
		


<br/>
<div id="features" class="section features" data-magellan-destination="features"  >
	<div class="row2 hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3b" style="">
		<div class="large-4 columns feature">
			<span class="icon icon-suitcase hi-icon" style="width:80px; height:80px"></span>
			<h3>Connect you with opportunities</h3>
<p>There are plenty of opportunities available in Africa. Mapplusyou comes handy whenever you are looking for job opportunities or you're looking to hire. 

</p>
		</div>
		<div class="large-4 columns feature">
			<span class="icon icon-lifebuoy hi-icon" style="width:80px; height:80px"></span>
			<h3>Easy to Manage and Update</h3>
			<p>Mapplusyou provides an easy way to Upload, Organize, Deliver and Manage the largest catalogue of Opportunities around the globe.

</p>
		</div>
		<div class="large-4 columns feature">
			<span class="icon icon-users hi-icon" style="width:80px; height:80px"></span>
			<h3>Dont miss out on any activity</h3>
			
			<p>Mapplusyou allows you to share your moments at events and even get to upload short videos with the activity.  You are allowed the luxury of sharing your location and traffic situation.

</p>
		</div>
	</div>
	<br/><br/>
</div>
<div id="dialog-form" title="Create CV" style="width:500px; top:20px">
<form method="post" action="?p=create_cv.php" id="search" name="cv_type" >
  <fieldset>
    
    <center><h5>Choose the style of CV you prefer</h5></center><br/>
    <center><div>
    <div style="float:left; padding-right:10px; width:33%"><img src="resources/images/standard.png" style="height:120px; width:90%" /><center><input type="radio" name="cv_style" value="0" checked="checked" ></center><span style="font-size:12px">Standard1</span></div>
    <div style="float:left;padding-right:10px;  width:33%"><img src="resources/images/stand2.png" style="height:120px; width:90%"  /><center><input type="radio" name="cv_style" value="1" ></center><span style="font-size:12px;">Standard2</span></div>
    <div style="float:left;padding-right:10px;  width:33%"><img src="resources/images/stand3.png" style="height:120px; width:90%" /><center><input type="radio" name="cv_style" value="2" ></center><span style="font-size:12px">Standard3</span></div>   
    </div>
    </center>
  </fieldset>
  <input type="hidden" name="select_cv_style" value="yes">
  
  </form>
</div>
<script src="resources/diaog/jquery-1.9.1.js"></script>
  <script src="resources/diaog/jquery-ui.js"></script>
  <script>
  document.getElementById('dialog-form').style.visibility="hidden";
  </script>
  
  <script>
  $(function() {
    
  
 
    $( "#dialog-for" ).dialog({
      autoOpen: false,
      modal: true,
	  width:(window.innerWidth/2)>300?(window.innerWidth/3):250,
	  height:(window.innerWidth/2)>300?(window.innerHeight/3+200):400,
      buttons: {
        "Submit": function() {
		 document.forms['cv_type'].submit();
		 return false;
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( message, "Activity", 3, 100 );
          if ( bValid ) {
            
           // $( this ).dialog( "close" );
		   document.forms['cv_type'].submit();
          }
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
       // allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#cv_creator" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
		 document.getElementById('dialog-form').style.visibility="visible";
      });
  });
  
  
  $('#cv_creator').click(function(e) {
    $('#dialog-form').lightbox_me({
        centered: true, 
        onLoad: function() { 
           // $('#sign_up').find('input:first').focus()
            }
        });
    e.preventDefault();
});

  </script>





			<form name="position" method="get">
            <input id="latitude" name="latitude" value="980"  type="hidden"   />
            <input id="longitude" name="longitude" value="950" type="hidden"   />
            <input type="hidden" name="get_pos" value="yes" /> 
            </form>
	        <script>
//getCurrentPos();
</script>
<script>

document.getElementById('one').style.visibility="hidden";
document.getElementById('two').style.visibility="hidden";
document.getElementById('three').style.visibility="hidden";
document.getElementById('four').style.visibility="hidden";
document.getElementById('five').style.visibility="hidden";
document.getElementById('six').style.visibility="hidden";

</script>
END;
echo $htmlBody;

