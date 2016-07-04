
/**
 * Current password.
 * @type {string}
 */
var currentPassword = "";

/**
 * Attempt to enter sudo mode.
 * @param password
 */
function sudoLogin(password) {
    axios.post(clearboard.basePath + "/auth/sudo", {
        password: password,
        _token: clearboard.csrfToken
    }).then(function (resp) {
        // Switch to normal security tab
        $("#tabbtn-security").attr("data-tab", "security");
        TabbedPanel.selectTab("tabbedpanel-settings", "security");
    }).catch(function (err) {
        if (err.status == 401) {
            showGenericModal("Incorrect", "The username/password you entered was incorrect.<br>Please try again.");
        } else {
            dialogConnectionError();
        }
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
