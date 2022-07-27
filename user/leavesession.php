<?php 

    // Get db keys
    require_once("../config.php");

    // Conect to database
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if (mysqli_connect_errno()) {
        exit("Fehler");
    }
    
    // Run a deletion query for the user entry
    if($stmt = $con->prepare("DELETE FROM ".$DB_USERS_TABLE." WHERE user_id=".$_SESSION["user_id"])){
        $stmt->execute();
        $stmt->close();
        $con->close();
    }

    // Destroy the session
    session_start();
    session_destroy();

    // Redirect to index
    header("Location: ./index.html")

?>