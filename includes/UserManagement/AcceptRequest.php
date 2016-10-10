<?php
if(session_id() == '') {
    session_start();
}
require_once("../../PHPMailerAutoload.php");
require_once("../database.php");
class AcceptRequest
{
    private $email;
    private $table;

    Private $fname;
    Private $lname;
    Private $designation;
    Private $shift;


    Private $rom;
    Private $cnic;
    Private $phone;
    Private $gender;
    Private $qualification;

    Private $reg_no;
    Private $dob;
    Private $address;
    Private $cgpa;
    Private $nationality;

    Private $password;
    Private $Query;
    function __construct()
    {
        $this->email            = $_POST["email"];
        $this->table            = $_POST["table"];
    }
	public function Accept()
    {	
    	global $database;
        
        $Query  = "START TRANSACTION;";
        $this->Result = $database->query($Query);
        //{
        if($this->table == "temp_worker")
        {
            echo $Query1  = "SELECT * FROM temp_worker WHERE email='{$this->email}' ";
            $this->Result = $database->query($Query1);
            if ($row = mysqli_fetch_assoc($this->Result))
            {
                $this->fname        = $row['fname'];
                $this->lname        = $row['lname'];
                $this->designation  = $row['designation'];
                $this->shift        = $row['shift'];
                $this->password     = $row['password'];
            }
               echo  $Query2   = "INSERT INTO user (fname,lname,email,password,r_id) VALUES ('{$this->fname}','{$this->lname}','{$this->email}','{$this->password}',1)";

                $this->Result = $database->query($Query2);
                
                if($this->Result)
                {
                    $Query5  = "INSERT INTO c_officer ";
                    $Query5  .= "(c_o_designation,c_o_shif,u_id) VALUES ";
                    $Query5  .= "('{$this->designation}','{$this->shift}',LAST_INSERT_ID())"; 
                    $this->Result = $database->query($Query5);
                }
                
                if($this->Result)
                {
                    $this->Query  = "DELETE FROM temp_worker WHERE email ='{$this->email}' ; ";
                    $this->Result = $database->query($this->Query);
                }
            
        //}
        }
        else if($this->table == "temp_teacher")
        {
            
           $Query1  = "SELECT * FROM temp_teacher WHERE email='{$this->email}' ";
            $this->Result = $database->query($Query1);
            if ($row = mysqli_fetch_assoc($this->Result))
            {
                $this->fname             = $row['fname'];
                $this->lname             = $row['lname'];
                $this->password          = $row['password'];
                $this->rom               = $row['office'];
                $this->cnic              = $row['cnic'];
                $this->phone             = $row['phone'];
                $this->gender            = $row['gender'];
                $this->qualification     = $row['qualification'];

            }
               $Query2   = "INSERT INTO user (fname,lname,email,password,r_id) VALUES ('{$this->fname}','{$this->lname}','{$this->email}','{$this->password}',2)";

                $this->Result = $database->query($Query2);
                
                if($this->Result)
                {
                    $Query5  = "INSERT INTO teacher ";
                    $Query5  .= "(t_office,t_phone,final_qualification,t_cnic,t_gender,u_id) VALUES ";
                    $Query5  .= "('{$this->rom}','{$this->phone}','{$this->qualification}','{$this->cnic}','{$this->gender}',LAST_INSERT_ID())"; 
                    $this->Result = $database->query($Query5);
                }
                
                if($this->Result)
                {
                    $this->Query  = "DELETE FROM temp_teacher WHERE email ='{$this->email}' ; ";
                  $this->Result = $database->query($this->Query);
                }
        }
        else if($this->table == "temp_student")
        {
            
            $Query1  = "SELECT * FROM temp_student WHERE email='{$this->email}' ";
            $this->Result = $database->query($Query1);
            if ($row = mysqli_fetch_assoc($this->Result))
            {
                $this->fname             = $row['fname'];
                $this->lname             = $row['lname'];
                $this->password          = $row['password'];

                $this->cnic              = $row['cnic'];
                $this->reg_no            = $row['reg_no'];
                $this->dob               = $row['dob'];
                $this->address           = $row['address'];
                $this->phone             = $row['contact'];
                $this->cgpa              = $row['cgpa'];
                $this->nationality       = $row['nationality'];
                $Query_reg  = "SELECT count(*) row FROM student WHERE Reg_no='{$this->reg_no}' ";
                $this->Result = $database->query($Query_reg);
                if ($row_reg = mysqli_fetch_assoc($this->Result))
                {
                    if($row_reg['row'] > 0)
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Failed to perform action.Students with same Registration NUmber</div>";
                        header("Location: ../../user/account.php");
                        die();
                    }
                }

            }
               $Query2   = "INSERT INTO user (fname,lname,email,password,r_id) VALUES ('{$this->fname}','{$this->lname}','{$this->email}','{$this->password}',3)";

                $this->Result = $database->query($Query2);
                
                if($this->Result)
                {
                    $Query5  = "INSERT INTO student ";
                    $Query5  .= "(Reg_no,s_dob,s_address,s_cnic,s_phone,s_nationality,s_cgpa,u_id) VALUES ";
                    $Query5  .= "('{$this->reg_no}','{$this->dob}','{$this->address}','{$this->cnic}','{$this->phone}','{$this->nationality}','{$this->cgpa}',LAST_INSERT_ID())"; 
                    $this->Result = $database->query($Query5);
                    if(!$this->Result)
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Failed to perform action.Students with same Registration NUmber</div>";
                        header("Location: ../../user/account.php");
                        die();
                    }
                }
                
                if($this->Result)
                {
                    $this->Query  = "DELETE FROM temp_student WHERE email ='{$this->email}' ; ";
                    $this->Result = $database->query($this->Query);
                }
                else
                {
                     $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Failed to perform action.Students with same Registration NUmber</div>";
                     header("Location: ../../user/account.php");
                     die(); 
                }
        }
        if($Query1 && $Query2 && $this->Query)
        {

            $Query  = "COMMIT;";
           $this->Result = $database->query($Query);
           $mail = new PHPMailer;
                    
                    $message = "Welcome <b>".$this->fname." ".$this->lname."</b> to Teacher's Wallet";
                    $message .= "<br><br>";
                    $message .= "Your Account Request Is accepted by the Admin";
                    $message .= "<br><br>";
                    $message .= "**** Please Login to continue ****<br>";
                    //$message .= "Link : http://localhost:80/tw/includes/UserManagement/VerifyAccount.php?token=".$token."&email=".$this->email."&id=1";
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
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'><b>Requests Accepted</div>";
            header("Location: ../../user/account.php");  
        }
        else
        {
            $Query  = "ROLLBACK;";
          $this->Result = $database->query($Query);
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'><b>Failed to perform action</div>";
          header("Location: ../../user/account.php"); 
        }
    } 

}
$MyOBJECT = new AcceptRequest;
$MyOBJECT->Accept();

?>