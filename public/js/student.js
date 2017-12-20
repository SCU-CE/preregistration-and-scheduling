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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (immutable) */ __webpack_exports__["a"] = feedbackInit;
function feedbackInit() {
    window.$('#feedback-btn button').on('click', function () {
        if (window.$('#feedback-btn').hasClass('open') && window.$('#feedback-btn').hasClass('msg')) {
            window.$(this).blur();
            window.$('#feedback-panel').animate({ right: '-64px' }, { duration: 250, easing: 'swing', queue: false });
            window.$('#feedback-type').animate({ right: '-57px' }, { duration: 250, easing: 'swing', queue: false });
            window.$('#feedback-msg').animate({ right: '-240px' }, 250, 'swing', function () {
                window.$('#feedback-btn').removeClass('open msg');
            });
        } else if (window.$('#feedback-btn').hasClass('open')) {
            window.$(this).blur();
            window.$('#feedback-panel').animate({ right: '-64px' }, 250, 'swing');
            window.$('#feedback-type').animate({ right: '-57px' }, 250, 'swing', function () {
                window.$('#feedback-btn').removeClass('open');
            });
        } else {
            window.$(this).blur();
            window.$('#feedback-panel').animate({ right: '-9px' }, 250, 'swing');
            window.$('#feedback-type').animate({ right: '0px' }, 250, 'swing', function () {
                window.$('#feedback-btn').addClass('open');
            });
        }
    });

    window.$('.fb-bt.bt1').hover(function () {
        window.$(this).css('background-color', '#23CE47');
    }, function () {
        window.$(this).css('background-color', '#21BA45');
    });
    window.$('.fb-bt.bt2').hover(function () {
        window.$(this).css('background-color', '#00C9C1');
    }, function () {
        window.$(this).css('background-color', '#00B5AD');
    });
    window.$('.fb-bt.bt3').hover(function () {
        window.$(this).css('background-color', '#EF2A2A');
    }, function () {
        window.$(this).css('background-color', '#DB2828');
    });

    window.$('.fb-bt').on('click', function () {
        if (!window.$('#feedback-btn').hasClass('msg')) {
            window.$('#feedback-panel').animate({ right: '232px' }, 250, 'swing');
            window.$('#feedback-type').animate({ right: '240px' }, 250, 'swing');
            window.$('#feedback-msg').animate({ right: '0px' }, 250, 'swing', function () {
                window.$('#feedback-btn').addClass('msg');
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

    window.$(document).on('mouseup', function (e) {
        var container = window.$('#feedback-panel');
        if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 // ... nor a descendant of the container
        && window.$('#feedback-btn').hasClass('open')) {
            window.$('#feedback-btn button').trigger('click');
        }
    });

    window.$("#feedbackForm").submit(function () {
        window.$('#feedback_dimmer').dimmer('toggle');
        var formURL = window.$(this).attr("action");
        var postData = window.$(this).serializeArray();
        window.$.ajax({
            url: formURL + '/feedback',
            type: "POST",
            data: postData,
            success: function success(data) {
                window.$('#message').val('');
                window.$('#feedback_dimmer').dimmer('toggle');
                window.$('#feedback_success').dimmer('toggle');
                setTimeout(function () {
                    window.$('#feedback-btn button').trigger('click');
                    window.$('#feedback_success').dimmer('toggle');
                }, 500);
            },
            error: function error(data) {

                window.$('#feedback_dimmer').dimmer('toggle');
            }
        });
        return false;
    });
}

/***/ }),
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(7);


/***/ }),
/* 7 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__commons__ = __webpack_require__(0);

// utility functions
function elementExist(selector) {
    return window.$(selector).length != 0;
}
function autohide_menu(btn_selector, menu_selector) {
    var menu = window.$(menu_selector);
    var container = window.$(btn_selector + ',' + menu_selector);
    window.$(document).on('mouseup', function (e) {
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
        if ($(item).html() !== '') $(item).html(persianJs($(item).html()).englishNumber().toString());
    });
}
function findIndexByKeyValue(arraytosearch, key, valuetosearch) {
    var indexes = [];
    for (var i = 0; i < arraytosearch.length; i++) {
        if (arraytosearch[i][key] == valuetosearch) {
            indexes.push(i);
        }
    }
    return indexes;
}

function init_menu_btns() {
    // cache map btn and steps dom elements
    var map_btn = window.$('.mobile.menu #steps_btn');
    var mobile_steps = window.$('.mobile.steps');
    // show/hide steps if map btn clicked
    map_btn.on('click', function () {
        mobile_steps.transition('fade down');
    });
    // hide steps if clicked elsewhere
    autohide_menu('.mobile.menu #steps_btn', '.mobile.steps');

    // cache computer and mobile user btns and menus
    var computer_user_btn = window.$('.computer.menu #user_btn');
    var mobile_user_btn = window.$('.mobile.menu #user_btn');
    var computer_vmenu = window.$('.computer.vertical.menu');
    var mobile_vmenu = window.$('.mobile.vertical.menu');
    // show/hide menu if user btn clicked
    computer_user_btn.on('click', function () {
        computer_vmenu.transition('fade down');
    });
    mobile_user_btn.on('click', function () {
        mobile_vmenu.transition('fade down');
    });
    // hide menu if clicked elsewhere
    autohide_menu('.computer.menu #user_btn', '.computer.vertical.menu');
    autohide_menu('.mobile.menu #user_btn', '.mobile.vertical.menu');

    // logout
    var logout_btns = window.$('.basic.logout.icon.button');
    logout_btns.on('click', function () {
        window.$('#logout_form').submit();
    });
}
function init_position() {
    var mobile_steps = window.$('.mobile.steps');

    var computer_user_btn = window.$('.computer.menu #user_btn');
    var mobile_user_btn = window.$('.mobile.menu #user_btn');
    var computer_vmenu = window.$('.computer.vertical.menu');
    var mobile_vmenu = window.$('.mobile.vertical.menu');

    var mobile_vmenu_left = mobile_user_btn[0].offsetLeft;
    var mobile_vmenu_top = mobile_user_btn[0].offsetTop * 2 + mobile_user_btn[0].offsetHeight;

    mobile_vmenu.css('left', mobile_vmenu_left);
    mobile_vmenu.css('top', mobile_vmenu_top);

    var computer_vmenu_left = computer_user_btn[0].offsetLeft;
    var computer_vmenu_top = computer_user_btn[0].offsetTop * 2 + computer_user_btn[0].offsetHeight;

    computer_vmenu.css('left', computer_vmenu_left);
    computer_vmenu.css('top', computer_vmenu_top);

    if (elementExist('#p_student_semestercourses')) {
        var units_summery_desktop = window.$('#units_summery.desktop');
        var units_summery_desktop_top = (window.innerHeight - units_summery_desktop[0].offsetHeight) / 2;
        units_summery_desktop.css('top', units_summery_desktop_top);

        var units_summery_mobile = window.$('#units_summery.mobile');
        var units_summery_mobile_left = (window.innerWidth - units_summery_mobile[0].offsetWidth) / 2;
        units_summery_mobile.css('left', units_summery_mobile_left);
    }

    if (screen.width > 767) {
        if (!mobile_vmenu.hasClass('hidden')) {
            mobile_vmenu.removeClass('visible');
            mobile_vmenu.addClass('hidden');
        }
        if (!mobile_steps.hasClass('hidden')) {
            mobile_steps.removeClass('visible');
            mobile_steps.addClass('hidden');
        }
    } else {
        if (!computer_vmenu.hasClass('hidden')) {
            computer_vmenu.removeClass('visible');
            computer_vmenu.addClass('hidden');
        }
    }
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
    // --------
    adjust_cards_number();
    // --------
    if (screen.width < 768) {
        window.$('.ui.container .segment .fluid.main.steps').removeClass('large').addClass('tiny');
        window.$('.ui.container .segment .blue.fluid.button').removeClass('huge');
        window.$('#feedback-panel').hide();
    } else {
        window.$('.ui.container .segment .fluid.main.steps').removeClass('tiny').addClass('large');
        window.$('.ui.container .segment .blue.fluid.button').addClass('huge');
        window.$('#feedback-panel').show();
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
    $lecture.prepend('\n    <div class="ui inverted dimmer">\n        <div class="ui loader"></div>\n    </div>\n    ');

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
function draw_schedule(lectures_container, position_info) {
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

    __WEBPACK_IMPORTED_MODULE_0__commons__["a" /* feedbackInit */]();
    init_menu_btns();
    init_position();
    adjust_to_screen_size();

    if (elementExist('#p_student_home')) {
        window.$('#p_student_home .unix.date').each(function (index, item) {
            var date = new persianDate(parseInt($(item).html()));
            $(item).html(date.format('D MMMM'));
        });
    }
    if (elementExist('#p_student_passedcourses')) {
        // pass and unpass course
        var class_values = ['red', 'green', 'hidden', 'checkmark', 'remove'];
        var course_card = window.$('.ui.course.card');
        course_card.on('mouseenter', function () {
            if ($(this).attr('data-state') === 'taken') {
                set_class(class_values, 'red', $(this));
                set_class(class_values, 'red', $(this).find('.right.corner.label'));
                set_class(class_values, 'remove', $(this).find('.right.corner.label i'));
            } else {
                set_class(class_values, 'green', $(this));
                set_class(class_values, 'green', $(this).find('.right.corner.label'));
                set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
            }
        });
        course_card.on('mouseleave', function () {
            if ($(this).attr('data-state') === 'taken') {
                set_class(class_values, 'green', $(this));
                set_class(class_values, 'green', $(this).find('.right.corner.label'));
                set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
            } else {
                set_class(class_values, '', $(this));
                set_class(class_values, 'hidden', $(this).find('.right.corner.label'));
                set_class(class_values, '', $(this).find('.right.corner.label i'));
            }
        });
        course_card.on('click', function () {
            if ($(this).attr('data-state') === 'taken') {
                var current_card = $(this);
                current_card.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: document.location.origin + '/student/' + current_card.attr('data-id') + '/unpass',
                    type: "POST",
                    success: function success(result, status, xhr) {
                        current_card.attr('data-state', 'nottaken');
                        set_class(class_values, '', current_card);
                        set_class(class_values, 'hidden', current_card.find('.right.corner.label'));
                        set_class(class_values, '', current_card.find('.right.corner.label i'));
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function error(xhr, status, _error) {
                        // TODO error handling logic
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            } else {
                var _current_card = $(this);
                _current_card.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: document.location.origin + '/student/' + _current_card.attr('data-id') + '/pass',
                    type: "POST",
                    success: function success(result, status, xhr) {
                        _current_card.attr('data-state', 'taken');
                        set_class(class_values, 'green', _current_card);
                        set_class(class_values, 'green', _current_card.find('.right.corner.label'));
                        set_class(class_values, 'checkmark', _current_card.find('.right.corner.label i'));
                        _current_card.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function error(xhr, status, _error2) {
                        // TODO error handling logic
                        _current_card.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            }
        });
    }
    if (elementExist('#p_student_semestercourses')) {
        // convert english numbers to persian
        fix_persian_numbers('.ui.massive.inverted.center.aligned.segment');
        fix_persian_numbers('#units_summery .units div');
        // init course cards progress
        window.$('.ui.indicating.progress').progress({
            label: 'ratio',
            text: {
                active: 'تا الان {value} نفر از {total} نفر حداقل مورد نیاز برای ارائه‌ی این درس آن را گرفته اند.',
                success: 'بیش از {value} نفر این درس را گرفته اند! این درس در ترم جاری ارائه خواهد شد.',
                ratio: '{value}/{total}'
            }
        });

        // take and untake course
        var _class_values = ['red', 'green', 'hidden', 'checkmark', 'remove'];
        var _course_card = window.$('.ui.course.card');
        _course_card.on('mouseenter', function () {
            if ($(this).attr('data-state') === 'taken') {
                set_class(_class_values, 'red', $(this));
                set_class(_class_values, 'red', $(this).find('.right.corner.label'));
                set_class(_class_values, 'remove', $(this).find('.right.corner.label i'));
            } else {
                set_class(_class_values, 'green', $(this));
                set_class(_class_values, 'green', $(this).find('.right.corner.label'));
                set_class(_class_values, 'checkmark', $(this).find('.right.corner.label i'));
            }
        });
        _course_card.on('mouseleave', function () {
            if ($(this).attr('data-state') === 'taken') {
                set_class(_class_values, 'green', $(this));
                set_class(_class_values, 'green', $(this).find('.right.corner.label'));
                set_class(_class_values, 'checkmark', $(this).find('.right.corner.label i'));
            } else {
                set_class(_class_values, '', $(this));
                set_class(_class_values, 'hidden', $(this).find('.right.corner.label'));
                set_class(_class_values, '', $(this).find('.right.corner.label i'));
            }
        });
        _course_card.on('click', function () {
            var course_units = $(this).attr('data-units');
            var course_cat = $(this).attr('data-category') - 1;
            if ($(this).attr('data-state') === 'taken') {
                var current_card = $(this);
                current_card.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: document.location.origin + '/student/' + current_card.attr('data-id') + '/untake',
                    type: "POST",
                    success: function success(result, status, xhr) {
                        // fix course card state and view
                        current_card.attr('data-state', 'nottaken');
                        set_class(_class_values, '', current_card);
                        set_class(_class_values, 'hidden', current_card.find('.right.corner.label'));
                        set_class(_class_values, '', current_card.find('.right.corner.label i'));

                        // fix units sum warning
                        var units_sum_circle = window.$('.category.sum i');
                        if (units_sum_circle.hasClass('warning yellow')) {
                            units_sum_circle.removeClass('warning yellow').addClass('plus grey');
                            window.$('.units.sum').css('background-color', '#666666');
                        }

                        // set course card progress bar
                        var progress_value = current_card.find('.ui.indicating.progress').attr('data-value');
                        current_card.find('.ui.indicating.progress').attr('data-value', --progress_value);
                        current_card.find('.ui.indicating.progress').progress('set progress', progress_value);

                        // change category units value in summary panel
                        var $cat_units_d = window.$('.desktop .units.number:eq(' + course_cat + ') div');
                        var cat_units_d_value = $cat_units_d.attr('data-value');
                        $cat_units_d.html(+cat_units_d_value - +course_units);
                        $cat_units_d.attr('data-value', +cat_units_d_value - +course_units);
                        var $cat_units_m = window.$('.mobile .units.number:eq(' + course_cat + ') div');
                        var cat_units_m_value = $cat_units_m.attr('data-value');
                        $cat_units_m.html(+cat_units_m_value - +course_units);
                        $cat_units_m.attr('data-value', +cat_units_m_value - +course_units);

                        // change sum units value in summary panel
                        var $sum_units_d = window.$('.desktop .units.sum div:first');
                        var sum_units_d_value = $sum_units_d.attr('data-value');
                        $sum_units_d.html(+sum_units_d_value - +course_units);
                        $sum_units_d.attr('data-value', +sum_units_d_value - +course_units);
                        var $sum_units_m = window.$('.mobile .units.sum div:first');
                        var sum_units_m_value = $sum_units_m.attr('data-value');
                        $sum_units_m.html(+sum_units_m_value - +course_units);
                        $sum_units_m.attr('data-value', +sum_units_m_value - +course_units);

                        fix_persian_numbers('#units_summery .units div');

                        window.$('.desktop .category.button:eq(' + course_cat + ')').transition('pulse');
                        window.$('.mobile .category.button:eq(' + course_cat + ')').transition('pulse');

                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function error(xhr, status, _error3) {
                        // TODO error handling logic
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            } else {
                var _current_card2 = $(this);
                _current_card2.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: document.location.origin + '/student/' + _current_card2.attr('data-id') + '/take',
                    type: "POST",
                    success: function success(result, status, xhr) {
                        if (result === 'UNITS_RANGE_ERROR') {
                            var units_sum_circle = window.$('.category.sum i');
                            units_sum_circle.removeClass('plus grey').addClass('warning yellow');
                            window.$('.category.sum').transition('shake');
                            window.$('.units.sum').css('background-color', '#E2AA08');
                        } else {
                            // fix course card state and view
                            _current_card2.attr('data-state', 'taken');
                            set_class(_class_values, 'green', _current_card2);
                            set_class(_class_values, 'green', _current_card2.find('.right.corner.label'));
                            set_class(_class_values, 'checkmark', _current_card2.find('.right.corner.label i'));

                            // fix units sum warning
                            var _units_sum_circle = window.$('.category.sum i');
                            if (_units_sum_circle.hasClass('warning yellow')) {
                                _units_sum_circle.removeClass('warning yellow').addClass('plus grey');
                                window.$('.units.sum').css('background-color', '#666666');
                            }

                            // set course card progress bar
                            var progress_value = _current_card2.find('.ui.indicating.progress').attr('data-value');
                            _current_card2.find('.ui.indicating.progress').attr('data-value', ++progress_value);
                            _current_card2.find('.ui.indicating.progress').progress('set progress', progress_value);

                            // change category units value in summary panel
                            var $cat_units_d = window.$('.desktop .units.number:eq(' + course_cat + ') div');
                            var cat_units_d_value = $cat_units_d.attr('data-value');
                            $cat_units_d.html(+cat_units_d_value + +course_units);
                            $cat_units_d.attr('data-value', +cat_units_d_value + +course_units);
                            var $cat_units_m = window.$('.mobile .units.number:eq(' + course_cat + ') div');
                            var cat_units_m_value = $cat_units_m.attr('data-value');
                            $cat_units_m.html(+cat_units_m_value + +course_units);
                            $cat_units_m.attr('data-value', +cat_units_m_value + +course_units);

                            // change sum units value in summary panel
                            var $sum_units_d = window.$('.desktop .units.sum div:first');
                            var sum_units_d_value = $sum_units_d.attr('data-value');
                            $sum_units_d.html(+sum_units_d_value + +course_units);
                            $sum_units_d.attr('data-value', +sum_units_d_value + +course_units);
                            var $sum_units_m = window.$('.mobile .units.sum div:first');
                            var sum_units_m_value = $sum_units_m.attr('data-value');
                            $sum_units_m.html(+sum_units_m_value + +course_units);
                            $sum_units_m.attr('data-value', +sum_units_m_value + +course_units);

                            fix_persian_numbers('#units_summery .units div');

                            window.$('.desktop .category.button:eq(' + course_cat + ')').transition('jiggle');
                            window.$('.mobile .category.button:eq(' + course_cat + ')').transition('jiggle');
                        }
                        _current_card2.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function error(xhr, status, _error4) {
                        // TODO error handling logic
                        _current_card2.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            }
        });

        // units summery desktop
        window.$('#units_summery.desktop .category.sum').popup({
            on: 'hover',
            transition: 'fade down'
        });
        window.$('#units_summery.desktop .category.button').hover(function () {
            $(this).siblings('.units').animate({ width: '56px' }, 250, function () {
                $(this).find('div').show();
            });
        }, function () {
            $(this).siblings('.units').animate({ width: '0px' }, 250, function () {
                $(this).find('div').hide();
            });
        });
        window.$('#units_summery.desktop .category.sum').hover(function () {
            $(this).siblings('.units').animate({ width: '84px' }, 250, function () {
                $(this).find('div').show();
            });
            $('.units.number').animate({ width: '56px' }, 250, function () {
                $(this).find('div').show();
            });
        }, function () {
            $(this).siblings('.units').animate({ width: '0px' }, 250, function () {
                $(this).find('div').hide();
            });
            $('.units.number').animate({ width: '0px' }, 250, function () {
                $(this).find('div').hide();
            });
        });
        // units summery mobile
        window.$('#units_summery.mobile .category.sum').popup({
            on: 'hover',
            transition: 'fade down',
            onVisible: function onVisible() {
                window.$('.ui.popup').animate({ bottom: '+=56px' }, 250);
            }
        });
        window.$('#units_summery.mobile .category.button').hover(function () {
            $(this).siblings('.units').css('width', '56px').animate({ top: '-56px' }, 250, function () {
                $(this).find('div').show();
            });
        }, function () {
            $(this).siblings('.units').animate({ top: '0px' }, 250, function () {
                $(this).css('width', '0');
                $(this).find('div').hide();
            });
        });
        window.$('#units_summery.mobile .category.sum').hover(function () {
            $(this).siblings('.units').css('width', '56px').animate({ top: '-56px' }, 250, function () {
                $(this).find('div').show();
            });
            $('.units.number').css('width', '56px').animate({ top: '-56px' }, 250, function () {
                $(this).find('div').show();
            });
        }, function () {
            $(this).siblings('.units').animate({ top: '0px' }, 250, function () {
                $(this).css('width', '0');
                $(this).find('div').hide();
            });
            $('.units.number').animate({ top: '0px' }, 250, function () {
                $(this).css('width', '0');
                $(this).find('div').hide();
            });
        });
    }
    if (elementExist('#p_student_instructorsuggestion')) {
        var _course_card2 = window.$('.ui.course.card');
        var instructor_cards = window.$('.ui.instructor.card');
        var instructor_suggest_modal = window.$('#instructor_suggest.modal');
        var _class_values2 = ['red', 'green', 'hidden', 'legal', 'checkmark', 'remove'];
        _course_card2.hover(function () {
            if ($(this).attr('data-state') === 'voted') {
                $(this).find('.right.corner.label i').transition('flash');
            } else {
                set_class(_class_values2, 'green', $(this));
                set_class(_class_values2, 'green', $(this).find('.right.corner.label'));
                set_class(_class_values2, 'legal', $(this).find('.right.corner.label i'));
            }
        }, function () {
            if ($(this).attr('data-state') !== 'voted') {
                set_class(_class_values2, '', $(this));
                set_class(_class_values2, 'hidden', $(this).find('.right.corner.label'));
                set_class(_class_values2, '', $(this).find('.right.corner.label i'));
            }
        });
        _course_card2.on('click', function () {
            var current_card = $(this);
            current_card.find('.inverted.dimmer').dimmer('toggle');
            window.$.ajax({
                url: document.location.origin + '/student/' + current_card.attr('data-id') + '/votes',
                type: "GET",
                success: function success(result, status, xhr) {
                    instructor_cards.each(function (index, item) {
                        $(item).attr('data-state', 'notselected');
                        set_class(_class_values2, '', $(item));
                        set_class(_class_values2, 'hidden', $(item).find('.right.corner.label'));
                        set_class(_class_values2, '', $(item).find('.right.corner.label i'));
                    });
                    for (var i = 0; i < result.length; i++) {
                        var instructor_card = window.$('#instructor_' + result[i]);
                        instructor_card.attr('data-state', 'selected');
                        set_class(_class_values2, 'green', instructor_card);
                        set_class(_class_values2, 'green', instructor_card.find('.right.corner.label'));
                        set_class(_class_values2, 'checkmark', instructor_card.find('.right.corner.label i'));
                    }
                    current_card.find('.inverted.dimmer').dimmer('toggle');
                    instructor_suggest_modal.attr('data-id', current_card.attr('data-id'));
                    instructor_suggest_modal.modal('show');
                },
                error: function error(xhr, status, _error5) {
                    // TODO error handling logic
                    current_card.find('.inverted.dimmer').dimmer('toggle');
                }
            });
        });
        instructor_cards.hover(function () {
            if ($(this).attr('data-state') === 'selected') {
                set_class(_class_values2, 'red', $(this));
                set_class(_class_values2, 'red', $(this).find('.right.corner.label'));
                set_class(_class_values2, 'remove', $(this).find('.right.corner.label i'));
            } else {
                set_class(_class_values2, 'green', $(this));
                set_class(_class_values2, 'green', $(this).find('.right.corner.label'));
                set_class(_class_values2, 'checkmark', $(this).find('.right.corner.label i'));
            }
        }, function () {
            if ($(this).attr('data-state') === 'selected') {
                set_class(_class_values2, 'green', $(this));
                set_class(_class_values2, 'green', $(this).find('.right.corner.label'));
                set_class(_class_values2, 'checkmark', $(this).find('.right.corner.label i'));
            } else {
                set_class(_class_values2, '', $(this));
                set_class(_class_values2, 'hidden', $(this).find('.right.corner.label'));
                set_class(_class_values2, '', $(this).find('.right.corner.label i'));
            }
        });
        instructor_cards.on('click', function () {
            $(this).find('.inverted.dimmer').dimmer('toggle');
            if ($(this).attr('data-state') === 'selected') {
                $(this).attr('data-state', 'notselected');
                set_class(_class_values2, '', $(this));
                set_class(_class_values2, 'hidden', $(this).find('.right.corner.label'));
                set_class(_class_values2, '', $(this).find('.right.corner.label i'));
            } else {
                $(this).attr('data-state', 'selected');
                set_class(_class_values2, 'green', $(this));
                set_class(_class_values2, 'green', $(this).find('.right.corner.label'));
                set_class(_class_values2, 'checkmark', $(this).find('.right.corner.label i'));
            }
            $(this).find('.inverted.dimmer').dimmer('toggle');
        });
        instructor_suggest_modal.modal({
            onApprove: function onApprove() {
                var instructor_data = [];
                instructor_cards.each(function (index, item) {
                    instructor_data.push({
                        id: $(item).attr('data-id'),
                        state: $(item).attr('data-state')
                    });
                });
                window.$.ajax({
                    url: document.location.origin + '/student/' + instructor_suggest_modal.attr('data-id') + '/vote',
                    type: "POST",
                    data: JSON.stringify(instructor_data),
                    contentType: "application/json",
                    success: function success(result, status, xhr) {
                        // TODO show success before redirect
                        window.location = document.location.origin + '/student/instructor-suggestion';
                    },
                    error: function error(xhr, status, _error6) {
                        // TODO error handling logic
                    }
                });
            }
        });
    }
    if (elementExist('#p_student_evaluate_schedule')) {
        window.$('#p_student_evaluate_schedule .unix.date').each(function (index, item) {
            var date = new persianDate(parseInt($(item).html()));
            $(item).html(date.format('D MMMM'));
        });
        fix_persian_numbers('.p_number');

        // scheduler info
        var position_info = {
            top_offset: window.$('#schedule_table table')[0].offsetTop,
            header_h: window.$('#schedule_table table thead tr')[0].offsetHeight,
            tblock_h: window.$('#schedule_table table tbody tr')[0].offsetHeight / 2,
            timecol_w: window.$('#schedule_table table tbody tr td:first-child')[0].offsetWidth,
            weekday_w: window.$('#schedule_table table thead tr th:last-child')[0].offsetWidth
        };
        var lectures_container = window.$('#schedule_table .schedule');
        draw_schedule(lectures_container, position_info);

        var lecture_blocks = lectures_container.find('.course.lecture');
        var evaluate_lecture_modal = window.$('#evaluate_lecture');
        lecture_blocks.on('click', function () {
            var schedule_id = $(this).attr('data-schedule-id');
            var lecture_blocks_dimmer = $(this).find('.ui.inverted.dimmer');
            lecture_blocks_dimmer.dimmer('toggle');
            window.$.ajax({
                url: document.location.origin + '/student/evaluate-schedule/' + schedule_id + '/modal',
                type: "GET",
                success: function success(result, status, xhr) {
                    evaluate_lecture_modal.html(result);
                    evaluate_lecture_modal.find('input[name=schedule_id]').val(schedule_id);
                    fix_persian_numbers('.p_number');
                    evaluate_lecture_modal.find('.menu .item').tab({
                        onLoad: function onLoad() {
                            evaluate_lecture_modal.modal('refresh');
                        }
                    });
                    evaluate_lecture_modal.find('.ui.dropdown').dropdown();
                    evaluate_lecture_modal.find('.timepicker').timepicker({
                        timeFormat: 'HH:mm:ss',
                        interval: 15,
                        minTime: '08:00',
                        maxTime: '20:00',
                        dynamic: false,
                        dropdown: true,
                        scrollbar: true
                    });
                    var dp = evaluate_lecture_modal.find('input[name=suggested_exam_date]').persianDatepicker({
                        initialValue: false,
                        observer: true,
                        autoClose: true,
                        format: 'YYYY/MM/DD',
                        altField: '#evaluate_lecture input[name=suggested_exam_date_unix]',
                        'toolbox': {
                            'enabled': false
                        }
                    });
                    if (elementExist('#evaluate_lecture input[name=suggested_exam_date_unix]')) {
                        if (evaluate_lecture_modal.find('input[name=suggested_exam_date_unix]').val() !== '') {
                            dp.setDate(parseInt(evaluate_lecture_modal.find('input[name=suggested_exam_date_unix]').val()));
                        }
                    }
                    evaluate_lecture_modal.find('form').form({
                        fields: {
                            suggestion_reason_1: 'maxLength[250]',
                            suggestion_reason_2: 'maxLength[250]',
                            exam_suggestion_reason: 'maxLength[250]',
                            privacy: 'empty'
                        }
                    });
                    evaluate_lecture_modal.find('form').on('submit', function () {
                        var ret_value = true;
                        if (evaluate_lecture_modal.find('select[name=suggested_weekday_1]').val() === '' && evaluate_lecture_modal.find('select[name=suggested_weekday_2]').val() === '' && evaluate_lecture_modal.find('input[name=suggested_exam_date]').val() === '') {
                            if (ret_value) evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                            evaluate_lecture_modal.find('form').addClass('error');
                            evaluate_lecture_modal.find('select[name=suggested_weekday_1]').parent().parent().parent().addClass('error');
                            evaluate_lecture_modal.find('select[name=suggested_weekday_2]').parent().parent().parent().addClass('error');
                            evaluate_lecture_modal.find('input[name=suggested_exam_date]').parent().parent().addClass('error');
                            evaluate_lecture_modal.find('textarea[name=suggestion_reason_1]').parent().addClass('error');
                            evaluate_lecture_modal.find('textarea[name=suggestion_reason_2]').parent().addClass('error');
                            evaluate_lecture_modal.find('textarea[name=exam_suggestion_reason]').parent().addClass('error');
                            ret_value = false;
                        }
                        if (evaluate_lecture_modal.find('select[name=suggested_weekday_1]').val() !== '') {
                            if (evaluate_lecture_modal.find('input[name=suggested_start_time_1]').val() === '' || evaluate_lecture_modal.find('input[name=suggested_end_time_1]').val() === '' || evaluate_lecture_modal.find('textarea[name=suggestion_reason_1]').val() === '') {
                                if (ret_value) evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                                evaluate_lecture_modal.find('form').addClass('error');
                                evaluate_lecture_modal.find('select[name=suggested_weekday_1]').parent().parent().parent().addClass('error');
                                evaluate_lecture_modal.find('textarea[name=suggestion_reason_1]').parent().addClass('error');
                                ret_value = false;
                            }
                        }
                        if (evaluate_lecture_modal.find('select[name=suggested_weekday_2]').val() !== '') {
                            if (evaluate_lecture_modal.find('input[name=suggested_start_time_2]').val() === '' || evaluate_lecture_modal.find('input[name=suggested_end_time_2]').val() === '' || evaluate_lecture_modal.find('textarea[name=suggestion_reason_2]').val() === '') {
                                if (ret_value) evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                                evaluate_lecture_modal.find('form').addClass('error');
                                evaluate_lecture_modal.find('select[name=suggested_weekday_2]').parent().parent().parent().addClass('error');
                                evaluate_lecture_modal.find('textarea[name=suggestion_reason_2]').parent().addClass('error');
                                ret_value = false;
                            }
                        }
                        if (evaluate_lecture_modal.find('input[name=suggested_exam_date]').val() !== '') {
                            if (evaluate_lecture_modal.find('input[name=suggested_exam_date_unix]').val() === '' || evaluate_lecture_modal.find('input[name=suggested_exam_time]').val() === '' || evaluate_lecture_modal.find('textarea[name=exam_suggestion_reason]').val() === '') {
                                if (ret_value) evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                                evaluate_lecture_modal.find('form').addClass('error');
                                evaluate_lecture_modal.find('input[name=suggested_exam_date]').parent().parent().addClass('error');
                                evaluate_lecture_modal.find('textarea[name=exam_suggestion_reason]').parent().addClass('error');
                                ret_value = false;
                            }
                        }
                        return ret_value;
                    });
                    evaluate_lecture_modal.find('#erase_form').on('click', function () {
                        evaluate_lecture_modal.find('form').form('clear');
                        evaluate_lecture_modal.find('select[name=privacy]').val('private');
                        evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                        evaluate_lecture_modal.find('.ui.dropdown').dropdown();
                    });
                    evaluate_lecture_modal.find('#delete_btn').on('click', function () {
                        evaluate_lecture_modal.find('#delete_form').submit();
                    });
                    var upvote_btn = evaluate_lecture_modal.find('.card #upvote');
                    var downvote_btn = evaluate_lecture_modal.find('.card #downvote');
                    upvote_btn.hover(function () {
                        $(this).toggleClass('blue-color');
                        if ($(this).hasClass('blue-color')) {
                            $(this).find('span').html((parseInt($(this).find('span').html()) + 1).toString());
                        } else {
                            $(this).find('span').html((parseInt($(this).find('span').html()) - 1).toString());
                        }
                    }, function () {
                        $(this).toggleClass('blue-color');
                        if ($(this).hasClass('blue-color')) {
                            $(this).find('span').html((parseInt($(this).find('span').html()) + 1).toString());
                        } else {
                            $(this).find('span').html((parseInt($(this).find('span').html()) - 1).toString());
                        }
                    });
                    downvote_btn.hover(function () {
                        $(this).toggleClass('red-color');
                        if ($(this).hasClass('red-color')) {
                            $(this).find('span').html((parseInt($(this).find('span').html()) - 1).toString());
                        } else {
                            $(this).find('span').html((parseInt($(this).find('span').html()) + 1).toString());
                        }
                    }, function () {
                        $(this).toggleClass('red-color');
                        if ($(this).hasClass('red-color')) {
                            $(this).find('span').html((parseInt($(this).find('span').html()) - 1).toString());
                        } else {
                            $(this).find('span').html((parseInt($(this).find('span').html()) + 1).toString());
                        }
                    });
                    upvote_btn.on('click', function () {
                        var evaluation_id = $(this).attr('data-id');
                        var card_dimmer = $(this).parent().siblings('.dimmer');
                        var value = '0';
                        if ($(this).hasClass('blue-color')) {
                            value = '1';
                        }
                        var this_upvote = $(this);
                        card_dimmer.dimmer('toggle');
                        window.$.ajax({
                            url: document.location.origin + '/student/evaluation/' + evaluation_id + '/upvote/' + value,
                            type: "POST",
                            success: function success(result, status, xhr) {
                                this_upvote.find('span').html(result[0]);
                                this_upvote.siblings('#downvote').find('span').html(result[1]);

                                if (!this_upvote.hasClass('blue-color') && value === '1') {
                                    this_upvote.addClass('blue-color');
                                } else {
                                    this_upvote.removeClass('blue-color');
                                }

                                if (this_upvote.siblings('#downvote').hasClass('red-color')) {
                                    this_upvote.siblings('#downvote').removeClass('red-color');
                                }
                                card_dimmer.dimmer('toggle');
                            },
                            error: function error(xhr, status, _error7) {
                                // TODO error handling logic
                                card_dimmer.dimmer('toggle');
                            }
                        });
                    });
                    downvote_btn.on('click', function () {
                        var evaluation_id = $(this).attr('data-id');
                        var card_dimmer = $(this).parent().siblings('.dimmer');
                        var value = '0';
                        if ($(this).hasClass('red-color')) {
                            value = '1';
                        }
                        var this_downvote = $(this);
                        card_dimmer.dimmer('toggle');
                        window.$.ajax({
                            url: document.location.origin + '/student/evaluation/' + evaluation_id + '/downvote/' + value,
                            type: "POST",
                            success: function success(result, status, xhr) {
                                this_downvote.find('span').html(result[1]);
                                this_downvote.siblings('#upvote').find('span').html(result[0]);

                                if (!this_downvote.hasClass('red-color') && value === '1') {
                                    this_downvote.addClass('red-color');
                                } else {
                                    this_downvote.removeClass('red-color');
                                }

                                if (this_downvote.siblings('#upvote').hasClass('blue-color')) {
                                    this_downvote.siblings('#upvote').removeClass('blue-color');
                                }
                                card_dimmer.dimmer('toggle');
                            },
                            error: function error(xhr, status, _error8) {
                                // TODO error handling logic
                                card_dimmer.dimmer('toggle');
                            }
                        });
                    });
                    evaluate_lecture_modal.modal('show');
                    lecture_blocks_dimmer.dimmer('toggle');
                },
                error: function error(xhr, status, _error9) {
                    // TODO error handling logic
                    lecture_blocks_dimmer.dimmer('toggle');
                }
            });
        });

        // init messages
        if (elementExist('#p_student_evaluate_schedule .message.session')) {
            var message_box = window.$('#p_student_evaluate_schedule .message.session');
            var container_width = window.$('.ui.container')[0].offsetWidth;
            message_box.css('left', ((window.innerWidth - container_width - 16) / 2).toString() + 'px');
            message_box.css('display', 'block');
            window.$('#p_student_evaluate_schedule .message.session .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('#p_student_evaluate_schedule .message.session').hasClass('hidden')) window.$('#p_student_evaluate_schedule .message.session').transition('fade');
            }, 4000);
        }
    }
    if (elementExist('#p_student_final_schedule')) {
        // scheduler info
        var _position_info = {
            top_offset: window.$('#schedule_table table')[0].offsetTop,
            header_h: window.$('#schedule_table table thead tr')[0].offsetHeight,
            tblock_h: window.$('#schedule_table table tbody tr')[0].offsetHeight / 2,
            timecol_w: window.$('#schedule_table table tbody tr td:first-child')[0].offsetWidth,
            weekday_w: window.$('#schedule_table table thead tr th:last-child')[0].offsetWidth
        };
        var _lectures_container = window.$('#schedule_table .schedule');
        draw_schedule(_lectures_container, _position_info);
    }
    if (elementExist('#p_student_edit_information')) {
        window.$('.ui.dropdown').dropdown();
        // init messages
        if (elementExist('.message.session')) {
            window.$('.message.session .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('.message.session').hasClass('hidden')) window.$('.message.session').transition('fade');
            }, 4000);
        }
    }
    if (elementExist('#p_student_change_password')) {
        // init messages
        if (elementExist('.message.session')) {
            window.$('.message.session .close').on('click', function () {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if (!window.$('.message.session').hasClass('hidden')) window.$('.message.session').transition('fade');
            }, 4000);
        }
    }
}

window.$(function () {
    pagesInit();
    window.$(window).resize(function () {
        init_position();
        adjust_to_screen_size();
    });
});

/***/ })
/******/ ]);