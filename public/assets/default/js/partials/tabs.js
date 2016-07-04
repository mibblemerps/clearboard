/*
Provides tabbed panel functionality.
 */

window.TabbedPanel = {

    /**
     * Select a tab in a tab group.
     *
     * @param tabGroup Tab group class name.
     * @param tab Tab name to change to
     */
    selectTab: function (tabGroup, tab) {
        var tabClass = "." + tabGroup;

        // Show only the selected tab.
        $(tabClass).find(".tabbedpanel-panel").each(function () {
            if ($(this).attr("data-tab") == tab) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Highlight selected tab button.
        $(tabClass).find(".tabbedpanel-tabs").children().each(function () {
            if ($(this).attr("data-tab") == tab) {
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });
    },

    /**
     * Initialize a tab group by assigning click handlers to tab buttons and selecting the default tab.
     *
     * @param tabGroup
     */
    initTabbedPanel: function (tabGroup) {
        var tabClass = "." + tabGroup;

        $(tabClass).find(".tabbedpanel-tabs").children().click(function () {
            var tab = $(this).attr("data-tab");
            if (tab !== undefined) {
                TabbedPanel.selectTab(tabGroup, tab);
            }
        });

        var activeTab = $(tabClass).find(".tabbedpanel-tabs").find(".active").attr("data-tab");
        TabbedPanel.selectTab(tabGroup, activeTab);
    }

};
