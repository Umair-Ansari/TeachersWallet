<?php
if(session_id() == '') {
    session_start();
}
require_once("../../PHPMailerAutoload.php");
require_once("../database.php");
class DeleteRequest
{
    private $email;
    private $table;
    private $reason;

    function __construct()
    {
        $this->email            = $_POST["email"];
        $this->table            = $_POST["table"];
        $this->reason           = $_POST["reason"];

    }
	public function Delete()
    {	
    	global $database;
        //$Query  = "START TRANSACTION;";
        //{
            
            $Query  = "DELETE FROM $this->table WHERE email='{$this->email}'; ";
            $this->Result = $database->query($Query);;
        //}
      //  $Query  = "COMMIT;";
        if($this->Result)
        {
            //$this->Result = $database->query($Query);
            $mail = new PHPMailer;
                    
                    $message = "hi, <b>".$this->email."</b>";
                    $message .= "<br><br>";
                    $message .= "Your Account Request Is rejected by the Admin";
                    $message .= "<br><br>";
                    $message .= "**** Reason ****<br>";
                    $message .= $this->reason;
                    $message .= "<br><br>";
                    $message .= "<img src='cid:logo' /><br>";
                    $message .= "Teacher's Wallet";

                    $mail->isSMTP();                                      
                    $mail->Host = 'smtp.gmail.com';  
                    $mail->SMTPAuth = true;                               
                    $mail->Username = "teacherwallet@gmail.com";                
                    $mail->Password = 'dhjqihygjwxheeph';                           
                    $mail->SMTPSecure = 'tls';                           
                    $mail->Port = 587;                                  
                    $mail->From = 'admin@unishare.com';
                    $mail->FromName = "Teacher's Wallet";
                    $mail->addAddress($this->email);              
                    $mail->isHTML(true);                                  
                    $mail->AddEmbeddedImage('../../images/icon.png', 'logo');
                    $mail->Subject = 'Email Address Verification';
                    $mail->Body    = $message;
                    
                    if(!$mail->send()) {
                        //$_SESSION['emailNotSent'] ="Failed to send verification email.";
                        //echo $mail->ErrorInfo;
                       // header("Location:index.view.php");
                    }
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'><b>Requests Deleted</div>";
            header("Location: ../../user/account.php");  
        }
        else
        {
           // $Query  = "ROLLBACK;";
           // $this->Result = $database->query($Query);
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Failed to perform action</div>";
            header("Location: ../../user/account.php"); 
        }
    }  
}
$MyOBJECT = new DeleteRequest;
$MyOBJECT->Delete();

?>