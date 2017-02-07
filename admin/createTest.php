<?php

    require("../helper/dbHelper.php");

    if(!isset($_SESSION['admin_id']))
    {
        header("Location:".$base_url);
        die();
    }

    $conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    function escape($conn,$str) 
    {
        return mysqli_real_escape_string($conn,$str);
    }

    if(isset($_POST) && isset($_POST['id']))
    {
        $data = json_decode($_POST['data'], true);
        $id = $_POST['id'];

        if($data)
        {   
            $res['status'] = "success";
            $res['id']=$id;

            $title = escape($conn,$data['title']);
            $description = escape($conn,$data['description']);
            $guidelines = escape($conn,$data['guidelines']);
            $max_marks = escape($conn,$data['max_marks']);
            $time = escape($conn,$data['time']);

            if($id !=0)
            {
                $query ="UPDATE quiz SET title = '$title', description = '$description',".
                            "guidelines = '$guidelines', max_marks = '$max_marks',".
                            "time_alloted = $time WHERE id = $id";        
                
                if($conn->query($query))
                {
                    $query = "DELETE FROM quiz_questions WHERE qid=".$id;
                    if($conn->query($query))
                    {
                        foreach ($data['questions'] as $obj) 
                        {
                            extract($obj);
                            $query ="INSERT INTO quiz_questions(qid,question,option1,option2,option3,option4,answer,marks,negative_marks) ".
                                    "VALUES ($id,'$qsn','$optn1','$optn2','$optn3','$optn4','$ans','$marks','$negative')";
                            if(!$conn->query($query)) $res['status']="Insertion of questions failed";    
                        }
                    }
                    else
                    {
                        $res['status']="deletion of questions failed";
                    }
                }
                else
                {
                    $res['status']="Quiz detail update failed";
                }
            }
            else
            {
                $row = getAdminProfile($conn,$_SESSION['admin_id']);
                $admin = $row['name'];

                $query ="INSERT INTO quiz (title,description,guidelines,max_marks,time_alloted,author) ".
                            "VALUES ('$title', '$description', '$guidelines', '$max_marks', '$time', '$admin')";
                
                if($conn->query($query))
                {
                    $id = $conn->insert_id;

                    foreach ($data['questions'] as $obj) 
                    {
                        extract($obj);
                        $query ="INSERT INTO quiz_questions(qid,question,option1,option2,option3,option4,answer,marks,negative_marks) ".
                                "VALUES ($id,'$qsn','$optn1','$optn2','$optn3','$optn4','$ans','$marks','$negative')";
                        if(!$conn->query($query)) $res['status']="Insertion of questions failed";
                    }

                    $res['id'] = $id;
                   
                }
                else
                {
                    $res['status']="Quiz Insert new Failed";
                }
            }

            echo json_encode($res);
        }      
    }
    else
    {
        session_destroy();
        header("Location: ../index.html");
    }