<?php
$v_url=isset($_GET['video'])?$_GET['video']:'';
if($v_url==""){
echo '<script> window.location="?p=location.php";</script>';
}
 ?>
  <script>
 // alert(window.innerWidth);
  $(function() {
   
 
   
 
    $( "#dialog-form" ).dialog({
	//if(window.innerWidth/2)
      autoOpen: true,
      modal: true,
	  width:(window.innerWidth/2)>300?(window.innerWidth/2):250,
	  height:(window.innerWidth/2)>300?(window.innerHeight/2+200):400,
      buttons: {
        "Close": function() {
 window.location="?p=location.php";
        }
      },
      close: function() {
        window.location="?p=location.php";//allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#create-user" )
      .button()
      .click(function() {
	 window.location="?p=location.php";//document.getElementById('dialog-form').style.visibility="visible";
        $( "#dialog-form" ).dialog( "open" );
      });
  });
  
 
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

</script>


<div class="wrapper wrapper-style2">
<br/><br/><br/><br/><br/><br/>
  
<br/><br/><br/><br/>
				<article id="work">

<div id="dialog-form" style="width:500px" title="Activity Video"   >
<center><br/><?php 
$width='<script>getWidth();</script>';
?>
                                <iframe name="w_video" id="video" src="http://www.youtube.com/embed/<?php echo $v_url; ?>"  frameborder="3"    style="" allowfullscreen>
                               </iframe>
                                <script >
   var iframeName = document.getElementById('video');
  iframeName.style.width=(window.innerWidth/2)>300?(window.innerWidth/2-100):250-50;
  iframeName.style.height=(window.innerWidth/2)>300?(window.innerHeight/2-50):180;
 </script>
</center><br/><br/>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</article>
				<br/><br/><br/>
			</div>
            
            
            
 
 
 
