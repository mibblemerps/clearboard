
$(document).ready(function(){
    var simplemde = new SimpleMDE({
        element: $("#postreply")[0],
        // Autosave disabled temporarily because it keeps it's content even after submitting (Clearboard will use a custom AJAX submit function)
        /*autosave: {
            enabled: true,
            delay: 2000,
            unique_id: "thread-" + window.thread_id // save drafts based on thread id
        },*/
        spellChecker: false
    });
});
