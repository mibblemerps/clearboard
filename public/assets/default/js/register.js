
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

    // Display each neccesary message for each error.
    $(".register-error li").each(function() {
        if ( $.inArray($(this).attr("data-error"), errors) != -1 ) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    // Now show the actual error message
    $(".register-error").slideDown(200);
}

function register(email, username, password) {
    // Send registration request to server
    $.post("/ajax/register", {
        _token: window.csrf_token,
        email: email,
        username: username,
        password: password
    });


}
