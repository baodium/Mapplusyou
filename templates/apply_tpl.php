<?php
if(!isset($_SESSION['mapplusu_user'])){
echo'<script>alert("You must login to apply")</script>';
echo'<script>window.location="?p=home.php"</script>';
}

if(!isset($_POST['job_id']) || !$jobs=$mplusu->loadJob($_POST['job_id'])){
echo '<script>window.location="?p=contract.php"; </script>';
}

$deadline=$jobs[0]['deadline'];
$today=date('m/d/Y');
if($today>$deadline || $jobs[0]['url']!=NULL || $jobs[0]['url']!="" ){
echo '<script>window.location="?p=contract.php"; </script>';
}

$job=$jobs[0];
$msg="";
if(isset($ret) && $ret['status']=="Error"){  
$msg='<p style="color:#990000; font-size:16px; padding-bottom:0px">* '.ucfirst($ret['message']).'</p>'; 
}
if(isset($ret) && $ret['status']=="OK"){
echo '<script>alert("your application has been sent"); </script>'; 
echo'<script>window.location="?p=contract.php"</script>'; 
 }
 
// require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
//use google\appengine\api\cloud_storage\CloudStorageTools;

//$options = [ 'gs_bucket_name' => 'mapplusyou' ];
//$upload_url = CloudStorageTools::createUploadUrl('http://gcdc2013-mapplusyou.appspot.com', $options);

 ?>

<div class="wrapper wrapper-style2">
<br/><br/><br/><br/><br/>
				<article id="work">
				
					<div class="container" style="width:60%" ><br/><br/><br/>
					<div style="width:100%"><div style="float:right;" ><a style=" float:left; " id="create_cv_text" >You don't have a CV?</a>&nbsp;<a href="#" id="create_cv" style="  padding-left:30px; padding-right:30px ">Create a CV</a></div></div><br/><br/><br/><br/>
<?php //var_dump($upload_url); exit; ?>
						<div class="row">
							<div class="12u" style="padding-bottom:10px">
								<section class="box box-style1" style="padding:10px 5px 10px 5px"><br/>
         <h3>&nbsp;&nbsp;&nbsp;<a href="?p=contract.php" style="float:left; font-size:80%; color:#006699" ><img src="resources/images/back_button.png" style="margin-bottom:-5px" />&nbsp;Back</a>Opportunity Application Form </h3><br/>
                                <p>Opportunity Title:&nbsp;<a href="#" onclick="viewJob('<?php echo $job['job_id']; ?>');"><?php echo $job['title']; ?></a></p>
                                <?php echo($msg); ?>
                                <form name="application_form" action="<?php //echo $upload_url?>" method="POST" enctype="multipart/form-data" style="padding:50px; text-align:left">
                                <p>Your Name:<input type="text" name="name" style="height:40px" /></p><br/>                              
                                <p style="" >Select your CV for upload:<input type="file" id="files" name="files" style="font: 16pt bold 'Vollkorn';color: #bbb;" /></p>
                                
                                <div id="progress_bar"><div class="percent">0%</div></div>
                                <output id="list"></output>
                                <input type="hidden" name="submit_application" value="yes"   />
                                <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>"   />
                                <a href="#" id="go_btn" class="button form-button-submit" onclick="submitForm('application_form');" >Send Application</a>
                                </form><br/><br/><br/>
                                <?php 
						$address=$job['country'].','.$job['state'];
               $prepAddr = str_replace(' ','+',$address);
								?>
								<div class="nav" >
                                <ul class="level-1 white" >
                                <li class="diap"><a href="#" title="Click to view detail" onclick="viewJob('<?php echo $job['job_id']; ?>');">Detail</a></li>
                                <li class="bookmark"><a href="?p=loaction.php&address=<?php echo $prepAddr; ?>">Locate on map</a></li>
                                <li class="people"><a href="<?php echo $job['link']; ?>">Meet Owner</a></li>
                                
                                </ul>
                                </div>
								</section>
							</div>
				</article>
				<br/>
			</div>
<div id="dialog-form" title="Create CV" style="width:500px">
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
           <form name="view_job" action="?p=job_detail.php" method="post" >
<input type="hidden" name="job_id"  />
</form>
            <script>
  var reader;
  var progress = document.querySelector('.percent');

  function abortRead() {
    reader.abort();
  }

  function errorHandler(evt) {
    switch(evt.target.error.code) {
      case evt.target.error.NOT_FOUND_ERR:
        alert('File Not Found!');
        break;
      case evt.target.error.NOT_READABLE_ERR:
        alert('File is not readable');
        break;
      case evt.target.error.ABORT_ERR:
        break; 
      default:
        alert('An error occurred reading this file.');
    };
  }
function getExtension(name){
var lastdot=name.lastIndexOf(".");
var extension=name.substr(lastdot+1,name.length);
if(extension!="wmv" && extension!="wma" && extension!="avi" && extension!="mpeg"){
abortRead();
alert(extension+" file is not supported");
return false;
}
return extension;
}
  function updateProgress(evt) {
    // evt is an ProgressEvent.
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        progress.textContent = percentLoaded + '%';
      }
    }
  }

  function handleFileSelect(evt) {
   document.getElementById('list').innerHTML="";
   progress.style.width = '0%';
    progress.textContent = '0%';
    var files = evt.target.files; // FileList object
    var total=files.length;
	
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
        if(i>4){
		return false;
		}
      // Only process image files.
	  
      if (!f.type.match('application.*')) {
	  alert("This file type is not supported");
	  return false;
        //continue;
      }
	  if (f.size>100000) {
	  alert("This file is too large!");
	 return false;
        //continue;
      }


      var reader = new FileReader();
    reader.onerror = errorHandler;
    reader.onprogress = updateProgress;
	
	reader.onloadstart = function(e) {
      document.getElementById('progress_bar').className = 'loading';
    };
      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
	progress.style.width = '100%';
      progress.textContent = '100%';
      setTimeout("document.getElementById('progress_bar').className='';", 2000);
          var span = document.createElement('span');
          span.innerHTML = ['<center><img class="thumb" src="resources/images/video.png" title="', escape(theFile.name), '"/>Done!</center><br/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }

  }
  
  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
<script src="resources/diaog/jquery-1.9.1.js"></script>
  <script src="resources/diaog/jquery-ui.js"></script>
  <script>
  document.getElementById('dialog-form').style.visibility="hidden";
  </script>
  
  <script>
  $(function() {
    
  
 
    $( "#dialog-form" ).dialog({
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
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#create_cv" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
		 document.getElementById('dialog-form').style.visibility="visible";
      });
  });
  </script>
