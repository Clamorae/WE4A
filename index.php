<?php
    include("./PHP/function.php");
    ConnectDatabase();
    include("./PHP/header.php");
?> 
<div class="container"> 
    <a href = "./PHP/SignIn.php"> Se créer un compte</a> 
</div>
<?php
    include("./PHP/footer.php");
    DisconnectDatabase();
?>