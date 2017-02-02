<?php

    session_start();

    require('../helper/config.php');

    if(!isset($_SESSION['id']))
    {
        session_destroy();
        header("Location:".$base_url);
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