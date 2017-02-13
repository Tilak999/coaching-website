<?php

    session_start();

    require('../helper/config.php');
    require('../helper/helper.php');

    $conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);  
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    if(isset($_POST) && validate($_POST))
    {
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $class = mysqli_real_escape_string($conn,$_POST['class']);
        $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
        $image = "profile.jpg";

        if($_FILES["photo"]["tmp_name"]!="")
        {
            $temp_path = $_FILES["photo"]["tmp_name"];
            $check = getimagesize($temp_path);

            if($check !== false && filesize($temp_path) < (2*1024*1024)) 
            {
                $filename = $_FILES["photo"]["name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $image = md5($_SESSION['id'].'salt').".$ext";
                move_uploaded_file($temp_path, "../uploads/".$image);
            } 
            else 
            {
                unlink($temp_path);
            }
        }

        $sql = "UPDATE registration_data SET name = '$name', email='$email', image='$image', class='$class', mobile='$mobile' WHERE id = ".$_SESSION['id'];
        
        if($conn->query($sql)==TRUE)
        {
            header("Location: dashboard.php");
        }
        else
        {
            echo "can't Update please logout and login again.";
        }
        
    }
    else
    {
        session_destroy();
        header("Location:".$base_url);
    }