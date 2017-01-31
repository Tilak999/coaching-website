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