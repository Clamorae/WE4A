<?php

//TODO add friend (optionnal)

    function ConnectDatabase(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "raiso ceauci al";
        global $conn;
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    function DisconnectDatabase(){
        global $conn;
        $conn->close();
    }

    function CheckEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false);
    }

    function UsersExists($mail) {
        global $conn;
        $query = "SELECT * FROM users WHERE Mail = '".$mail."'";
        $result = $conn->query($query);
        if (mysqli_num_rows($result) > 0) {
            return (true);
        }else {
            return(false);
        }
    }

    function Signin(){
        global $conn;

        $send = false;
        $created = false;
        $error = NULL;

        if(isset($_POST["name"]) && isset($_POST["mail"])&& isset($_POST["password"])&& isset($_POST["confirm"])){
            $send = true;
            $check = CheckEmail($_POST["mail"]);
            if (md5($_POST["password"])!=md5($_POST["confirm"])){
                $error ="Les mots de passes doivent correspondre.";
            }else if(!$check){
                $error = "Adresse mail invalide.";
            }else{
                $username = SecurizeString_ForSQL($_POST["name"]);
                $mail = SecurizeString_ForSQL($_POST["mail"]);
                $password = md5($_POST["password"]);
                if (UsersExists($mail)){
                    $error = "un compte avec cette adresse mail existe déjà!";
                }else{
                    $query = "INSERT INTO users(Pseudo, Mail, password,root) VALUES ('$username', '$mail', '$password', false)";
                    $result = $conn->query($query);
                    if( mysqli_affected_rows($conn) == 0 )
                    {
                        $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
                    }
                    else{
                        $created = true;
                        CreateLoginCookie($mail, $password);
                    }
                }
            }
        }
        return array($send, $created, $error);
    }

    function LogIn(){
        global $conn, $mail, $userID;

        $error = NULL; 
        $loginSuccessful = false;

        if(isset($_POST["mail"]) && isset($_POST["password"])){
            $mail = SecurizeString_ForSQL($_POST["mail"]);
            $password = md5($_POST["password"]);
            $loginAttempted = true;
        }
        elseif ( isset( $_COOKIE["mail"] ) && isset( $_COOKIE["password"] ) ) {
            $mail = $_COOKIE["mail"];
            $password = $_COOKIE["password"];
            $loginAttempted = true;
        }else{
            $loginAttempted = false;
        }

        if($loginAttempted){
            $query = "SELECT * FROM users WHERE mail = '".$mail."' AND password ='".$password."'";
            $result = $conn->query($query);
            if (mysqli_num_rows($result) != 0){
                $row = $result->fetch_assoc();
                $userID = $row["ID"];
                CreateLoginCookie($mail, $password);
                $loginSuccessful = true;
            }else {
                $error = "Ce compte n'existe pas.";
                $loginSuccessful = false;
            }
            return(array($loginSuccessful, $error));
        }
    }

   function CreatePost(){
        global $conn, $userID;

        $error = NULL; 
        $creationSuccessful = false;

        if(isset($_POST["titre"]) && isset($_POST["text"])){
            $titre = SecurizeString_ForSQL($_POST["titre"]);
            $text = SecurizeString_ForSQL($_POST["text"]);
            $creationAttempted = true;
        }else{
            $creationAttempted = false;
            $error = "veuillez remplir les champs";
        }

        if($creationAttempted){
            $query = "SELECT `ID` FROM users WHERE mail = '".$_COOKIE["mail"]."'";
            $result = $conn->query($query);
            if ( $result ){
                $row = $result->fetch_assoc();
                $userID = $row["ID"];
                $query = "INSERT INTO post(title,content,owner) VALUES ('$titre', '$text', '$userID')";
                $result = $conn->query($query);
                $creationSuccessful = true;
            }else {
                $error = "Vous n'etes pas connecté";
            }
            return(array($creationSuccessful, $error));
        }

    }

    function EditPost(){
        global $conn;
        $creationSuccessful = false;

        $error = NULL;
        if(isset($_POST["titre"]) && isset($_POST["text"])){
            $pretitre = SecurizeString_ForSQL($_POST["titre"]);
            $edit = "[edited]";
            $titre = $pretitre . $edit;
            $text = SecurizeString_ForSQL($_POST["text"]);
            $creationAttempted = true;
        }else{
            $creationAttempted = false;
            $error = "veuillez remplir les champs";
        }

        if($creationAttempted){
            $query = "UPDATE post SET title = '".$titre."', content = '".$text."' WHERE ID = '".$_COOKIE["postID"]."'";
            $result = $conn->query($query);
            if ( $result ){
                $creationSuccessful = true;
                setcookie("postID", $_POST["postID"], time() -1,"/" );
                header("Location:./HomePage.php");
                exit();
            }
        }
        return(array($creationSuccessful, $error));
    }

    function CreateLoginCookie($mail, $encryptedPasswd){
        setcookie("mail", $mail, time() + 24*3600,"/" );
        setcookie("password", $encryptedPasswd, time() + 24*3600,"/");
    }

    function DestroyLoginCookie(){
        setcookie("name", NULL, -1,"/" );
        setcookie("password", NULL, -1,"/");
    }

    function SecurizeString_ForSQL($string) {
        $string = trim($string);
        $string = stripcslashes($string);
        $string = addslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    function SearchUser(){
        global $conn;

        if(isset($_POST["search"])){
            $pseudo = SecurizeString_ForSQL($_POST["search"]);
            $query = "SELECT ID FROM users WHERE Pseudo LIKE '".$pseudo."'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $ID = $row["ID"];
            if ($ID!=NULL){
                do{
                    DisplayPostsPage($row["ID"]);
                }while( $row = $result->fetch_assoc());  
            }else{
                return array(NULL,"Cet utilisateur n'existe pas");
            }
        }

    }

    function Root($userID){
        global $conn;
        $query = "SELECT * FROM users WHERE ID = '".$userID."'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return($row["root"]);
    }

    function DisplayPostsPage($ownerID){
        global $conn;
        if(!(isset( $_COOKIE["mail"] ))){
            $userID=0;
        }else{
            $query = "SELECT ID FROM users WHERE mail = '".$_COOKIE["mail"]."'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $userID = $row["ID"];
            $isRoot = Root($userID);
        }
        $query = "SELECT * FROM post WHERE owner = ".$ownerID." ORDER BY Date DESC LIMIT 10";
        $result = $conn->query($query);
        $query2 = "SELECT * FROM users WHERE ID = '".$ownerID."'";
        $result2 = $conn->query($query2);
        $row2 = $result2->fetch_assoc();
        if( mysqli_num_rows($result) != 0 ){
            if ($userID!=0){

                if (($isRoot==1)||($ownerID===$userID)){
                ?>
        
                <form action="editPost.php" method="POST">
                    <input type="hidden" name="newPost" value="1">
                </form>
        
                <?php    
                }
            }
            while( $row = $result->fetch_assoc() ){
    
                echo '
                    <div class="blogPost">
                ';
                if($row2["image"]===NULL){
                    echo '
                        <div class="postAuthor">par '.$row2["Pseudo"].' le '.$row["Date"].'</div>
                    ';
                }else{
                    echo '
                        <div class="postAuthor"> </br><img src="data:image/jpeg;base64, '.base64_encode($row2['image']).'" height="220" name="image"/><br/> par '.$row2["Pseudo"].' le '.$row["Date"].'</div>
                    ';
                }
                
                echo' 
                    <div class="postTitle">
                        <p class="postTitle">'.$row["title"].'</p>
                    </div>
                    <div class="postContent">
                        <p class="postContent">'.$row["content"].'</p>
                    </div>
                    </div>
                ';
                if ($userID!=0){

                    if (($isRoot==1)||($ownerID===$userID)){
                        $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
                        if ($curPageName=="index.php"){
                            ?>
                                <script src='./PHP/verif.js'></script>
                                <div class="postModify">
                                    <form action="./PHP/modifyPost.php" method="POST">
                                        <input type="hidden" name="postID" value=<?php echo $row['ID'] ?>>
                                        <button type="submit" class="button" >Modifier</button>
                                    </form>
                                    <div class="delete">
                                        <p onclick="verify(<?php echo $row['ID']?>,'./PHP/deletePost.php')">Effacer</p>
                                    </div>
                                </div>
                            <?php
                        }else{
                            ?>
                                <script src='./verif.js'></script>
                                <div class="postModify">
                                    <form action="./modifyPost.php" method="POST">
                                        <input type="hidden" name="postID" value=<?php echo $row['ID'] ?>>
                                        <button type="submit">Modifier</button>
                                    </form>
                                    <div class="delete">
                                        <p onclick="verify(<?php echo $row['ID']?>,'./deletePost.php')">Effacer</p>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
            }
        }
        else {
            echo '
            <p>Il n\'y a pas de post dans le blog de '.$row2["Pseudo"].'.</p>';        
        }
    }

    function DeletePost($PostID){
        global $conn;

        $query = "DELETE FROM post WHERE ID='".$PostID."'";
        $conn->query($query);
        header("Location:./HomePage.php");
        exit();
    }

    function SelectRandomUser(){
        global $conn; 
        
        $query = "SELECT * FROM post";
        $result = $conn->query($query);
        
        if( mysqli_num_rows($result) != 0 ){
            if( mysqli_num_rows($result) >= 10 ){
                $more=10;
            }else{
                $more=0;
            }

            $query = "SELECT * FROM users ORDER BY ID DESC";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            if( mysqli_num_rows($result) != 0 ){
                $maxRange = $row["ID"];
                do {
                    do {
                        $randUser = rand(2,$maxRange);
                        $query = "SELECT * FROM post WHERE owner='".$randUser."'";
                        $result = $conn->query($query);
                    }while (mysqli_num_rows($result) == 0);
                    $row = $result->fetch_assoc();
                    $more-=mysqli_num_rows($result);
                    DisplayPostsPage($randUser);
                } while ($more>0);
                    
            }
        }else{
            echo "Rien n'a encore été posté ici";
        }
    }

    function newPic(){
        global $conn;

        $imagename=$_FILES["image"]["name"]; 

        //Get the content of the image and then add slashes to it 
        $imagetmp=addslashes (file_get_contents($_FILES['image']['tmp_name']));

        //Insert the image name and image content in image_table
        $insert_image="INSERT INTO users VALUES('$imagetmp','$imagename')";
        $query = "UPDATE users SET image = '".$imagetmp."', image_name = '".$imagename."' WHERE mail = '".$_COOKIE["mail"]."'";

        $result = $conn->query($query);
        return ($result);
    }
?>