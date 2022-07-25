<?php 

    // Start session
    session_start();

    // Get the userinput
    $username = $_POST["username"];
    $session_id = $_POST["session_id"];

    // Get db keys
    require_once("../config.php");

    // Conect to database
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if (mysqli_connect_errno()) {
        exit("Fehler");
    }

    // Check if session with id exists
    if ($stmt = $con->prepare("SELECT * FROM ".$DB_SESSION_TABLE." WHERE session_id = ?")) {
        $stmt->bind_param('s', $session_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            // Unknown session ID
        } else {
            // Close the check-statement
            $stmt->close();

            // Insert session to DB
            if ($stmt = $con->prepare('INSERT INTO '.$DB_USERS_TABLE.' (username, session_id) VALUES (?, ?)')) {
                $stmt->bind_param('ss', $username, $session_id);
                $stmt->execute();

                // close the statement
                $stmt->close();

                // Add the values to session vars
                $_SESSION["username"] = $username;
                $_SESSION["session_id"] = $session_id;

                // Redirect
                header("Location: ./page1-pause.php");
                exit("Leite weiter...");

            } else {
                // Log the error
                exit("Error-".mysqli_error($con));
            }
        }
    }
?>