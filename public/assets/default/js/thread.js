
var posteditor;

/**
 * Update the width of post-content elements.
 * A limit must be applied with Javascript so word-wrapping works.
 */
function updatePostWidth() {
    // Stop allowing wrapping in the middle of words
    $(".post .post-content").css("word-break", "normal");

    //$(".post .post-content").css("width", "auto");

    var postWidth = $(".post .post-right").width();

    $(".post .post-content").css("width", postWidth + "px");
}

$(document).ready(function(){
    // Update post widths on window resize
    $(window).resize(updatePostWidth);
    updatePostWidth(); // initial post width update
});

$(document).ready(function() {
    if (window.isLoggedIn) {
        // Create post editor
        posteditor = new SimpleMDE({
            element: $("#postreply-box")[0],
            // Autosave disabled temporarily because it keeps it's content even after submitting (Clearboard will use a custom AJAX submit function)
            /*autosave: {
             enabled: true,
             delay: 2000,
             unique_id: "thread-" + window.thread_id // save drafts based on thread id
             },*/
            spellChecker: false,

            // Use remote server to process markdown preview, for best accuracy.
            previewRender: function(content, preview){
                processMarkdown(content, false, function(data){
                    preview.innerHTML = data;
                });

                return '<span style="color:#575757;font-weight:bold;">Loading, please wait...</span>';
            }
        });

        // Post reply
        $("#postreply-submit").click(function () {
            if (posteditor.value() == "") {
                // Post editor empty, abort..
                //$("#postreply-submit").css("background-color", "#4E4E4E");
                $("#postreply-submit").addClass("button-gray");
                setTimeout(function(){
                    //$("#postreply-submit").css("background-color", "");
                    $("#postreply-submit").removeClass("button-gray");
                }, 200);
                return false;
            }

            // Submit post
            var req = $.post("/ajax/new_post", {
                _token: window.csrf_token,
                body: posteditor.value(),
                thread: window.thread_id
            });

            req.done(function (data) {
                if (data.status) {
                    // Successfully posted
                    console.log("Successfully posted");

                    // Clear postreply field
                    posteditor.value("");

                    // Render new post onto page
                    $("#postreply-insert-anchor").before(data.html);

                    if (window.thread_page != window.thread_last_page) {
                        // Not on last page, show notification alerting post is on a different page
                        window.setInterval(function() {
                            $(".postreply-other-page-info").slideDown(400).fadeIn(500);
                        }, 250);
                    }
                } else {
                    // Unexpected response
                    console.warn("Unexpected response when submitting post!");
                    alert("Oh noes! Something went wrong! :(");
                }
            });
            req.fail(function () {
                console.warn("Request to submit post failed!");
                alert("Oh noes! Something went wrong! :(");
            });
        });
    }
});



