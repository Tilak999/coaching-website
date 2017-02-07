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

    function getProfile($id,$conn)
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
        $sql = "INSERT INTO quiz_report (quiz_id, user_id, marks, attempted, total_question) VALUES (".$data["quiz-id"].
                ",".$user.", ".$data["marks"].", ".$data["attempted"].", ".$data["count"].")";
        
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