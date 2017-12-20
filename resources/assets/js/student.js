import * as commons from './commons';
// utility functions
function elementExist(selector) {
    return window.$(selector).length != 0;
}
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
function set_class(all_classes, selected_class, selector) {
    for (let i=0; i<all_classes.length; i++){
        selector.removeClass(all_classes[i]);
    }
    selector.addClass(selected_class);
}
function fix_persian_numbers(selector) {
    const element = window.$(selector);
    element.each(function(index,item){
        if($(item).html() !== '')
            $(item).html(persianJs($(item).html()).englishNumber().toString());
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

    // logout
    const logout_btns = window.$('.basic.logout.icon.button');
    logout_btns.on('click', function () {
        window.$('#logout_form').submit();
    });
}
function init_position() {
    const mobile_steps = window.$('.mobile.steps');

    const computer_user_btn = window.$('.computer.menu #user_btn');
    const mobile_user_btn = window.$('.mobile.menu #user_btn');
    const computer_vmenu = window.$('.computer.vertical.menu');
    const mobile_vmenu = window.$('.mobile.vertical.menu');

    const mobile_vmenu_left = mobile_user_btn[0].offsetLeft;
    const mobile_vmenu_top = (mobile_user_btn[0].offsetTop * 2) + mobile_user_btn[0].offsetHeight;

    mobile_vmenu.css('left', mobile_vmenu_left);
    mobile_vmenu.css('top', mobile_vmenu_top);

    const computer_vmenu_left = computer_user_btn[0].offsetLeft;
    const computer_vmenu_top = (computer_user_btn[0].offsetTop * 2) + computer_user_btn[0].offsetHeight;

    computer_vmenu.css('left', computer_vmenu_left);
    computer_vmenu.css('top', computer_vmenu_top);

    if(elementExist('#p_student_semestercourses')) {
        const units_summery_desktop = window.$('#units_summery.desktop');
        const units_summery_desktop_top = (window.innerHeight - units_summery_desktop[0].offsetHeight) / 2;
        units_summery_desktop.css('top', units_summery_desktop_top);

        const units_summery_mobile = window.$('#units_summery.mobile');
        const units_summery_mobile_left = (window.innerWidth - units_summery_mobile[0].offsetWidth) / 2;
        units_summery_mobile.css('left', units_summery_mobile_left);
    }

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

function adjust_cards_number() {
    const course_cards = window.$('.ui.course.cards');
    const class_values = ['one', 'two', 'three', 'four'];
    if(window.innerWidth > 1199) {
        set_class(class_values, 'four', course_cards);
    }else if(window.innerWidth > 991) {
        set_class(class_values, 'three', course_cards);
    }else if(window.innerWidth > 559) {
        set_class(class_values, 'two', course_cards);
    }else {
        set_class(class_values, 'one', course_cards);
    }
}
function adjust_to_screen_size() {
    // --------
    adjust_cards_number();
    // --------
    if(screen.width < 768) {
        window.$('.ui.container .segment .fluid.main.steps').removeClass('large').addClass('tiny');
        window.$('.ui.container .segment .blue.fluid.button').removeClass('huge');
        window.$('#feedback-panel').hide();
    }else{
        window.$('.ui.container .segment .fluid.main.steps').removeClass('tiny').addClass('large');
        window.$('.ui.container .segment .blue.fluid.button').addClass('huge');
        window.$('#feedback-panel').show();
    }
}

function calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log) {
    // for calculating position of parallel lectures in schedule
    // TODO this algorithm needs improvement and doesn't work in some cases (ex. lecture continues between two other lectures)
    let lecture_num = 1;
    for (let i=0; i<lectures_log[weekday].length; i++){
        if(st_minutes >= lectures_log[weekday][i].st && st_minutes <= lectures_log[weekday][i].et
            || et_minutes >= lectures_log[weekday][i].st && et_minutes <= lectures_log[weekday][i].et){
            lecture_num++;
        }
    }
    return lecture_num;
}
function add_to_schedule(selector, lecture_info, weekday, start_time, end_time, color, pos_info, lectures_log) {
    const $title = window.$('<div>', {'class': 'title'});
    $title.html(lecture_info.course_name);
    let data_tooltip = '';
    if(lecture_info.group_number !== '')
        data_tooltip += `گروه: ${lecture_info.group_number}`;
    if(lecture_info.instructor_name !== '')
        data_tooltip += ` | استاد درس: ${lecture_info.instructor_name}`;
    if(lecture_info.classroom !== '')
        data_tooltip += ` | کلاس: ${lecture_info.classroom}`;
    if(lecture_info.exam_date !== '')
        data_tooltip += ` | تاریخ امتحان: ${lecture_info.exam_date}`;
    if(lecture_info.exam_time !== '')
        data_tooltip += ` | ساعت امتحان: ${lecture_info.exam_time}`;

    const $lecture = window.$('<div>', {
        'class': 'course lecture',
        'data-schedule-id': lecture_info.schedule_id,
        'data-course-id': lecture_info.course_id,
        'data-weekday': weekday,
        'data-tooltip': data_tooltip,
        'data-position': 'bottom center'
    });
    $lecture.html($title);
    $lecture.prepend(`
    <div class="ui inverted dimmer">
        <div class="ui loader"></div>
    </div>
    `);

    $lecture.css('background-color', color);

    const st = start_time.split(':');
    const et = end_time.split(':');
    const minutes = (parseInt(et[0])-parseInt(st[0]))*60 + (parseInt(et[1])-parseInt(st[1]));
    $lecture.css('width', pos_info.tblock_h*(minutes/15));

    selector.append($lecture);

    const st_minutes = parseInt(st[0])*60 + parseInt(st[1]) + 1;
    const et_minutes = parseInt(et[0])*60 + parseInt(et[1]);

    let lecture_num = 1;
    switch (weekday){
        case 'saturday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num*$lecture[0].offsetHeight + pos_info.timecol_w);
            break;
        case 'sunday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num*$lecture[0].offsetHeight + pos_info.timecol_w + pos_info.weekday_w);
            break;
        case 'monday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num*$lecture[0].offsetHeight + pos_info.timecol_w + 2*pos_info.weekday_w);
            break;
        case 'tuesday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num*$lecture[0].offsetHeight + pos_info.timecol_w + 3*pos_info.weekday_w);
            break;
        case 'wednesday':
            lecture_num = calculate_lecture_num(weekday, st_minutes, et_minutes, lectures_log);
            $lecture.css('right', 16 + lecture_num*$lecture[0].offsetHeight + pos_info.timecol_w + 4*pos_info.weekday_w);
            break;
    }

    lectures_log[weekday].push({
        id:lecture_info.course_id,
        st:st_minutes,
        et:et_minutes
    });

    const st_offset = (((parseInt(st[0])-8)*60+parseInt(st[1]))/15)*pos_info.tblock_h;
    $lecture.css('top', pos_info.top_offset + pos_info.header_h + pos_info.tblock_h + st_offset);
}
function draw_schedule(lectures_container,position_info) {
    let lectures_log = {
        saturday: [],
        sunday: [],
        monday: [],
        tuesday: [],
        wednesday: []
    };
    lectures_container.html('');
    for (let i=0; i<schedule_data.length; i++) {
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

    commons.feedbackInit();
    init_menu_btns();
    init_position();
    adjust_to_screen_size();

    if(elementExist('#p_student_home')){
        window.$('#p_student_home .unix.date').each(function (index,item) {
            let date = new persianDate(parseInt($(item).html()));
            $(item).html(date.format('D MMMM'));
        });
    }
    if(elementExist('#p_student_passedcourses')){
        // pass and unpass course
        const class_values = ['red', 'green', 'hidden', 'checkmark', 'remove'];
        const course_card = window.$('.ui.course.card');
        course_card.on('mouseenter', function(){
            if($(this).attr('data-state') === 'taken'){
                set_class(class_values, 'red', $(this));
                set_class(class_values, 'red', $(this).find('.right.corner.label'));
                set_class(class_values, 'remove', $(this).find('.right.corner.label i'));
            }else{
                set_class(class_values, 'green', $(this));
                set_class(class_values, 'green', $(this).find('.right.corner.label'));
                set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
            }
        });
        course_card.on('mouseleave', function(){
            if($(this).attr('data-state') === 'taken'){
                set_class(class_values, 'green', $(this));
                set_class(class_values, 'green', $(this).find('.right.corner.label'));
                set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
            }else{
                set_class(class_values, '', $(this));
                set_class(class_values, 'hidden', $(this).find('.right.corner.label'));
                set_class(class_values, '', $(this).find('.right.corner.label i'));
            }
        });
        course_card.on('click', function(){
            if($(this).attr('data-state') === 'taken'){
                const current_card = $(this);
                current_card.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: (document.location.origin+document.location.pathname).replace('passed-courses','') + current_card.attr('data-id') + '/unpass',
                    type: "POST",
                    success: function (result,status,xhr) {
                        current_card.attr('data-state', 'nottaken');
                        set_class(class_values, '', current_card);
                        set_class(class_values, 'hidden', current_card.find('.right.corner.label'));
                        set_class(class_values, '', current_card.find('.right.corner.label i'));
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function (xhr,status,error) {
                        // TODO error handling logic
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            }else{
                const current_card = $(this);
                current_card.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: (document.location.origin+document.location.pathname).replace('passed-courses','') + current_card.attr('data-id') + '/pass',
                    type: "POST",
                    success: function (result,status,xhr) {
                        current_card.attr('data-state', 'taken');
                        set_class(class_values, 'green', current_card);
                        set_class(class_values, 'green', current_card.find('.right.corner.label'));
                        set_class(class_values, 'checkmark', current_card.find('.right.corner.label i'));
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function (xhr,status,error) {
                        // TODO error handling logic
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            }
        });
    }
    if(elementExist('#p_student_semestercourses')){
        // convert english numbers to persian
        fix_persian_numbers('.ui.massive.inverted.center.aligned.segment');
        fix_persian_numbers('#units_summery .units div');
        // init course cards progress
        window.$('.ui.indicating.progress')
            .progress({
                label: 'ratio',
                text: {
                    active  : 'تا الان {value} نفر از {total} نفر حداقل مورد نیاز برای ارائه‌ی این درس آن را گرفته اند.',
                    success : 'بیش از {value} نفر این درس را گرفته اند! این درس در ترم جاری ارائه خواهد شد.',
                    ratio: '{value}/{total}'
                }
            });

        // take and untake course
        const class_values = ['red', 'green', 'hidden', 'checkmark', 'remove'];
        const course_card = window.$('.ui.course.card');
        course_card.on('mouseenter', function(){
            if($(this).attr('data-state') === 'taken'){
                set_class(class_values, 'red', $(this));
                set_class(class_values, 'red', $(this).find('.right.corner.label'));
                set_class(class_values, 'remove', $(this).find('.right.corner.label i'));
            }else{
                set_class(class_values, 'green', $(this));
                set_class(class_values, 'green', $(this).find('.right.corner.label'));
                set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
            }
        });
        course_card.on('mouseleave', function(){
            if($(this).attr('data-state') === 'taken'){
                set_class(class_values, 'green', $(this));
                set_class(class_values, 'green', $(this).find('.right.corner.label'));
                set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
            }else{
                set_class(class_values, '', $(this));
                set_class(class_values, 'hidden', $(this).find('.right.corner.label'));
                set_class(class_values, '', $(this).find('.right.corner.label i'));
            }
        });
        course_card.on('click', function(){
            const course_units = $(this).attr('data-units');
            const course_cat = $(this).attr('data-category') - 1;
            if($(this).attr('data-state') === 'taken'){
                const current_card = $(this);
                current_card.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: (document.location.origin+document.location.pathname).replace('semester-courses','') + current_card.attr('data-id') + '/untake',
                    type: "POST",
                    success: function (result,status,xhr) {
                        // fix course card state and view
                        current_card.attr('data-state', 'nottaken');
                        set_class(class_values, '', current_card);
                        set_class(class_values, 'hidden', current_card.find('.right.corner.label'));
                        set_class(class_values, '', current_card.find('.right.corner.label i'));

                        // fix units sum warning
                        const units_sum_circle = window.$('.category.sum i');
                        if(units_sum_circle.hasClass('warning yellow')){
                            units_sum_circle.removeClass('warning yellow').addClass('plus grey');
                            window.$('.units.sum').css('background-color', '#666666');
                        }

                        // set course card progress bar
                        let progress_value = current_card.find('.ui.indicating.progress').attr('data-value');
                        current_card.find('.ui.indicating.progress').attr('data-value', --progress_value);
                        current_card.find('.ui.indicating.progress').progress('set progress', progress_value);

                        // change category units value in summary panel
                        const $cat_units_d = window.$('.desktop .units.number:eq('+course_cat+') div');
                        const cat_units_d_value = $cat_units_d.attr('data-value');
                        $cat_units_d.html(+cat_units_d_value - +course_units);
                        $cat_units_d.attr('data-value', (+cat_units_d_value - +course_units));
                        const $cat_units_m = window.$('.mobile .units.number:eq('+course_cat+') div');
                        const cat_units_m_value = $cat_units_m.attr('data-value');
                        $cat_units_m.html(+cat_units_m_value - +course_units);
                        $cat_units_m.attr('data-value', (+cat_units_m_value - +course_units));

                        // change sum units value in summary panel
                        const $sum_units_d = window.$('.desktop .units.sum div:first');
                        const sum_units_d_value = $sum_units_d.attr('data-value');
                        $sum_units_d.html(+sum_units_d_value - +course_units);
                        $sum_units_d.attr('data-value', (+sum_units_d_value - +course_units));
                        const $sum_units_m = window.$('.mobile .units.sum div:first');
                        const sum_units_m_value = $sum_units_m.attr('data-value');
                        $sum_units_m.html(+sum_units_m_value - +course_units);
                        $sum_units_m.attr('data-value', (+sum_units_m_value - +course_units));

                        fix_persian_numbers('#units_summery .units div');

                        window.$('.desktop .category.button:eq('+course_cat+')').transition('pulse');
                        window.$('.mobile .category.button:eq('+course_cat+')').transition('pulse');

                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function (xhr,status,error) {
                        // TODO error handling logic
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            }else{
                const current_card = $(this);
                current_card.find('.inverted.dimmer').dimmer('toggle');
                window.$.ajax({
                    url: (document.location.origin+document.location.pathname).replace('semester-courses','') + current_card.attr('data-id') + '/take',
                    type: "POST",
                    success: function (result,status,xhr) {
                        if(result === 'UNITS_RANGE_ERROR'){
                            const units_sum_circle = window.$('.category.sum i');
                            units_sum_circle.removeClass('plus grey').addClass('warning yellow');
                            window.$('.category.sum').transition('shake');
                            window.$('.units.sum').css('background-color', '#E2AA08');
                        }else{
                            // fix course card state and view
                            current_card.attr('data-state', 'taken');
                            set_class(class_values, 'green', current_card);
                            set_class(class_values, 'green', current_card.find('.right.corner.label'));
                            set_class(class_values, 'checkmark', current_card.find('.right.corner.label i'));

                            // fix units sum warning
                            const units_sum_circle = window.$('.category.sum i');
                            if(units_sum_circle.hasClass('warning yellow')){
                                units_sum_circle.removeClass('warning yellow').addClass('plus grey');
                                window.$('.units.sum').css('background-color', '#666666');
                            }

                            // set course card progress bar
                            let progress_value = current_card.find('.ui.indicating.progress').attr('data-value');
                            current_card.find('.ui.indicating.progress').attr('data-value', ++progress_value);
                            current_card.find('.ui.indicating.progress').progress('set progress', progress_value);

                            // change category units value in summary panel
                            const $cat_units_d = window.$('.desktop .units.number:eq('+course_cat+') div');
                            const cat_units_d_value = $cat_units_d.attr('data-value');
                            $cat_units_d.html(+cat_units_d_value + +course_units);
                            $cat_units_d.attr('data-value', (+cat_units_d_value + +course_units));
                            const $cat_units_m = window.$('.mobile .units.number:eq('+course_cat+') div');
                            const cat_units_m_value = $cat_units_m.attr('data-value');
                            $cat_units_m.html(+cat_units_m_value + +course_units);
                            $cat_units_m.attr('data-value', (+cat_units_m_value + +course_units));

                            // change sum units value in summary panel
                            const $sum_units_d = window.$('.desktop .units.sum div:first');
                            const sum_units_d_value = $sum_units_d.attr('data-value');
                            $sum_units_d.html(+sum_units_d_value + +course_units);
                            $sum_units_d.attr('data-value', (+sum_units_d_value + +course_units));
                            const $sum_units_m = window.$('.mobile .units.sum div:first');
                            const sum_units_m_value = $sum_units_m.attr('data-value');
                            $sum_units_m.html(+sum_units_m_value + +course_units);
                            $sum_units_m.attr('data-value', (+sum_units_m_value + +course_units));

                            fix_persian_numbers('#units_summery .units div');

                            window.$('.desktop .category.button:eq('+course_cat+')').transition('jiggle');
                            window.$('.mobile .category.button:eq('+course_cat+')').transition('jiggle');
                        }
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    },
                    error: function (xhr,status,error) {
                        // TODO error handling logic
                        current_card.find('.inverted.dimmer').dimmer('toggle');
                    }
                });
            }
        });

        // units summery desktop
        window.$('#units_summery.desktop .category.sum').popup({
            on: 'hover',
            transition: 'fade down'
        });
        window.$('#units_summery.desktop .category.button').hover(
            function () {
                $(this).siblings('.units').animate({width: '56px'},250, function () {
                    $(this).find('div').show();
                });
            },
            function () {
                $(this).siblings('.units').animate({width: '0px'},250, function () {
                    $(this).find('div').hide();
                });
            }
        );
        window.$('#units_summery.desktop .category.sum').hover(
            function () {
                $(this).siblings('.units').animate({width: '84px'},250, function () {
                    $(this).find('div').show();
                });
                $('.units.number').animate({width: '56px'},250, function () {
                    $(this).find('div').show();
                });
            },
            function () {
                $(this).siblings('.units').animate({width: '0px'},250, function () {
                    $(this).find('div').hide();
                });
                $('.units.number').animate({width: '0px'},250, function () {
                    $(this).find('div').hide();
                });
            }
        );
        // units summery mobile
        window.$('#units_summery.mobile .category.sum').popup({
            on: 'hover',
            transition: 'fade down',
            onVisible: function(){
                window.$('.ui.popup').animate({bottom: '+=56px'},250);
            }
        });
        window.$('#units_summery.mobile .category.button').hover(
            function () {
                $(this).siblings('.units').css('width','56px').animate({top: '-56px'},250, function () {
                    $(this).find('div').show();
                });
            },
            function () {
                $(this).siblings('.units').animate({top: '0px'},250, function () {
                    $(this).css('width','0');
                    $(this).find('div').hide();
                });
            }
        );
        window.$('#units_summery.mobile .category.sum').hover(
            function () {
                $(this).siblings('.units').css('width','56px').animate({top: '-56px'},250, function () {
                    $(this).find('div').show();
                });
                $('.units.number').css('width','56px').animate({top: '-56px'},250, function () {
                    $(this).find('div').show();
                });
            },
            function () {
                $(this).siblings('.units').animate({top: '0px'},250, function () {
                    $(this).css('width','0');
                    $(this).find('div').hide();
                });
                $('.units.number').animate({top: '0px'},250, function () {
                    $(this).css('width','0');
                    $(this).find('div').hide();
                });
            }
        );
    }
    if(elementExist('#p_student_instructorsuggestion')){
        const course_card = window.$('.ui.course.card');
        const instructor_cards = window.$('.ui.instructor.card');
        const instructor_suggest_modal = window.$('#instructor_suggest.modal');
        const class_values = ['red', 'green', 'hidden', 'legal', 'checkmark', 'remove'];
        course_card.hover(
            function () {
                if($(this).attr('data-state') === 'voted'){
                    $(this).find('.right.corner.label i').transition('flash');
                }else{
                    set_class(class_values, 'green', $(this));
                    set_class(class_values, 'green', $(this).find('.right.corner.label'));
                    set_class(class_values, 'legal', $(this).find('.right.corner.label i'));
                }
            },
            function () {
                if($(this).attr('data-state') !== 'voted'){
                    set_class(class_values, '', $(this));
                    set_class(class_values, 'hidden', $(this).find('.right.corner.label'));
                    set_class(class_values, '', $(this).find('.right.corner.label i'));
                }
            }
        );
        course_card.on('click', function(){
            const current_card = $(this);
            current_card.find('.inverted.dimmer').dimmer('toggle');
            window.$.ajax({
                url: (document.location.origin+document.location.pathname).replace('instructor-suggestion','') + current_card.attr('data-id') + '/votes',
                type: "GET",
                success: function (result, status, xhr) {
                    instructor_cards.each(function(index,item){
                        $(item).attr('data-state', 'notselected');
                        set_class(class_values, '', $(item));
                        set_class(class_values, 'hidden', $(item).find('.right.corner.label'));
                        set_class(class_values, '', $(item).find('.right.corner.label i'));
                    });
                    for (let i=0; i<result.length; i++){
                        let instructor_card = window.$('#instructor_'+result[i]);
                        instructor_card.attr('data-state', 'selected');
                        set_class(class_values, 'green', instructor_card);
                        set_class(class_values, 'green', instructor_card.find('.right.corner.label'));
                        set_class(class_values, 'checkmark', instructor_card.find('.right.corner.label i'));
                    }
                    current_card.find('.inverted.dimmer').dimmer('toggle');
                    instructor_suggest_modal.attr('data-id', current_card.attr('data-id'));
                    instructor_suggest_modal.modal('show');
                },
                error: function (xhr, status, error) {
                    // TODO error handling logic
                    current_card.find('.inverted.dimmer').dimmer('toggle');
                }
            });
        });
        instructor_cards.hover(
            function () {
                if($(this).attr('data-state') === 'selected'){
                    set_class(class_values, 'red', $(this));
                    set_class(class_values, 'red', $(this).find('.right.corner.label'));
                    set_class(class_values, 'remove', $(this).find('.right.corner.label i'));
                }else{
                    set_class(class_values, 'green', $(this));
                    set_class(class_values, 'green', $(this).find('.right.corner.label'));
                    set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
                }
            },
            function () {
                if($(this).attr('data-state') === 'selected'){
                    set_class(class_values, 'green', $(this));
                    set_class(class_values, 'green', $(this).find('.right.corner.label'));
                    set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
                }else{
                    set_class(class_values, '', $(this));
                    set_class(class_values, 'hidden', $(this).find('.right.corner.label'));
                    set_class(class_values, '', $(this).find('.right.corner.label i'));
                }
            }
        );
        instructor_cards.on('click', function(){
            $(this).find('.inverted.dimmer').dimmer('toggle');
            if($(this).attr('data-state') === 'selected'){
                $(this).attr('data-state', 'notselected');
                set_class(class_values, '', $(this));
                set_class(class_values, 'hidden', $(this).find('.right.corner.label'));
                set_class(class_values, '', $(this).find('.right.corner.label i'));
            }else{
                $(this).attr('data-state', 'selected');
                set_class(class_values, 'green', $(this));
                set_class(class_values, 'green', $(this).find('.right.corner.label'));
                set_class(class_values, 'checkmark', $(this).find('.right.corner.label i'));
            }
            $(this).find('.inverted.dimmer').dimmer('toggle');
        });
        instructor_suggest_modal.modal({
            onApprove : function () {
                const instructor_data = [];
                instructor_cards.each(function (index, item) {
                    instructor_data.push({
                        id: $(item).attr('data-id'),
                        state: $(item).attr('data-state')
                    });
                });
                window.$.ajax({
                    url: (document.location.origin+document.location.pathname).replace('instructor-suggestion','') + instructor_suggest_modal.attr('data-id') + '/vote',
                    type: "POST",
                    data: JSON.stringify(instructor_data),
                    contentType: "application/json",
                    success: function (result, status, xhr) {
                        // TODO show success before redirect
                        window.location = document.location.origin + '/student/instructor-suggestion';
                    },
                    error: function (xhr, status, error) {
                        // TODO error handling logic
                    }
                });
            }
        });
    }
    if(elementExist('#p_student_evaluate_schedule')){
        window.$('#p_student_evaluate_schedule .unix.date').each(function (index,item) {
            let date = new persianDate(parseInt($(item).html()));
            $(item).html(date.format('D MMMM'));
        });
        fix_persian_numbers('.p_number');

        // scheduler info
        const position_info = {
            top_offset: window.$('#schedule_table table')[0].offsetTop,
            header_h: window.$('#schedule_table table thead tr')[0].offsetHeight,
            tblock_h: window.$('#schedule_table table tbody tr')[0].offsetHeight / 2,
            timecol_w: window.$('#schedule_table table tbody tr td:first-child')[0].offsetWidth,
            weekday_w: window.$('#schedule_table table thead tr th:last-child')[0].offsetWidth
        };
        const lectures_container = window.$('#schedule_table .schedule');
        draw_schedule(lectures_container,position_info);

        const lecture_blocks = lectures_container.find('.course.lecture');
        const evaluate_lecture_modal = window.$('#evaluate_lecture');
        lecture_blocks.on('click', function () {
            const schedule_id = $(this).attr('data-schedule-id');
            const lecture_blocks_dimmer = $(this).find('.ui.inverted.dimmer');
            lecture_blocks_dimmer.dimmer('toggle');
            window.$.ajax({
                url: document.location.origin + document.location.pathname + '/' + schedule_id + '/modal',
                type: "GET",
                success: function (result,status,xhr) {
                    evaluate_lecture_modal.html(result);
                    evaluate_lecture_modal.find('input[name=schedule_id]').val(schedule_id);
                    fix_persian_numbers('.p_number');
                    evaluate_lecture_modal.find('.menu .item').tab({
                        onLoad: function () {
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
                    let dp = evaluate_lecture_modal.find('input[name=suggested_exam_date]').persianDatepicker({
                        initialValue: false,
                        observer: true,
                        autoClose: true,
                        format: 'YYYY/MM/DD',
                        altField: '#evaluate_lecture input[name=suggested_exam_date_unix]',
                        'toolbox': {
                            'enabled': false
                        }
                    });
                    if(elementExist('#evaluate_lecture input[name=suggested_exam_date_unix]')){
                        if(evaluate_lecture_modal.find('input[name=suggested_exam_date_unix]').val() !== ''){
                            dp.setDate(parseInt(evaluate_lecture_modal.find('input[name=suggested_exam_date_unix]').val()));
                        }
                    }
                    evaluate_lecture_modal.find('form').form({
                        fields: {
                            suggestion_reason_1 : 'maxLength[250]',
                            suggestion_reason_2 : 'maxLength[250]',
                            exam_suggestion_reason : 'maxLength[250]',
                            privacy : 'empty'
                        }
                    });
                    evaluate_lecture_modal.find('form').on('submit', function () {
                        let ret_value = true;
                        if(evaluate_lecture_modal.find('select[name=suggested_weekday_1]').val() === ''
                            && evaluate_lecture_modal.find('select[name=suggested_weekday_2]').val() === ''
                            && evaluate_lecture_modal.find('input[name=suggested_exam_date]').val() === '')
                        {
                            if(ret_value)
                                evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                            evaluate_lecture_modal.find('form').addClass('error');
                            evaluate_lecture_modal.find('select[name=suggested_weekday_1]').parent().parent().parent().addClass('error');
                            evaluate_lecture_modal.find('select[name=suggested_weekday_2]').parent().parent().parent().addClass('error');
                            evaluate_lecture_modal.find('input[name=suggested_exam_date]').parent().parent().addClass('error');
                            evaluate_lecture_modal.find('textarea[name=suggestion_reason_1]').parent().addClass('error');
                            evaluate_lecture_modal.find('textarea[name=suggestion_reason_2]').parent().addClass('error');
                            evaluate_lecture_modal.find('textarea[name=exam_suggestion_reason]').parent().addClass('error');
                            ret_value = false;
                        }
                        if(evaluate_lecture_modal.find('select[name=suggested_weekday_1]').val() !== ''){
                            if(evaluate_lecture_modal.find('input[name=suggested_start_time_1]').val() === ''
                                || evaluate_lecture_modal.find('input[name=suggested_end_time_1]').val() === ''
                                || evaluate_lecture_modal.find('textarea[name=suggestion_reason_1]').val() === '')
                            {
                                if(ret_value)
                                    evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                                evaluate_lecture_modal.find('form').addClass('error');
                                evaluate_lecture_modal.find('select[name=suggested_weekday_1]').parent().parent().parent().addClass('error');
                                evaluate_lecture_modal.find('textarea[name=suggestion_reason_1]').parent().addClass('error');
                                ret_value = false;
                            }
                        }
                        if(evaluate_lecture_modal.find('select[name=suggested_weekday_2]').val() !== ''){
                            if(evaluate_lecture_modal.find('input[name=suggested_start_time_2]').val() === ''
                                || evaluate_lecture_modal.find('input[name=suggested_end_time_2]').val() === ''
                                || evaluate_lecture_modal.find('textarea[name=suggestion_reason_2]').val() === '')
                            {
                                if(ret_value)
                                    evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
                                evaluate_lecture_modal.find('form').addClass('error');
                                evaluate_lecture_modal.find('select[name=suggested_weekday_2]').parent().parent().parent().addClass('error');
                                evaluate_lecture_modal.find('textarea[name=suggestion_reason_2]').parent().addClass('error');
                                ret_value = false;
                            }
                        }
                        if(evaluate_lecture_modal.find('input[name=suggested_exam_date]').val() !== ''){
                            if(evaluate_lecture_modal.find('input[name=suggested_exam_date_unix]').val() === ''
                                || evaluate_lecture_modal.find('input[name=suggested_exam_time]').val() === ''
                                || evaluate_lecture_modal.find('textarea[name=exam_suggestion_reason]').val() === '')
                            {
                                if(ret_value)
                                    evaluate_lecture_modal.find('form,form .field,form .fields').removeClass('error');
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
                    evaluate_lecture_modal.find('#delete_btn').on('click', function (){
                        evaluate_lecture_modal.find('#delete_form').submit();
                    });
                    let upvote_btn = evaluate_lecture_modal.find('.card #upvote');
                    let downvote_btn = evaluate_lecture_modal.find('.card #downvote');
                    upvote_btn.hover(
                        function () {
                            $(this).toggleClass('blue-color');
                            if($(this).hasClass('blue-color')){
                                $(this).find('span').html((parseInt($(this).find('span').html())+1).toString());
                            }else{
                                $(this).find('span').html((parseInt($(this).find('span').html())-1).toString());
                            }
                        },
                        function () {
                            $(this).toggleClass('blue-color');
                            if($(this).hasClass('blue-color')){
                                $(this).find('span').html((parseInt($(this).find('span').html())+1).toString());
                            }else{
                                $(this).find('span').html((parseInt($(this).find('span').html())-1).toString());
                            }
                        }
                    );
                    downvote_btn.hover(
                        function () {
                            $(this).toggleClass('red-color');
                            if($(this).hasClass('red-color')){
                                $(this).find('span').html((parseInt($(this).find('span').html())-1).toString());
                            }else{
                                $(this).find('span').html((parseInt($(this).find('span').html())+1).toString());
                            }
                        },
                        function () {
                            $(this).toggleClass('red-color');
                            if($(this).hasClass('red-color')){
                                $(this).find('span').html((parseInt($(this).find('span').html())-1).toString());
                            }else{
                                $(this).find('span').html((parseInt($(this).find('span').html())+1).toString());
                            }
                        }
                    );
                    upvote_btn.on('click', function () {
                        let evaluation_id = $(this).attr('data-id');
                        let card_dimmer = $(this).parent().siblings('.dimmer');
                        let value = '0';
                        if($(this).hasClass('blue-color')){
                            value = '1';
                        }
                        let this_upvote = $(this);
                        card_dimmer.dimmer('toggle');
                        window.$.ajax({
                            url: (document.location.origin+document.location.pathname).replace('evaluate-schedule','evaluation/') + evaluation_id + '/upvote/' + value,
                            type: "POST",
                            success: function (result,status,xhr) {
                                this_upvote.find('span').html(result[0]);
                                this_upvote.siblings('#downvote').find('span').html(result[1]);

                                if(!this_upvote.hasClass('blue-color') && value === '1'){
                                    this_upvote.addClass('blue-color');
                                }else{
                                    this_upvote.removeClass('blue-color');
                                }

                                if(this_upvote.siblings('#downvote').hasClass('red-color')){
                                    this_upvote.siblings('#downvote').removeClass('red-color')
                                }
                                card_dimmer.dimmer('toggle');
                            },
                            error: function (xhr,status,error) {
                                // TODO error handling logic
                                card_dimmer.dimmer('toggle');
                            }
                        });
                    });
                    downvote_btn.on('click', function () {
                        let evaluation_id = $(this).attr('data-id');
                        let card_dimmer = $(this).parent().siblings('.dimmer');
                        let value = '0';
                        if($(this).hasClass('red-color')){
                            value = '1';
                        }
                        let this_downvote = $(this);
                        card_dimmer.dimmer('toggle');
                        window.$.ajax({
                            url: (document.location.origin+document.location.pathname).replace('evaluate-schedule','evaluation/') + evaluation_id + '/downvote/' + value,
                            type: "POST",
                            success: function (result,status,xhr) {
                                this_downvote.find('span').html(result[1]);
                                this_downvote.siblings('#upvote').find('span').html(result[0]);

                                if(!this_downvote.hasClass('red-color') && value === '1'){
                                    this_downvote.addClass('red-color');
                                }else{
                                    this_downvote.removeClass('red-color');
                                }

                                if(this_downvote.siblings('#upvote').hasClass('blue-color')){
                                    this_downvote.siblings('#upvote').removeClass('blue-color')
                                }
                                card_dimmer.dimmer('toggle');
                            },
                            error: function (xhr,status,error) {
                                // TODO error handling logic
                                card_dimmer.dimmer('toggle');
                            }
                        });
                    });
                    evaluate_lecture_modal.modal('show');
                    lecture_blocks_dimmer.dimmer('toggle');
                },
                error: function (xhr,status,error) {
                    // TODO error handling logic
                    lecture_blocks_dimmer.dimmer('toggle');
                }
            });
        });
        // init messages
        if(elementExist('#p_student_evaluate_schedule .message.session')){
            const message_box = window.$('#p_student_evaluate_schedule .message.session');
            const container_width = window.$('.ui.container')[0].offsetWidth;
            message_box.css('left',((window.innerWidth-container_width-16)/2).toString()+'px');
            message_box.css('display','block');
            window.$('#p_student_evaluate_schedule .message.session .close').on('click', function() {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if(!window.$('#p_student_evaluate_schedule .message.session').hasClass('hidden'))
                    window.$('#p_student_evaluate_schedule .message.session').transition('fade');
            },4000);
        }
    }
    if(elementExist('#p_student_final_schedule')){
        // scheduler info
        const position_info = {
            top_offset: window.$('#schedule_table table')[0].offsetTop,
            header_h: window.$('#schedule_table table thead tr')[0].offsetHeight,
            tblock_h: window.$('#schedule_table table tbody tr')[0].offsetHeight / 2,
            timecol_w: window.$('#schedule_table table tbody tr td:first-child')[0].offsetWidth,
            weekday_w: window.$('#schedule_table table thead tr th:last-child')[0].offsetWidth
        };
        const lectures_container = window.$('#schedule_table .schedule');
        draw_schedule(lectures_container,position_info);
    }
    if(elementExist('#p_student_edit_information')){
        window.$('.ui.dropdown').dropdown();
        // init messages
        if(elementExist('.message.session')){
            window.$('.message.session .close').on('click', function() {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if(!window.$('.message.session').hasClass('hidden'))
                    window.$('.message.session').transition('fade');
            },4000);
        }
    }
    if(elementExist('#p_student_change_password')){
        // init messages
        if(elementExist('.message.session')){
            window.$('.message.session .close').on('click', function() {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if(!window.$('.message.session').hasClass('hidden'))
                    window.$('.message.session').transition('fade');
            },4000);
        }
    }
}

window.$(function () {
    pagesInit();
    window.$(window).resize(function(){
        init_position();
        adjust_to_screen_size();
    });
});