
var posteditor;

/**
 * Update the width of post-content elements.
 * A limit must be applied with Javascript so word-wrapping works.
 */
function updatePostWidth()
{
    // Stop allowing wrapping in the middle of words
    $(".post .post-content").css("word-break", "normal");

    $(".post .post-content").css("width", "auto");

    var postWidth = $(".post .post-content").width();

    $(".post .post-content").css("width", postWidth + "px");
}

$(document).ready(function(){
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

    $("#postreply-submit").click(function() {
        // Submit post
        var req = $.post("/ajax/new_post", {
            _token: window.csrf_token,
            body: posteditor.value(),
            thread: window.thread_id
        });

        req.done(function(data) {
            if (data.status) {
                // Successfully posted
                console.log("Successfully posted");

                // Clear postreply field
                posteditor.value("");

                // Render new post onto page
                $("#postreply").before(data.html);
            } else {
                // Unexpected response
                console.warn("Unexpected response when submitting post!");
                alert("Oh noes! Something went wrong! :(");
            }
        });
        req.fail(function() {
            console.warn("Request to submit post failed!");
            alert("Oh noes! Something went wrong! :(");
        });
    });

    // Update post widths on window resize
    $(window).resize(updatePostWidth);
    updatePostWidth(); // initial post width update
});
