<?php
    if(!(isset( $_COOKIE["mail"] ) && isset( $_COOKIE["password"]))) {
        header("Location:../index.php");
        exit();
    }       

    include("./function.php");
    ConnectDatabase();
    $editPost = EditPost();
    include("./header.php");
    if ( isset($_POST["postID"]) ){
        setcookie("postID", $_POST["postID"], time() + 24*3600,"/" );
    }
?>

<h1>Modification d'un Post</h1>

<?php 
    if($editPost[1]){
        echo '<h3 class="successMessage">Nouveau post crée avec succès!'.$editPost[1].'</h3>';

    }
    else{
        echo '<h3 class="errorMessage">'.$editPost[1].'</h3>';
    }
    include("./modifyForm.php");
    
?>
<hr>
<br>

<p><a href="./HomePage.php" class="backlink"><< Revenir à votre profil</a><br><br></p>

<?php
	include("./footer.php");
	DisconnectDatabase();
?> 