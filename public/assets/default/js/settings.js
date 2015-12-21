
/**
 * Current password.5
 * @type {string}
 */
var currentPassword = "";

/**
 * Select a tab
 * @param tab
 */
function selectTab(tab) {
    // Update the conntrol area
    $("#settings-wrap .settings-pane").hide();
    $("#settings-wrap .settings-pane").each(function() {
        if ($(this).data("tab") == tab) {
            $(this).show();
            return false;
        }
    });

    // Get the title of the tab from the tab button
    var title = "";
    $("#settings-wrap .tab").each(function() {
        if ($(this).data("tab") == tab) {
            title = $(this).html();
        }
    });

    // Update the title
    $("#settings-wrap .settings-right .side-header").html(title);
}

/**
 * Initialize the tab system
 */
function initTabs() {
    // Assign click handler to tab buttons
    $(".tab").click(function() {
        selectTab($(this).data("tab"));
    });

    // Hide all the settings panes
    $("#settings-wrap .settings-pane").hide();

    // Show the settings control area
    $("#settings-wrap .settings-control-area").show();
}

/**
 * Attempt a login to get password for use with high-security operations such as password changing.
 * @param password
 */
function sudoLogin(password) {
    $.post(window.base_path + "/auth/check", {
        password: password,
        _token: window.csrf_token
    }).done(function(data) {
        // Check if verification passed
        if (data == "true") {
            // Verification passed.
            currentPassword = password;

            // Switch to normal security tab
            $("#tabbtn-security").data("tab", "security");
            selectTab("general");
        } else {
            cbPrompt("Access Denied", "Incorrect password. Try again?")
        }
    }).fail(function() {
        // Password verification error
        dialogConnectionError();
    });
}

$(document).ready(function() {
    // Initialize tabs
    initTabs();
    selectTab("security-login");

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
