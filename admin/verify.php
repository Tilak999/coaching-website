<?php

    session_start();

    require('../helper/config.php');
    require('../helper/helper.php');

    $conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    if(isset($_POST) && validate($_POST))
    {
        
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
    
        $sql = "SELECT id FROM admin WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if($result->num_rows == 1)
        {
            echo "success";
            $row = $result->fetch_assoc();
            $_SESSION['valid'] = TRUE;
            $_SESSION['admin_id'] = $row['id'];
            unset($_SESSION['id']);
        }
        else
        {
            echo "Invalid E-mail or Password";
        }
        
    }
    else
    {
        session_destroy();
        header("Location: ../index.html");
    }