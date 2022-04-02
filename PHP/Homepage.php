<?php
    if(!(isset( $_COOKIE["mail"] ) && isset( $_COOKIE["password"]))) {
        header("Location:../index.php");
        exit();
    }       

    include("./function.php");
    ConnectDatabase();
    $newPost = CreatePost();
    include("./header.php");
?>

<h1>Création d'un nouveau Post</h1>
<?php
    if($newPost[1]){
        echo '<h3 class="successMessage">Nouveau post crée avec succès!'.$newPost[1].'</h3>';
    }
    else{
        echo '<h3 class="errorMessage">'.$newPost[1].'</h3>';
    }
?>

<?php 
    include("./Createpost.php"); 
    $query="SELECT * from users where mail = '".$_COOKIE["mail"]."'";
    $result = $conn->query($query);
    

    if($row = $result->fetch_assoc()){
        $image_name=$row["image_name"];
        $image_content=$row["image"];
        echo('</br><img src="data:image/jpeg;base64, '.base64_encode($row['image']).'" height="120" name="image"/><br/>');
    }
?>
<hr>
<br>
<?php 
    $query = "SELECT `ID` FROM users WHERE mail = '".$_COOKIE["mail"]."'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $userID = $row["ID"];
    DisplayPostsPage($userID);
?>
<p><a href="../index.php" class="backlink"><< Revenir à l'acceuil</a><br><br></p>

<?php
	include("./footer.php");
	DisconnectDatabase();
?> 