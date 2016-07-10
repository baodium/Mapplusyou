<?php

$term=$_POST['search_m'];
//$result=$mplusu->search($term);
var_dump($term);

exit;
?>
<?php
$htmlBody = <<<END
<div class="wrapper wrapper-style2">
<br/><br/><br/>
<br/><br/><br/><br/>

	<article id="work">
	
					<div class="container" style="width:70%" >
					
						<div class="row">
							<div class="14u" style="padding-bottom:10px; ">
								<section class="box box-style1" style="padding:50px; text-align:justify; line-height:30px">
  
<a href="?p=opportunityalert.php" style="font-size:24px" ><img src="resources/images/back_button.png" style="margin-bottom:-5px;">&nbsp;Go Back</a><br/><br/>
<center><h3>This article will show you how to enable SMS notifications for your reminders in Google calendar.</h3></center><br/><br/>  
<ul>       
  <li style="list-style: disc" > <p>You have a google account right? If no then create one for yourself.
   Once your account becomes active then browse to this address <a href="https://www.google.com/calendar" >"https://www.google.com/calendar"</a></p> </li>
   <li style="list-style: disc">So Click on little down arrow besides your Calendar Name and a drop will appear. Click on settings. Now at this step you will need to configure your mobile phone number. Click on the link as shown in the picture below<br/><br/>
  <center> <img src="resources/images/step1.png" /></center>
   </li>
   <li style="list-style: disc">When you click on “Set up your mobile phone to receive notifications” you will be taken to this screen
Enter your mobile number in this format +COUNTRYcodeYOURnumber so for Australia its +61400000000 and for India its +919800000000 
If you number is correct you will receive a SMS with verification code once you hit “Verify now” button.</li>

<li style="list-style: disc">Click “Finish Setup”. Don’t forget to hit Save button to save your settings. Go Back to your Notifications screen and you will get this screen
</li>
</ul>    
			</section>
            </div>
		</article><br/><br/>
	</div>		
END;
echo $htmlBody;	


