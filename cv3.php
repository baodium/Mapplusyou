<?php
if(!isset($_POST['submit_job']) || $_POST['submit_job']!="yes"){
header("location:index.php");
}
require 'resources/pdf/fpdf.php';

$surname=strtoupper($_POST['surname']);
$othernames=ucwords($_POST['othernames']);
$dob=$_POST['date_of_birth'];
$country=$_POST['country'];
$state=$_POST['state'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];

$x=50;
$y=30;
$pdf=new FPDF('p', 'pt', 'Letter');
 $pdf->SetFont('Times','U',20);
 $pdf->addPage();
 $pdf->SetFillColor(255,0,0);
 $pdf->SetAutoPageBreak(false,1);
 //$pdf->SetMargins(1.5,1,2,2);
 $pdf->SetTitle($surname. "".$othernames."'s CV");
 $pdf->setXY($x,50);
$pdf->setXY($x,50);
 $pdf->setXY($x+130,$y);
 $pdf->Write(25,"CURRICULUM VITAE");
$x=30;
 $y+=50;
 $pdf->SetFont('Times','',12);
 $pdf->setXY($x,$y);
  $pdf->Write(25,$surname." ".strtoupper($othernames));
 
 if($address!==""){
// $x=30;
 $y+=25;
 $pdf->setXY($x,$y);
  $pdf->SetFont('Times','',14);
   $pdf->Write(25,$address);
 //$pdf->DrawDot($x,$y+200);
 }
  if($phone!==""){
  $y+=25;
  //$x+=20;
 $pdf->setXY($x,$y);
  $pdf->SetFont('Times','',14);
   $pdf->Write(16,$phone);
 //$pdf->DrawDot($x,$y+200);
 }
 
 if($email!==""){
 $y+=20;
// $x-=10;
 $pdf->setXY($x,$y);
  $pdf->SetFont('Times','',14);
   $pdf->Write(16,$email);
 //$pdf->DrawDot($x,$y+200);
 }
 $y+=5;
 $x=30;
   $pdf->setXY($x,$y);
   //   //$w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='',$currentx=0
    $pdf->cell(0,20,"",'B',10,'L', false);
 $x=30;
  $pdf->setXY($x,$y);
 //$pdf->cell(0,20," ",'B',2,'L', false);
 
 $pdf->SetFont('Times','U',16);
 $y+=40;
   $pdf->setXY($x,$y);
   $pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Personal Profile", 0 , 'L' , 1);
  // $pdf->Write(16,"Personal Profile");
   $y+=5;
    $x=30;
  $pdf->setXY($x,$y);
    //$pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);
	$pdf->SetFont('Times','',12);
	$pdf->Write(16,"NATIONALITY: ");
	$x+=120;
	$pdf->setXY($x,$y);
	$pdf->Write(16,$_POST['country']);
	$x-=120;
	$y+=20;
	  $pdf->setXY($x,$y);
	$pdf->Write(16,"STATE OF ORIGIN:");
	$x+=120;
	$pdf->setXY($x,$y);
	$pdf->Write(16,$_POST['state']);
	$x-=120;
	$y+=20;
	  $pdf->setXY($x,$y);
	$pdf->Write(16,"SEX:");
	$x+=120;
	$pdf->setXY($x,$y);
	$pdf->Write(16,$_POST['sex']);
	$x-=120;
	
	$y+=20;
	  $pdf->setXY($x,$y);
	$pdf->Write(16,"PHONE NUMBER:");
	$x+=120;
	$pdf->setXY($x,$y);
	$pdf->Write(16,$_POST['phone']);
	$x-=120;
	$y+=20;
	  $pdf->setXY($x,$y);
	$pdf->Write(16,"HOME ADDRESS:");
	$x+=120;
	$pdf->setXY($x,$y);
	$pdf->Write(16,$_POST['address']);
	$x-=120;
		$y+=20;
		  $pdf->setXY($x,$y);
	$pdf->Write(16,"MARITAL STATUS:");
	$x+=120;
	$pdf->setXY($x,$y);
	$pdf->Write(16,$_POST['status']);
	$x-=120;
	$y+=30;
	$pdf->SetFont('Times','U',16);
	$pdf->setXY($x,$y);
	$y+=10;
	$x=30;
	$pdf->setXY($x,$y);
	//$w,$h,$txt,$border=0,$align='J',$fill=0,$link=''
	$pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Carrear Objective", 0 , 'L' , 1);
	//$pdf->Write(16,"Carrer Objective");
	//$y+=10;
	$x=30;
	$pdf->setXY($x,$y);
   // $pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);
	$pdf->SetFont('Times','',12);
	$objective=($_POST['obj']!="")?$_POST['obj']:$_POST['objective'];
	$pdf->Write(16,$objective);
	/* Experience *****************/
	$y+=50;
	$pdf->SetFont('Times','U',16);
	$pdf->setXY($x,$y);
	//$y+=10;
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Work Experience", 0 , 'L' , 1);
	//$pdf->Write(16,"Work Experience");
    $x=30;
	$pdf->setXY($x,$y);
	//$pdf->DottedRect($x,$y=150,$w=50,$h=50);
    //$pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);	
	if($_POST['expirience']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['expirience']." (".$_POST['expi_from']." - ".$_POST['expi_to']." )");
	  $y+=20;
	}

	if(isset($_POST['nameexpia']) && $_POST['nameexpia']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['nameexpia']." (".$_POST['expia']." - ".$_POST['expiy']." )");
	  $y+=20;
	}

  if(isset($_POST['nameexpiaa']) && $_POST['nameexpiaa']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['nameexpiaa']." (".$_POST['expiaa']." - ".$_POST['expiay']." )");
	  $y+=20;
	}
	/* Education *****************/
	//$y+=30;
	$pdf->SetFont('Times','U',16);
	$pdf->setXY($x,$y);
	$y+=10;
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Education Background", 0 , 'L' , 1);
	//$pdf->Write(16,"Education Background");
    $x=30;
	$pdf->setXY($x,$y);
	//$pdf->DottedRect($x,$y=150,$w=50,$h=50);
    //$pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);	
	if($_POST['pri_school']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['pri_school']." (".$_POST['pri_from']." - ".$_POST['pri_to']." )");
	  $y+=12;
	}
	//'nameprimarya' => string 'dfff' (length=4)
  //'primarya' => string '1965' (length=4)
    if(isset($_POST['nameprimarya']) && $_POST['nameprimarya']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	 $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['nameprimarya']." (".$_POST['primarya']." - ".$_POST['primaryy']." )");
	  $y+=12;
	}
	  if(isset($_POST['nameprimaryaa']) && $_POST['nameprimaryaa']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	 $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['nameprimaryaa']." (".$_POST['primaryaa']." - ".$_POST['primaryay']." )");
	  $y+=12;
	}
	
	if($_POST['sec_school']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	 $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['sec_school']." (".$_POST['sec_from']." - ".$_POST['sec_to']." )");
	  $y+=12;
	}
	
  if(isset($_POST['namesecondarya']) && $_POST['namesecondarya']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namesecondarya']." (".$_POST['secondarya']." - ".$_POST['secondaryy']." )");
	  $y+=12;
	}

	if(isset($_POST['namesecondaryaa']) && $_POST['namesecondaryaa']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namesecondaryaa']." (".$_POST['secondaryaa']." - ".$_POST['secondaryay']." )");
	  $y+=12;
	}
	
	
	
	
	if(isset($_POST['higher_school']) && $_POST['higher_school']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['higher_school']." (".$_POST['higher_from']." - ".$_POST['higher_to']." )");
	  $y+=12;
	}	
		if(isset($_POST['nameunia']) && $_POST['nameunia']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['nameunia']." (".$_POST['unia']." - ".$_POST['uniy']." )");
	  $y+=12;
	}
	
	if(isset($_POST['nameuniaa']) && $_POST['nameuniaa']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['nameuniaa']." (".$_POST['uniaa']." - ".$_POST['uniay']." )");
	  $y+=12;
	}
	$pdf->SetFont('Times','U',16);
	$pdf->setXY($x,$y);
	$y+=20;
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Qualifications", 0 , 'L' , 1);
	//$pdf->Write(16,"Qualifications");
    $x=30;
	$pdf->setXY($x,$y);
	//$pdf->DottedRect($x,$y=150,$w=50,$h=50);
    //$pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);	
	  
	  if(isset($_POST['qualification']) && $_POST['qualification']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['qualification']." (".$_POST['quali_date']." )");
	  $y+=12;
	}
	
	  if(isset($_POST['namequalia']) && $_POST['namequalia']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namequalia']." (".$_POST['qualia']." )");
	  $y+=12;
	}

	  if(isset($_POST['namequaliaa']) && $_POST['namequaliaa']!=""){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namequaliaa']." (".$_POST['qualiaa']." )");
	  $y+=12;
	} 
	
	if(isset($_POST['namequaliaaa']) && $_POST['namequaliaaa']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namequaliaaa']." (".$_POST['qualiaaa']." )");
	  $y+=12;
	} 
	
	if(isset($_POST['namequaliaaaa']) && $_POST['namequaliaaaa']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namequaliaaaa']." (".$_POST['qualiaaaa']." )");
	  $y+=12;
	} 
	
	if ($pdf->GetY() >= 700) {
    $pdf->AddPage();
    $y = 0; // should be your top margin
    }
	/* Hobby */	  
	  	$pdf->SetFont('Times','U',16);
	$pdf->setXY($x,$y);
	$y+=20;
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Hobbies", 0 , 'L' , 1);
	//$pdf->Write(16,"Hobbies");
    $x=30;
	$pdf->setXY($x,$y);
	//$pdf->DottedRect($x,$y=150,$w=50,$h=50);
   // $pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);
	
	
	if(isset($_POST['hobby']) && $_POST['hobby']!="" ){
	$hobbies=explode(",",$_POST['hobby']);
	foreach($hobbies as $hobby){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$hobby);
	  $y+=12;
	  }
	}
	  
	/* Strength */	  
	  	$pdf->SetFont('Times','U',16);
	$pdf->setXY($x,$y);
	$y+=20;
	$x=30;
	if ($pdf->GetY() >= 700) {
    $pdf->AddPage();
    $y = 0; // should be your top margin
}
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Strength", 0 , 'L' , 1);
	//$pdf->Write(16,"Strength");
    $x=30;
	$pdf->setXY($x,$y);
	//$pdf->DottedRect($x,$y=150,$w=50,$h=50);
    //$pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);
	  
	 
	  if(isset($_POST['strength']) && $_POST['strength']!="" ){
	  //$x = $pdf->width;
	$strength=explode(",",$_POST['strength']);
	foreach($strength as $str){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$str);
	  $y+=12;
	  }
	}	
	  
/* Referees */
if ($pdf->GetY() >= 700) {
    $pdf->AddPage();
    $y = 0; // should be your top margin
}	  
	  $pdf->SetFont('Times','U',16);
	$pdf->setXY($x,$y);
	$y+=20;
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',16);
	 $pdf->SetFillColor(216,216,216);
	 $pdf->MultiCell(555, 20, "Referees", 0 , 'L' , 1);
	//$pdf->Write(16,"Referees");
    $x=30;
	$pdf->setXY($x,$y);
	//$pdf->DottedRect($x,$y=150,$w=50,$h=50);
    //$pdf->cell(0,20," ",'B',2,'L', false);
	$y+=20;
	  $pdf->setXY($x,$y);	
	  
	  if(isset($_POST['ref_name']) && $_POST['ref_name']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['ref_name']);
	  $y+=20;
	  $pdf->setXY($x,$y);
	  $pdf->Write(16,$_POST['ref_pos']);
	   $y+=20;
	  $pdf->setXY($x,$y);
	  $pdf->Write(16,$_POST['ref_phone']);
	  $y+=12;
	}

    if(isset($_POST['namerefereea']) && $_POST['namerefereea']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namerefereea']);
	  $y+=20;
	  $pdf->setXY($x,$y);
	  $pdf->Write(16,$_POST['refereea']);
	   $y+=20;
	  $pdf->setXY($x,$y);
	  $pdf->Write(16,$_POST['refereey']);
	  $y+=12;
	}
	
	if(isset($_POST['namerefereeaa']) && $_POST['namerefereeaa']!="" ){
	$x=30;
	$pdf->setXY($x,$y);
	$pdf->SetFont('Times','',30);
	  $pdf->Write(16,".");
	  $x+=10;
	  $y+=8;
	  $pdf->setXY($x,$y);
	  $pdf->SetFont('Times','',12);
	  $pdf->Write(16,$_POST['namerefereeaa']);
	  $y+=20;
	  $pdf->setXY($x,$y);
	  $pdf->Write(16,$_POST['refereeay']);
	   $y+=20;
	  $pdf->setXY($x,$y);
	  $pdf->Write(16,$_POST['refereeay']);
	  $y+=12;
	}


 $pdf->Output($surname.'_cv.pdf','D');//F(file system),I(to browser),D(to browser and force download), S(string format)

?> 