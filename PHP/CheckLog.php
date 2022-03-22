<?php
    include("../PHP/function.php");
    ConnectDatabase();
    $logged = LogIn();
    include("../PHP/header.php");

?>

<h1>Se connecter</h1>
<?php
    if($logged[1]){
        echo '<h3 class="successMessage">Nouveau compte crée avec succès!</h3>';
    }
    elseif ($logged[0]){
        echo '<h3 class="errorMessage">'.$created[2].'</h3>';
        echo '<h3> <a href="./new_user.php"> créez vous un compte</a> </h3>';
    }
?>

<hr>
<p><a href="../index.php" class="backlink"><< Revenir à l'acceuil</a><br><br></p>

<?php
	include("../PHP/footer.php");
	DisconnectDatabase();
?> 