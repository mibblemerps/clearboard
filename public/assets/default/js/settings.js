
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
    // Update the control area
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

    // Highlight the selected tab
    $(".tab").removeClass("tab-selected");
    $(".tab").each(function() {
        if ($(this).data("tab") == tab) {
            $(this).addClass("tab-selected");
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
    // Initialize tabs
    initTabs();
    selectTab("general");

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
