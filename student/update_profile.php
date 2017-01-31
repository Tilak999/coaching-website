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

        $sql = "UPDATE registration_data SET name = '$name', email='$email', class='$class', mobile='$mobile' WHERE id = ".$_SESSION['id'];
        
        if($conn->query($sql)==TRUE)
        {
            echo "success";
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