<?php
if(isset($_POST['submit_testimonial'])){
$testimony=$mplusu->addTestimonial($_POST);
//var_dump($testimony);
}
$testimonials=$mplusu->loadTestimony();
//var_dump($testimonials[0]['name']);
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
                                <a href=""><img src="resources/images/back_button.png" style="margin-bottom:-5px">&nbsp;Go Back</a>
									<center><h3>Testimonials</h3></center><br/><br/>
                                    <?php foreach($testimonials as $testimony){ ?>
                                    <p style="padding-left:5px; width:100%; color: #006699" id="testim" ><span style="font-size:18px; color: #006699"><?php echo $testimony['name']?>:</span>&nbsp;<?php echo $testimony['testimony'];?>.&nbsp;<i style="font-size:12px"><?php echo $testimony['date']?></i></p><?php } ?>
<br/><br/>
        <h6>Add your testimonial</h6>
           <form name="testimonial_form" method="post" action="?p=testimonials.php" >
           <input type="text" name="name"  placeholder="Your name" >
            <textarea name="testimonial"  style="text-align-left" placeholder="Your testimonial"></textarea>
            <input type="hidden" name="submit_testimonial" value="yes" /> 
             <a href="#" id="go_btn"  class="new" onclick="submitTestimonial();">Submit Testimonial</a><br/>
             </form>
        				
<div class="nav" >
<center>

</center>
</div>
								</section>
							</div>
							
					
				</article>
				<br/><br/><br/>
			</div>
