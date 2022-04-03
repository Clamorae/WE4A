<?php
    include("./function.php");
    ConnectDatabase();
    if ( isset($_GET["id"]) ){
        DeletePost($_GET["id"]);
    }
    DisconnectDatabase();
?>