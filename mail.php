<?php

require_once("PHPMailerAutoload.php");

$mail = new PHPMailer;
$To = "mumair1992@gmail.com";
$message = "abc"; 
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = "teacherwallet@gmail.com";                 // SMTP username
				$mail->Password = 'dhjqihygjwxheeph';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to

				$mail->From = 'admin@unishare.com';
				$mail->FromName = "Teacher's Wallet";
				$mail->addAddress($To);               // Name is optional
				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Email Address Verification';
				$mail->Body    = $message;
				
				if(!$mail->send()) {
					//$_SESSION['emailNotSent'] ="Failed to send verification email.";
					//echo $mail->ErrorInfo;
				   // header("Location:index.view.php");
				}
				else
				{
					echo "send";
				}

?>