<?php 

    // Get db keys
    require_once("../config.php");

    // Conect to database
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if (mysqli_connect_errno()) {
        exit("Fehler");
    }

    // Check if id is already taken
    $checking_id_double = true;
    while($checking_id_double){
        
        // Generate random session id
        $new_id = strval(mt_rand(1111, 9999));
        if ($stmt = $con->prepare("SELECT * FROM ".$DB_SESSION_TABLE." WHERE session_id = ?")) {
            $stmt->bind_param('s', $new_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Do nothing (this will repeat the process) 
            } else {

                // Set checking id double to false (to not repeat the process)
                $checking_id_double = false;

                // Close the statement
                $stmt->close();

                // Send back the game id
                echo "SESSION_ID_START-".$new_id."-SESSION_ID_END";

                // Insert session to DB
                if ($stmt = $con->prepare('INSERT INTO '.$DB_SESSION_TABLE.' (session_id) VALUES (?)')) {
                    $stmt->bind_param('s', $new_id);
                    $stmt->execute();

                    // close the statement
                    $stmt->close();

                } else {

                    // Log the error
                    exit("Error-".mysqli_error($con));
                }

                // close the database connection
                $con->close();



            }
        }
    }

?>