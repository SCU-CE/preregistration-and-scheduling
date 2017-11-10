function login_validation() {
    $('#p_login .ui.form')
        .form({
            fields: {
                email: {
                    identifier  : 'email',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا پست الکترونیکی خود را وارد کنید'
                        },
                        {
                            type   : 'email',
                            prompt : 'لطفا پست الکترونیکی را به شکل درست وارد کنید'
                        }
                    ]
                },
                password: {
                    identifier  : 'password',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا رمز عبور خود را وارد کنید'
                        },
                        {
                            type   : 'length[6]',
                            prompt : 'رمز عبور شما باید حداقل شامل 6 کاراکتر باشد'
                        }
                    ]
                }
            }
        })
    ;
}
function register_validation() {
    $('#p_register .ui.form')
        .form({
            fields: {
                first_name: {
                    identifier  : 'first_name',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نام خود را وارد کنید'
                        }
                    ]
                },
                last_name: {
                    identifier  : 'last_name',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نام خانوادگی خود را وارد کنید'
                        }
                    ]
                },
                student_id: {
                    identifier  : 'student_id',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا شماره دانشجویی خود را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'شماره دانشجویی باید به شکل عددی باشد'
                        },
                        {
                            type   : 'exactLength[7]',
                            prompt : 'شماره دانشجویی باید 7 کاراکتر باشد'
                        }
                    ]
                },
                email: {
                    identifier  : 'email',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا پست الکترونیکی خود را وارد کنید'
                        },
                        {
                            type   : 'email',
                            prompt : 'لطفا پست الکترونیکی را به شکل درست وارد کنید'
                        }
                    ]
                },
                password: {
                    identifier  : 'password',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا رمز عبور خود را وارد کنید'
                        },
                        {
                            type   : 'length[6]',
                            prompt : 'رمز عبور شما باید حداقل شامل 6 کاراکتر باشد'
                        }
                    ]
                },
                password_confirmation: {
                    identifier  : 'password_confirmation',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا تکرار رمز عبور خود را وارد کنید'
                        },
                        {
                            type   : 'match[password]',
                            prompt : 'در وارد کردن تکرار رمز عبور دقت کنید'
                        }
                    ]
                },
                entry_year: {
                    identifier  : 'entry_year',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا سال ورود خود را انتخاب کنید'
                        }
                    ]
                },
            }
        })
    ;
}
function forget_validation() {
    $('#p_forget .ui.form')
        .form({
            fields: {
                email: {
                    identifier: 'email',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'لطفا پست الکترونیکی خود را وارد کنید'
                        },
                        {
                            type: 'email',
                            prompt: 'لطفا پست الکترونیکی را به شکل درست وارد کنید'
                        }
                    ]
                }
            }
        })
    ;
}
function reset_validation() {
    $('#p_reset .ui.form')
        .form({
            fields: {
                email: {
                    identifier  : 'email',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا پست الکترونیکی خود را وارد کنید'
                        },
                        {
                            type   : 'email',
                            prompt : 'لطفا پست الکترونیکی را به شکل درست وارد کنید'
                        }
                    ]
                },
                password: {
                    identifier  : 'password',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا رمز عبور خود را وارد کنید'
                        },
                        {
                            type   : 'length[6]',
                            prompt : 'رمز عبور شما باید حداقل شامل 6 کاراکتر باشد'
                        }
                    ]
                },
                password_confirmation: {
                    identifier  : 'password_confirmation',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا تکرار رمز عبور خود را وارد کنید'
                        },
                        {
                            type   : 'match[password]',
                            prompt : 'در وارد کردن تکرار رمز عبور دقت کنید'
                        }
                    ]
                },
            }
        })
    ;
}

function vertical_align_panel(id) {
    const body_height = window.$('body')[0].offsetHeight;
    const p_panel_height = window.$(id)[0].offsetHeight;
    if(body_height > p_panel_height)
        window.$(id).css('padding-top', (body_height-p_panel_height)/2);
}
function init_message_dismiss_btns() {
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
}

function panelsInit() {
    // initialize footer date
    window.$('#month_year').html(new persianDate().format("MMMM YYYY"));

    if(window.$('#p_login').length != 0){
        // Components initialization
        window.$('#p_login .checkbox').checkbox();

        vertical_align_panel('#p_login');
        login_validation();
    }

    if(window.$('#p_register').length != 0) {
        // Components initialization
        window.$('#p_register .dropdown').dropdown();

        vertical_align_panel('#p_register');
        register_validation();
    }

    if(window.$('#p_forget').length != 0){
        // Components initialization
        init_message_dismiss_btns();

        vertical_align_panel('#p_forget');
        forget_validation();
    }

    if(window.$('#p_reset').length != 0){
        // Components initialization
        init_message_dismiss_btns();

        vertical_align_panel('#p_reset');
        reset_validation();
    }
}
function feedbackInit() {
    window.$('#feedback-btn button').on('click', function () {
        if(window.$('#feedback-btn').hasClass('open') && window.$('#feedback-btn').hasClass('msg')){
            window.$(this).blur();
            window.$('#feedback-panel').animate({right: '-64px'},{duration: 250, easing: 'swing', queue: false});
            window.$('#feedback-type').animate({right: '-57px'},{duration: 250, easing: 'swing', queue: false});
            window.$('#feedback-msg').animate({right: '-240px'},250,'swing',function () {
                window.$('#feedback-btn').removeClass('open msg');
                window.$(document).off('mouseup');
            });

        }else if(window.$('#feedback-btn').hasClass('open')){
            window.$(this).blur();
            window.$('#feedback-panel').animate({right: '-64px'},250,'swing');
            window.$('#feedback-type').animate({right: '-57px'},250,'swing', function () {
                window.$('#feedback-btn').removeClass('open');
                window.$(document).off('mouseup');
            });
        }else{
            window.$(this).blur();
            window.$('#feedback-panel').animate({right: '-9px'},250,'swing');
            window.$('#feedback-type').animate({right: '0px'},250,'swing', function () {
                window.$('#feedback-btn').addClass('open');
                hideFeedbackPanelWhenClickOutside();
            });
        }
    });

    window.$('.fb-bt.bt1').hover(
        function () {
            window.$(this).css('background-color', '#23CE47');
        },
        function () {
            window.$(this).css('background-color', '#21BA45');
        }
    );
    window.$('.fb-bt.bt2').hover(
        function () {
            window.$(this).css('background-color', '#00C9C1');
        },
        function () {
            window.$(this).css('background-color', '#00B5AD');
        }
    );
    window.$('.fb-bt.bt3').hover(
        function () {
            window.$(this).css('background-color', '#EF2A2A');
        },
        function () {
            window.$(this).css('background-color', '#DB2828');
        }
    );

    window.$('.fb-bt').on('click', function () {
        if(!window.$('#feedback-btn').hasClass('msg')) {
            window.$('#feedback-panel').animate({right: '232px'}, 250, 'swing');
            window.$('#feedback-type').animate({right: '240px'}, 250, 'swing');
            window.$('#feedback-msg').animate({right: '0px'}, 250, 'swing', function () {
                window.$('#feedback-btn').addClass('msg');
                hideFeedbackPanelWhenClickOutside();
            });
        }
    });

    window.$('.fb-bt.bt1').on('click', function () {
        window.$('#send-btn').removeClass('green red teal');
        window.$('#send-btn').addClass('green');
        window.$('#msg-type').css('background-color', '#21BA45');
        window.$('#msg-type i').removeClass('smile frown heart');
        window.$('#msg-type i').addClass('smile');
        window.$('#mtype').val('smile');
    });
    window.$('.fb-bt.bt2').on('click', function () {
        window.$('#send-btn').removeClass('green red teal');
        window.$('#send-btn').addClass('teal');
        window.$('#msg-type').css('background-color', '#00B5AD');
        window.$('#msg-type i').removeClass('smile frown heart');
        window.$('#msg-type i').addClass('frown');
        window.$('#mtype').val('frown');
    });
    window.$('.fb-bt.bt3').on('click', function () {
        window.$('#send-btn').removeClass('green red teal');
        window.$('#send-btn').addClass('red');
        window.$('#msg-type').css('background-color', '#DB2828');
        window.$('#msg-type i').removeClass('smile frown heart');
        window.$('#msg-type i').addClass('heart');
        window.$('#mtype').val('heart');
    });

    function hideFeedbackPanelWhenClickOutside() {
        window.$(document).mouseup(function (e)
        {
            const container = window.$('#feedback-panel');

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                window.$('#feedback-btn button').trigger('click');
            }
        });
    }


    window.$("#feedbackForm").submit(function()
    {
        window.$('#feedback_dimmer').dimmer('toggle');
        const formURL = window.$(this).attr("action");
        const postData = window.$(this).serializeArray();
        window.$.ajax(
            {
                url : formURL + '/feedback',
                type : "POST",
                data : postData,
                success:function(data)
                {
                    window.$('#message').val('');
                    window.$('#feedback_dimmer').dimmer('toggle');
                    window.$('#feedback_success').dimmer('toggle');
                    setTimeout(function () {
                        window.$('#feedback-btn button').trigger('click');
                        window.$('#feedback_success').dimmer('toggle');
                    },500)
                },
                error: function(data)
                {

                    window.$('#feedback_dimmer').dimmer('toggle');
                }
            });
        return false;
    });
}

window.$(function () {
    panelsInit();
    feedbackInit();
});