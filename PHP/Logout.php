<?php
    include("./function.php");
    ConnectDatabase();
    DestroyLoginCookie();
    header("Location:./CheckLog.php");
    exit();
	DisconnectDatabase();
?> 