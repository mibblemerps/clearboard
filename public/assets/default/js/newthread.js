
var posteditor;
var posting = false; // is the thread being posted?
var postComplete = false; // is the post completed and ready to be posted?

$(document).ready(function(){
    posteditor = new SimpleMDE({
        element: $("#newthread-editor")[0],
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

    $("#newthread-submit").click(function() {
        if (!postComplete) {
            // Post incomplete
            return;
        }

        posting = true;

        var req = $.post("/ajax/new_thread", {
            _token: window.csrf_token,
            title: $("#newthread-title").val(),
            forum: window.forum_id,
            body: posteditor.value()
        });
        req.done(function(data) {
            if (data.status) {
                // Successfully posted
                console.log("Successfully posted");

                // Navigate to new thread
                window.location = data.link;
            }
        });
        req.fail(function() {
            dialogConnectionError();
            posting = false;
        });
    });

    window.setInterval(function() {
        if ( (posteditor.value() == "") || ($("#newthread-title").val() == "") ) {
            // Thread incomplete
            $("#newthread-submit").addClass("button-disabled");
            postComplete = false;
        } else {
            $("#newthread-submit").removeClass("button-disabled");
            postComplete = true;
        }
    }, 100);
});
