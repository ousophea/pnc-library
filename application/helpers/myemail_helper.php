<?php
require 'phpmailer/PHPMailerAutoload.php';
function myEmail($email, $name, $subject, $body){
	$mail = new PHPMailer;

	//Enable SMTP debugging. 
	$mail->SMTPDebug = 0;  // SET to 3 to see errors                              
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
	//Set SMTP host name                          
	$mail->Host = "smtp.gmail.com";
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password - DO NOT CHANGE IT -    
	$mail->Username = "rithysam.sr@gmail.com";                 
	$mail->Password = "rithy@sam";                           
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "tls";                           
	//Set TCP port to connect to 
	$mail->Port = 587;                                   

	$mail->From = "rithysam.sr@gmail.com";


	// HERE YOU CAN CUSTOMIZE DEPENDING YOUR GROUP/PROJECT
	$mail->FromName = "PNC Library";
	$mail->addAddress($email, $name); // Define address of destination
	$mail->isHTML(true);

	// DEFINE THE MAIl CONTENT
	$mail->Subject = $subject;
	$mail->Body = $body;
	// $mail->AltBody = "This is the plain text version of the email content";

	if(!$mail->send()) // calling send(), send the email. Return true if success return false otherwize
	{
	    return false;
	} 
	else 
	{
	   return true;
	}
}

?>