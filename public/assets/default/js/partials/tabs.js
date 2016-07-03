/*
Provides tab functionality.
Should be used with tabs scss partial.
 */

/**
 * Select a tab
 * @param tab
 */
function selectTab(tab) {
    // Update the control area
    $(".tab-pane").hide().each(function() {
        if ($(this).data("tab") == tab) {
            console.log("show" + tab);
            $(this).css("display", "inline-block");
            return false;
        }
    });

    // Get the title of the tab from the tab button
    var title = "";
    $(".tab").each(function() {
        if ($(this).data("tab") == tab) {
            title = $(this).html();
        }
    });

    // Highlight the selected tab
    $(".tab").removeClass("tab-selected");
    $(".tab").each(function() {
        if ($(this).data("tab") == tab) {
            $(this).addClass("tab-selected");
        }
    });

    // Update the title
    $(".tab-view .tab-header").html(title);
}

/**
 * Find and select the default tab.
 */
function selectDefaultTab()
{
    $(".tab").each(function() {
        if ($(this).data("tab-default")) {
            // Found default tab.
            selectTab($(this).data("tab"));
            return true;
        }
    });
}

$(document).ready(function() {
    selectDefaultTab();

    // Assign click handler to tab buttons
    $(".tab").click(function() {
        selectTab($(this).data("tab"));
    });
});
