<?php
if(isset($_POST)){

//var_dump($_POST);
}
?>
<script src="resources/js/countries.js"></script>
<!--<script src="resources/js/jquery.min2.js"></script> -->
<script>
document.addEventListener('DOMContentLoaded', function () {
 print_country('country');
 
});
</script>
<script>
function createPrimary(){

var count=document.forms['creator'].pri_count.value;
if(count>=3){
alert('you cannot add more than 3 primary schools');
return false;
}else{
count+=1;
document.forms['creator'].pri_count.value=count;
}
var val=document.forms['creator'].pri_name.value;

var title='primary';
var name=val+'a';
var sch='name'+val+'a';
var name2=val+'y';
document.forms['creator'].pri_name.value=name;
//var pri=$('#primary')
var opt_val='';
for(var i=1950;i<2015; i++){
opt_val+='<option value="'+i+'">'+i+'</option>';
}
var html='<div class="row half" id="'+name+'"><div class="6u"><input type="text" name="'+sch+'" id="subject" placeholder="Primary School attended" /></div><div class="3u">'+
  '<select name="'+name+'" style="text-align:center">'+
  '<option value=""><center>--From--</center></option>'+opt_val+
  '</select></div>'+
  '<div class="3u">'+
  '<select name="'+name2+'" style="text-align:center">'+
  '<option value=""><center>--To--</center></option>'+opt_val+
  '</select></div>'+
  '<div id="'+name+'b" ><a id="go_btn" href="#" class="go_go" onClick="createPrimary();">Add another Primary school</a></div></div>'+
  '';
$('#'+val+'b').remove();
$(html).insertAfter('#'+val);
return false;
}

function createSecondary(){
var count=document.forms['creator'].sec_count.value;
if(count>=3){
alert('you cannot add more than 3 secondary schools');
return false;
}else{
count+=1;
document.forms['creator'].sec_count.value=count;
}
var val=document.forms['creator'].sec_name.value;

var title='secondary';
var name=val+'a';
var name2=val+'y';
var sch='name'+val+'a';
document.forms['creator'].sec_name.value=name;
//var pri=$('#primary')
var opt_val='';
for(var i=1950;i<2015; i++){
opt_val+='<option value="'+i+'">'+i+'</option>';
}
var html='<div class="row half" id="'+name+'"><div class="6u"><input type="text" name="'+sch+'" id="subject" placeholder="Secondary school attended" /></div><div class="3u">'+
  '<select name="'+name+'" style="text-align:center">'+
  '<option value=""><center>--From--</center></option>'+opt_val+
  '</select></div>'+
  '<div class="3u">'+
  '<select name="'+name2+'" style="text-align:center">'+
  '<option value=""><center>--To--</center></option>'+opt_val+
  '</select></div>'+
  '<div id="'+name+'b" ><a id="go_btn" href="#" class="go_go" onClick="createSecondary();">Add another secondary school</a></div></div>'+
  '';
$('#'+val+'b').remove();
$(html).insertAfter('#'+val);
return false;
}

function createUni(){
var count=document.forms['creator'].uni_count.value;
if(count>=3){
alert('you cannot add more than 3 higher institutions');
return false;
}else{
count+=1;
document.forms['creator'].uni_count.value=count;
}
var val=document.forms['creator'].uni_name.value;

var title='uni';
var name=val+'a';
var name2=val+'y';
var sch='name'+val+'a';
document.forms['creator'].uni_name.value=name;
//var pri=$('#primary')
var opt_val='';
for(var i=1950;i<2015; i++){
opt_val+='<option value="'+i+'">'+i+'</option>';
}
var html='<div class="row half" id="'+name+'"><div class="6u"><input type="text" name="'+sch+'" id="subject" placeholder="Higher institution attended" /></div><div class="3u">'+
  '<select name="'+name+'" style="text-align:center">'+
  '<option value=""><center>--From--</center></option>'+opt_val+
  '</select></div>'+
  '<div class="3u">'+
  '<select name="'+name2+'" style="text-align:center">'+
  '<option value=""><center>--To--</center></option>'+opt_val+
  '</select></div>'+
  '<div id="'+name+'b" ><a id="go_btn" href="#" class="go_go" onClick="createUni();">Add another higher institution</a></div></div>'+
  '';
$('#'+val+'b').remove();
$(html).insertAfter('#'+val);
return false;
}


function createQuali(){
var count=document.forms['creator'].quali_count.value;
count=parseInt(count);
//alert(count);
if(count>=9){
alert('you cannot add more than 10 qualifications');
return false;
}
count+=1;
document.forms['creator'].quali_count.value=count;
var val=document.forms['creator'].quali_name.value;
var title='quali';
var name=val+'a';
var name2=val+'y';
var sch='name'+val+'a';
document.forms['creator'].quali_name.value=name;
//var pri=$('#primary')
var opt_val='';
for(var i=1950;i<2015; i++){
opt_val+='<option value="'+i+'">'+i+'</option>';
}
var html='<div class="row half" id="'+name+'"><div class="6u"><input type="text" name="'+sch+'" id="subject" placeholder="Qualification obtained" /></div><div class="6u">'+
  '<select name="'+name+'" style="text-align:center">'+
  '<option value=""><center>--Year--</center></option>'+opt_val+
  '</select></div>'+
  '<div id="'+name+'b" ><a id="go_btn" href="#" class="go_go" onClick="createQuali();">Add another qualification</a></div></div>'+
  '';
$('#'+val+'b').remove();
$(html).insertAfter('#'+val);
$('#'+val).focus();
return false;
}


function createReferee(){
var count=document.forms['creator'].ref_count.value;
if(count>=3){
alert('you cannot add more than 3 Referees');
return false;
}else{
count+=1;
document.forms['creator'].ref_count.value=count;
}
var val=document.forms['creator'].ref_name.value;

var title='referee';
var name=val+'a';
var name2=val+'y';
var sch='name'+val+'a';
document.forms['creator'].ref_name.value=name;
//var pri=$('#primary')
var opt_val='';
for(var i=1950;i<2015; i++){
opt_val+='<option value="'+i+'">'+i+'</option>';
}
var html='<div class="row half" id="'+name+'"><div class="6u"><input type="text" name="'+sch+'" id="subject" placeholder="Referee name" /></div><div class="3u">'+
 '<input name="'+name+'" type="text" placeholder="Referee position" >'+
  '</div><div class="3u">'+
  '<input name="'+name2+'" type="text" placeholder="Referee phone" >'+
  '</div>'+
  '<div id="'+name+'b" ><a id="go_btn" href="#" class="go_go" onClick="createReferee();">Add another referee</a></div></div>'+
  '';
$('#'+val+'b').remove();
$(html).insertAfter('#'+val);
return false;
}

function createExpi(){
var count=document.forms['creator'].expi_count.value;
count=parseInt(count);
if(count>=9){
alert('you cannot add more than 10 experiences');
return false;
}else{
count+=1;
document.forms['creator'].expi_count.value=count;
}
var val=document.forms['creator'].expi_name.value;

var title='expirience';
var name=val+'a';
var name2=val+'y';
var sch='name'+val+'a';
document.forms['creator'].expi_name.value=name;
//var pri=$('#primary')
var opt_val='';
for(var i=1950;i<2015; i++){
opt_val+='<option value="'+i+'">'+i+'</option>';
}
var html='<div class="row half" id="'+name+'"><div class="6u"><input type="text" name="'+sch+'" id="subject" placeholder="Work Expirience" /></div><div class="3u">'+
  '<select name="'+name+'" style="text-align:center">'+
  '<option value=""><center>--From--</center></option>'+opt_val+
  '</select></div>'+
  '<div class="3u">'+
  '<select name="'+name2+'" style="text-align:center">'+
  '<option value=""><center>--To--</center></option>'+opt_val+
  '</select></div>'+
  '<div id="'+name+'b" ><a id="go_btn" href="#" class="go_go" onClick="createExpi();">Add another experience</a></div></div>'+
  '';
$('#'+val+'b').remove();
$(html).insertAfter('#'+val);
return false;
}
</script>
<div class="wrapper wrapper-style2">

<br/>	<br/><br/>			<article id="work">
				
					<div class="container" style="width:65%">
							
				
						<div class="row" style=" padding-top:0px"></p><br/><br/>
                        <p><h6>Please fill all the information below to create your CV</h6>
							<div class="12u" style="padding-bottom:10px; padding-top:0px" >
							<section class="box box-style1" style="padding:10px 5px 10px 5px;  padding-left:30px; padding-right:30px">
							<br/><br/><br/><br/><br/>
                            <?php //echo $msg; ?>	
                            <br/><br/>
                            						
								<form method="post" action="generatecv.php" enctype="multipart/form-data" name="cv"   style="margin-top:-80px; padding-right:0px;" />
									 <p >Personal Information</p>	
                                    <div>
                                   									
										<div class="row half">
											<div class="6u">
												<input type="text" name="surname" id="subject" placeholder="Your Surname" />
											</div>
                                            <div class="6u">
                                           
											<input type="text" name="othernames" id="subject" placeholder="Other names" value="" />	
											</div>
										</div>
										<div class="row half">
											<div class="6u">
												<select   onChange="print_state('state',this.selectedIndex);" id="country" name ="country" placeholder="Nationality"></select>
											</div>
											<div class="6u">
												<select name ="state" id ="state" placeholder="State of origin"  ></select>
											</div>
										</div>
										<div class="row half">
											<div class="6u">
												<input type="date" name="date_of_birth" id="deadline" min="" class="datepicker" placeholder="Date of Birth" title="Application Deadline"   value=""/>
                              
											</div>
                                            <div class="3u">
												<input type="text" name="phone" id="phone" placeholder="Phone Number" value="" />
											</div>
                                            <div class="3u">
                                            <select name="sex" >
                                            <option value="" >Sex</option>
                                            <option value="Male" >Male</option>
                                            <option value="Female" >Female</option>
											</select>
											</div>
										</div>
                                        <div class="row half">
											<div class="6u">
                                            <input type="text" name="address" id="address" placeholder="Home address" value="" />
												
											</div>
                                            <div class="3u">
												<input type="text" name="email" id="email"   placeholder="Email Address" value=""/>
											</div>
                                            <div class="3u">
                                            <select name="status" >
                                            <option value="" >Marital Status</option>
                                            <option value="Single" >Single</option>
                                            <option value="Married" >Married</option>
                                            <option value="Divorced" >Divorced</option>
											</select>
											</div>
                                            
										</div>
										<hr/><br/>
                                        <p style="margin-bottom:0px" >Education Background (optional)</p>	
                                        <div class="row half" id="primary">
											<div class="6u">
											<input type="text" name="pri_school" id="subject" placeholder="Primary School attended" />
											</div>
                                            <div class="3u">
                                           <select name="pri_from" style="text-align:center">
                                           <option value=""><center>--From--</center></option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>	
											</div>
                                            <div class="3u" >
                                           <select name="pri_to" style="text-align:center">
                                           <option value="">--To--</option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>
											</div>
                                            <div id="primaryb"><a id="go_btn" href="#" class="go_go" onclick="createPrimary();">Add another Primary school</a></div>
										</div>
                                        
                                        
                                        <div class="row half" id="secondary">
											<div class="6u">
											<input type="text" name="sec_school" id="subject" placeholder="Secondary School attended" />
											</div>
                                            <div class="3u">
                                           <select name="sec_from" style="text-align:center">
                                           <option value=""><center>--From--</center></option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>	
											</div>
                                            <div class="3u">
                                           <select name="sec_to" style="text-align:center">
                                           
                                           <option value="">--To--</option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>
											</div>
                                            <div id="secondaryb"><a id="go_btn"  href="#" onclick="createSecondary();" class="go_go" >Add another secondary school</a></div>
										</div>
                                        
                                        
                                          <div class="row half" id="uni">
											<div class="6u">
											<input type="text" name="higher_school" id="subject" placeholder="Higher institution attended" />
											</div>
                                            <div class="3u">
                                           <select name="higher_from" style="text-align:center">
                                           <option value=""><center>--From--</center></option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>	
											</div>
                                            <div class="3u">
                                           <select name="higher_to" style="text-align:center">
                                           
                                           <option value="">--To--</option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>
											</div>
                                            <div id="unib"><a id="go_btn" onclick="createUni();" href="#" class="go_go">Add another higher institution</a></div>
										</div><hr/><br/>
                                        <p style="margin-bottom:0px" >Qualifications/Award(optional) e.g BSc. in Computer Science</p>
                                        
                                         <div class="row half" id="quali">
											<div class="6u">
											<input type="text" name="qualification" id="subject" placeholder="Qualification obtained" />
											</div>
                                            <div class="6u">
                                           <select name="quali_date" style="text-align:center">
                                           <option value=""><center>--Year--</center></option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>	
											</div>
                                           
                                            <div id="qualib"><a id="go_btn" href="#" class="go_go" onclick="createQuali();">Add another qualification</a></div>
										</div><hr/><br/>
                                        <p style="margin-bottom:0px" >Work Experience </p>
                                        
                                         <div class="row half" id="expi" >
											<div class="6u">
											<input type="text" name="expirience" id="subject" placeholder="Company/Organization/Institution" />
											</div>
                                          <div class="3u">
                                           <select name="expi_from" style="text-align:center">
                                           <option value=""><center>--From--</center></option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>	
											</div>
                                            <div class="3u">
                                           <select name="expi_to" style="text-align:center">
                                           
                                           <option value="">--To--</option>
                                           <?php 
										   $today=date("Y");
										   for($i=1900; $i<=($today); $i++){ ?>
                                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                           <?php } ?>
                                           </select>
											</div>
                                           
                                            <div id="expib" ><a id="go_btn" href="#" class="go_go" onclick="createExpi();">Add another experience</a></div>
										</div>
                                        <hr/><br/>
                                        <p style="margin-bottom:0px" >Referees(optional)</p>
                                        
                                         <div class="row half" id="referee">
											<div class="6u">
											<input type="text" name="ref_name" id="subject" placeholder="Referee name" />
											</div>
                                          <div class="3u">
                                           <input type="text" name="ref_pos" id="subject" placeholder="Referee position" />
											</div>
                                           <div class="3u">
                                           <input type="text" name="ref_phone" id="subject" placeholder="Referee phone" />
											</div>
                                          <div id="refereeb"><a id="go_btn" href="#" class="go_go" onclick="createReferee();">Add another Referee</a></div>
										</div>
                                        <hr/><br/>
                                        <p style="margin-bottom:0px" >Hobbies(separate by comma if more than one) </p>
                                        
                                         <div class="row half">
											<div class="12u">
											<input type="text" name="hobby" id="subject" placeholder=" e.g swimming, Dancing" />
											</div>
										</div>
                                        <hr/>
                                        <br/>
                                        <p style="margin-bottom:0px" >Objective</p>
										<div class="row half">
                                        <div class="12u">
                                        <textarea name="obj"  style="height:100" placeholder="Type your objective"></textarea>or select from sample objective<br/>
                                        <select name="objective" >
                                        
                                        <option style="height:60px" value="To strive and achieve the organization's goal through, individual motivation and team work.">To strive and achieve the organization's goal through,individual motivation and team work. </option>
                                        <option  style="height:60px" value="To work deligently in order to pursue the greatness of any company, organization or institution I find myself.">To work deligently in order to pursue <br/>the greatness of any company, organization or institution I find myself.</option>
                                        </select>
                                        </div>
                                      </div>  
                                      <hr/>
                                        <br/> 
                                      <p style="margin-bottom:0px" >Addidtional information(separate by comma if more than one) </p>
										<div class="row half">
											<div class="12u">
<textarea name="strength"  style="height:100" placeholder="e.g Good communication and interpersonal skills, Ideas and information oriented, Proven leadership abilities in working as a team etc."></textarea>
<input type="hidden" name="cv_type" value="<?php echo $_POST['cv_style']; ?>"   />
<input type="hidden" name="submit_job" value="yes"   />
											</div>
										</div>
                                       
										<div class="row">
											<div class="12u">
                                                
												<a href="#" id="go_btn"  class="new" onClick="submitForm('cv');">Create CV</a>
												<a href="#" id="go_btn"  class="new" onClick="clearForm('cv');">Clear Form</a>
											</div>
										</div>
									</div>
                                 <!--   <textarea id="tinyeditor"  class="no-class" style="width: 400px; height: 200px"></textarea> -->
								</form>	
								
							</div>
							
					<form name="creator" method="post" >
                    <input type="hidden" name="pri_name" value="primary" />
                    <input type="hidden" name="pri_count" value="0" />
                    <input type="hidden" name="sec_name" value="secondary" />
                    <input type="hidden" name="sec_count" value="0" />
                     <input type="hidden" name="uni_name" value="uni" />
                    <input type="hidden" name="uni_count" value="0" />
                    <input type="hidden" name="quali_name" value="quali" />
                    <input type="hidden" name="quali_count" value="0" />
                    <input type="hidden" name="ref_name" value="referee" />
                    <input type="hidden" name="ref_count" value="0" />
                    <input type="hidden" name="expi_name" value="expi" />
                    <input type="hidden" name="expi_count" value="0" />
                    </form>
					</section>
				</article>
				<br/><br/><br/>

			</div>

