<?php
    include("./function.php");
    ConnectDatabase();
    $logged = LogIn();
    include("./header.php");

?>

<h1>Se connecter</h1>
<?php
    if($logged[0]){
        echo '<h3 class="successMessage">Bon retour parmi nous</h3>';
        header("Location:./HomePage.php");
        exit();
    }
    else{
        echo '<h3 class="errorMessage">'.$logged[1].'</h3>';
        include("./login.php");
        echo '<h3> <a href="./SignIn.php" class="backlink"> créez vous un compte</a> </h3>';
    }
?>

<hr>
<p><a href="../index.php" class="backlink"><< Revenir à l'acceuil</a><br><br></p>

<?php
	include("./footer.php");
	DisconnectDatabase();
?> 