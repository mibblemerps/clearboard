
$(document).ready(function(){
    var simplemde = new SimpleMDE({
        element: $("#postreply")[0],
        autosave: {
            enabled: true,
            delay: 2000,
            unique_id: "thread-" + window.thread_id // save drafts based on thread id
        },
        spellChecker: false
    });
});
