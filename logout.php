<?php

    if(isset($_SESSION['id']) || isset($_SESSION['admin_id']))
    {
        session_destroy();
    }

    header("Location: /");
?>