Chart.defaults.global.maintainAspectRatio = false;
Chart.defaults.global.defaultFontFamily = "'IRANSans', 'Tahoma', 'Arial', sans-serif";

function autohide_menu (btn_selector,menu_selector){
    const menu = window.$(menu_selector);
    const container = window.$(btn_selector + ',' + menu_selector);
    window.$(document).mouseup(function (e) {
        if (!menu.hasClass('hidden') // if menu is not hidden
            && !container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            menu.transition('fade down');
        }
    });
}
function init_menu_btns () {
    // cache map btn and steps dom elements
    const sidebar_btn = window.$('.mobile.menu #sidebar_btn');
    const mobile_vmenu = window.$('.mobile.vertical.menu');
    // show/hide steps if map btn clicked
    sidebar_btn.on('click', function () {
        mobile_vmenu.transition('fade down');
    });
    // hide steps if clicked elsewhere
    autohide_menu('.mobile.menu #sidebar_btn', '.mobile.vertical.menu');
}

window.$(function () {
    // initialize footer date
    window.$('#month_year').html(new persianDate().format("MMMM YYYY"));

    init_menu_btns();
});