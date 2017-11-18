import * as commons from './commons';

function autohide_menu (btn_selector,menu_selector){
    const menu = window.$(menu_selector);
    const container = window.$(btn_selector + ',' + menu_selector);
    window.$(document).on('mouseup', function (e) {
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
    const map_btn = window.$('.mobile.menu #steps_btn');
    const mobile_steps = window.$('.mobile.steps');
    // show/hide steps if map btn clicked
    map_btn.on('click', function () {
        mobile_steps.transition('fade down');
    });
    // hide steps if clicked elsewhere
    autohide_menu('.mobile.menu #steps_btn','.mobile.steps');

    // cache computer and mobile user btns and menus
    const computer_user_btn = window.$('.computer.menu #user_btn');
    const mobile_user_btn = window.$('.mobile.menu #user_btn');
    const computer_vmenu = window.$('.computer.vertical.menu');
    const mobile_vmenu = window.$('.mobile.vertical.menu');
    // show/hide menu if user btn clicked
    computer_user_btn.on('click', function () {
        computer_vmenu.transition('fade down');
    });
    mobile_user_btn.on('click', function () {
        mobile_vmenu.transition('fade down');
    });
    // hide menu if clicked elsewhere
    autohide_menu('.computer.menu #user_btn','.computer.vertical.menu');
    autohide_menu('.mobile.menu #user_btn','.mobile.vertical.menu');
}
function init_vmenu_position() {
    const mobile_steps = window.$('.mobile.steps');

    const computer_user_btn = window.$('.computer.menu #user_btn');
    const mobile_user_btn = window.$('.mobile.menu #user_btn');
    const computer_vmenu = window.$('.computer.vertical.menu');
    const mobile_vmenu = window.$('.mobile.vertical.menu');

    const mobile_vmenu_left = mobile_user_btn[0].offsetLeft - (Math.abs(mobile_user_btn[0].offsetWidth - mobile_vmenu[0].offsetWidth));
    const mobile_vmenu_top = (mobile_user_btn[0].offsetTop * 2) + mobile_user_btn[0].offsetHeight;

    mobile_vmenu.css('left', mobile_vmenu_left);
    mobile_vmenu.css('top', mobile_vmenu_top);

    const computer_vmenu_left = computer_user_btn[0].offsetLeft - (Math.abs(computer_user_btn[0].offsetWidth - computer_vmenu[0].offsetWidth));
    const computer_vmenu_top = (computer_user_btn[0].offsetTop * 2) + computer_user_btn[0].offsetHeight;

    computer_vmenu.css('left', computer_vmenu_left);
    computer_vmenu.css('top', computer_vmenu_top);

    if(screen.width > 767){
        if(!mobile_vmenu.hasClass('hidden')){
            mobile_vmenu.removeClass('visible');
            mobile_vmenu.addClass('hidden');
        }
        if(!mobile_steps.hasClass('hidden')){
            mobile_steps.removeClass('visible');
            mobile_steps.addClass('hidden');
        }
    }else {
        if(!computer_vmenu.hasClass('hidden')){
            computer_vmenu.removeClass('visible');
            computer_vmenu.addClass('hidden');
        }
    }
}
function adjust_to_screen_size() {
    if(screen.width < 768) {
        window.$('.ui.container .segment .fluid.steps').removeClass('large').addClass('tiny');
        window.$('.ui.container .segment .blue.button').removeClass('huge');
        window.$('#feedback-panel').hide();
    }else{
        window.$('.ui.container .segment .fluid.steps').removeClass('tiny').addClass('large');
        window.$('.ui.container .segment .blue.button').addClass('huge');
        window.$('#feedback-panel').show();
    }
}

window.$(function () {
    // initialize footer date
    window.$('#month_year').html(new persianDate().format("MMMM YYYY"));

    commons.feedbackInit();
    init_menu_btns();

    init_vmenu_position();
    adjust_to_screen_size();

    window.$(window).resize(function(){
        init_vmenu_position();
        adjust_to_screen_size();
    });
});