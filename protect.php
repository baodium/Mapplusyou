<?php
session_start();
if(isset($_POST['protect'])){
//var_dump($_POST);
$username=$_POST['username'];
$password=$_POST['password'];
if($username=="testing_mapplusyou" && $password=="yes"){
$_SESSION['logged_in']="yes";
//var_dump($_SESSION);
header('location:index.php');
}
}
?>
<html>
<head>
 <title>Map Plus You</title>
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css" />
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqqEjyaKwHduw_26LD6W8HBIEzBFhmZXg&sensor=false&libraries=places">
      </script>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css" />     
		<script src="resources/js/jquery.min.js" type="text/javascript"></script>
		<script src="resources/js/config.js" type="text/javascript"></script>		
       
		<script src="resources/js/skel-panels.min.js" type="text/javascript"></script>
		<script src="resources/js2/skel.min.js" type="text/javascript"></script>           

<link href="resources/erg/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="resources/erg/css/coin-slider.css" />

<script type="text/javascript" src="resources/js/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="resources/erg/js/script.js"></script>
<script type="text/javascript" src="resources/erg/js/coin-slider.min.js"></script>

<link rel="stylesheet" type="text/css" href="resources/stylesheets/reset.css" />
    <link rel="stylesheet" type="text/css" href="resources/stylesheets/main.css" />       
        <link rel="stylesheet" href="resources/css/style-desktop.css"  type="text/css"/>
	    <link rel="stylesheet" href="resources/css/style.css" type="text/css" />
          <link  rel="favicon" href="resources/images/favicon.ico" >     
        <link rel="stylesheet" href="resources/flickr/jquery-ui-1.8.16.custom.css" type="text/css" />
        <script src="resources/js/modernizr.custom.js" type="text/javascript"></script>	
        <link rel="stylesheet" href="resources/foundation.min.css">
        <link rel="stylesheet" href="resources/style.css">	
        
        
        
 
<link href="resources/temp/anythingslider.css" rel="stylesheet" type="text/css">
<body><br/><br/><br/><br/>

<center>
<div id="dialog-form" title="Login" style="width:500px; top:20px">
  <p style="font-size:16px">
  Thank you for taking some minutes out of your time to test Mapplusyou.
  Note that we have included some recharge card (MTN, GLO, AIRTEL, ETISALAT) in
  some location in our website as a token of our appreciation.
  
  Kindly send your feedback to mapplusyou@gmail.com.

  </p>
  <form name="frrm" method="post" action="" >
           Username: <input  name="username" value=""  type="text"   /><br/>
           Password: <input name="password" value="" type="password"   /><br/>
            <input type="hidden" name="protect" value="Login" style="float:right" /> 
           
  <br/><br/>
  </form>
</div>
</center>

  <script>
  $(function() {
    
  
 
    $("#dialog-form" ).dialog({
      autoOpen: true,
      modal: true,
	  width:(window.innerWidth/2)>300?(window.innerWidth/3+50):350,
	  height:(window.innerWidth/2)>300?(window.innerHeight/3+250):550,
      buttons: {
        "Submit": function() {
		 document.forms['frrm'].submit();
		 return false;
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( message, "Activity", 3, 100 );
          if ( bValid ) {
            
           // $( this ).dialog( "close" );
		   document.forms['frrm'].submit();
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
 
    $( "#cv_creator" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
		 document.getElementById('dialog-form').style.visibility="visible";
      });
  });
  </script>
  
  
  <script src="resources/js/jquery-ui-1.8.16.custom.min.js"></script>
  <script type="text/javascript" src="resources/js/foundation.min.js"></script> 
 <!-- <script src="resources/js/jquery.flexslider.js" type="text/javascript"></script><!-- Flex slider -->
  <script type="text/javascript" src="resources/js/custom.js"></script>	
<input type="hidden" name="page" id="page" value="<?php //echo file_get_contents("gs://mapplusyou/page.txt"); ?>">	
 <script type="text/javascript">
  (function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = 'https://apis.google.com/js/client:plusone.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();
</script>
</body>
</html>
