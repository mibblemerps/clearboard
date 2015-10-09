
function expandUserbox() {
    $("#userbox-dropdown").stop().slideDown(250);
}

function collapseUserbox() {
    $("#userbox-dropdown").stop().slideUp(250);
}

$(document).ready(function(){

    // To allow use of jQuery's hide and show methods
    $("#userbox-dropdown").css("display", "block").hide();

    // Userbox click handler (for logged in users)
    if (window.isLoggedIn) {
        $("#userbox").mouseenter(expandUserbox);
        $("#userbox").mouseleave(collapseUserbox);
    }

    // Userbox click handler (for non-logged in users)
    if (!window.isLoggedIn) {
        $("#loginbtn").click(expandUserbox);
        $("#userbox").mouseleave(collapseUserbox);
    }

});
