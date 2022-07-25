<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Mal!</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="tob_bar" class="top_bar">
        <div id="top_bar_username"><?=$_SESSION["username"]?></div>
        <div id="top_bar_session"><?=$_SESSION["session_id"]?></div>
    </div>

    <p class="heading" id="user_choose_name_heading">Rate Mal! - Pause</p>
    <p class="sub_heading" id="user_choose_name_sub_heading">Bitte warte kurz!</p>

    <div class="abort_pause_button" onclick="leave();">Runde verlassen</div>

    <!-- Get the ajax library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>