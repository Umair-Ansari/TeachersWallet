<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class CourseEvaluation
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
    private $T;
    private $U;
    private $V;
    private $W;
    private $X;
    private $Y;
    private $Z;
    private $AA;
    private $BB;
    private $CC;
    private $DD;
    private $EE;
    private $FF;
    private $GG;
    private $HH;
    private $com_a;
    private $com_b;
    private $com_c;
    private $com_d;
    private $com_e;
    private $com_f;
    private $com_g;
    private $com_h;

    Private $user;
    Private $course;
    Private $Result;
	function __construct()
	{
        $this->A        = $_POST['A']; 
        $this->B        = $_POST['B'];
        $this->C        = $_POST['C'];
        $this->D        = $_POST['D'];
        $this->E        = $_POST['E'];
        $this->F        = $_POST['F'];
        $this->G        = $_POST['G'];
        $this->H        = $_POST['H'];
        $this->I        = $_POST['I'];
        $this->J        = $_POST['J'];
        $this->K        = $_POST['K'];
        $this->L        = $_POST['L'];
        $this->M        = $_POST['M'];
        $this->N        = $_POST['N'];
        $this->O        = $_POST['O'];
        $this->P        = $_POST['P'];
        $this->Q        = $_POST['Q'];
        $this->R        = $_POST['R'];
        $this->S        = $_POST['S'];
        $this->T        = $_POST['T'];
        $this->U        = $_POST['U'];
        $this->V        = $_POST['V'];
        $this->W        = $_POST['W'];
        $this->X        = $_POST['X'];
        $this->Y        = $_POST['Y'];
        $this->Z        = $_POST['Z'];
        $this->AA       = $_POST['AA'];
        $this->BB       = $_POST['BB'];
        $this->CC       = $_POST['CC'];

        if(isset($_POST['DD']))
        {
            $this->DD       = $_POST['DD'];
        }
        if(isset($_POST['EE']))
        {
            $this->EE       = $_POST['EE'];
        }
        if(isset($_POST['FF']))
        {
            $this->FF       = $_POST['FF'];
        }
        if(isset($_POST['GG']))
        {
            $this->GG       = $_POST['GG'];
        }
        if(isset($_POST['HH']))
        {
            $this->HH       = $_POST['HH'];
        }
        $this->com_a = $_POST['com_a'];
        $this->com_b = $_POST['com_b'];
        $this->com_c = $_POST['com_c'];
        $this->com_d = $_POST['com_d'];
        $this->com_e = $_POST['com_e'];
        $this->com_f = $_POST['com_f'];
        $this->com_g = $_POST['com_g'];
        $this->com_h = $_POST['com_h'];

        $this->user     = $_POST['user'];
        $this->course   = $_POST['course'];
    }
    public function add()
    {	
    	global $database;
        $this->Result = $this->A +  $this->B + $this->C + $this->D + $this->E + $this->F + $this->G + $this->H + $this->I + $this->J + $this->K + $this->L + $this->M + $this->N + $this->O + $this->P + $this->Q + $this->R + $this->S + $this->T + $this->U + $this->V + $this->W + $this->X + $this->Y + $this->Z + $this->AA + $this->BB + $this->CC;       
        $this->Result = ($this->Result / 145)*100;

        if(($this->HH + $this->GG + $this->FF + $this->EE + $this->DD)> 0)
        {
           $Query = "SELECT * FROM Information WHERE cf_id = $this->course";
            $result = $database->query($Query);
            if($row = mysqli_fetch_assoc($result))
            {
                $set = '';
                $qoma = false;
                if($this->HH > 0)
                {
                    $distance = $row['distance'] + 1;
                       $set .= "distance = '".$distance."'"; 
                    
                    
                    $qoma = true;
                }
                if($this->GG > 0)
                {
                    if($this->GG == 3)
                    {
                        $less =$row['less'] + 1; 
                        if($qoma == true)
                        {
                            $set .= ", less = '".$less."'";
                        }
                        else
                        {
                            $set .= "less = '".$less."'";
                        }
                        $qoma = true;
                    }
                    if($this->GG == 2)
                    {
                        $bet = $row['bet'] + 1;
                       if($qoma == true)
                        {
                            $set .= ", bet = '".$bet."' ";
                        }
                        else
                        {
                            $set .= "bet = '".$bet."' ";
                        }
                        $qoma = true;
                    }
                    if($this->GG == 1)
                    {
                        $row = $row['over'] + 1;
                       if($qoma == true)
                        {
                            $set .= ", over = '".$row."' ";
                        }
                        else
                        {
                            $set .= "over = '".$row."' ";
                        }
                        $qoma = true;
                    } 
                }
                if($this->FF > 0)
                {
                    if($this->FF == 2)
                    {
                        $fmale = $row['fmale'] + 1;
                       if($qoma == true)
                        {
                            $set .= ", fmale = '".$fmale."' ";
                        }
                        else
                        {
                            $set .= "fmale = '".$fmale."' ";
                        }
                        $qoma = true;
                    }
                    if($this->FF == 1)
                    {
                        $male = $row['male'] + 1;
                       if($qoma == true)
                        {
                            $set .= ", male = '".$male."' ";
                        }
                        else
                        {
                            $set .= "male = '".$male."' ";
                        }
                        $qoma = true;
                    } 
                }
                if($this->EE > 0)
                {
                    $disable =  $row['disable'] + 1; 
                    if($this->EE == 2)
                    {
                       if($qoma == true)
                        {
                            $set .= ", disable = '".$disable."' ";
                        }
                        else
                        {
                            $set .= "disable = '".$disable."' ";
                        }
                        $qoma = true;
                    }
                }
                if($this->DD > 0)
                {
                    $part = $row['part'] + 1;
                    if($this->DD == 2)
                    {
                       if($qoma == true)
                        {
                            $set .= ", part = '".$part."' ";
                        }
                        else
                        {
                            $set .= "part = '".$part."' ";
                        }
                        $qoma = true;
                    }
                    if($this->DD == 1)
                    {
                        $full = $row['full'] + 1;
                       if($qoma == true)
                        {
                            $set .= ", full = '".$full."' ";
                        }
                        else
                        {
                            $set .= "full = '".$full."' ";
                        }
                        $qoma = true;
                    } 
                }
                $Query = "UPDATE Information SET $set WHERE cf_id = $this->course";
                $result = $database->query($Query);
            }
        }
        $this->com_a = $database->escape_value($this->com_a);
        $this->com_b = $database->escape_value($this->com_b);
        $this->com_c = $database->escape_value($this->com_c);
        $this->com_d = $database->escape_value($this->com_d);
        $this->com_e = $database->escape_value($this->com_e);
        $this->com_f = $database->escape_value($this->com_f);
        $this->com_g = $database->escape_value($this->com_g);
        $this->com_h = $database->escape_value($this->com_h);
        $Query = "UPDATE course_student SET com_a = '{$this->com_a}', com_b = '{$this->com_b}', com_c = '{$this->com_c}', com_d  = '{$this->com_d}', com_e = '{$this->com_e}', com_f = '{$this->com_f}' , com_g = '{$this->com_g}' , com_h = '{$this->com_h}' WHERE u_id = $this->user AND c_id = $this->course";
        $result = $database->query($Query);

        $Query = "UPDATE course_student SET course = $this->Result WHERE u_id = $this->user AND c_id = $this->course";
        $result = $database->query($Query);
        if($result)
        {
            
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Course Evaluation Submited</div>";
            header("Location: ../../user/courseFileStudent.php");
        
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/courseFileStudent.php");
               
        }  
        
        
    }  
}
$MyOBJECT = new CourseEvaluation;
$MyOBJECT->add();

?>