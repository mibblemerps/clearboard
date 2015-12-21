
/**
 * Select a tab
 * @param tab
 */
function selectTab(tab) {
    // Update the conntrol area
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

$(document).ready(function() {
    initTabs();
    selectTab("general");
});
