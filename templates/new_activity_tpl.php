<?php

$data="home.php";
//file_put_contents("gs://mapplusyou/page.txt",$data,1);

?>

<div class="wrapper wrapper-style2">

<article id="work" class="work">
<br/><br/>
<!--
<span id="" class="pre-sign-in" style="visibility:hidden">
      <span
          class="g-signin" style="visibility:hidden"
          data-callback="oauth2Callback"
          data-clientid="123185527631-tp5vr837ufu2caaejh0vlcbfjkbackur.apps.googleusercontent.com"
          data-cookiepolicy="single_host_origin"
          data-scope="https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/youtube.upload">
      </span>
    </span>
    -->

    <div class="post-sign-in">
      <div>
        <img id="channel-thumbnail">
        <span id="channel-name"></span>
      </div>
<script>//loadVideo();</script>
<form id="upload-form" name="traffic" method="post" action="">
<div class="container" style="width:65%">
<div class="row">

<div style=" font-size:110%; " id="smaller" >&nbsp;&nbsp;&nbsp;<a href="?p=location.php" style="float:left; margin-top:-10px;  color:#006699" ><img src="resources/images/back_button.png" style="margin-bottom:-8px" />&nbsp;Go Back</a>Supply the activity in your current location</div><br/>

 <div class="12u" style="">
 <section class="box box-style2"  >
 <select placeholder="Location" style="" name="type" title="select activity type" >
 <option value="" >Activity Type</option>
 <option value="traffic" >Traffic</option>
 <option value="event">Event</option>
  <option value="disaster">Disaster</option>
 <option value="others" >Others</option></select></section>
</div>			                        
<div class="12u">
<section class="box box-style2"  >
<textarea name="message" id="message"  style="height:100px"placeholder="Activity description (maximum of 200 characters)" title="provide detail of activity" ></textarea>
</div>
<div class="12u" style="">
<section class="box box-style2"  >
Record video from webcam (optional)<br/><br/>
<div id="widget"><span style="color:red">Not Available!</span></div><br/><br/>
<span id="done" style="visibility:hidden"><img src="resources/images/video.png" />Done</span>

    <script>
      // 2. Asynchronously load the Upload Widget and Player API code.
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. Define global variables for the widget and the player.
      //    The function loads the widget after the JavaScript code
      //    has downloaded and defines event handlers for callback
      //    notifications related to the widget.
      var widget;
      var player;
      function onYouTubeIframeAPIReady() {
        widget = new YT.UploadWidget('widget', {
          width: (window.innerWidth/2)>400?(window.innerWidth/2-100):250,
          events: {
            'onUploadSuccess': onUploadSuccess,
            'onProcessingComplete': onProcessingComplete
          }
        });
      }

      // 4. This function is called when a video has been successfully uploaded.
      function onUploadSuccess(event) {
	  document.forms['traffic'].video_id.value=event.data.videoId;
	  document.getElementById('done').style.visibility="visible";
       // alert('Video ID ' + event.data.videoId + ' was uploaded and is currently being processed.');
      }

      // 5. This function is called when a video has been successfully
      //    processed.
      function onProcessingComplete(event) {
        document.forms['traffic'].video_id.value=event.data.videoId;
		document.getElementById('done').style.visibility="visible";
      }
    </script>
</div>	
<div class="12u" >
<section class="box box-style2"  >
<p style="color: #000;" >Or upload video file(optional)<input type="file" id="file" name="files" style="background: #CCCCCC; border-radius:3px" title="click to select file" /></p>
<input type="hidden" name="video_id" value="" >
<div class="during-upload" id="progress_video" style="visibility:hidden">
        <p><progress id="upload-progress" max="1" value="0"></progress>&nbsp;<span id="percent-transferred">&nbsp;0</span>% done</p>
</div><br/>
<span id="uploaded" style="visibility:hidden"><img src="resources/images/video.png" />&nbsp;Done!</span>
<div class="post-upload">

      </div>
</div>

</section></div>									
<div class="row half">
<div class="12u">
												
											</div>
										</div>
										<div class="row">
											<div class="12u">
                                            <input name="title" type="hidden" value="activity video via mapplusyou" />
        
                                            <input id="latitude" name="latitude"   type="hidden"   />
                                            <input id="longitude" name="longitude"  type="hidden"   />
											<input type="hidden" name="submit_traffic" value="yes" />
												<a href="#" id="go_btn" class="button form-button-submit" onclick="submitForm('traffic');" >Submit Activity</a>
                                                
												<a href="#" id="go_btn" class="button button-alt form-button-reset" onclick="clearForm('traffic');">Clear Form</a>
											</div>
										</div>
									</div>
								

</section></form>
<br/><br/>

     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="resources/js/index.js"></script>
</div>
</div>
			
			</div>
			
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
    // evt is a ProgressEvent.
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
	  console.log(f);
      if (!f.type.match('video.*')) {
	  alert("only video files are supported");
	  return false;
        //continue;
      }
	  if (f.size>5000000) {
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
          span.innerHTML = ['<center><img class="thumb" src="resources/images/video.png" title="', escape(theFile.name), '"/></center>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }

  }
  
 // document.getElementById('files').addEventListener('change', handleFileSelect, false);

</script>


 

