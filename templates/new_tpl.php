<?php
//$pg="home.php";
//file_put_contents("gs://mapplusyou/page.txt",$pg,1);
//$_SESSION['mmpage']='yes';
if(!isset($_SESSION['mapplusu_user'])){
echo'<script>alert("You must login to add opportunity")</script>';
echo'<script>window.location="?p=home.php"</script>';
}

if(isset($msg) && $msg['status']=="Error"){  
$msg='<p style="color:#990000; font-size:20px; padding-bottom:0px">* '.ucfirst($msg['message']).'</p><br/><br/>'; 

}elseif(isset($msg) && $msg['status']=="OK"){ 
echo'<script>window.location="?p=contract.php"</script>'; 
 }else{
 $msg="";
 }
$contenttext=isset($_POST['message'])?$_POST['message']:'';
?>
<script src="resources/js/tiny.editor.packed.js"></script>
<script src="resources/js/countries.js"></script>
<!--<script src="resources/js/jquery.min2.js"></script> -->
<script>
document.addEventListener('DOMContentLoaded', function () {
 print_country('country');
 
});
</script>
<script>
/*
		$(document).ready(function() {
		
		$(".datepicker").datepicker();
		
		});
		*/

		</script>
<style>
.tinyeditor-font{
width:15%;
height:80%;
style:non;
padding:0px;
font-size:10px;
}
.tinyeditor-size{
width:15%;
height:80%;
style:non;
padding:0px;
font-size:10px;
}
.tinyeditor-style{
width:15%;
height:80%;
style:non;
padding:0px;
font-size:10px;
}
#editor{
background:#ccc;
color:#000;
}
</style>
<div class="wrapper wrapper-style2">

<br/>	<br/><br/>			<article id="work">
				
					<div class="container" style="width:65%">
							
				
						<div class="row" style=" padding-top:0px"></p><br/><br/>
                        <p><a href="?p=contract.php" style="float:left"><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a><h4>New Opportunity form</h4>
							<div class="12u" style="padding-bottom:10px; padding-top:0px" >
                           
                          	<section class="box box-style1" style="padding:10px 5px 10px 5px;  padding-left:30px; padding-right:30px">
							<br/><br/><br/><br/><br/>
						   <?php echo $msg; ?>	
                            <br/><br/>
                            					
								<form method="post" action="#" enctype="multipart/form-data" name="job"   style="margin-top:-80px; padding-right:0px;" />
									<div>										
										<div class="row half">
											<div class="6u">
												<input type="text" name="title" id="subject" placeholder="Opportunity Title" value="<?php echo (isset($_POST['title'])?$_POST['title']:''); ?>" />
											</div>
                                            <div class="6u">
                                           
												<select  id="type" name ="type" placeholder="Type" >
                                                <option <?php if(isset($_POST['type']) && $_POST['type']=='FT'){  echo 'selected'; } ?> value="FT" >Full Time Job</option>
                                                <option value="PT" <?php if(isset($_POST['type']) && $_POST['type']=='PT'){  echo 'selected'; } ?>   >Part Time Job</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='CT') ?'selected':''); ?> value="CT">Contract</option><option <?php echo ((isset($_POST['type'])&& $_POST['type']=='IT') ?'selected':''); ?> value="IT">Internship Program</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='SC') ?'selected':''); ?> value="SC">Scholarship</option>
                                                <option <?php echo ((isset($_POST['type'])&& $_POST['type']=='VL') ?'selected':''); ?> value="VL">Volunteer</option>
												<option <?php echo ((isset($_POST['type'])&& $_POST['type']=='CP') ?'selected':''); ?> value="CP">Competition</option>
                                                </select>
											</div>
										</div>
										<div class="row half">
											<div class="6u">
												<select   onChange="print_state('state',this.selectedIndex);" id="country" name ="country" placeholder="Country"></select>
											</div>
											<div class="6u">
												<select name ="state" id ="state" placeholder="State"  ></select>
											</div>
										</div>
										<div class="row half">
											<div class="6u">
					<input type="date" name="deadline" id="deadline" min="<?php echo date('Y-m-d'); ?>"  placeholder="Deadline(MM/DD/YYYY)" title="Application Deadline"   value="<?php echo (isset($_POST['deadline'])?$_POST['deadline']:''); ?>"/>
                              
											</div>
                                            <div class="6u">
												<input type="text" name="address" id="address" placeholder="Address" value="<?php echo (isset($_POST['address'])?$_POST['address']:''); ?>" />
											</div>
										</div>
                                        <div class="row half">
											<div class="6u">
												<input type="text" name="email" id="email"   placeholder="Application mail(optional)" value="<?php echo (isset($_POST['email'])?$_POST['email']:''); ?>"/>
											</div>
                                            <div class="6u">
												<input type="text" name="url" id="url" placeholder="Application Url(optional)" value="<?php echo (isset($_POST['url'])?$_POST['url']:''); ?>" />
											</div>
										</div>
										<br/>
										<div class="row half">
											<div class="12u">
<textarea name="message" id="tinyeditor" style="height:200"><?php if(isset($contenttext)){ echo $contenttext;}  ?></textarea>
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
                                 <input type="hidden" name="submit_job" value="yes"   />
											</div>
										</div>
										<div class="row">
											<div class="12u">
                                                
												<a href="#" id="go_btn"  class="new" onclick="submitForm('job');">Post Opportunity</a>
												<a href="#" id="go_btn"  class="new" onclick="clearForm('job');">Clear Form</a>
											</div>
										</div>
								</form>	
								</section>	
									</div>
                                 <!--   <textarea id="tinyeditor"  class="no-class" style="width: 400px; height: 200px"></textarea> -->
								
								
							</div>
						
					
				</article>
				<br/><br/><br/>

			</div>

