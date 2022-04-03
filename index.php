<?php
    include("./PHP/function.php");
    ConnectDatabase();
    include("./PHP/header.php");
?> 

<div class="container"> 
    <div class="menu">
    <div class="delete"><a href = "./PHP/SignIn.php"> Créer un compte</a><br></div>
    <div class="delete"><a href = "./PHP/CheckLog.php"> Connexion</a><br></div>
    
    <?php
        if((isset( $_COOKIE['mail'] ) && isset( $_COOKIE['password']))) {
            ?> 
            <div class="delete"><a href = "./PHP/HomePage.php"> Votre profil</a><br></div>
            <div class="delete"><a href = "./PHP/Search.php"> Cherchez un profil</a><br></div>
            </div>
            <?php
        }
        SelectRandomUser();
    ?> 
</div>
<?php
    include("./PHP/footer.php");
    DisconnectDatabase();
?>