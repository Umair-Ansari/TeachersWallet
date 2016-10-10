<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class DeleteCourse
{
    Private $course;
    Private $password;
    Private $result;
    function __construct()
    {
        $this->course = $_POST['course'];
        $this->password = $_POST['password'];
    }
    public function Delete()
    {	
    	global $database;

        $user = $_SESSION["user"];

        $query_user = "SELECT password FROM user WHERE u_id =$user";
        $result_user = $database->query($query_user);
        if($row_user = mysqli_fetch_assoc($result_user))
        {
            if($row_user['password'] == $this->password)
            {
                    $query_course_file = "SELECT cf_id FROM course_file WHERE c_code =$this->course ";
                    $result_course_file = $database->query($query_course_file);
                    while($row_course_file = mysqli_fetch_assoc($result_course_file))
                    {
                        $query_attendance = "DELETE FROM  attendance WHERE cf_id =".$row_course_file['cf_id']." ";
                        $result_attendance = $database->query($query_attendance);
                        
                        $query_course_student = "DELETE FROM course_student WHERE c_id =".$row_course_file['cf_id']." ";
                        $result_course_student = $database->query($query_course_student);
                        
                        $query_midterm = "SELECT m_id FROM midterm WHERE cf_id =".$row_course_file['cf_id']." ";
                        $result_midterm = $database->query($query_midterm);
                        while($row_midterm =   mysqli_fetch_assoc($result_midterm))
                        {
                            $query_total = "DELETE FROM total WHERE m_id =".$row_midterm['m_id']."";
                            $result_total = $database->query($query_total);
                            if($result_total)
                            {
                                $query_midterm_delete = "DELETE FROM  midterm WHERE m_id =".$row_midterm['m_id']."";
                                $result_midterm_delete = $database->query($query_midterm_delete);
                            }

                        }
                        $query_final = "SELECT f_id FROM final WHERE cf_id =".$row_course_file['cf_id']." ";
                        $result_final = $database->query($query_final);
                        while($row_final =   mysqli_fetch_assoc($result_final))
                        {
                            $query_total = "DELETE FROM total WHERE f_id =".$row_final['f_id']."";
                            $result_total = $database->query($query_total);
                            if($result_total)
                            {
                                $query_final_delete = "DELETE FROM  final WHERE f_id =".$row_final['f_id']."";
                                $result_final_delete = $database->query($query_final_delete);
                            }
                        }
                        $query_project = "SELECT p_id FROM project WHERE cf_id =".$row_course_file['cf_id']." ";
                        $result_project = $database->query($query_project);
                        while($row_project =   mysqli_fetch_assoc($result_project))
                        {
                            $query_total = "DELETE FROM total WHERE p_id =".$row_project['p_id']."";
                            $result_total = $database->query($query_total);
                            if($result_total)
                            {
                                $query_project_delete = "DELETE FROM  project WHERE p_id =".$row_project['p_id']."";
                                $result_project_delete = $database->query($query_project_delete);
                            }
                        }
                        $query_assignment = "SELECT assign_id FROM assignment WHERE cf_id =".$row_course_file['cf_id']." ";
                        $result_assignment = $database->query($query_assignment);
                        while($row_assignment =   mysqli_fetch_assoc($result_assignment))
                        {
                            $query_assignment_student = "DELETE FROM assignment_student WHERE assign_id =".$row_assignment['assign_id']."";
                            $result_assignment_student = $database->query($query_assignment_student);
                            if($result_assignment_student)
                            {
                                $query_assignment_delete = "DELETE FROM  assignment WHERE assign_id =".$row_assignment['assign_id']."";
                                $result_assignment_delete = $database->query($query_assignment_delete);
                            }

                        }
                        $query_quizzes = "SELECT q_id FROM quizzes WHERE cf_id =".$row_course_file['cf_id']." ";
                        $result_quizzes = $database->query($query_quizzes);
                        while($row_quizzes =   mysqli_fetch_assoc($result_quizzes))
                        {
                            $query_quiz_student = "DELETE FROM quiz_student WHERE q_id =".$row_quizzes['q_id']."";
                            $result_quiz_student = $database->query($query_quiz_student);
                            if($result_quiz_student)
                            {
                                $query_quizzes_delete = "DELETE FROM  quizzes WHERE q_id =".$row_quizzes['q_id']."";
                                $result_quizzes_delete = $database->query($query_quizzes_delete);
                            }
                        }

                        $query_course_file = "DELETE FROM  course_file WHERE cf_id =".$row_course_file['cf_id']."";
                        $result_course_file = $database->query($query_course_file);
                    }
                    $query_student_request = "DELETE FROM  student_request WHERE c_code =$this->course";
                    $result_student_request = $database->query($query_student_request);
                
                    $query_course = "DELETE FROM course WHERE c_code =$this->course ";
                    $result_course = $database->query($query_course);
                    if ($result_course) 
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Course Deleted</div>";
                        header("Location: ../../user/newCourse.php");
                    }
                    else 
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;font-size: 10pt;'>Error!</div>";
                        header("Location: ../../user/newCourse.php");
                    }
            }
            else
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;font-size: 10pt;'>Wrong Password!</div>";
                header("Location: ../../user/newCourse.php");
            }
        }
        
            
    	
    	

        return $this->result;
    }  
}
$MyOBJECT = new DeleteCourse;
$MyOBJECT->Delete();

?>