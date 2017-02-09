<?php

    session_start();

    require('../helper/config.php');
    require('../helper/helper.php');

    $conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);  
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    if(isset($_POST) && validate($_POST))
    {
        if($_POST['hash'] == $_SESSION['hash'])
        {
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $name = mysqli_real_escape_string($conn,$_POST['name']);
            $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
            $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);

            $sql = "INSERT INTO registration_data (email,name,password,mobile) VALUES ('$email','$name','$password','$mobile')";
    
            if($conn->query($sql)==TRUE)
            {
               echo "success";
               $_SESSION['valid'] = TRUE;
               $_SESSION['id'] = $conn->insert_id;
            }
            else
            {
                echo "User with this E-mail already exist.";
            }
        }
    }
    else
    {
        session_destroy();
        header("Location: ../index.php");
    }