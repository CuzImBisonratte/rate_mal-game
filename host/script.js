var userAlreadyOnPage = [];

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

            // Make the user list visible
            document.getElementById("user_list").style.display = "flex"

            // Add username loader
            usernameloadtimer = window.setInterval(() => {

                // Get the usernames from "./getusers.php"
                $.ajax({
                    url: "./getusers.php",
                    type: "POST",
                    data: {},
                    success: function(data) {

                        // convert data to a string
                        data = data.toString();

                        // decode json
                        json = JSON.parse(data);

                        // loop through
                        json.forEach(element => {

                            if (userAlreadyOnPage.includes(element)) {
                                // Do nothing (go to next element)
                                return;
                            }

                            // Add the element to the check array
                            userAlreadyOnPage.push(element);

                            // Add username to userboard
                            var username_obj = document.createElement("div");
                            username_obj.classList.add("user_list_item");
                            username_obj.id = "user_list_item_" + toString(element);
                            username_obj.innerHTML = element;
                            document.getElementById("user_list").appendChild(username_obj);

                        });

                        userAlreadyOnPage.forEach(element => {

                            // Check if user is no more in recieved json
                            if (!json.includes(element)) {

                                // Delete the element
                                document.getElementById("user_list_item_" + toString(element)).remove();
                            }
                        });
                    }
                });

            }, 3 * 1000);

            console.log(session_id);
        }
    });
}