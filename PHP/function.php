<?php
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
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
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
                    $query = "INSERT INTO `users` VALUES (NULL, '$username', '$mail', '$password', false)";
                    echo $query."<br>";
                    $result = $conn->query($query);
                    if( mysqli_affected_rows($conn) == 0 )
                    {
                        $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
                    }
                    else{
                        $created = true;
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
        $loginAttempted = false;

        if(isset($_POST["mail"]) && isset($_POST["password"])){
            $mail = SecurizeString_ForSQL($_POST["mail"]);
            $password = md5($_POST["password"]);
            $loginAttempted = true;
        }
        //Données via le cookie?
        elseif ( isset( $_COOKIE["mail"] ) && isset( $_COOKIE["password"] ) ) {
            $mail = $_COOKIE["mail"];
            $password = $_COOKIE["password"];
            $loginAttempted = true;
        }

        if($loginAttempted){
            $query = "SELECT * FROM user WHERE mail = '".$mail."' AND password ='".$password."'";
            $result = $conn->query($query);

            if ( $result ){
                $row = $result->fetch_assoc();
                $userID = $row["ID"];
                CreateLoginCookie($mail, $password);
                $loginSuccessful = true;
            }
            else {
                $error = "Ce compte n'existe pas.";
            }
            return(array())
        }

    }

    function SecurizeString_ForSQL($string) {
        $string = trim($string);
        $string = stripcslashes($string);
        $string = addslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }
?>