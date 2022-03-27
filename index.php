<?php
    include("./PHP/function.php");
    ConnectDatabase();
    include("./PHP/header.php");
?> 
<div class="container"> 
    <a href = "./PHP/SignIn.php"> Se créer un compte</a><br>
    <a href = "./PHP/login.php"> Se connecter</a>
    <br>
    <a href = "./PHP/HomePage.php"> Votre profil</a>
    <?php
    if((isset( $_COOKIE['mail'] ) && isset( $_COOKIE['password']))) {
        ?> 
        <br>
        <a href = "./PHP/HomePage.php"> Votre profil</a>
        <?php
    }
    ?> 
</div>
<?php
    include("./PHP/footer.php");
    DisconnectDatabase();
?>