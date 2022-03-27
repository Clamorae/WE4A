<?php
    if(!isset($_COOKIE["allowed"])) {
        header("Location:index.php");
        exit();
    }       
?>