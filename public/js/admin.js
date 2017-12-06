/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ 8:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(9);


/***/ }),

/***/ 9:
/***/ (function(module, exports) {

Chart.defaults.global.maintainAspectRatio = false;
Chart.defaults.global.defaultFontFamily = "'IRANSans', 'Tahoma', 'Arial', sans-serif";

// utility functions
function elementExist(selector) {
    return window.$(selector).length != 0;
}
function autohide_menu(btn_selector, menu_selector) {
    var menu = window.$(menu_selector);
    var container = window.$(btn_selector + ',' + menu_selector);
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
    window.$('#p_admin_courses .ui.form').form({
        fields: {
            course_name: {
                identifier: 'course_name',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا نام درس را وارد کنید'
                }]
            },
            course_code: {
                identifier: 'course_code',
                rules: [{
                    type: 'empty',
                    prompt: 'کد درس را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'کد درس باید به شکل عددی باشد'
                }]
            },
            units: {
                identifier: 'units',
                rules: [{
                    type: 'empty',
                    prompt: 'تعداد واحد های درس را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'تعداد واحد های درس باید به شکل عددی باشد'
                }, {
                    type: 'exactLength[1]',
                    prompt: 'تعداد واحد های درس باید 1 کاراکتر باشد'
                }]
            },
            default_min_capacity_fall: {
                identifier: 'default_min_capacity_fall',
                rules: [{
                    type: 'empty',
                    prompt: 'حداقل ظرفیت پاییز را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'حداقل ظرفیت پاییز باید به شکل عددی باشد'
                }, {
                    type: 'maxLength[2]',
                    prompt: 'حداقل ظرفیت پاییز باید حداکثر 2 کاراکتر باشد'
                }]
            },
            default_min_capacity_spring: {
                identifier: 'default_min_capacity_spring',
                rules: [{
                    type: 'empty',
                    prompt: 'حداقل ظرفیت بهار را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'حداقل ظرفیت بهار باید به شکل عددی باشد'
                }, {
                    type: 'maxLength[2]',
                    prompt: 'حداقل ظرفیت بهار باید حداکثر 2 کاراکتر باشد'
                }]
            },
            category: {
                identifier: 'category',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا دسته بندی درس مورد نظر را انتخاب کنید'
                }]
            }
        }
    });
}
function edit_course_validation() {
    window.$('#edit_course .ui.form').form({
        fields: {
            course_name: {
                identifier: 'course_name',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا نام درس را وارد کنید'
                }]
            },
            course_code: {
                identifier: 'course_code',
                rules: [{
                    type: 'empty',
                    prompt: 'کد درس را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'کد درس باید به شکل عددی باشد'
                }]
            },
            units: {
                identifier: 'units',
                rules: [{
                    type: 'empty',
                    prompt: 'تعداد واحد های درس را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'تعداد واحد های درس باید به شکل عددی باشد'
                }, {
                    type: 'exactLength[1]',
                    prompt: 'تعداد واحد های درس باید 1 کاراکتر باشد'
                }]
            },
            default_min_capacity_fall: {
                identifier: 'default_min_capacity_fall',
                rules: [{
                    type: 'empty',
                    prompt: 'حداقل ظرفیت پاییز را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'حداقل ظرفیت پاییز باید به شکل عددی باشد'
                }, {
                    type: 'maxLength[2]',
                    prompt: 'حداقل ظرفیت پاییز باید حداکثر 2 کاراکتر باشد'
                }]
            },
            default_min_capacity_spring: {
                identifier: 'default_min_capacity_spring',
                rules: [{
                    type: 'empty',
                    prompt: 'حداقل ظرفیت بهار را وارد کنید'
                }, {
                    type: 'integer',
                    prompt: 'حداقل ظرفیت بهار باید به شکل عددی باشد'
                }, {
                    type: 'maxLength[2]',
                    prompt: 'حداقل ظرفیت بهار باید حداکثر 2 کاراکتر باشد'
                }]
            },
            category: {
                identifier: 'category',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا دسته بندی درس مورد نظر را انتخاب کنید'
                }]
            }
        }
    });
}
function add_instructor_validation() {
    window.$('#p_admin_instructors .ui.form').form({
        fields: {
            instructor_name: {
                identifier: 'instructor_name',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا نام استاد را وارد کنید.'
                }]
            },
            sex: {
                identifier: 'sex',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا جنسیت استاد را انتخاب کنید.'
                }]
            },
            profile_link: {
                identifier: 'profile_link',
                rules: []
            },
            photo: {
                identifier: 'photo',
                rules: []
            }
        }
    });
}
function edit_instructor_validation() {
    window.$('#edit_instructor .ui.form').form({
        fields: {
            instructor_name: {
                identifier: 'instructor_name',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا نام استاد را وارد کنید.'
                }]
            },
            sex: {
                identifier: 'sex',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا جنسیت استاد را انتخاب کنید.'
                }]
            },
            profile_link: {
                identifier: 'profile_link',
                rules: []
            },
            photo: {
                identifier: 'photo',
                rules: []
            }
        }
    });
}
function add_semester_validation() {
    window.$('#p_admin_semesters .ui.form').form({
        fields: {
            semester: {
                identifier: 'semester',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا نوبت ترم را انتخاب کنید.'
                }]
            },
            year: {
                identifier: 'year',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا سال ترم را وارد کنید.'
                }, {
                    type: 'number',
                    prompt: 'سال ترم باید به شکل عددی باشد.'
                }, {
                    type: 'exactLength[4]',
                    prompt: 'سال ترم باید 4 رقم داشته باشد.'
                }]
            }
        }
    });
}
function edit_semester_validation() {
    window.$('#edit_semester .ui.form').form({
        fields: {
            semester: {
                identifier: 'semester',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا نوبت ترم را انتخاب کنید.'
                }]
            },
            year: {
                identifier: 'year',
                rules: [{
                    type: 'empty',
                    prompt: 'لطفا سال ترم را وارد کنید.'
                }, {
                    type: 'number',
                    prompt: 'سال ترم باید به شکل عددی باشد.'
                }, {
                    type: 'exactLength[4]',
                    prompt: 'سال ترم باید 4 رقم داشته باشد.'
                }]
            }
        }
    });
}

function init_menu_btns() {
    // cache map btn and steps dom elements
    var sidebar_btn = window.$('.mobile.menu #sidebar_btn');
    var mobile_vmenu = window.$('.mobile.vertical.menu');
    // show/hide steps if map btn clicked
    sidebar_btn.on('click', function () {
        mobile_vmenu.transition('fade down');
    });
    // hide steps if clicked elsewhere
    autohide_menu('.mobile.menu #sidebar_btn', '.mobile.vertical.menu');

    //
    var logout_btns = window.$('.basic.logout.icon.button');
    logout_btns.on('click', function () {
        window.$('#logout_form').submit();
    });
}
function adjust_to_screen_size() {
    var mobile_vmenu = window.$('.mobile.vertical.menu');

    if (screen.width < 768) {} else {
        if (!mobile_vmenu.hasClass('hidden')) {
            mobile_vmenu.removeClass('visible');
            mobile_vmenu.addClass('hidden');
        }
    }
}

function pagesInit() {
    // initialize footer date
    window.$('#month_year').html(new persianDate().format("MMMM YYYY"));
    // setup csrf token for ajax
    window.$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        }
    });
    init_menu_btns();
    // home page logic
    if (elementExist('#p_admin_home')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(0)').addClass('blue');
        window.$('.vertical.menu a i:eq(0)').removeClass('grey').addClass('blue');
    }
    // course page logic
    if (elementExist('#p_admin_courses')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(1)').addClass('green');
        window.$('.vertical.menu a i:eq(1)').removeClass('grey').addClass('green');

        // edit course logic
        var edit_btns = window.$('.grey.segment table tr .orange.button');
        var edit_course_modal = window.$('#edit_course.modal');
        var edit_course_form = edit_course_modal.find('form');
        var edit_course_form_action = edit_course_form.attr('action');
        edit_btns.on('click', function () {
            var course_id = $(this).data('id');
            var course_row = window.$('#course_' + course_id);
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
            edit_course_form.attr('action', edit_course_form_action + '/' + course_id);
            edit_course_modal.modal({
                onApprove: function onApprove() {
                    return window.$('#edit_course .ui.form').form('is valid');
                }
            }).modal('show');
        });
        if (window.$('#edit_course.modal').data('error') === true) {
            edit_course_modal.modal('show');
        }

        // delete course logic
        var delete_btns = window.$('.grey.segment table tr .red.button');
        var delete_course_modal = window.$('#delete_course.modal');
        var delete_preview_row = delete_course_modal.find('table tbody tr');
        var delete_course_form = delete_course_modal.find('form');
        var delete_course_form_action = delete_course_form.attr('action');
        delete_btns.on('click', function () {
            var course_id = $(this).data('id');
            var course_row = window.$('#course_' + course_id);
            delete_preview_row.find('td:nth-child(1)').html(course_row.find('td:nth-child(1)').html());
            delete_preview_row.find('td:nth-child(2)').html(course_row.find('td:nth-child(2)').html());
            delete_preview_row.find('td:nth-child(3)').html(course_row.find('td:nth-child(3)').html());
            delete_course_form.attr('action', delete_course_form_action + '/' + course_id);
            delete_course_modal.modal('show');
        });

        // validations
        add_course_validation();
        edit_course_validation();

        // init dropdowns
        window.$('.ui.dropdown').dropdown();

        // init messages
        if (elementExist('.grey.segment .message')) {
            window.$('.grey.segment .message .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('.grey.segment .message').hasClass('hidden')) window.$('.grey.segment .message').transition('fade');
            }, 4000);
        }
    }
    // instructor page logic
    if (elementExist('#p_admin_instructors')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(2)').addClass('violet');
        window.$('.vertical.menu a i:eq(2)').removeClass('grey').addClass('violet');

        // edit instructor logic
        var _edit_btns = window.$('.grey.segment table tr .orange.button');
        var edit_instructor_modal = window.$('#edit_instructor.modal');
        var edit_instructor_form = edit_instructor_modal.find('form');
        var edit_instructor_form_action = edit_instructor_form.attr('action');
        _edit_btns.on('click', function () {
            var instructor_id = $(this).data('id');
            var instructor_row = window.$('#instructor_' + instructor_id);
            // clear the form
            window.$('#edit_instructor .ui.form').form('reset');
            window.$('#edit_instructor .ui.form .error.message').html('');
            // fill it with prev info
            edit_instructor_form.find('[name=instructor_name]').val(instructor_row.find('td:nth-child(1)').html());
            edit_instructor_form.find('[name=sex]').val(instructor_row.find('td:nth-child(2)').html());
            if (instructor_row.find('td:nth-child(3) a').html() !== '') {
                edit_instructor_form.find('[name=profile_link]').val(instructor_row.find('td:nth-child(3) a').html());
            }
            window.$('.ui.dropdown').dropdown();
            edit_instructor_form.attr('action', edit_instructor_form_action + '/' + instructor_id);
            edit_instructor_modal.modal({
                onApprove: function onApprove() {
                    return window.$('#edit_instructor .ui.form').form('is valid');
                }
            }).modal('show');
        });
        if (window.$('#edit_instructor.modal').data('error') === true) {
            edit_instructor_modal.modal('show');
        }

        // delete instructor logic
        var _delete_btns = window.$('.grey.segment table tr .red.button');
        var delete_instructor_modal = window.$('#delete_instructor.modal');
        var _delete_preview_row = delete_instructor_modal.find('table tbody tr');
        var delete_instructor_form = delete_instructor_modal.find('form');
        var delete_instructor_form_action = delete_instructor_form.attr('action');
        _delete_btns.on('click', function () {
            var instructor_id = $(this).data('id');
            var instructor_row = window.$('#instructor_' + instructor_id);
            _delete_preview_row.find('td:nth-child(1)').html(instructor_row.find('td:nth-child(1)').html());
            _delete_preview_row.find('td:nth-child(2)').html(instructor_row.find('td:nth-child(2)').html());
            _delete_preview_row.find('td:nth-child(3)').html(instructor_row.find('td:nth-child(3)').html());
            _delete_preview_row.find('td:nth-child(4)').html(instructor_row.find('td:nth-child(4)').html());
            delete_instructor_form.attr('action', delete_instructor_form_action + '/' + instructor_id);
            delete_instructor_modal.modal('show');
        });

        // validations
        add_instructor_validation();
        edit_instructor_validation();

        // init dropdowns
        window.$('.ui.dropdown').dropdown();

        // init messages
        if (elementExist('.grey.segment .message')) {
            window.$('.grey.segment .message .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('.grey.segment .message').hasClass('hidden')) window.$('.grey.segment .message').transition('fade');
            }, 4000);
        }
    }
    // semester page logic
    if (elementExist('#p_admin_semesters')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(3)').addClass('brown');
        window.$('.vertical.menu a i:eq(3)').removeClass('grey').addClass('brown');

        // edit semester logic
        var _edit_btns2 = window.$('.grey.segment table tr .orange.button');
        var edit_semester_modal = window.$('#edit_semester.modal');
        var edit_semester_form = edit_semester_modal.find('form');
        var edit_semester_form_action = edit_semester_form.attr('action');
        _edit_btns2.on('click', function () {
            var semester_id = $(this).data('id');
            var semester_row = window.$('#semester_' + semester_id);
            // clear the form
            window.$('#edit_semester .ui.form').form('reset');
            window.$('#edit_semester .ui.form .error.message').html('');
            // fill it with prev info
            edit_semester_form.find('[name=semester]').val(semester_row.find('td:nth-child(1)').html());
            edit_semester_form.find('[name=year]').val(semester_row.find('td:nth-child(2)').html());
            window.$('.ui.dropdown').dropdown();
            edit_semester_form.attr('action', edit_semester_form_action + '/' + semester_id);
            edit_semester_modal.modal({
                onApprove: function onApprove() {
                    return window.$('#edit_semester .ui.form').form('is valid');
                }
            }).modal('show');
        });
        if (window.$('#edit_semester.modal').data('error') === true) {
            edit_semester_modal.modal('show');
        }

        // delete semester logic
        var _delete_btns2 = window.$('.grey.segment table tr .red.button');
        var delete_semester_modal = window.$('#delete_semester.modal');
        var _delete_preview_row2 = delete_semester_modal.find('table tbody tr');
        var delete_semester_form = delete_semester_modal.find('form');
        var delete_semester_form_action = delete_semester_form.attr('action');
        _delete_btns2.on('click', function () {
            var semester_id = $(this).data('id');
            var semester_row = window.$('#semester_' + semester_id);
            _delete_preview_row2.find('td:nth-child(1)').html(semester_row.find('td:nth-child(1)').html());
            _delete_preview_row2.find('td:nth-child(2)').html(semester_row.find('td:nth-child(2)').html());
            delete_semester_form.attr('action', delete_semester_form_action + '/' + semester_id);
            delete_semester_modal.modal('show');
        });
        // validations
        add_semester_validation();
        edit_semester_validation();

        // init dropdowns
        window.$('.ui.dropdown').dropdown();

        // init messages
        if (elementExist('.grey.segment .message')) {
            window.$('.grey.segment .message .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('.grey.segment .message').hasClass('hidden')) window.$('.grey.segment .message').transition('fade');
            }, 4000);
        }
    }
    if (elementExist('#p_admin_semester_courses')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(3)').addClass('brown');
        window.$('.vertical.menu a i:eq(3)').removeClass('grey').addClass('brown');
        // on check and unckeck events
        window.$('.ui.checkbox').checkbox({
            onChecked: function onChecked() {
                $(this).parents('tr').find('.ui.input').removeClass('disabled');
            },
            onUnchecked: function onUnchecked() {
                $(this).parents('tr').find('.ui.input').addClass('disabled');
            }
        });
        // select and deselect all buttons
        window.$('#select_all').on('click', function () {
            window.$('.ui.checkbox').checkbox('check');
        });
        window.$('#deselect_all').on('click', function () {
            window.$('.ui.checkbox').checkbox('uncheck');
        });
        // submit changes button
        window.$('#submit_changes').on('click', function () {
            // TODO validation logic
            var rows = window.$('tbody tr');
            var course_data = [];
            for (var i = 0; i < rows.length; i++) {
                var course_id = rows[i].id;
                course_data.push({
                    id: course_id,
                    checked: window.$('#' + course_id + ' .ui.checkbox').checkbox('is checked'),
                    min_capacity: window.$('#' + course_id + ' .ui.input input').val()
                });
            }
            window.$.ajax({
                url: document.location.href + '/updatecourses',
                type: "POST",
                data: JSON.stringify(course_data),
                contentType: "application/json",
                success: function success(result, status, xhr) {
                    // TODO show success before redirect
                    window.location = window.$('.ui.breadcrumb a').attr('href');
                },
                error: function error(xhr, status, _error) {
                    // TODO error handling logic
                }
            });
        });
    }
    // student page logic
    if (elementExist('#p_admin_students')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(4)').addClass('teal');
        window.$('.vertical.menu a i:eq(4)').removeClass('grey').addClass('teal');
        // delete student logic
        var _delete_btns3 = window.$('.grey.segment table tr .red.button');
        var delete_student_modal = window.$('#delete_student.modal');
        var _delete_preview_row3 = delete_student_modal.find('table tbody tr');
        var delete_student_form = delete_student_modal.find('form');
        var delete_student_form_action = delete_student_form.attr('action');
        _delete_btns3.on('click', function () {
            var student_id = $(this).data('id');
            var student_row = window.$('#student_' + student_id);
            _delete_preview_row3.find('td:nth-child(1)').html(student_row.find('td:nth-child(1)').html());
            _delete_preview_row3.find('td:nth-child(2)').html(student_row.find('td:nth-child(2)').html());
            _delete_preview_row3.find('td:nth-child(3)').html(student_row.find('td:nth-child(3)').html());
            _delete_preview_row3.find('td:nth-child(4)').html(student_row.find('td:nth-child(4)').html());
            _delete_preview_row3.find('td:nth-child(5)').html(student_row.find('td:nth-child(5)').html());
            delete_student_form.attr('action', delete_student_form_action + '/' + student_id);
            delete_student_modal.modal('show');
        });
        // init messages
        if (elementExist('.grey.segment .message')) {
            window.$('.grey.segment .message .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('.grey.segment .message').hasClass('hidden')) window.$('.grey.segment .message').transition('fade');
            }, 4000);
        }
    }
    if (elementExist('#p_admin_student_courses')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(4)').addClass('teal');
        window.$('.vertical.menu a i:eq(4)').removeClass('grey').addClass('teal');

        window.$('.menu .item').tab();
    }
    // report page logic
    if (elementExist('#p_admin_reports')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(5)').addClass('red');
        window.$('.vertical.menu a i:eq(5)').removeClass('grey').addClass('red');
    }
    // scheduling page logic
    if (elementExist('#p_admin_scheduling')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(6)').addClass('orange');
        window.$('.vertical.menu a i:eq(6)').removeClass('grey').addClass('orange');
    }
    // message page logic
    if (elementExist('#p_admin_messages')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(7)').addClass('olive');
        window.$('.vertical.menu a i:eq(7)').removeClass('grey').addClass('olive');
    }
    // setting page logic
    if (elementExist('#p_admin_settings')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(8)').addClass('black');
        window.$('.vertical.menu a i:eq(8)').removeClass('grey').addClass('black');
    }
}

window.$(function () {
    pagesInit();
    window.$(window).resize(function () {
        adjust_to_screen_size();
    });
});

/***/ })

/******/ });