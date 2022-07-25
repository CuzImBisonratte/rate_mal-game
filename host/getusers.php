<?php

    // Start sessions
    session_start();

    // Get db keys
    require_once("../config.php");

    // Conect to database
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if (mysqli_connect_errno()) {
        exit("Fehler");
    }

    // Get users
    $users = array();
    $query = $con->query('SELECT username FROM '.$DB_USERS_TABLE.' WHERE session_id='.$_SESSION["session_id"]);
    while($row = mysqli_fetch_array($query)){
        array_push($users, $row["username"]);
    }
    exit(json_encode($users));

?>