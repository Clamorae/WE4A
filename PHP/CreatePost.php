<form action="./HomePage.php" method="post">
	
    <div class="formbutton"><h2>Créez un poste</h2></div>
    <div>
        <label for="titre">entrez le titre de votre post :</label>
        <input autofocus type="text" id="titre" name="titre">
    </div>
    <div>
        <label for="text">Entrez le texte de votre post :</label>
        <input type="text" id="text" name="text">
    </div>
    <div class="formbutton">
        <button type="submit">Poster</button>
    </div>
</form>
<form method="POST" action="addImage.php" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" name="submit_image" value="Upload">
</form>