<?php
    if(!(isset( $_COOKIE["mail"] ) && isset( $_COOKIE["password"]))) {
        header("Location:../index.php");
        exit();
    }       

    include("./function.php");
    ConnectDatabase();
    $profilePic = newPic();
    include("./header.php");
?>
<?php
    
    header("Location:./HomePage.php");
        exit();
?>
<?php
	include("./footer.php");
	DisconnectDatabase();
?> 