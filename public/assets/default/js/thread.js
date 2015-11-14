
$(document).ready(function(){
    var simplemde = new SimpleMDE({
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
});
