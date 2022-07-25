function createSession() {
    document.getElementById("host_session_create_button").style.display = "none";

    // Send the status to "./createsession.php" 
    $.ajax({
        url: "./createsession.php",
        type: "POST",
        data: {},
        success: function(data) {
            data = data.toString();
            session_id = data.split("SESSION_ID_START-")[1].split("-SESSION_ID_END")[0];

            // Set the id to the frontend
            document.getElementById("session_id_container").innerText = "ID: " + session_id;

            console.log(session_id);
        }
    });
}