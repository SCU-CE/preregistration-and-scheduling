import * as commons from './commons';

function elementExist(selector) {
    return window.$(selector).length != 0;
}

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

function vertical_align_panel(selector) {
    const body = window.$('body');
    const p_panel = window.$(selector)
    if(body[0].offsetHeight > p_panel[0].offsetHeight) {
        window.$(selector).css('padding-top', (body[0].offsetHeight - p_panel[0].offsetHeight) / 2);
    }else{
        window.$(selector).css('padding-top', 16);
    }

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

    if(elementExist('#p_login')){
        // Components initialization
        window.$('#p_login .checkbox').checkbox();

        login_validation();
    }

    if(elementExist('#p_register')) {
        // Components initialization
        window.$('#p_register .dropdown').dropdown();

        register_validation();
    }

    if(elementExist('#p_forget')){
        // Components initialization
        init_message_dismiss_btns();

        forget_validation();
    }

    if(elementExist('#p_reset')){
        // Components initialization
        init_message_dismiss_btns();

        reset_validation();
    }
}
function panelsVAlign() {
    if(elementExist('#p_login'))
        vertical_align_panel('#p_login');

    if(elementExist('#p_register'))
        vertical_align_panel('#p_register');

    if(elementExist('#p_forget'))
        vertical_align_panel('#p_forget');

    if(elementExist('#p_reset'))
        vertical_align_panel('#p_reset');
}

window.$(function () {
    commons.feedbackInit();
    panelsInit();
    panelsVAlign();
    window.$(window).resize(function(){
        panelsVAlign();
    });
});