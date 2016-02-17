
/**
 * Current password.5
 * @type {string}
 */
var currentPassword = "";

/**
 * Attempt to enter sudo mode.
 * @param password
 */
function sudoLogin(password) {
    $.post(clearboard.basePath + "/auth/sudo", {
        password: password,
        _token: clearboard.csrfToken
    }).done(function(data) {
        // Check if verification passed
        if (data.status) {
            // Switch to normal security tab
            $("#tabbtn-security").data("tab", "security");
            selectTab("security");
        } else {
            cbPrompt("Access Denied", "Incorrect password. Try again?")
        }
    }).fail(function() {
        // Password verification error
        dialogConnectionError();
    });
}

$(document).ready(function() {
    // Setup handlers for security login
    $("#security-login-submit").click(function() {
        sudoLogin($("#security-login-password").val());
    });
    $("#security-login-password").keypress(function(event) {
        if (event.keyCode === 13) {
            $("#security-login-submit").click();
        }
    });
});
