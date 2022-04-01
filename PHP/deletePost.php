<?php
    include("./function.php");
    ConnectDatabase();
    if ( isset($_GET["postID"]) ){
        DeletePost($_GET["postID"]);
    }
    DisconnectDatabase();
?>