
$(document).ready(function(){
    // Register click handler for register button
    $("#register-submit").click(function(){
        console.log("test");
        register( $("#register-email").val(), $("#register-username").val(), $("#register-password").val() );
    });
});

/**
 * Display registration errors to the user.
 * Pass a blank array of errors to hide the error message.
 * @param errors Array of error identifiers
 */
function displayRegisterErrors(errors) {
    if (errors.length == 0) {
        // No errors passed, hide error message
        $(".register-error").slideUp(200);
        return;
    }

    // Clear old errors
    $(".register-error ul").html("");

    // Render errors
    $.each(errors, function(i, error) {
        console.log("render: " + error);
        $(".register-error ul").append("<li>" + error + "</li>");
    });

    // Now show the actual error message
    $(".register-error").slideDown(200);
}

function register(email, username, password) {
    // Send registration request to server
    console.log("Sending registration request to server...");
    var req = $.post("/ajax/register", {
        _token: window.csrf_token,
        email: email,
        username: username,
        password: password
    });
    req.done(function(data){
        if (data.success) {
            console.log("Registration successful");
        } else {
            // Registration failed
            console.log("Registration error:")
            console.log(data.errors);
            displayRegisterErrors(data.errors);
        }
    });
    req.fail(dialogConnectionError);
}
