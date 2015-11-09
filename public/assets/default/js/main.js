
/**
 * Send AJAX request to server to login
 * @param username
 * @param password
 */
function login(username, password) {
    $.post(window.base_path + "/auth/login", {
        _token: window.csrf_token,
        username: username,
        password: password
    }, null, "json").done(function(data){
        if (data.success == true) {
            location.reload(); // Logged in - reload page
        } else {
            alert("Incorrect username/password!")
        }
    }).fail(function(){
        // Failed to perform login request. =\
        alert("Login request failed.\nAre you still connected to the internet?");
    });
}

// Is the mouse currently hovering over the userbox?
var userboxHasMouse = false;

function expandUserbox() {
    $("#userbox-dropdown").stop().slideDown(250);
}

function collapseUserbox() {
    $("#userbox-dropdown").stop().slideUp(250);
}

$(document).ready(function(){

    // To allow use of jQuery's hide and show methods
    $("#userbox-dropdown").css("display", "block").hide();

    // Apply the event handlers to maintain the userboxHasMouse variable
    $("#userbox").mouseenter(function(){ userboxHasMouse = true; });
    $("#userbox").mouseleave(function(){ userboxHasMouse = false; });

    // Userbox click handler (for logged in users)
    if (window.isLoggedIn) {
        $("#userbox").mouseenter(expandUserbox);
        $("#userbox").mouseleave(collapseUserbox);
    }

    // Userbox click handler (for non-logged in users)
    if (!window.isLoggedIn) {
        $("#loginbtn").click(expandUserbox);
        $(document).click(function(){
            if (!userboxHasMouse) {
                collapseUserbox();
            }
        });

        // Bind form submit event to the login form
        $("#loginform").submit(function(e){
            // Perform login
            login( $("#login-username").val(), $("#login-password").val() );

            collapseUserbox();

            e.preventDefault();
        });
    }

});
