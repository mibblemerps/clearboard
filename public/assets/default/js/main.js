
function expandUserbox() {
    $("#userbox-dropdown").stop().slideDown(250);
}

function collapseUserbox() {
    $("#userbox-dropdown").stop().slideUp(250);
}

$(document).ready(function(){

    // Userbox click handler
    $("#userbox-dropdown").css("display", "block").hide(); // to allow use of jQuery's hide and show methods
    $("#userbox").mouseenter(expandUserbox);
    $("#userbox").mouseleave(collapseUserbox);

});
