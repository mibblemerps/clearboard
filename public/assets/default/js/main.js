
function cbPromptDismiss() {
    $("#promptbox").fadeOut(200);
    $("#cover").fadeOut(200);
}

function cbPrompt(title, message, buttons) {
    // Set prompt title and message
    $("#promptbox .promptbox-header").html(title);
    $("#promptbox .promptbox-message").html(message);

    // Clear existing buttons
    $("#promptbox .promptbox-buttons").html("");

    // Setup buttons
    for (var i = 0; i < buttons.length; i++) {
        // Add button html markup
        $("#promptbox .promptbox-buttons").append('<span class="button promptbox-button promptbox-button-'+i+'"></span>');

        var button = $("#promptbox .promptbox-buttons .promptbox-button-" + i);

        // Add text
        button.html(buttons[i].label);

        // Add color class if needed
        switch (buttons[i].color) {
            case 'green':
                button.addClass("button-green");
                break;
            case 'red':
                button.addClass("button-red");
                break;
        }

        // Assign callback
        if (typeof buttons[i].click === "function") {
            button.click(buttons[i].click);
        }

        // Display prompt
        $("#promptbox").fadeIn(200);
        $("#cover").fadeIn(200);
    }
}

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
    // Init promptbox
    $("#promptbox").css("display", "block").hide();
    $("#cover").css("display", "block").hide();

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

function processMarkdown(markdown, inline, callback) {
    var request = $.post(window.base_path + "/ajax/markdown" + (inline ? "_inline" : ""), {
        _token: window.csrf_token,
        markdown: markdown
    });
    request.done(callback);
    request.fail(function(){
        // Request failed!
        console.log("Warning! Failed to get response from server to parse markdown!");
        callback(null);
    });
}

