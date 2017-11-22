Chart.defaults.global.maintainAspectRatio = false;
Chart.defaults.global.defaultFontFamily = "'IRANSans', 'Tahoma', 'Arial', sans-serif";

// utility functions
function elementExist(selector) {
    return window.$(selector).length != 0;
}
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

// validations
function add_course_validation() {
    window.$('#p_admin_courses .ui.form')
        .form({
            fields: {
                course_name: {
                    identifier  : 'course_name',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نام درس را وارد کنید'
                        }
                    ]
                },
                course_code: {
                    identifier  : 'course_code',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'کد درس را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'کد درس باید به شکل عددی باشد'
                        }
                    ]
                },
                units: {
                    identifier  : 'units',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'تعداد واحد های درس را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'تعداد واحد های درس باید به شکل عددی باشد'
                        },
                        {
                            type   : 'exactLength[1]',
                            prompt : 'تعداد واحد های درس باید 1 کاراکتر باشد'
                        }
                    ]
                },
                default_min_capacity_fall: {
                    identifier  : 'default_min_capacity_fall',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'حداقل ظرفیت پاییز را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'حداقل ظرفیت پاییز باید به شکل عددی باشد'
                        },
                        {
                            type   : 'maxLength[2]',
                            prompt : 'حداقل ظرفیت پاییز باید حداکثر 2 کاراکتر باشد'
                        }
                    ]
                },
                default_min_capacity_spring: {
                    identifier  : 'default_min_capacity_spring',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'حداقل ظرفیت بهار را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'حداقل ظرفیت بهار باید به شکل عددی باشد'
                        },
                        {
                            type   : 'maxLength[2]',
                            prompt : 'حداقل ظرفیت بهار باید حداکثر 2 کاراکتر باشد'
                        }
                    ]
                },
                category: {
                    identifier  : 'category',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا دسته بندی درس مورد نظر را انتخاب کنید'
                        }
                    ]
                },
            }
        })
    ;
}
function edit_course_validation() {
    window.$('#edit_course .ui.form')
        .form({
            fields: {
                course_name: {
                    identifier  : 'course_name',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نام درس را وارد کنید'
                        }
                    ]
                },
                course_code: {
                    identifier  : 'course_code',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'کد درس را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'کد درس باید به شکل عددی باشد'
                        }
                    ]
                },
                units: {
                    identifier  : 'units',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'تعداد واحد های درس را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'تعداد واحد های درس باید به شکل عددی باشد'
                        },
                        {
                            type   : 'exactLength[1]',
                            prompt : 'تعداد واحد های درس باید 1 کاراکتر باشد'
                        }
                    ]
                },
                default_min_capacity_fall: {
                    identifier  : 'default_min_capacity_fall',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'حداقل ظرفیت پاییز را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'حداقل ظرفیت پاییز باید به شکل عددی باشد'
                        },
                        {
                            type   : 'maxLength[2]',
                            prompt : 'حداقل ظرفیت پاییز باید حداکثر 2 کاراکتر باشد'
                        }
                    ]
                },
                default_min_capacity_spring: {
                    identifier  : 'default_min_capacity_spring',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'حداقل ظرفیت بهار را وارد کنید'
                        },
                        {
                            type   : 'integer',
                            prompt : 'حداقل ظرفیت بهار باید به شکل عددی باشد'
                        },
                        {
                            type   : 'maxLength[2]',
                            prompt : 'حداقل ظرفیت بهار باید حداکثر 2 کاراکتر باشد'
                        }
                    ]
                },
                category: {
                    identifier  : 'category',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا دسته بندی درس مورد نظر را انتخاب کنید'
                        }
                    ]
                },
            }
        })
    ;
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
function adjust_to_screen_size() {
    const mobile_vmenu = window.$('.mobile.vertical.menu');

    if(screen.width < 768) {

    }else{
        if(!mobile_vmenu.hasClass('hidden')){
            mobile_vmenu.removeClass('visible');
            mobile_vmenu.addClass('hidden');
        }
    }
}
function pagesInit() {
    // initialize footer date
    window.$('#month_year').html(new persianDate().format("MMMM YYYY"));

    init_menu_btns();

    // course page logic
    if(elementExist('#p_admin_courses')){

        // edit course logic
        const edit_btns = window.$('.grey.segment table tr .orange.button');
        const edit_course_modal = window.$('#edit_course.modal');
        const edit_course_form = edit_course_modal.find('form');
        const edit_course_form_action = edit_course_form.attr('action');
        edit_btns.on('click', function () {
            const course_id = $(this).data('id');
            const course_row = window.$('#course_'+course_id);
            // clear the form
            window.$('#edit_course .ui.form').form('reset');
            window.$('#edit_course .ui.form .error.message').html('');
            // fill it with prev info
            edit_course_form.find('[name=course_name]').val(course_row.find('td:nth-child(1)').html());
            edit_course_form.find('[name=course_code]').val(course_row.find('td:nth-child(2)').html());
            edit_course_form.find('[name=units]').val(course_row.find('td:nth-child(3)').html());
            edit_course_form.find('[name=default_min_capacity_fall]').val(course_row.find('td:nth-child(4)').html());
            edit_course_form.find('[name=default_min_capacity_spring]').val(course_row.find('td:nth-child(5)').html());
            edit_course_form.find('[name=category]').val(course_row.find('td:nth-child(6)').html());
            window.$('.ui.dropdown').dropdown();
            edit_course_form.attr('action', edit_course_form_action+'/'+course_id);
            edit_course_modal.modal({
                onApprove : function () {
                    return window.$('#edit_course .ui.form').form('is valid');
                }
            }).modal('show');
        });
        if(window.$('#edit_course.modal').data('error') === true){
            edit_course_modal.modal('show');
        }

        // delete course logic
        const delete_btns = window.$('.grey.segment table tr .red.button');
        const delete_course_modal = window.$('#delete_course.modal');
        const delete_preview_row = delete_course_modal.find('table tbody tr');
        const delete_course_form = delete_course_modal.find('form');
        const delete_course_form_action = delete_course_form.attr('action');
        delete_btns.on('click', function () {
            const course_id = $(this).data('id');
            const course_row = window.$('#course_'+course_id);
            delete_preview_row.find('td:nth-child(1)').html(course_row.find('td:nth-child(1)').html());
            delete_preview_row.find('td:nth-child(2)').html(course_row.find('td:nth-child(2)').html());
            delete_preview_row.find('td:nth-child(3)').html(course_row.find('td:nth-child(3)').html());
            delete_course_form.attr('action', delete_course_form_action+'/'+course_id);
            delete_course_modal.modal('show');
        });

        // validations
        add_course_validation();
        edit_course_validation();

        // init dropdowns
        window.$('.ui.dropdown').dropdown();

        // init messages
        if(elementExist('.grey.segment .message')){
            window.$('.grey.segment .message .close').on('click', function() {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if(!window.$('.grey.segment .message').hasClass('hidden'))
                    window.$('.grey.segment .message').transition('fade');
            },4000);
        }
    }
}

window.$(function () {

    pagesInit();

    window.$(window).resize(function(){
        adjust_to_screen_size();
    });
});