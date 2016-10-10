<?php
if(session_id() == '') {
    session_start();
}
require_once("../../PHPMailerAutoload.php");
require_once("../database.php");
class RegisterStudent
{
    Private $register_no;
    private $degree;
    private $session;
    Private $fname;
    Private $lname;
    Private $dob;
    Private $contact;
	private $email;
	private $password;
    private $Cpassword;
    private $nationality;
    private $cgpa;
    private $address;
    private $cnic;
    Private $Result;

	function __construct()
	{
		$this->register_no  = $_POST["register_no"];
		$this->degree       = $_POST["degree"];
        $this->cnic         = $_POST["cnic"];
        $this->session      = $_POST["session"];
        $this->fname        = $_POST["fname"];
        $this->lname        = $_POST["lname"];
        $this->dob          = $_POST["dob"];
        $this->contact      = $_POST["contact"];
        $this->email        = $_POST["email"];
        $this->password     = $_POST["password"];
        $this->Cpassword    = $_POST["Cpassword"];
        $this->nationality  = $_POST["nationality"];
        $this->cgpa         = $_POST["cgpa"];
        $this->address      = $_POST["address"];
	}
    public function Register()
    {	
    	global $database;

    	$this->register_no  = trim($this->register_no);
        $this->degree       = trim($this->degree);
        $this->session      = trim($this->session);
        $this->fname        = trim($this->fname);
        $this->lname        = trim($this->lname);
        $this->dob          = trim($this->dob);
        $this->contact      = trim($this->contact);
        $this->email        = trim($this->email);
        $this->password     = trim($this->password);
        $this->Cpassword    = trim($this->Cpassword);
        $this->nationality  = trim($this->nationality);
        $this->cgpa         = trim($this->cgpa);
        $this->address      = trim($this->address);
        $this->cnic         = trim($this->cnic);
    	if(($this->register_no == null)||($this->degree == null)||($this->session == null)||($this->fname == null)||($this->lname == null)||($this->dob == null)||($this->contact == null)||($this->email == null)||($this->password == null)||($this->Cpassword == null)||($this->nationality == null )||($this->cgpa == null)||($this->address == null))
    	{
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -20pt 0pt 0pt 0pt;'><b>Please re-enter your missing information.</div>";
            header("Location: ../../signup.php");
    	}
    	else
    	{
    		if($this->password == $this->Cpassword)
            {

                $this->register_no  = $database->escape_value($this->register_no);
                $this->degree       = $database->escape_value($this->degree);
                $this->session      = $database->escape_value($this->session);
                $this->fname        = $database->escape_value($this->fname);
                $this->lname        = $database->escape_value($this->lname);
                $this->dob          = $database->escape_value($this->dob);
                $this->contact      = $database->escape_value($this->contact);
                $this->email        = $database->escape_value($this->email);
                $this->password     = $database->escape_value($this->password);
                $this->nationality  = $database->escape_value($this->nationality);
                $this->cgpa         = $database->escape_value($this->cgpa);
                $this->address      = $database->escape_value($this->address);

                $this->register_no = $this->register_no."-FBAS/".$this->degree."/".$this->session;
                $r_id = 3;

                $Query = "SELECT * FROM temp_student WHERE email ='".$this->email."' ";
                $result = $database->query($Query);
                if($row = mysqli_fetch_assoc($result)) 
                {
                    if($row['status'] == 0)
                    {
                        $token = 0;
                        $token = $row['ts_id'];
                        
                        $mail = new PHPMailer;
                        
                        $message = "Welcome <b>".$this->fname." ".$this->lname."</b> to Teacher's Wallet";
                        $message .= "<br><br>";
                        $message .= "We recieved your account request";
                        $message .= "<br><br>";
                        $message .= "**** Click link below to verify your account ****<br>";
                        $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/includes/UserManagement/VerifyAccount.php?token=".$token."&email=".$this->email."&id=1";
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
                        
                        if(!$mail->send()) {}
                                               
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Another Request Already Pendding!</div>";
                        $_SESSION["info"]    = "<center><b>Note</b> - <u>admin will not be able to view your account request untill you verify your email</u><br>An email that contain your verification link is already send to your email address <b>'".$this->email."'</b>.<br>Please verify your email by clicking  verification link</center>";
                        header("Location: ../../info.php");
                        die();
                        
                    }
                    else
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Your Account Request is in progress</div>";
                        $_SESSION["info"]    = "<center><b>Your email is verified and your request is in under progress.<br>You will be notified by email.</b></center>";
                        header("Location: ../../info.php");
                        die();
                    }
                }
                $Query = "SELECT * FROM user WHERE email ='".$this->email."' ";
                $result = $database->query($Query);
                if($row = mysqli_fetch_assoc($result))
                {
                    $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Email Already Registered!</div>";
                    $_SESSION["info"]    = "<center>Please <a href='index.php'>Login</a> to continue</center>";
                    header("Location: ../../info.php");
                    die();
                }
                $Query  = "INSERT INTO temp_student ";
                $Query .= "(reg_no,fname,lname,email,password,dob,cnic,contact,nationality,cgpa,address,status) ";
                $Query .= "VALUES "; 
                $Query .= "( ";
                $Query .= "'{$this->register_no}','{$this->fname}','{$this->lname}','{$this->email}','{$this->password}','{$this->dob}','{$this->cnic}','{$this->contact}','{$this->nationality}','{$this->cgpa}','{$this->address}',0";
                $Query .= " )";
                        
                $result = $database->query($Query);
               if (!$result) 
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -35pt 0pt -8pt;'><b>Please re-enter your information</b><br><br>Information you entered is incorrect. Please try again (make sure your caps lock is off).</div>";
                   header("Location: ../../signup.php");
                   
                } 
                else 
                {
                    $token = 0;
                    $Query = "SELECT ts_id AS token FROM temp_student WHERE email ='".$this->email."' ";
                    $result = $database->query($Query);
                    if($row = mysqli_fetch_assoc($result)) 
                    {
                        $token = $row['token'];
                    }
                    $mail = new PHPMailer;
                    
                    $message = "Welcome <b>".$this->fname." ".$this->lname."</b> to Teacher's Wallet";
                    $message .= "<br><br>";
                    $message .= "We recieved your account request";
                    $message .= "<br><br>";
                    $message .= "**** Click link below to verify your account ****<br>";
                    $message .= "Link : http://".$_SERVER['SERVER_NAME']."/tw/includes/UserManagement/VerifyAccount.php?token=".$token."&email=".$this->email."&id=1";
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
                    
                    $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Account Request Send!</div>";
                    $_SESSION["info"]    = "<center><b>Note</b> - <u>admin will not be able to view your account request untill you verify your email</u><br>An email that contain your verification link is already send to your email address <b>'".$this->email."'</b>.<br>Please verify your email by clicking  verification link</center>";
                    header("Location: ../../info.php");
                }
            }
            else
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin:-24pt 0px 0px;width: 100%;'>Password missmatch.</div>";
                header("Location: ../../signup.php");
            }
        }
    	return $this->Result;
    }  
}
$MyOBJECT = new RegisterStudent;
$MyOBJECT->Register();

?>