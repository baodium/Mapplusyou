<?php
//$_SESSION['mapplusu_user']="oaadedayo@gmail.com";
if(!isset($_SESSION['mapplusu_user'])){
echo'<script>window.location="?p=home.php"</script>';
}

//$jobs=$mplusu->loadJob($_GET['id']);

if(!$_POST['job_id'] || !$jobs=$mplusu->loadJob($_POST['job_id'])){
echo '<script>window.location="index.php"; </script>';
//var_dump(id);exit;
}


$deadline=$jobs[0]['deadline'];
$today=date('m/d/Y');
if($today>$deadline){
echo '<script>window.location="index.php"; </script>';
}

$job=$jobs[0];

?>
<?php

if(isset($msg) && $msg['status']=="Error"){  
$msg='<p style="color:#990000; font-size:20px; padding-bottom:0px">* '.ucfirst($msg['message']).'</p><br/><br/>'; 

}elseif(isset($msg) && $msg['status']=="OK"){ 
echo'<script>window.location="?p=myopportunities.php"</script>'; 
 }else{
 
 $msg="";
 
 }

?>
<script src="resources/js/tiny.editor.packed.js"></script>
<script src="resources/js/countries.js"></script>     
<div class="wrapper wrapper-style2">

<br/>	<br/><br/>			<article id="work">
				
					<div class="container" style="width:65%">
                    
					<br/><br/>
						<div class="row" style=" padding-top:0px">
                        
                        <p><a href="?p=myopportunities.php" style="float:left"><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a><h4>Edit Opportunity </h4></p>
							<div class="12u" style="padding-bottom:10px; padding-top:0px" >
							 	<section class="box box-style1" style="padding:10px 5px 10px 5px;  padding-left:30px; padding-right:30px">
							<br/><br/><br/><br/><br/><br/>
                            <?php echo $msg; ?>							
								<form method="post" action="#" enctype="multipart/form-data" name="job"   style="margin-top:-80px; padding-right:0px;" />
									<div>										
										<div class="row half">
											<div class="6u">
												<input type="text" name="title" id="subject" placeholder="Opportunity Title" value="<?php echo (isset($_POST['title'])?$_POST['title']:$job['title']); ?>" />
											</div>
                                            <div class="6u">
                                           
												<select  id="type" name ="type" placeholder="Type" style="height:45px">
                                                <option <?php if($job['type']=='FT'){  echo 'selected'; } ?> value="FT" >Full Time Job</option>
                                                <option value="PT" <?php if($job['type']=='PT'){  echo 'selected'; } ?>   >Part Time Job</option>
                                                <option <?php echo (($job['type']=='CT') ?'selected':''); ?> value="CT">Contract</option><option <?php echo (($job['type']=='IT') ?'selected':''); ?> value="IT">Internship Program</option>
                                                <option <?php echo (($job['type']=='SC') ?'selected':''); ?> value="SC">Scholarship</option>
                                                </select>
											</div>
										</div>
										<div class="row half">
											<div class="6u" id="country_container">
		<select  style="height:45px" onChange="print_state('state',this.selectedIndex);"  onFocus="print_country('country');"  id="country" name ="country" placeholder="Country">
                                                <option value="<?php echo $job['country'] ?>"><?php echo $job['country'] ?></option>
                                                </select>
											</div>
											<div class="6u">
												<select name ="state" id ="state" placeholder="State" style="height:45px" >
                                                <option value="<?php echo $job['state'] ?>"><?php echo $job['state'] ?></option>
                                                </select>
											</div>
										</div>
										<div class="row half">
											<div class="6u">
												<input type="text" name="deadline" id="deadline"  class="datepicker" placeholder="Deadline" value="<?php echo (isset($_POST['deadline'])?$_POST['deadline']:$job['deadline']); ?>"/>
        <script type="text/javascript" src="resources/js/datepickr.js"></script>
		<script type="text/javascript">
            new datepickr('deadline', {
				'dateFormat': 'm/d/Y'
			});		
		</script>
											</div>
                                            <div class="6u">
												<input type="text" name="address" id="address" placeholder="Address" value="<?php echo (isset($_POST['address'])?$_POST['address']:$job['address']); ?>" />
											</div>
										</div>
                                        <div class="row half">
											<div class="6u">
												<input type="text" name="email" id="email"   placeholder="Application mail(optional)" value="<?php echo (isset($_POST['email'])?$_POST['email']:$job['email']); ?>"/>
											</div>
                                            <div class="6u">
												<input type="text" name="url" id="url" placeholder="Application Url(optional)" value="<?php echo (isset($_POST['url'])?$_POST['url']:$job['url']); ?>" />
											</div>
										</div>
										<br/>
										<div class="row half">
											<div class="12u">
												<textarea name="message" id="tinyeditor" placeholder="Full detail" rows="6" value=""><?php echo (isset($_POST['message'])?$_POST['message']:$job['message']); ?></textarea>
     <script type="text/javascript">
var editor = new TINY.editor.edit('editor', {
	id: 'tinyeditor',
	cssclass: 'tinyeditor',
	cssfile: 'resources/css/style.css',
	controlclass: 'tinyeditor-control',
	rowclass: 'tinyeditor-header',
	dividerclass: 'tinyeditor-divider',
	controls: ['bold', 'italic', 'underline', 
		'orderedlist', 'unorderedlist',  'leftalign',
		'centeralign', 'rightalign', 'blockjustify', 'unformat','n', 'hr', 'link', 'unlink', 
		'font', 'size', 'style',],
	footer: false,
	fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
	xhtml: true,
	bodyid: 'editor',
	bodyid: 'editor',
	footerclass: 'tinyeditor-footer',
	toggle: {text: 'source', activetext: 'wysiwyg', cssclass: ''},
	resize: {cssclass: 'resize'}
});
</script>
											</div>
										</div>
										<div class="row">
											<div class="12u">
                                            <input type="hidden" name="id" value="<?php echo $job['job_id']; ?>"   />
                                            <input type="hidden" name="save_job" value="yes"   />
												<a href="#" id="go_btn" class="button form-button-submit" class="new" onclick="submitForm('job');">Save</a>
												<a href="#" id="go_btn" class="button button-alt form-button-reset" class="new" onclick="clearForm('job');">Clear Form</a>
											</div>
										</div>
									</div>
                                 <!--   <textarea id="tinyeditor"  class="no-class" style="width: 400px; height: 200px"></textarea> -->
								</form>	
							</section>	
							</div>
							
					
				</article>
				<br/><br/><br/>
               
			</div>


