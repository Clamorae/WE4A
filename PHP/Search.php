<?php
    include("./function.php");
    ConnectDatabase();
    include("./header.php");
    $account=SearchUser();
?> 

<?php
    if($account[0]){
        include("../PHP/SearchBar.php");
    }
    else{
        echo '<h3 class="errorMessage">'.$account[1].'</h3>';
        include("../PHP/SearchBar.php");
    }
?>

<hr>
<p><a href="../index.php" class="backlink"><< Revenir à l'acceuil</a><br><br></p>


<?php
	include("./footer.php");
	DisconnectDatabase();
?> 