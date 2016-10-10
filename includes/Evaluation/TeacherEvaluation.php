<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class TeacherEvaluation
{
    private $A;
    private $B;
    private $C;
    private $D;
    private $E;
    private $F;
    private $G;
    private $H;
    private $I;
    private $J;
    private $K;
    private $L;
    private $M;
    private $N;
    private $O;
    private $P;
    private $Q;
    private $R;
    private $S;
    
    Private $user;
    Private $course;
    Private $Result;
	function __construct()
	{
        $this->A = $_POST['A']; 
        $this->B = $_POST['B'];
        $this->C = $_POST['C'];
        $this->D = $_POST['D'];
        $this->E = $_POST['E'];
        $this->F = $_POST['F'];
        $this->G = $_POST['G'];
        $this->H = $_POST['H'];
        $this->I = $_POST['I'];
        $this->J = $_POST['J'];
        $this->K = $_POST['K'];
        $this->L = $_POST['L'];
        $this->M = $_POST['M'];
        $this->N = $_POST['N'];
        $this->O = $_POST['O'];
        $this->P = $_POST['P'];
        $this->Q = $_POST['Q'];
        $this->R = $_POST['R'];
        $this->S = $_POST['S'];
        $this->user     = $_POST['user'];
        $this->course   = $_POST['course'];
    }
    public function add()
    {	
    	global $database;
        $this->Result = $this->A +  $this->B + $this->C + $this->D + $this->E + $this->F + $this->G + $this->H + $this->I + $this->J + $this->K + $this->L + $this->M + $this->N + $this->O + $this->P + $this->Q + $this->R + $this->S;       
        $this->Result = ($this->Result / 90)*100;

        $Query = "UPDATE course_student SET teacher = $this->Result WHERE u_id = $this->user AND c_id = $this->course";
        $result = $database->query($Query);
        if($result)
        {
            
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Teacher Evaluation Submited</div>";
            header("Location: ../../user/courseFileStudent.php");
        
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/courseFileStudent.php");
               
        }  
        
        
    }  
}
$MyOBJECT = new TeacherEvaluation;
$MyOBJECT->add();

?>