<?php
    if ( isset($_POST["postID"]) ){
        $query = "SELECT * FROM post WHERE ID = '".$_POST["postID"]."'";    
    }else{
        $query = "SELECT * FROM post WHERE ID = '".$_COOKIE["postID"]."'";
    }
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
?>
<form action="./ModifyPost.php" method="post">
	
    <div class="formbutton"><h2>Modifiez un poste</h2></div>
    <div>
        <label for="titre">Modifiez le titre de votre post :</label>
        <input autofocus type="text" id="titre" name="titre" placeholder='<?php echo $row["title"]?>'>
    </div>
    <div>
        <label for="text">Modifiez le texte de votre post :</label>
        <input type="text" id="text" name="text" placeholder='<?php echo $row["content"]?>'>
    </div>
    <div class="formbutton">
        <button type="submit">Modifier</button>
    </div>
</form>
