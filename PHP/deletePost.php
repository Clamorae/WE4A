<?php
    include("./function.php");
    ConnectDatabase();
    if ( isset($_POST["postID"]) ){
        DeletePost($_POST["postID"]);
    }
    DisconnectDatabase();
?>