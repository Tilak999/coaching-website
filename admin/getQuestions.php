<?php

    require('../helper/config.php');
    require('../helper/dbHelper.php');


    $conn = new mysqli($MySql_server, $MySql_user, $MySql_pass, $MySql_db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    if(isset($_POST["id"]))
    {
        
        $result = getQuestions($conn,$_POST["id"]);

        if($result)
        {
            $str = '{"status":"success","items":[';
            
            while($row=$result->fetch_assoc())
            {
                $str =$str.'{'.
                            '"question":"'.$row['question'].'",'.
                            '"options":['.
                                        '"'.$row['option1'].'",'.
                                        '"'.$row['option2'].'",'.
                                        '"'.$row['option3'].'",'.
                                        '"'.$row['option4'].'"],'.
                            '"ans":"'.$row['answer'].'",'.
                            '"marks":"'.$row['marks'].'",'.
                            '"negative":"'.$row['negative_marks'].'"'.                       
                        '},';
            }
            
            $str = rtrim($str,",");
            $str = $str.']}';

            echo $str;
        }
        else
        {
            echo '{"status":"No_ITEMS"}';
        }
        
    }
    else
    {
        header("Location:".$base_url."/admin/dashboard.php");
    }