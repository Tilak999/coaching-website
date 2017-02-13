<?php

    session_start();

    require('../helper/config.php');
 
    if(!isset($_SESSION['id']))
    {
        if(!isset($_SESSION['admin_id']))
        {
            session_destroy();
            header("Location:".$base_url);
        }
    } 
    
    $conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    function getProfile($conn,$id)
    {
        $row['id'] = null;

        $sql = "SELECT * FROM registration_data WHERE id =".$id;
        $result = $conn->query($sql);

        if($result->num_rows == 1)
        {
           $row = $result->fetch_assoc();
           return $row;
        }
        else
        {
            return $row;
        }
    }

    function getProfileByEmail($conn,$email)
    {
        $sql = "SELECT * FROM registration_data WHERE email='$email'";
        $result = $conn->query($sql);

        if($result->num_rows == 1)
        {
           $row = $result->fetch_assoc();
           return $row;
        }
        else
        {
            return false;
        }
    }

    function getAdminProfile($conn,$id)
    {
        $sql = "SELECT * FROM admin WHERE id =".$id;
        $result = $conn->query($sql);

        if($result->num_rows == 1)
        {
           $row = $result->fetch_assoc();
           return $row;
        }
        else
        {
            return $row;
        }
    }

    function getQuizList($conn)
    {
        $sql = "SELECT * FROM quiz";
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
           return $result;
        }
        else
        {
            return null;
        }
    }

    function getQuestions($conn,$qid)
    {
        $sql = "SELECT * FROM quiz_questions where qid =".$qid;
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
           return $result;
        }
        else
        {
            return null;
        }
    }

    function getQuizData($conn,$id)
    {
        $sql = "SELECT * FROM quiz where id =".$id;
        $result = $conn->query($sql);

        if($result->num_rows==1)
        {
            $row = $result->fetch_assoc();
            return $row;
        }
        else
        {
            return null;
        }
    }

    function saveQuizReport($conn,$data)
    {
        $user = $_SESSION['id'];
        $row = getQuizData($conn,$data["quiz-id"]);
        $title = $row['title'];
        $sql = "INSERT INTO quiz_report (quiz_id, quiz_title, user_id, marks, attempted, total_question) VALUES (".$data["quiz-id"].
                ",'".$title."',".$user.", ".$data["marks"].", ".$data["attempted"].", ".$data["count"].")";
        
        if($conn->query($sql)==TRUE)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function deleteQuiz($conn,$id)
    {
        $sql = "DELETE FROM quiz WHERE id=".$id;
        
        if($conn->query($sql)==TRUE)
        {
            $sql = "DELETE FROM quiz_questions WHERE qid=".$id;
            $conn->query($sql);
        }
    }

    function getStudents($conn,$selector,$search)
    {
        if($selector=="" && $search=="")
        {
            $sql = "SELECT * FROM registration_data";    
        }
        else
        {
            $selector = strtolower($selector);
            $selector = preg_replace('/\s+/', '_', $selector);

            $sql = "SELECT * FROM registration_data WHERE $selector LIKE '%$search%'";
        }

        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
           return $result;
        }
        else
        {
           return FALSE;
        }
    }

    function getAvgAttendance($conn,$id)
    {
        
        $sql = "SELECT * FROM attendance WHERE student_id=$id";

        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
           $attendance = 0;
           $total = 0;

           while($row = $result->fetch_assoc())
           {
                $attendance += $row['attended'];
                $total += $row['total'];
           }

           return ($attendance/$total)*100;
        }
        else
        {
           return 0;
        }
    }

    function getAttendance($conn,$id)
    {
        $sql = "SELECT * FROM attendance WHERE student_id=$id";

        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
           return $result;
        }
        else
        {
           return FALSE;
        }
    }

    function saveAttendance($conn,$id,$dur,$atten,$total)
    {
        $sql = "INSERT INTO attendance (student_id,duration,total,attended) VALUES ($id,'$dur',$total,$atten)";

        if($conn->query($sql)==TRUE)
        {
            return "success";
        }
        else
        {
            return $sql;
        }
    }

    function deleteAttendance($conn,$student_id,$id)
    {
         $sql = "DELETE FROM attendance WHERE id=$id AND student_id=$student_id";
        
        if($conn->query($sql)==TRUE)
        {
           return "success";
        }
        else
        {
            return "Error Deleting Attendance Record";
        }
    }