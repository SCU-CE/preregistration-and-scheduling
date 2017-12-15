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
function set_class(all_classes, selected_class, selector) {
    for (var i = 0; i < all_classes.length; i++) {
        selector.removeClass(all_classes[i]);
    }
    selector.addClass(selected_class);
}
function fix_persian_numbers(selector) {
    var element = window.$(selector);
    element.each(function (index, item) {
        $(item).html(persianJs($(item).html()).englishNumber().toString());
    });
}
function findIndexByKeyValue(arraytosearch, key, valuetosearch) {
    for (var i = 0; i < arraytosearch.length; i++) {
        if (arraytosearch[i][key] == valuetosearch) {
            return i;
        }
    }
    return null;
}
String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};
var hexDigits = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");
function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}
//Function to convert rgb color to hex format
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
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
function adjust_cards_number() {
    var course_cards = window.$('.ui.course.cards');
    var class_values = ['one', 'two', 'three', 'four'];
    if (window.innerWidth > 1199) {
        set_class(class_values, 'four', course_cards);
    } else if (window.innerWidth > 991) {
        set_class(class_values, 'three', course_cards);
    } else if (window.innerWidth > 559) {
        set_class(class_values, 'two', course_cards);
    } else {
        set_class(class_values, 'one', course_cards);
    }
}
function adjust_to_screen_size() {
    if (elementExist('#p_admin_scheduling')) {
        adjust_cards_number();
    }

    var mobile_vmenu = window.$('.mobile.vertical.menu');

    if (screen.width < 768) {} else {
        if (!mobile_vmenu.hasClass('hidden')) {
            mobile_vmenu.removeClass('visible');
            mobile_vmenu.addClass('hidden');
        }
    }
}

function calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log) {
    // for calculating position of parallel lectures in schedule
    // TODO this algorithm needs improvement and doesn't work in some cases (ex. lecture continues between two other lectures)
    var lecture_num = 1;
    for (var i = 0; i < lectures_log[weekday].length; i++) {
        if (st_minutes >= lectures_log[weekday][i].st && st_minutes <= lectures_log[weekday][i].et || et_minutes >= lectures_log[weekday][i].st && et_minutes <= lectures_log[weekday][i].et) {
            lecture_num++;
        }
    }
    return lecture_num;
}
function add_to_schedule(selector, lecture_info, weekday, start_time, end_time, color, pos_info, lectures_log) {
    var $title = window.$('<div>', { 'class': 'title' });
    $title.html(lecture_info.course_name);
    var data_tooltip = '';
    if (lecture_info.group_number !== '') data_tooltip += '\u06AF\u0631\u0648\u0647: ' + lecture_info.group_number;
    if (lecture_info.instructor_name !== '') data_tooltip += ' | \u0627\u0633\u062A\u0627\u062F \u062F\u0631\u0633: ' + lecture_info.instructor_name;
    if (lecture_info.classroom !== '') data_tooltip += ' | \u06A9\u0644\u0627\u0633: ' + lecture_info.classroom;
    if (lecture_info.exam_date !== '') data_tooltip += ' | \u062A\u0627\u0631\u06CC\u062E \u0627\u0645\u062A\u062D\u0627\u0646: ' + lecture_info.exam_date;
    if (lecture_info.exam_time !== '') data_tooltip += ' | \u0633\u0627\u0639\u062A \u0627\u0645\u062A\u062D\u0627\u0646: ' + lecture_info.exam_time;

    var $lecture = window.$('<div>', {
        'class': 'course lecture',
        'data-schedule-id': lecture_info.schedule_id,
        'data-course-id': lecture_info.course_id,
        'data-weekday': weekday,
        'data-tooltip': data_tooltip,
        'data-position': 'bottom center'
    });
    $lecture.html($title);

    $lecture.css('background-color', color);

    var st = start_time.split(':');
    var et = end_time.split(':');
    var minutes = (parseInt(et[0]) - parseInt(st[0])) * 60 + (parseInt(et[1]) - parseInt(st[1]));
    $lecture.css('width', pos_info.tblock_h * (minutes / 15));

    selector.append($lecture);

    var st_minutes = parseInt(st[0]) * 60 + parseInt(st[1]) + 1;
    var et_minutes = parseInt(et[0]) * 60 + parseInt(et[1]);

    var lecture_num = 1;
    switch (weekday) {
        case 'saturday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num * $lecture[0].offsetHeight + pos_info.timecol_w);
            break;
        case 'sunday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num * $lecture[0].offsetHeight + pos_info.timecol_w + pos_info.weekday_w);
            break;
        case 'monday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num * $lecture[0].offsetHeight + pos_info.timecol_w + 2 * pos_info.weekday_w);
            break;
        case 'tuesday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num * $lecture[0].offsetHeight + pos_info.timecol_w + 3 * pos_info.weekday_w);
            break;
        case 'wednesday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num * $lecture[0].offsetHeight + pos_info.timecol_w + 4 * pos_info.weekday_w);
            break;
    }

    lectures_log[weekday].push({
        id: lecture_info.course_id,
        st: st_minutes,
        et: et_minutes
    });

    var st_offset = ((parseInt(st[0]) - 8) * 60 + parseInt(st[1])) / 15 * pos_info.tblock_h;
    $lecture.css('top', pos_info.top_offset + pos_info.header_h + pos_info.tblock_h + st_offset);
}
function lecture_blocks_click(selector, course_group_tab_btns, course_groups_tab, approve_btn, remove_schedule_btn, add_schedule_modal, return_btn) {
    selector.on('click', function () {
        course_id = $(this).attr('data-course-id');
        window.$.ajax({
            url: document.location.origin + '/admin/scheduling/' + course_id + '/information',
            type: "GET",
            success: function success(result, status, xhr) {
                //
                course_group_tab_btns.find('a.new').remove();
                var tab_btn = course_group_tab_btns.find('a:first-child');
                tab_btn.removeClass('active').addClass('active');
                course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').addClass('disabled');
                course_groups_tab.find('.bottom.attached.tab.segment.new').remove();
                var tab_content = course_groups_tab.find('.bottom.attached.tab.segment');
                tab_content.removeClass('active').addClass('active');

                var schedule_info = result.schedule_info;
                for (var i = 0; i < schedule_info.length; i++) {
                    if (i == 0) {
                        tab_content.find('form').form('clear');
                        tab_content.find('form input[name=course_id]').val(schedule_info[i].course_id);
                        tab_content.find('form input[name=group_number]').val(schedule_info[i].group_number);
                        tab_content.find('form select[name=instructor_id]').val(schedule_info[i].instructor_id);
                        tab_content.find('form input[name=course_color]').val(schedule_info[i].course_color);
                        tab_content.find('form select[name=weekday_1]').val(schedule_info[i].weekday_1);
                        tab_content.find('form input[name=classroom_1]').val(schedule_info[i].classroom_1);
                        tab_content.find('form input[name=start_time_1]').val(schedule_info[i].start_time_1);
                        tab_content.find('form input[name=end_time_1]').val(schedule_info[i].end_time_1);
                        tab_content.find('form select[name=weekday_2]').val(schedule_info[i].weekday_2);
                        tab_content.find('form input[name=classroom_2]').val(schedule_info[i].classroom_2);
                        tab_content.find('form input[name=start_time_2]').val(schedule_info[i].start_time_2);
                        tab_content.find('form input[name=end_time_2]').val(schedule_info[i].end_time_2);
                        tab_content.find('form input[name=exam_time]').val(schedule_info[i].exam_time);
                        var course_color_preview = tab_content.find('.block.preview');
                        course_color_preview.html(schedule_info[i].course_name);
                        course_color_preview.css('background-color', schedule_info[i].course_color);
                        course_color_preview.on('click', function () {
                            random_color = randomColor();
                            $(this).css('background-color', random_color);
                            $(this).siblings('input').val(random_color);
                        });
                        var dp = tab_content.find('form input[name=exam_date]').persianDatepicker({
                            initialValue: false,
                            observer: true,
                            autoClose: true,
                            format: 'YYYY/MM/DD',
                            altField: '#add_schedule.modal .scrolling.content form:eq(' + (parseInt(schedule_info[i].group_number) - 1).toString() + ') input[name=exam_date_unix]',
                            'toolbox': {
                                'enabled': false
                            }
                        });
                        if (schedule_info[i].exam_date_unix !== null) dp.setDate(parseInt(schedule_info[i].exam_date_unix));
                    } else {
                        var new_tab_btn = tab_btn.clone().removeClass('active').addClass('new');
                        new_tab_btn.attr('data-tab', (i + 1).toString());
                        new_tab_btn.html('گروه ' + (i + 1).toString());
                        course_group_tab_btns.append(new_tab_btn);
                        course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').removeClass('disabled');

                        var new_tab_content = tab_content.clone().removeClass('active').addClass('new');
                        new_tab_content.attr('data-tab', (i + 1).toString());
                        new_tab_content.find('form').form('clear');
                        new_tab_content.find('form input[name=course_id]').val(schedule_info[i].course_id);
                        new_tab_content.find('form input[name=group_number]').val(schedule_info[i].group_number);
                        new_tab_content.find('form select[name=instructor_id]').val(schedule_info[i].instructor_id);
                        new_tab_content.find('form input[name=course_color]').val(schedule_info[i].course_color);
                        new_tab_content.find('form select[name=weekday_1]').val(schedule_info[i].weekday_1);
                        new_tab_content.find('form input[name=classroom_1]').val(schedule_info[i].classroom_1);
                        new_tab_content.find('form input[name=start_time_1]').val(schedule_info[i].start_time_1);
                        new_tab_content.find('form input[name=end_time_1]').val(schedule_info[i].end_time_1);
                        new_tab_content.find('form select[name=weekday_2]').val(schedule_info[i].weekday_2);
                        new_tab_content.find('form input[name=classroom_2]').val(schedule_info[i].classroom_2);
                        new_tab_content.find('form input[name=start_time_2]').val(schedule_info[i].start_time_2);
                        new_tab_content.find('form input[name=end_time_2]').val(schedule_info[i].end_time_2);
                        new_tab_content.find('form input[name=exam_time]').val(schedule_info[i].exam_time);
                        var _course_color_preview = new_tab_content.find('.block.preview');
                        _course_color_preview.html(schedule_info[i].course_name);
                        _course_color_preview.css('background-color', schedule_info[i].course_color);
                        _course_color_preview.on('click', function () {
                            random_color = randomColor();
                            $(this).css('background-color', random_color);
                            $(this).siblings('input').val(random_color);
                        });
                        var _dp = new_tab_content.find('form input[name=exam_date]').persianDatepicker({
                            initialValue: false,
                            observer: true,
                            autoClose: true,
                            format: 'YYYY/MM/DD',
                            altField: '#add_schedule.modal .scrolling.content form:eq(' + (parseInt(schedule_info[i].group_number) - 1).toString() + ') input[name=exam_date_unix]',
                            'toolbox': {
                                'enabled': false
                            }
                        });
                        if (schedule_info[i].exam_date_unix !== null) _dp.setDate(parseInt(schedule_info[i].exam_date_unix));
                        course_groups_tab.append(new_tab_content);
                    }
                }
                window.$('#add_schedule.modal .scrolling.content .menu .item').tab();
                window.$('#add_schedule.modal .scrolling.content .ui.dropdown').dropdown();
                window.$('#add_schedule.modal .scrolling.content input.timepicker').timepicker({
                    timeFormat: 'HH:mm:ss',
                    interval: 15,
                    minTime: '08:00',
                    maxTime: '20:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });
                fix_persian_numbers('#add_schedule.modal .scrolling.content .menu .item');
                //
                var instructors_info = result.instructors_info;
                var instructors_info_rows = '';
                for (var _i = 0; _i < instructors_info.length; _i++) {
                    if (instructors_info[_i].photo === null) {
                        if (instructors_info[_i].sex === 'مرد') {
                            instructors_info[_i].photo = 'instructor_photos/img_male.png';
                        } else {
                            instructors_info[_i].photo = 'instructor_photos/img_female.png';
                        }
                    }
                    instructors_info_rows += '\n                            <div class="row">\n                                <div class="photo" data-tooltip="' + instructors_info[_i].name + '" data-position="right center">\n                                    <img class="ui mini circular image" src="/storage/' + instructors_info[_i].photo + '">\n                                </div>\n                                <div class="progress">\n                                    <div class="ui indicating progress" data-value="' + instructors_info[_i].votes + '" data-total="' + instructors_info[0].votes + '">\n                                        <div class="bar"></div>\n                                    </div>\n                                </div>\n                                <div class="votes">\n                                    ' + instructors_info[_i].votes + '\n                                </div>\n                            </div>\n                        ';
                }
                if (instructors_info_rows !== '') {
                    window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html(instructors_info_rows);
                    window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors .progress').progress();
                } else {
                    window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html('برای این درس استادی پیشنهاد نشده است.');
                }
                //
                var course_conflicts = result.course_conflicts;
                var course_conflicts_tbody = '';
                for (var _i2 = 0; _i2 < course_conflicts.length; _i2++) {
                    course_conflicts_tbody += '<tr><td>' + (_i2 + 1) + '</td><td>' + course_conflicts[_i2].code + '</td><td>' + course_conflicts[_i2].name + '</td><td>' + course_conflicts[_i2].count + '</td></tr>';
                }
                if (course_conflicts_tbody !== '') {
                    window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html(course_conflicts_tbody);
                } else {
                    window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html('<tr><td colspan="4">برای این درس تداخلی وجود ندارد.</td></tr>');
                }
                //
                var course_students = result.course_students;
                var course_students_tbody = '';
                for (var _i3 = 0; _i3 < course_students.length; _i3++) {
                    course_students_tbody += '<tr><td>' + (_i3 + 1) + '</td><td>' + course_students[_i3].first_name + '</td><td>' + course_students[_i3].last_name + '</td><td>' + course_students[_i3].student_id + '</td><td>' + course_students[_i3].entry_year + '</td></tr>';
                }
                if (course_students_tbody !== '') {
                    window.$('#add_schedule.modal .scrolling.content table.students tbody').html(course_students_tbody);
                } else {
                    window.$('#add_schedule.modal .scrolling.content table.students tbody').html('<tr><td colspan="5">دانشجویی این درس را اخذ نکرده است.</td></tr>');
                }
                //
                approve_btn.find('span').html('ویرایش برنامه');
                approve_btn.find('i').removeClass('checkmark').addClass('write');
                remove_schedule_btn.show();
                return_btn.hide();
                //
                add_schedule_modal.modal('show');
            },
            error: function error(xhr, status, _error) {
                // TODO error handling logic
            }
        });
    });
}
function draw_schedule(lectures_container, course_group_tab_btns, course_groups_tab, approve_btn, remove_schedule_btn, add_schedule_modal, return_btn, position_info) {
    var lectures_log = {
        saturday: [],
        sunday: [],
        monday: [],
        tuesday: [],
        wednesday: []
    };
    lectures_container.html('');
    for (var i = 0; i < schedule_data.length; i++) {
        add_to_schedule(lectures_container, schedule_data[i].lecture_info, schedule_data[i].weekday, schedule_data[i].start_time, schedule_data[i].end_time, schedule_data[i].course_color, position_info, lectures_log);
    }
    lectures_container.find('.course.lecture').each(function (index, item) {
        lecture_blocks_click($(item), course_group_tab_btns, course_groups_tab, approve_btn, remove_schedule_btn, add_schedule_modal, return_btn);
    });
}
function init_message_cards(messages_list, formURL) {
    var $msg_cards = messages_list.find('.msg.card');
    $msg_cards.find('.star-bt').hover(function () {
        $(this).toggleClass('yellow');
    }, function () {
        $(this).toggleClass('yellow');
    });
    $msg_cards.find('.archive-bt').hover(function () {
        $(this).toggleClass('brown');
    }, function () {
        $(this).toggleClass('brown');
    });
    $msg_cards.find('.later-bt').hover(function () {
        $(this).toggleClass('orange');
    }, function () {
        $(this).toggleClass('orange');
    });
    $msg_cards.find('.trash-bt').hover(function () {
        $(this).toggleClass('black');
    }, function () {
        $(this).toggleClass('black');
    });
    $msg_cards.find('.left.floated .icon').on('click', function () {
        var message_id = $(this).attr('data-id');
        var message_state = $(this).attr('data-state');
        var message_color = $(this).attr('data-color');
        var nextState = void 0;
        if ($(this).hasClass(message_color)) {
            nextState = message_state;
        } else {
            nextState = 'inbox';
        }
        var postData = $(this).find('input').serializeArray();
        window.$.ajax({
            url: formURL + '/' + message_id + '/' + nextState,
            type: "PATCH",
            data: postData,
            success: function success() {
                window.$('#messages_menu .item.active').trigger('click');
            },
            error: function error() {}
        });
    });
    $msg_cards.find('.trash.icon').on('click', function () {
        var message_id = $(this).attr('data-id');
        window.$('.small.modal .content').html(window.$('#message_' + message_id).clone());
        var postData = window.$('.small.modal' + ' :input').serializeArray();
        window.$('.small.modal').modal({
            onApprove: function onApprove() {
                window.$.ajax({
                    url: formURL + '/' + message_id,
                    type: "DELETE",
                    data: postData,
                    success: function success() {
                        window.$('#messages_menu .item.active').trigger('click');
                    }
                });
            }
        }).modal('show');
    });
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
            edit_course_form.find('[name=planned_semester]').val(course_row.find('td:nth-child(7)').html());
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
                var _course_id = rows[i].id;
                course_data.push({
                    id: _course_id,
                    checked: window.$('#' + _course_id + ' .ui.checkbox').checkbox('is checked'),
                    min_capacity: window.$('#' + _course_id + ' .ui.input input').val()
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
                error: function error(xhr, status, _error2) {
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

        // selectors
        var menu_add_btn = window.$('.ui.menu .large.green.labeled.icon.button');
        var courses_modal = window.$('#courses.modal');
        var course_cards = window.$('.ui.course.card');
        var add_schedule_modal = window.$('#add_schedule.modal');
        var remove_schedule_btn = add_schedule_modal.find('.actions .orange.right.labeled.icon.button');
        var return_btn = window.$('#add_schedule.modal .actions .blue.labeled.icon.button');
        var course_groups_tab = window.$('#add_schedule.modal .scrolling.content #course_groups');
        var course_group_tab_btns = course_groups_tab.find('.top.attached.menu .left.menu');
        var approve_btn = add_schedule_modal.find('.actions .positive.right.labeled.icon.button');

        // show courses
        menu_add_btn.on('click', function () {
            courses_modal.modal('show');
        });

        // click on each course card
        course_cards.on('click', function () {
            var course_id = $(this).attr('data-id');
            var card_dimmer = $(this).find('.ui.inverted.dimmer');
            return_btn.show();
            if ($(this).attr('data-state') === 'notscheduled') {
                approve_btn.find('span').html('ثبت در برنامه');
                approve_btn.find('i').removeClass('write').addClass('checkmark');
                remove_schedule_btn.hide();
                //
                course_group_tab_btns.find('a.new').remove();
                course_group_tab_btns.find('a:first-child').removeClass('active').addClass('active');
                course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').addClass('disabled');
                course_groups_tab.find('.bottom.attached.tab.segment.new').remove();
                course_groups_tab.find('.bottom.attached.tab.segment').removeClass('active').addClass('active');
                //
                window.$('#add_schedule.modal .scrolling.content form').form('clear');
                fix_persian_numbers('#add_schedule.modal .scrolling.content .menu .item');
                window.$('#add_schedule.modal .scrolling.content .menu .item').tab();
                window.$('#add_schedule.modal .scrolling.content .ui.dropdown').dropdown();
                //
                course_groups_tab.find('.bottom.attached.tab.segment form input[name=course_id]').val(course_id);
                course_groups_tab.find('.bottom.attached.tab.segment form input[name=group_number]').val(1);
                //
                var course_color_preview = window.$('#add_schedule.modal .scrolling.content .tab.segment .block.preview');
                var _random_color = randomColor();
                course_color_preview.css('background-color', _random_color);
                course_color_preview.siblings('input').val(_random_color);
                course_color_preview.on('click', function () {
                    _random_color = randomColor();
                    $(this).css('background-color', _random_color);
                    $(this).siblings('input').val(_random_color);
                });
                //
                course_color_preview.html($(this).find('.content .header').html());
                window.$('#add_schedule.modal .scrolling.content input.timepicker').timepicker({
                    timeFormat: 'HH:mm:ss',
                    interval: 15,
                    minTime: '08:00',
                    maxTime: '20:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });
                window.$('#add_schedule.modal .scrolling.content input[name=exam_date]').persianDatepicker({
                    initialValue: false,
                    observer: true,
                    autoClose: true,
                    format: 'YYYY/MM/DD',
                    altField: '#add_schedule.modal .scrolling.content form:eq(0) input[name=exam_date_unix]',
                    'toolbox': {
                        'enabled': false
                    }
                });
                //
                card_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: document.location.origin + '/admin/scheduling/' + course_id + '/information',
                    type: "GET",
                    success: function success(result, status, xhr) {
                        //
                        var instructors_info = result.instructors_info;
                        var instructors_info_rows = '';
                        for (var i = 0; i < instructors_info.length; i++) {
                            if (instructors_info[i].photo === null) {
                                if (instructors_info[i].sex === 'مرد') {
                                    instructors_info[i].photo = 'instructor_photos/img_male.png';
                                } else {
                                    instructors_info[i].photo = 'instructor_photos/img_female.png';
                                }
                            }
                            instructors_info_rows += '\n                            <div class="row">\n                                <div class="photo" data-tooltip="' + instructors_info[i].name + '" data-position="right center">\n                                    <img class="ui mini circular image" src="/storage/' + instructors_info[i].photo + '">\n                                </div>\n                                <div class="progress">\n                                    <div class="ui indicating progress" data-value="' + instructors_info[i].votes + '" data-total="' + instructors_info[0].votes + '">\n                                        <div class="bar"></div>\n                                    </div>\n                                </div>\n                                <div class="votes">\n                                    ' + instructors_info[i].votes + '\n                                </div>\n                            </div>\n                        ';
                        }
                        if (instructors_info_rows !== '') {
                            window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html(instructors_info_rows);
                            window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors .progress').progress();
                        } else {
                            window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html('برای این درس استادی پیشنهاد نشده است.');
                        }
                        //
                        var course_conflicts = result.course_conflicts;
                        var course_conflicts_tbody = '';
                        for (var _i4 = 0; _i4 < course_conflicts.length; _i4++) {
                            course_conflicts_tbody += '<tr><td>' + (_i4 + 1) + '</td><td>' + course_conflicts[_i4].code + '</td><td>' + course_conflicts[_i4].name + '</td><td>' + course_conflicts[_i4].count + '</td></tr>';
                        }
                        if (course_conflicts_tbody !== '') {
                            window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html(course_conflicts_tbody);
                        } else {
                            window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html('<tr><td colspan="4">برای این درس تداخلی وجود ندارد.</td></tr>');
                        }
                        //
                        var course_students = result.course_students;
                        var course_students_tbody = '';
                        for (var _i5 = 0; _i5 < course_students.length; _i5++) {
                            course_students_tbody += '<tr><td>' + (_i5 + 1) + '</td><td>' + course_students[_i5].first_name + '</td><td>' + course_students[_i5].last_name + '</td><td>' + course_students[_i5].student_id + '</td><td>' + course_students[_i5].entry_year + '</td></tr>';
                        }
                        if (course_students_tbody !== '') {
                            window.$('#add_schedule.modal .scrolling.content table.students tbody').html(course_students_tbody);
                        } else {
                            window.$('#add_schedule.modal .scrolling.content table.students tbody').html('<tr><td colspan="5">دانشجویی این درس را اخذ نکرده است.</td></tr>');
                        }
                        //
                        card_dimmer.dimmer('toggle');
                        add_schedule_modal.modal('show');
                    },
                    error: function error(xhr, status, _error3) {
                        // TODO error handling logic
                    }
                });
            } else {
                card_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: document.location.origin + '/admin/scheduling/' + course_id + '/information',
                    type: "GET",
                    success: function success(result, status, xhr) {
                        //
                        course_group_tab_btns.find('a.new').remove();
                        var tab_btn = course_group_tab_btns.find('a:first-child');
                        tab_btn.removeClass('active').addClass('active');
                        course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').addClass('disabled');
                        course_groups_tab.find('.bottom.attached.tab.segment.new').remove();
                        var tab_content = course_groups_tab.find('.bottom.attached.tab.segment');
                        tab_content.removeClass('active').addClass('active');

                        var schedule_info = result.schedule_info;
                        for (var i = 0; i < schedule_info.length; i++) {
                            if (i == 0) {
                                tab_content.find('form').form('clear');
                                tab_content.find('form input[name=course_id]').val(schedule_info[i].course_id);
                                tab_content.find('form input[name=group_number]').val(schedule_info[i].group_number);
                                tab_content.find('form select[name=instructor_id]').val(schedule_info[i].instructor_id);
                                tab_content.find('form input[name=course_color]').val(schedule_info[i].course_color);
                                tab_content.find('form select[name=weekday_1]').val(schedule_info[i].weekday_1);
                                tab_content.find('form input[name=classroom_1]').val(schedule_info[i].classroom_1);
                                tab_content.find('form input[name=start_time_1]').val(schedule_info[i].start_time_1);
                                tab_content.find('form input[name=end_time_1]').val(schedule_info[i].end_time_1);
                                tab_content.find('form select[name=weekday_2]').val(schedule_info[i].weekday_2);
                                tab_content.find('form input[name=classroom_2]').val(schedule_info[i].classroom_2);
                                tab_content.find('form input[name=start_time_2]').val(schedule_info[i].start_time_2);
                                tab_content.find('form input[name=end_time_2]').val(schedule_info[i].end_time_2);
                                tab_content.find('form input[name=exam_time]').val(schedule_info[i].exam_time);
                                var _course_color_preview2 = tab_content.find('.block.preview');
                                _course_color_preview2.html(schedule_info[i].course_name);
                                _course_color_preview2.css('background-color', schedule_info[i].course_color);
                                _course_color_preview2.on('click', function () {
                                    random_color = randomColor();
                                    $(this).css('background-color', random_color);
                                    $(this).siblings('input').val(random_color);
                                });
                                var dp = tab_content.find('form input[name=exam_date]').persianDatepicker({
                                    initialValue: false,
                                    observer: true,
                                    autoClose: true,
                                    format: 'YYYY/MM/DD',
                                    altField: '#add_schedule.modal .scrolling.content form:eq(' + (parseInt(schedule_info[i].group_number) - 1).toString() + ') input[name=exam_date_unix]',
                                    'toolbox': {
                                        'enabled': false
                                    }
                                });
                                if (schedule_info[i].exam_date_unix !== null) dp.setDate(parseInt(schedule_info[i].exam_date_unix));
                            } else {
                                var new_tab_btn = tab_btn.clone().removeClass('active').addClass('new');
                                new_tab_btn.attr('data-tab', (i + 1).toString());
                                new_tab_btn.html('گروه ' + (i + 1).toString());
                                course_group_tab_btns.append(new_tab_btn);
                                course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').removeClass('disabled');

                                var new_tab_content = tab_content.clone().removeClass('active').addClass('new');
                                new_tab_content.attr('data-tab', (i + 1).toString());
                                new_tab_content.find('form').form('clear');
                                new_tab_content.find('form input[name=course_id]').val(schedule_info[i].course_id);
                                new_tab_content.find('form input[name=group_number]').val(schedule_info[i].group_number);
                                new_tab_content.find('form select[name=instructor_id]').val(schedule_info[i].instructor_id);
                                new_tab_content.find('form input[name=course_color]').val(schedule_info[i].course_color);
                                new_tab_content.find('form select[name=weekday_1]').val(schedule_info[i].weekday_1);
                                new_tab_content.find('form input[name=classroom_1]').val(schedule_info[i].classroom_1);
                                new_tab_content.find('form input[name=start_time_1]').val(schedule_info[i].start_time_1);
                                new_tab_content.find('form input[name=end_time_1]').val(schedule_info[i].end_time_1);
                                new_tab_content.find('form select[name=weekday_2]').val(schedule_info[i].weekday_2);
                                new_tab_content.find('form input[name=classroom_2]').val(schedule_info[i].classroom_2);
                                new_tab_content.find('form input[name=start_time_2]').val(schedule_info[i].start_time_2);
                                new_tab_content.find('form input[name=end_time_2]').val(schedule_info[i].end_time_2);
                                new_tab_content.find('form input[name=exam_time]').val(schedule_info[i].exam_time);
                                var _course_color_preview3 = new_tab_content.find('.block.preview');
                                _course_color_preview3.html(schedule_info[i].course_name);
                                _course_color_preview3.css('background-color', schedule_info[i].course_color);
                                _course_color_preview3.on('click', function () {
                                    random_color = randomColor();
                                    $(this).css('background-color', random_color);
                                    $(this).siblings('input').val(random_color);
                                });
                                var _dp2 = new_tab_content.find('form input[name=exam_date]').persianDatepicker({
                                    initialValue: false,
                                    observer: true,
                                    autoClose: true,
                                    format: 'YYYY/MM/DD',
                                    altField: '#add_schedule.modal .scrolling.content form:eq(' + (parseInt(schedule_info[i].group_number) - 1).toString() + ') input[name=exam_date_unix]',
                                    'toolbox': {
                                        'enabled': false
                                    }
                                });
                                if (schedule_info[i].exam_date_unix !== null) _dp2.setDate(parseInt(schedule_info[i].exam_date_unix));
                                course_groups_tab.append(new_tab_content);
                            }
                        }
                        window.$('#add_schedule.modal .scrolling.content .menu .item').tab();
                        window.$('#add_schedule.modal .scrolling.content .ui.dropdown').dropdown();
                        window.$('#add_schedule.modal .scrolling.content input.timepicker').timepicker({
                            timeFormat: 'HH:mm:ss',
                            interval: 15,
                            minTime: '08:00',
                            maxTime: '20:00',
                            dynamic: false,
                            dropdown: true,
                            scrollbar: true
                        });
                        fix_persian_numbers('#add_schedule.modal .scrolling.content .menu .item');

                        //
                        var instructors_info = result.instructors_info;
                        var instructors_info_rows = '';
                        for (var _i6 = 0; _i6 < instructors_info.length; _i6++) {
                            if (instructors_info[_i6].photo === null) {
                                if (instructors_info[_i6].sex === 'مرد') {
                                    instructors_info[_i6].photo = 'instructor_photos/img_male.png';
                                } else {
                                    instructors_info[_i6].photo = 'instructor_photos/img_female.png';
                                }
                            }
                            instructors_info_rows += '\n                            <div class="row">\n                                <div class="photo" data-tooltip="' + instructors_info[_i6].name + '" data-position="right center">\n                                    <img class="ui mini circular image" src="/storage/' + instructors_info[_i6].photo + '">\n                                </div>\n                                <div class="progress">\n                                    <div class="ui indicating progress" data-value="' + instructors_info[_i6].votes + '" data-total="' + instructors_info[0].votes + '">\n                                        <div class="bar"></div>\n                                    </div>\n                                </div>\n                                <div class="votes">\n                                    ' + instructors_info[_i6].votes + '\n                                </div>\n                            </div>\n                        ';
                        }
                        if (instructors_info_rows !== '') {
                            window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html(instructors_info_rows);
                            window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors .progress').progress();
                        } else {
                            window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html('برای این درس استادی پیشنهاد نشده است.');
                        }
                        //
                        var course_conflicts = result.course_conflicts;
                        var course_conflicts_tbody = '';
                        for (var _i7 = 0; _i7 < course_conflicts.length; _i7++) {
                            course_conflicts_tbody += '<tr><td>' + (_i7 + 1) + '</td><td>' + course_conflicts[_i7].code + '</td><td>' + course_conflicts[_i7].name + '</td><td>' + course_conflicts[_i7].count + '</td></tr>';
                        }
                        if (course_conflicts_tbody !== '') {
                            window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html(course_conflicts_tbody);
                        } else {
                            window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html('<tr><td colspan="4">برای این درس تداخلی وجود ندارد.</td></tr>');
                        }
                        //
                        var course_students = result.course_students;
                        var course_students_tbody = '';
                        for (var _i8 = 0; _i8 < course_students.length; _i8++) {
                            course_students_tbody += '<tr><td>' + (_i8 + 1) + '</td><td>' + course_students[_i8].first_name + '</td><td>' + course_students[_i8].last_name + '</td><td>' + course_students[_i8].student_id + '</td><td>' + course_students[_i8].entry_year + '</td></tr>';
                        }
                        if (course_students_tbody !== '') {
                            window.$('#add_schedule.modal .scrolling.content table.students tbody').html(course_students_tbody);
                        } else {
                            window.$('#add_schedule.modal .scrolling.content table.students tbody').html('<tr><td colspan="5">دانشجویی این درس را اخذ نکرده است.</td></tr>');
                        }
                        //
                        approve_btn.find('span').html('ویرایش برنامه');
                        approve_btn.find('i').removeClass('checkmark').addClass('write');
                        remove_schedule_btn.show();
                        //
                        card_dimmer.dimmer('toggle');
                        add_schedule_modal.modal('show');
                    },
                    error: function error(xhr, status, _error4) {
                        // TODO error handling logic
                    }
                });
            }
        });
        course_cards.hover(function () {
            if ($(this).attr('data-state') === 'scheduled') {
                $(this).find('.right.corner.label i').transition('flash');
            } else {
                $(this).find('.right.corner.label i').addClass('checkmark');
            }
        }, function () {
            if ($(this).attr('data-state') === 'notscheduled') {
                $(this).find('.right.corner.label i').removeClass('checkmark');
            }
        });
        // add new group
        course_groups_tab.find('.top.attached.menu .right.menu .green.labeled.icon.button').on('click', function () {
            //
            var new_tab_btn = course_group_tab_btns.find('a:last-child').clone().removeClass('active').addClass('new');
            var group_counter = parseInt(new_tab_btn.attr('data-tab'));
            new_tab_btn.html('گروه ' + (group_counter + 1).toString());
            new_tab_btn.attr('data-tab', (group_counter + 1).toString());
            course_group_tab_btns.append(new_tab_btn);
            course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').removeClass('disabled');
            //
            var new_tab_content = course_groups_tab.find('.bottom.attached.tab.segment:last-child').clone().removeClass('active').addClass('new');
            new_tab_content.attr('data-tab', (group_counter + 1).toString());
            var course_id = new_tab_content.find('form input[name=course_id]').val();
            new_tab_content.find('form').form('clear');
            new_tab_content.find('form input[name=course_id]').val(course_id);
            new_tab_content.find('form input[name=group_number]').val((group_counter + 1).toString());
            course_groups_tab.append(new_tab_content);
            //
            course_group_tab_btns.find('a').removeClass('active');
            course_group_tab_btns.find('a:last-child').addClass('active');
            course_groups_tab.find('.bottom.attached.tab.segment').removeClass('active');
            course_groups_tab.find('.bottom.attached.tab.segment:last-child').addClass('active');
            window.$('#add_schedule.modal .scrolling.content .menu .item').tab();
            new_tab_content.find('.ui.dropdown').dropdown();
            //
            var course_color_preview = new_tab_content.find('.block.preview');
            course_color_preview.siblings('input').val(rgb2hex(course_color_preview.css('background-color')));
            course_color_preview.on('click', function () {
                var random_color = randomColor();
                $(this).css('background-color', random_color);
                $(this).siblings('input').val(random_color);
            });
            //
            fix_persian_numbers('#add_schedule.modal .scrolling.content .menu .item');
            window.$('#add_schedule.modal .scrolling.content input.timepicker').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 15,
                minTime: '08:00',
                maxTime: '20:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
            window.$('#add_schedule.modal .scrolling.content input[name=exam_date]').persianDatepicker({
                initialValue: false,
                observer: true,
                autoClose: true,
                format: 'YYYY/MM/DD',
                altField: '#add_schedule.modal .scrolling.content form:eq(' + group_counter.toString() + ') input[name=exam_date_unix]',
                'toolbox': {
                    'enabled': false
                }
            });
        });
        // remove group btn
        course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').on('click', function () {
            course_group_tab_btns.find('a.new:last').remove();
            if (elementExist(course_group_tab_btns.find('a.new:last'))) {
                course_group_tab_btns.find('a.new:last').addClass('active');
            } else {
                course_group_tab_btns.find('a:first').addClass('active');
                course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').addClass('disabled');
            }
            course_groups_tab.find('.bottom.attached.tab.segment.new:last').remove();
            if (elementExist(course_groups_tab.find('.bottom.attached.tab.segment.new:last'))) {
                course_groups_tab.find('.bottom.attached.tab.segment.new:last').addClass('active');
            } else {
                course_groups_tab.find('.bottom.attached.tab.segment:first').addClass('active');
            }
        });
        // return button
        return_btn.on('click', function () {
            courses_modal.modal('show');
        });

        // scheduler info
        var position_info = {
            top_offset: window.$('#schedule_table table')[0].offsetTop,
            header_h: window.$('#schedule_table table thead tr')[0].offsetHeight,
            tblock_h: window.$('#schedule_table table tbody tr')[0].offsetHeight / 2,
            timecol_w: window.$('#schedule_table table tbody tr td:first-child')[0].offsetWidth,
            weekday_w: window.$('#schedule_table table thead tr th:last-child')[0].offsetWidth
        };
        var lectures_container = window.$('#schedule_table .schedule');

        // add to schedule btn
        add_schedule_modal.modal({
            onApprove: function onApprove() {
                var schedule_data = [];
                var forms_are_valid = true;
                course_groups_tab.find('form').each(function (index, item) {
                    $(item).form({
                        fields: {
                            instructor_id: 'empty',
                            weekday_1: 'empty',
                            start_time_1: 'empty',
                            end_time_1: 'empty'
                        }
                    });
                    if (!$(item).form('is valid')) {
                        $(item).submit();
                        forms_are_valid = false;
                    } else {
                        $(item).removeClass('error');
                        $(item).find('.field').removeClass('error');
                    }
                    var form_data = $(item).serializeArray();
                    var form_object = {};
                    for (var i = 0; i < form_data.length; i++) {
                        form_object[[form_data[i]['name']]] = form_data[i]['value'];
                    }
                    schedule_data[index] = form_object;
                });
                if (!forms_are_valid) {
                    return false;
                }
                window.$.ajax({
                    url: document.location.origin + '/admin/scheduling/store',
                    type: "POST",
                    data: JSON.stringify(schedule_data),
                    contentType: "application/json",
                    success: function success(result, status, xhr) {
                        document.location = document.location.origin + '/admin/scheduling';
                    },
                    error: function error(xhr, status, _error5) {
                        // TODO error handling logic
                        document.location = document.location.origin + '/admin/scheduling';
                    }
                });
            }
        });
        // remove schedule btn
        remove_schedule_btn.on('click', function () {
            var course_id = course_groups_tab.find('form:first input[name=course_id]').val();
            window.$.ajax({
                url: document.location.origin + '/admin/scheduling/' + course_id + '/destroy',
                type: "POST",
                success: function success(result, status, xhr) {
                    document.location = document.location.origin + '/admin/scheduling/';
                },
                error: function error(xhr, status, _error6) {
                    document.location = document.location.origin + '/admin/scheduling';
                }
            });
        });
        // draw schedule on page load
        draw_schedule(lectures_container, course_group_tab_btns, course_groups_tab, approve_btn, remove_schedule_btn, add_schedule_modal, return_btn, position_info);
    }
    // message page logic
    if (elementExist('#p_admin_messages')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(7)').addClass('olive');
        window.$('.vertical.menu a i:eq(7)').removeClass('grey').addClass('olive');

        var formURL = document.location.origin + '/admin/messages';
        var menu_items = window.$('#messages_menu .item');
        var messages_dimmer = window.$('#messages_dimmer');
        var messages_list = window.$('#messages_list');
        var no_messages = window.$('#no_messages');
        init_message_cards(messages_list, formURL);
        menu_items.on('click', function () {
            menu_items.removeClass('active');
            $(this).addClass('active');
            var bt_state = $(this).attr('data-state');
            if (bt_state === 'inbox') {
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getinbox',
                    type: "GET",
                    success: function success(data) {
                        if (data === '') {
                            no_messages.show();
                        } else {
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list, formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function error() {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            } else if (bt_state === 'star') {
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getstar',
                    type: "GET",
                    success: function success(data) {
                        if (data === '') {
                            no_messages.show();
                        } else {
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list, formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function error() {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            } else if (bt_state === 'later') {
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getlater',
                    type: "GET",
                    success: function success(data) {
                        if (data === '') {
                            no_messages.show();
                        } else {
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list, formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function error() {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            } else if (bt_state === 'archive') {
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getarchive',
                    type: "GET",
                    success: function success(data) {
                        if (data === '') {
                            no_messages.show();
                        } else {
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list, formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function error() {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            }
        });
    }
    // setting page logic
    if (elementExist('#p_admin_settings')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(8)').addClass('black');
        window.$('.vertical.menu a i:eq(8)').removeClass('grey').addClass('black');

        window.$('.ui.dropdown').dropdown();

        var delete_admin_modal = window.$('#delete_admin.modal');
        var delete_admin_btn = window.$('#registered_admin_list tr .red.button');
        var delete_admin_form = delete_admin_modal.find('form');
        delete_admin_btn.on('click', function () {
            var admin_id = $(this).attr('data-id');
            delete_admin_modal.find('table tbody td:eq(0)').html(window.$('#registered_admin_list #admin_' + admin_id + ' td:eq(0)').html());
            delete_admin_modal.find('table tbody td:eq(1)').html(window.$('#registered_admin_list #admin_' + admin_id + ' td:eq(1)').html());
            delete_admin_form.attr('action', delete_admin_form.attr('action') + '/' + admin_id + '/unregisteradmin');
            delete_admin_modal.modal('show');
        });
        delete_admin_modal.modal({
            onApprove: function onApprove() {
                delete_admin_form.submit();
            }
        });

        var date_input_names = ['prereg_start_date', 'prereg_end_date', 'eval_start_date', 'eval_end_date', 'final_date'];
        var semester_options_form = window.$('#p_admin_settings form:eq(0)');
        for (var i = 0; i < date_input_names.length; i++) {
            var dp = semester_options_form.find('input[name=' + date_input_names[i] + '_p]').persianDatepicker({
                initialValue: false,
                observer: true,
                autoClose: true,
                format: 'YYYY/MM/DD',
                altField: '#p_admin_settings form input[name=' + date_input_names[i] + ']',
                'toolbox': {
                    'enabled': false
                }
            });
            if (semester_options_form.find('input[name=' + date_input_names[i] + ']').val() !== '') {
                dp.setDate(parseInt(semester_options_form.find('input[name=' + date_input_names[i] + ']').val()));
            }
        }

        // init messages
        if (elementExist('#manage_admin_panel .message.session')) {
            window.$('#manage_admin_panel .message.session .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('#manage_admin_panel .message.session').hasClass('hidden')) window.$('#manage_admin_panel .message.session').transition('fade');
            }, 4000);
        }
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