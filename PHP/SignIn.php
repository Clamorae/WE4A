<?php
    include("../PHP/function.php");
    ConnectDatabase();
    $created = SignIn();
    include("../PHP/header.php");
?>

<h1>Création d'un nouveau compte</h1>
<?php
    if($created[1]){
        echo '<h3 class="successMessage">Nouveau compte crée avec succès!</h3>';
    }
    elseif ($created[0]){
        echo '<h3 class="errorMessage">'.$created[2].'</h3>';
    }
?>

<?php include("../PHP/new_user.php"); ?>
<hr>
<p><a href="../index.php" class="backlink"><< Revenir à l'acceuil</a><br><br></p>

<?php
	include("../PHP/footer.php");
	DisconnectDatabase();
?> 