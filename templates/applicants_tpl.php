<?php
$jobs=$mplusu->loadFile('jobs');
//var_dump($_POST); exit;
if(!$_POST['job_id'] || !$jobs=$mplusu->loadJob($_POST['job_id'])){
echo '<script>window.location="index.php"; </script>';
//var_dump(id);exit;
}
$today=strtotime(date('m/d/Y'));
$deadline=strtotime($jobs[0]['deadline']);


if($today>$deadline){
echo '<script>window.location="index.php"; </script>';
}
$applicants=$mplusu->get_applicants($_POST['job_id']);

$job=$jobs[0];
?>

<div class="wrapper wrapper-style2">
<br/><br/><br/>
<br/><br/>
<br/><br/><br/>
				<article id="work">
				
					<div class="container" style="width:62%">
					
				
						<div class="row">
							<div class="12u" style="padding-bottom:10px" >
								<section class="box box-style1" style="padding:50px; text-align:justify">
                                <a href="?p=myopportunities.php"><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a>
									<center><h5>Applicants list for opportunity "<?php echo $job['title']; ?>" </h5></center><br/><br/>
                                 <?php if ($applicants!=NULL){ ?>   
                                    <center><table style="width:100%; border:1px solid #999999;">
                            <tr style="border:1px solid #999999"><th style=" border:1px solid #999999;"><b>S/n</b></th><th style=" border:1px solid #999999;"><b>Applicant email</b></th><th style=" border:1px solid #999999;"><b>Application Date</b></th><th style=" border:1px solid #999999;"><b>Hangout Date</b></th><th style=" border:1px solid #999999;"><b>Hangout Time</b></th><th style=" border:1px solid #999999;"><b>Goto hangout</b></th><th style=" border:1px solid #999999;"><b>Schedule hangout</b></th></tr>
                            <?php foreach($applicants as $applicant){
							
							$jb=$mplusu->loadJob($applicant['job_id']);
							 ?>
                            <tr><td style=" border:1px solid #999999;"><?php echo $applicant['id']; ?></td><td style=" border:1px solid #999999;"><?php echo $applicant['applicant_email']; ?></td><td style="border:1px solid #999999;"><?php echo $applicant['date']; ?></td><td style=" border:1px solid #999999;"><?php echo $applicant['hangout_date']; ?></td><td style="border:1px solid #999999;"><?php echo $applicant['hangout_time']; ?></td><?php if($applicant['hangout_url']==""){ ?> <td style="border:1px solid #999999;"><a href="<?php echo $applicant['hangout_url']; ?>"><img src="resources/images/hangout1.png" style="width:70px; height:40px" /></a></td><?php } else{ ?><td style="border:1px solid #999999;"><a href="<?php echo $applicant['hangout_url']; ?>"><img src="resources/images/hangout.png" style="width:70px; height:40px" /></a></td><?php } ?><td><center><a href="#" <?php if($applicant['hangout_url']!=""){ ?> onClick="alert('You have already schedule an hangout for this applicant');"  <?php }else{ ?>onClick="setId('<?php echo $applicant['job_id'].','.$applicant['applicant_email'].','.$applicant['id']; ?>');" id="d_dialog"  <?php } ?> > schedule</a></td></center></tr>
                            <?php } ?>
                            </table>
                            </table></center>	
								<?php } else{ ?>
                                <br/><br/>
                                <center><p>No applicant has applied for this opportunity</p></center>
                                <?php } ?>	
		<br/><br/>	<br/><br/><br/>					
					</section>
							</div>	
                            							
				</article>
				<br/><br/><br/>
			</div>
<form name="apply_job" action="" method="post" >
<input type="hidden" name="job_id"  />
</form>
<div id="dialog-form" title="Schedule Hangout" style="width:500px">
<form method="post" action="" id="search" name="hangout">
  <fieldset>
    <label for="email">Hangout Date</label>
     <input type="date" name="date" id="searchTextField" placeholder="Select date" style="height:40px" style="padding:0px" /> 
     <label for="email">Hangout Time</label>
     <input type="time" name="time" id="searchTextField" placeholder="Select date" style="height:40px" style=" padding:0px" /> 
     <input type="hidden" name="job_id"  />
      <input type="hidden" name="applicant_email"  />
      <input type="hidden" name="applicant_id"  />
     <input type="hidden" name="make_hangout" value="yes"  />   
  </fieldset>
  
  </form>
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
        "Schedule": function() {
		 
	//document.forms['hangout'].job_id.value=job_id;
	var date =document.forms['hangout'].date.value;
	var time= document.forms['hangout'].time.value;
	if(date==""){
	alert("Please select hagout date");
	return false;
	}else if(time==""){
	alert("Please select hagout time");
	return false;
	}else{
	
	document.forms['hangout'].submit();
		 return false;
		 }
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( message, "Activity", 3, 100 );
          if ( bValid ) {
            
           // $( this ).dialog( "close" );
		   document.forms['hangout'].submit();
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
 
    $( "#d_dialog" )
      .button()
      .click(function() {
	  
        $( "#dialog-form" ).dialog( "open" );
		 document.getElementById('dialog-form').style.visibility="visible";
      });
  });
  </script>
