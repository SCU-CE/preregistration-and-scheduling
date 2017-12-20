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
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};
const hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}
//Function to convert rgb color to hex format
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
function persian_weekday(weekday) {
    switch (weekday){
        case 'saturday':
            return 'شنبه';
            break;
        case 'sunday':
            return 'یکشنبه';
            break;
        case 'monday':
            return 'دوشنبه';
            break;
        case 'tuesday':
            return 'سه شنبه';
            break;
        case 'wednesday':
            return 'چهارشنبه';
            break;
    }
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
function add_instructor_validation() {
    window.$('#p_admin_instructors .ui.form')
        .form({
            fields: {
                instructor_name: {
                    identifier  : 'instructor_name',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نام استاد را وارد کنید.'
                        }
                    ]
                },
                sex: {
                    identifier  : 'sex',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا جنسیت استاد را انتخاب کنید.'
                        }
                    ]
                },
                profile_link: {
                    identifier  : 'profile_link',
                    rules: [
                    ]
                },
                photo: {
                    identifier  : 'photo',
                    rules: [
                    ]
                }
            }
        })
    ;
}
function edit_instructor_validation() {
    window.$('#edit_instructor .ui.form')
        .form({
            fields: {
                instructor_name: {
                    identifier  : 'instructor_name',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نام استاد را وارد کنید.'
                        }
                    ]
                },
                sex: {
                    identifier  : 'sex',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا جنسیت استاد را انتخاب کنید.'
                        }
                    ]
                },
                profile_link: {
                    identifier  : 'profile_link',
                    rules: [
                    ]
                },
                photo: {
                    identifier  : 'photo',
                    rules: [
                    ]
                }
            }
        })
    ;
}
function add_semester_validation() {
    window.$('#p_admin_semesters .ui.form')
        .form({
            fields: {
                semester: {
                    identifier  : 'semester',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نوبت ترم را انتخاب کنید.'
                        }
                    ]
                },
                year: {
                    identifier  : 'year',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا سال ترم را وارد کنید.'
                        },
                        {
                            type   : 'number',
                            prompt : 'سال ترم باید به شکل عددی باشد.'
                        },
                        {
                            type   : 'exactLength[4]',
                            prompt : 'سال ترم باید 4 رقم داشته باشد.'
                        }
                    ]
                },
            }
        })
    ;
}
function edit_semester_validation() {
    window.$('#edit_semester .ui.form')
        .form({
            fields: {
                semester: {
                    identifier  : 'semester',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا نوبت ترم را انتخاب کنید.'
                        }
                    ]
                },
                year: {
                    identifier  : 'year',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'لطفا سال ترم را وارد کنید.'
                        },
                        {
                            type   : 'number',
                            prompt : 'سال ترم باید به شکل عددی باشد.'
                        },
                        {
                            type   : 'exactLength[4]',
                            prompt : 'سال ترم باید 4 رقم داشته باشد.'
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
    
    //
    const logout_btns = window.$('.basic.logout.icon.button');
    logout_btns.on('click', function () {
        window.$('#logout_form').submit();
    });
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
    if(elementExist('#p_admin_scheduling')) {
        adjust_cards_number();
    }

    const mobile_vmenu = window.$('.mobile.vertical.menu');

    if(screen.width < 768) {

    }else{
        if(!mobile_vmenu.hasClass('hidden')){
            mobile_vmenu.removeClass('visible');
            mobile_vmenu.addClass('hidden');
        }
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
function lecture_blocks_click(selector,course_group_tab_btns,course_groups_tab,approve_btn,remove_schedule_btn,add_schedule_modal,return_btn,scheduling_stage) {
    selector.on('click', function () {
        const lecture_blocks_dimmer = $(this).find('.ui.inverted.dimmer');
        lecture_blocks_dimmer.dimmer('toggle');
        course_id = $(this).attr('data-course-id');
        add_schedule_modal.find('#course_info .top.attached.tabular.menu a[data-tab=evaluations]').remove();
        add_schedule_modal.find('#course_info .bottom.attached.tab.segment[data-tab=evaluations]').remove();
        add_schedule_modal.find('#course_info .top.attached.tabular.menu a').removeClass('active');
        add_schedule_modal.find('#course_info .top.attached.tabular.menu a:first').addClass('active');
        add_schedule_modal.find('#course_info .bottom.attached.tab.segment').removeClass('active');
        add_schedule_modal.find('#course_info .bottom.attached.tab.segment:first').addClass('active');
        window.$.ajax({
            url: document.location.origin + '/admin/scheduling/' + course_id + '/information',
            type: "GET",
            success: function (result,status,xhr) {
                //
                course_group_tab_btns.find('a.new').remove();
                const tab_btn =  course_group_tab_btns.find('a:first-child');
                tab_btn.removeClass('active').addClass('active');
                course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').addClass('disabled');
                course_groups_tab.find('.bottom.attached.tab.segment.new').remove();
                const tab_content = course_groups_tab.find('.bottom.attached.tab.segment');
                tab_content.removeClass('active').addClass('active');

                const schedule_info = result.schedule_info;
                for (let i=0; i<schedule_info.length; i++){
                    if(i==0) {
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
                        const course_color_preview = tab_content.find('.block.preview');
                        course_color_preview.html(schedule_info[i].course_name);
                        course_color_preview.css('background-color', schedule_info[i].course_color);
                        course_color_preview.on('click', function () {
                            random_color = randomColor();
                            $(this).css('background-color', random_color);
                            $(this).siblings('input').val(random_color)
                        });
                        const dp = tab_content.find('form input[name=exam_date]').persianDatepicker({
                            initialValue: false,
                            observer: true,
                            autoClose: true,
                            format: 'YYYY/MM/DD',
                            altField: '#add_schedule.modal .scrolling.content form:eq(' + (parseInt(schedule_info[i].group_number) - 1).toString() + ') input[name=exam_date_unix]',
                            'toolbox': {
                                'enabled': false
                            }
                        });
                        if(schedule_info[i].exam_date_unix !== null)
                            dp.setDate(parseInt(schedule_info[i].exam_date_unix));
                    } else {
                        let new_tab_btn = tab_btn.clone().removeClass('active').addClass('new');
                        new_tab_btn.attr('data-tab',(i+1).toString());
                        new_tab_btn.html('گروه ' + (i+1).toString());
                        course_group_tab_btns.append(new_tab_btn);
                        course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').removeClass('disabled');

                        let new_tab_content = tab_content.clone().removeClass('active').addClass('new');
                        new_tab_content.attr('data-tab',(i+1).toString());
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
                        const course_color_preview = new_tab_content.find('.block.preview');
                        course_color_preview.html(schedule_info[i].course_name);
                        course_color_preview.css('background-color', schedule_info[i].course_color);
                        course_color_preview.on('click', function () {
                            random_color = randomColor();
                            $(this).css('background-color', random_color);
                            $(this).siblings('input').val(random_color)
                        });
                        const dp = new_tab_content.find('form input[name=exam_date]').persianDatepicker({
                            initialValue: false,
                            observer: true,
                            autoClose: true,
                            format: 'YYYY/MM/DD',
                            altField: '#add_schedule.modal .scrolling.content form:eq('+(parseInt(schedule_info[i].group_number)-1).toString()+') input[name=exam_date_unix]',
                            'toolbox': {
                                'enabled': false
                            }
                        });
                        if(schedule_info[i].exam_date_unix !== null)
                            dp.setDate(parseInt(schedule_info[i].exam_date_unix));
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
                const instructors_info = result.instructors_info;
                let instructors_info_rows = '';
                for(let i=0; i<instructors_info.length; i++){
                    if(instructors_info[i].photo === null){
                        if(instructors_info[i].sex === 'مرد'){
                            instructors_info[i].photo = 'instructor_photos/img_male.png';
                        }else {
                            instructors_info[i].photo = 'instructor_photos/img_female.png';
                        }
                    }
                    instructors_info_rows += `
                            <div class="row">
                                <div class="photo" data-tooltip="${instructors_info[i].name}" data-position="right center">
                                    <img class="ui mini circular image" src="/storage/${instructors_info[i].photo}">
                                </div>
                                <div class="progress">
                                    <div class="ui indicating progress" data-value="${instructors_info[i].votes}" data-total="${instructors_info[0].votes}">
                                        <div class="bar"></div>
                                    </div>
                                </div>
                                <div class="votes">
                                    ${instructors_info[i].votes}
                                </div>
                            </div>
                        `;
                }
                if(instructors_info_rows !== ''){
                    window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html(instructors_info_rows);
                    window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors .progress').progress();
                }else{
                    window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html('برای این درس استادی پیشنهاد نشده است.');
                }
                //
                const course_conflicts = result.course_conflicts;
                let course_conflicts_tbody = '';
                for(let i=0; i<course_conflicts.length; i++){
                    course_conflicts_tbody += '<tr><td>'+(i+1)+'</td><td>'+ course_conflicts[i].code +'</td><td>'+ course_conflicts[i].name +'</td><td>'+ course_conflicts[i].count +'</td></tr>';
                }
                if(course_conflicts_tbody !== '') {
                    window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html(course_conflicts_tbody);
                }else {
                    window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html('<tr><td colspan="4">برای این درس تداخلی وجود ندارد.</td></tr>');
                }
                //
                const course_students = result.course_students;
                let course_students_tbody = '';
                for(let i=0; i<course_students.length; i++){
                    course_students_tbody += '<tr><td>'+(i+1)+'</td><td>'+ course_students[i].first_name +'</td><td>'+ course_students[i].last_name +'</td><td>'+ course_students[i].student_id +'</td><td>'+ course_students[i].entry_year +'</td></tr>';
                }
                if(course_students_tbody !== '') {
                    window.$('#add_schedule.modal .scrolling.content table.students tbody').html(course_students_tbody);
                }else {
                    window.$('#add_schedule.modal .scrolling.content table.students tbody').html('<tr><td colspan="5">دانشجویی این درس را اخذ نکرده است.</td></tr>');
                }
                //
                if(scheduling_stage === '2nd'){
                    const course_evaluation = result.course_evaluation;
                    if(course_evaluation.length > 0){
                    add_schedule_modal.find('#course_info .top.attached.tabular.menu').append(`
                                    <a class="item fw-400" data-tab="evaluations">درخواست های دانشجویان</a>
                                `);
                    let course_evaluation_tab_content = '';
                    course_evaluation_tab_content += `<div class="ui bottom attached tab segment" data-tab="evaluations"><div class="ui text container">`;
                    for(let i=0; i<course_evaluation.length; i++){
                        course_evaluation_tab_content += `
                                    <div class="ui fluid inverted card">
                                        <div class="ui inverted dimmer">
                                            <div class="ui loader"></div>
                                        </div>
                                        <div class="content">
                                            <div class="ui divided selection list">
                                    `;
                        if(course_evaluation[i].suggested_weekday_1 !== null){
                            course_evaluation_tab_content += `
                                        <a class="item">
                                            <div class="ui blue large horizontal label fw-400" style="padding: 1rem">تغییر جلسه اول</div>
                                            <span style="font-size: 1.2rem">
                                                <span>از </span>
                                                <span>${persian_weekday(course_evaluation[i].weekday_1)}</span>
                                                <span class="p_number">${course_evaluation[i].start_time_1.substr(0,5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].end_time_1.substr(0,5)}</span>
                                                <span> به </span>
                                                <span>${persian_weekday(course_evaluation[i].suggested_weekday_1)}</span>
                                                <span class="p_number">${course_evaluation[i].suggested_start_time_1.substr(0,5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].suggested_end_time_1.substr(0,5)}</span>
                                            </span>
                                            <div style="margin-top: .5rem">
                                                <div class="ui green fluid basic label">
                                                    <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                                    <span style="line-height: 2rem">${course_evaluation[i].suggestion_reason_1}</span>
                                                </div>
                                            </div>
                                        </a>
                                        `;
                        }
                        if(course_evaluation[i].suggested_weekday_2 !== null){
                            course_evaluation_tab_content += `
                                        <a class="item">
                                            <div class="ui blue large horizontal label fw-400" style="padding: 1rem">تغییر جلسه اول</div>
                                            <span style="font-size: 1.2rem">
                                                <span>از </span>
                                                <span>${persian_weekday(course_evaluation[i].weekday_2)}</span>
                                                <span class="p_number">${course_evaluation[i].start_time_2.substr(0,5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].end_time_2.substr(0,5)}</span>
                                                <span> به </span>
                                                <span>${persian_weekday(course_evaluation[i].suggested_weekday_2)}</span>
                                                <span class="p_number">${course_evaluation[i].suggested_start_time_2.substr(0,5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].suggested_end_time_2.substr(0,5)}</span>
                                            </span>
                                            <div style="margin-top: .5rem">
                                                <div class="ui green fluid basic label">
                                                    <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                                    <span style="line-height: 2rem">${course_evaluation[i].suggestion_reason_2}</span>
                                                </div>
                                            </div>
                                        </a>
                                        `;
                        }
                        if(course_evaluation[i].suggested_exam_date !== null){
                            course_evaluation_tab_content += `
                                        <a class="item">
                                            <div class="ui red large horizontal label fw-400" style="padding: 1rem">تغییر امتحان</div>
                                            <span style="font-size: 1.2rem">
                                                <span>از </span>
                                                <span>${course_evaluation[i].exam_date}</span>
                                                <span> ساعت </span><span class="p_number">${course_evaluation[i].exam_time.substr(0,5)}</span>
                                                <span> به </span>
                                                <span>${course_evaluation[i].suggested_exam_date}</span>
                                                <span> ساعت </span><span class="p_number">${course_evaluation[i].suggested_exam_time.substr(0,5)}</span>
                                            </span>
                                            <div style="margin-top: .5rem">
                                                <div class="ui green fluid basic label">
                                                    <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                                    <span style="line-height: 2rem">${course_evaluation[i].exam_suggestion_reason}</span>
                                                </div>
                                            </div>
                                        </a>
                                        `;
                        }
                        course_evaluation_tab_content += `</div></div>`;
                        if(course_evaluation[i].privacy === 'public'){
                            let upvotes_color = '';
                            let downvotes_color = '';
                            if(course_evaluation[i].upvotes > 0){
                                upvotes_color = ' blue-color';
                            }
                            if(course_evaluation[i].downvotes < 0){
                                downvotes_color = ' red-color';
                            }
                            course_evaluation_tab_content += `
                                            <div class="extra content">
                                                <div class="left floated${upvotes_color}" style="direction: ltr">
                                                    <i class="thumbs outline up big icon"></i>
                                                    <span>${course_evaluation[i].upvotes}</span>
                                                </div>
                                                <div class="right floated${downvotes_color}" style="direction: ltr">
                                                    <i class="thumbs outline down big icon"></i>
                                                    <span>${course_evaluation[i].downvotes}</span>
                                                </div>
                                            </div>
                                        </div>
                                        `;
                        }else{
                            course_evaluation_tab_content += `
                                            <div class="extra content" style="text-align: center">
                                                <span>درخواست شخصی</span>
                                            </div>
                                        </div>
                                        `;
                        }
                    }
                    course_evaluation_tab_content += `</div></div>`;

                    add_schedule_modal.find('#course_info').append(course_evaluation_tab_content);
                    add_schedule_modal.find('#course_info .menu .item').tab();
                    fix_persian_numbers('.p_number');
                }
                }
                //
                approve_btn.find('span').html('ویرایش برنامه');
                approve_btn.find('i').removeClass('checkmark').addClass('write');
                remove_schedule_btn.show();
                return_btn.hide();
                //
                lecture_blocks_dimmer.dimmer('toggle');
                add_schedule_modal.modal('show');
            },
            error: function (xhr,status,error) {
                // TODO error handling logic
                lecture_blocks_dimmer.dimmer('toggle');
            }
        });
    });
}
function draw_schedule(lectures_container,course_group_tab_btns,course_groups_tab,approve_btn,remove_schedule_btn,add_schedule_modal,return_btn,position_info,scheduling_stage) {
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
    if(window.$.inArray(scheduling_stage,['1st','2nd']) !== -1){
        lectures_container.find('.course.lecture').each(function (index,item) {
            lecture_blocks_click($(item),course_group_tab_btns,course_groups_tab,approve_btn,remove_schedule_btn,add_schedule_modal,return_btn,scheduling_stage);
        });
    }
}
function init_message_cards(messages_list,formURL) {
    let $msg_cards = messages_list.find('.msg.card');
    $msg_cards.find('.star-bt').hover(
        function () {
            $(this).toggleClass('yellow');
        },
        function () {
            $(this).toggleClass('yellow');
        }
    );
    $msg_cards.find('.archive-bt').hover(
        function () {
            $(this).toggleClass('brown');
        },
        function () {
            $(this).toggleClass('brown');
        }
    );
    $msg_cards.find('.later-bt').hover(
        function () {
            $(this).toggleClass('orange');
        },
        function () {
            $(this).toggleClass('orange');
        }
    );
    $msg_cards.find('.trash-bt').hover(
        function () {
            $(this).toggleClass('black');
        },
        function () {
            $(this).toggleClass('black');
        }
    );
    $msg_cards.find('.left.floated .icon').on('click', function () {
        let message_id = $(this).attr('data-id');
        let message_state = $(this).attr('data-state');
        let message_color = $(this).attr('data-color');
        let nextState;
        if($(this).hasClass(message_color)){
            nextState = message_state;
        }else{
            nextState = 'inbox';
        }
        let postData = $(this).find('input').serializeArray();
        window.$.ajax(
            {
                url : formURL + '/' + message_id + '/' + nextState,
                type : "PATCH",
                data : postData,
                success:function() {
                    window.$('#messages_menu .item.active').trigger('click');
                },
                error: function() {
                }
            });
    });
    $msg_cards.find('.trash.icon').on('click', function ()
    {
        let message_id = $(this).attr('data-id');
        window.$('.small.modal .content').html(window.$('#message_'+message_id).clone());
        let postData = window.$('.small.modal'+' :input').serializeArray();
        window.$('.small.modal')
            .modal({
                onApprove : function() {
                    window.$.ajax(
                        {
                            url: formURL + '/' + message_id,
                            type: "DELETE",
                            data: postData,
                            success: function()
                            {
                                window.$('#messages_menu .item.active').trigger('click');
                            }
                        });
                }
            })
            .modal('show')
        ;
    });
}
function init_session_date_inputs(evaluation_sessions_modal) {
    evaluation_sessions_modal.find('[id^=session_]').each(function (index,item){
        let session_number = $(item).attr('data-number');
        let dp1 = $(item).find('[name=start_date_p_'+session_number+']').persianDatepicker({
            initialValue: false,
            observer: true,
            autoClose: true,
            format: 'YYYY/MM/DD',
            altField: '#evaluation_sessions.modal tbody #session_'+session_number+' [name=start_date_'+session_number+']',
            'toolbox': {
                'enabled': false
            }
        });
        if($(item).find('[name=start_date_'+session_number+']').val() !== ''){
            dp1.setDate(parseInt($(item).find('[name=start_date_'+session_number+']').val()));
        }
        let dp2 = $(item).find('[name=end_date_p_'+session_number+']').persianDatepicker({
            initialValue: false,
            observer: true,
            autoClose: true,
            format: 'YYYY/MM/DD',
            altField: '#evaluation_sessions.modal tbody #session_'+session_number+' [name=end_date_'+session_number+']',
            'toolbox': {
                'enabled': false
            }
        });
        if($(item).find('[name=end_date_'+session_number+']').val() !== ''){
            dp2.setDate(parseInt($(item).find('[name=end_date_'+session_number+']').val()));
        }
    });
}
function calculate_column_btn_positions(add_column_btn,remove_column_btn,query_columns) {
    add_column_btn.css('top',query_columns.find('div:last')[0].offsetTop);
    remove_column_btn.css('top',query_columns.find('div:last')[0].offsetTop);
    add_column_btn.css('left',query_columns.find('div:last')[0].offsetLeft);
    remove_column_btn.css('left',query_columns.find('div:last')[0].offsetLeft);
}
function initialize_query_builder_form(create_query_form,add_column_btn,remove_column_btn,query_columns,add_parameter_btn,remove_parameter_btn,parameters_list,modal=[]) {
    calculate_column_btn_positions(add_column_btn,remove_column_btn,query_columns);
    add_column_btn.on('click', function () {
        const column_number = (parseInt(query_columns.find('div:last').attr('data-number'))+1).toString();
        create_query_form.find('[name=number_of_columns]').val(column_number);
        query_columns.append(`
            <div class="column" data-number="${column_number}">
                <input type="text" name="column_id_${column_number}" placeholder="'id' of column ${column_number}"  style="direction: ltr" required>
                <input type="text" name="column_name_${column_number}" placeholder="'نام فارسی' ستون ${column_number}" required>
            </div>
            `);
        calculate_column_btn_positions(add_column_btn,remove_column_btn,query_columns);
        if(modal.length != 0){
            modal.modal('refresh');
        }
    });
    remove_column_btn.on('click', function () {
        if(query_columns.find('div').length>1){
            create_query_form.find('[name=number_of_columns]').val((parseInt(query_columns.find('div:last').attr('data-number'))-1).toString());
            query_columns.find('div:last').remove();
        }
        calculate_column_btn_positions(add_column_btn,remove_column_btn,query_columns);
        if(modal.length != 0){
            modal.modal('refresh');
        }
    });
    add_parameter_btn.on('click', function () {
        let parameter_number = 1;
        if(parameters_list.find('.fields').length>0){
            parameter_number = (parseInt(parameters_list.find('.fields:last').attr('data-number'))+1).toString();
        }
        create_query_form.find('[name=number_of_parameters]').val(parameter_number);
        parameters_list.append(`
            <div class="fields" data-number="${parameter_number}">
                <div class="two wide field">
                    <label class="fw-400">'id' پارامتر ${parameter_number}</label>
                    <input type="text" name="p_id_${parameter_number}" placeholder="'p' in \${p}" style="direction: ltr" required>
                </div>
                <div class="three wide field">
                    <label class="fw-400">نام فارسی پارامتر ${parameter_number}</label>
                    <input type="text" name="p_name_${parameter_number}" placeholder="نام فارسی پارامتر ${parameter_number}" required>
                </div>
                <div class="two wide field">
                    <label class="fw-400">نوع پارامتر ${parameter_number}</label>
                    <select class="ui fluid dropdown" name="p_type_${parameter_number}" required>
                        <option value="textbox">Textbox</option>
                        <option value="dropdown">Dropdown</option>
                    </select>
                </div>
                <div id="p_query" class="seven wide field disabled">
                    <label class="fw-400">پرس و جوی پارامتر ${parameter_number}</label>
                    <input type="text" name="p_query_${parameter_number}" placeholder="SELECT statement for dropdown parameter" style="direction: ltr">
                </div>
                <div id="p_query_column" class="two wide field disabled">
                    <label class="fw-400">'id' پرس و جو</label>
                    <input type="text" name="p_query_column_${parameter_number}" placeholder="column id" style="direction: ltr">
                </div>
            </div>
            `);
        parameters_list.find('.ui.dropdown').dropdown({
            onChange: function (value, text, $choice) {
                if(value === 'textbox'){
                    $choice.parents('.field').siblings('#p_query,#p_query_column').removeClass('disabled').addClass('disabled');
                    $choice.parents('.field').siblings('#p_query,#p_query_column').find('input').removeAttr('required');
                }else if(value === 'dropdown'){
                    $choice.parents('.field').siblings('#p_query,#p_query_column').removeClass('disabled');
                    $choice.parents('.field').siblings('#p_query,#p_query_column').find('input').attr('required','required');
                }
            }
        });
        if(modal.length != 0){
            modal.modal('refresh');
        }
    });
    remove_parameter_btn.on('click', function () {
        if(parameters_list.find('.fields').length !== 0) {
            create_query_form.find('[name=number_of_parameters]').val((parseInt(parameters_list.find('.fields:last').attr('data-number')) - 1).toString());
        }
        parameters_list.find('.fields:last').remove();
        if(modal.length != 0){
            modal.modal('refresh');
        }
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
    if(elementExist('#p_admin_home')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(0)').addClass('blue');
        window.$('.vertical.menu a i:eq(0)').removeClass('grey').addClass('blue');
        //
        fix_persian_numbers('.p_number');
        window.$('.ui.indicating.progress').progress({
            label: 'ratio',
            text: {
                ratio: '{value}/{total}'
            }
        });
        //
        const feedback_chart_config = {
            type: 'pie',
            data: feedback_data,
            options: {
                tooltips: {
                    enabled: false
                },
                responsive: true,
                legend: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
            }
        };
        const feedback_chart = window.$('#feedback_chart canvas')[0].getContext("2d");
        new Chart(feedback_chart, feedback_chart_config);

        window.random_colors = randomColor({luminosity: 'bright', count: 25 });
        const students_chart_config = {
            type: 'pie',
            data: students_data,
            options: {
                responsive: true,
                    legend: {
                    position: 'bottom',
                        labels: {
                        boxWidth: 14,
                            fontSize: 14
                    }
                },
                tooltips: {
                    displayColors: false,
                        bodyFontSize: 14
                }
            }
        };
        const students_chart = window.$('#students_chart canvas')[0].getContext("2d");
        new Chart(students_chart, students_chart_config);
        // init unix timestamps
        window.$('.unix.date').each(function (index,item) {
            let date = new persianDate(parseInt($(item).html()));
            $(item).html(date.format('D MMMM'));
        });
    }
    // course page logic
    if(elementExist('#p_admin_courses')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(1)').addClass('green');
        window.$('.vertical.menu a i:eq(1)').removeClass('grey').addClass('green');

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
            edit_course_form.find('[name=planned_semester]').val(course_row.find('td:nth-child(7)').html());
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
    // instructor page logic
    if(elementExist('#p_admin_instructors')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(2)').addClass('violet');
        window.$('.vertical.menu a i:eq(2)').removeClass('grey').addClass('violet');

        // edit instructor logic
        const edit_btns = window.$('.grey.segment table tr .orange.button');
        const edit_instructor_modal = window.$('#edit_instructor.modal');
        const edit_instructor_form = edit_instructor_modal.find('form');
        const edit_instructor_form_action = edit_instructor_form.attr('action');
        edit_btns.on('click', function () {
            const instructor_id = $(this).data('id');
            const instructor_row = window.$('#instructor_'+instructor_id);
            // clear the form
            window.$('#edit_instructor .ui.form').form('reset');
            window.$('#edit_instructor .ui.form .error.message').html('');
            // fill it with prev info
            edit_instructor_form.find('[name=instructor_name]').val(instructor_row.find('td:nth-child(1)').html());
            edit_instructor_form.find('[name=sex]').val(instructor_row.find('td:nth-child(2)').html());
            if(instructor_row.find('td:nth-child(3) a').html() !== ''){
                edit_instructor_form.find('[name=profile_link]').val(instructor_row.find('td:nth-child(3) a').html());
            }
            window.$('.ui.dropdown').dropdown();
            edit_instructor_form.attr('action', edit_instructor_form_action+'/'+instructor_id);
            edit_instructor_modal.modal({
                onApprove : function () {
                    return window.$('#edit_instructor .ui.form').form('is valid');
                }
            }).modal('show');
        });
        if(window.$('#edit_instructor.modal').data('error') === true){
            edit_instructor_modal.modal('show');
        }

        // delete instructor logic
        const delete_btns = window.$('.grey.segment table tr .red.button');
        const delete_instructor_modal = window.$('#delete_instructor.modal');
        const delete_preview_row = delete_instructor_modal.find('table tbody tr');
        const delete_instructor_form = delete_instructor_modal.find('form');
        const delete_instructor_form_action = delete_instructor_form.attr('action');
        delete_btns.on('click', function () {
            const instructor_id = $(this).data('id');
            const instructor_row = window.$('#instructor_'+instructor_id);
            delete_preview_row.find('td:nth-child(1)').html(instructor_row.find('td:nth-child(1)').html());
            delete_preview_row.find('td:nth-child(2)').html(instructor_row.find('td:nth-child(2)').html());
            delete_preview_row.find('td:nth-child(3)').html(instructor_row.find('td:nth-child(3)').html());
            delete_preview_row.find('td:nth-child(4)').html(instructor_row.find('td:nth-child(4)').html());
            delete_instructor_form.attr('action', delete_instructor_form_action+'/'+instructor_id);
            delete_instructor_modal.modal('show');
        });

        // validations
        add_instructor_validation();
        edit_instructor_validation();

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
    // semester page logic
    if(elementExist('#p_admin_semesters')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(3)').addClass('brown');
        window.$('.vertical.menu a i:eq(3)').removeClass('grey').addClass('brown');

        // edit semester logic
        const edit_btns = window.$('.grey.segment table tr .orange.button');
        const edit_semester_modal = window.$('#edit_semester.modal');
        const edit_semester_form = edit_semester_modal.find('form');
        const edit_semester_form_action = edit_semester_form.attr('action');
        edit_btns.on('click', function () {
            const semester_id = $(this).data('id');
            const semester_row = window.$('#semester_'+semester_id);
            // clear the form
            window.$('#edit_semester .ui.form').form('reset');
            window.$('#edit_semester .ui.form .error.message').html('');
            // fill it with prev info
            edit_semester_form.find('[name=semester]').val(semester_row.find('td:nth-child(1)').html());
            edit_semester_form.find('[name=year]').val(semester_row.find('td:nth-child(2)').html());
            window.$('.ui.dropdown').dropdown();
            edit_semester_form.attr('action', edit_semester_form_action+'/'+semester_id);
            edit_semester_modal.modal({
                onApprove : function () {
                    return window.$('#edit_semester .ui.form').form('is valid');
                }
            }).modal('show');
        });
        if(window.$('#edit_semester.modal').data('error') === true){
            edit_semester_modal.modal('show');
        }

        // delete semester logic
        const delete_btns = window.$('.grey.segment table tr .red.button');
        const delete_semester_modal = window.$('#delete_semester.modal');
        const delete_preview_row = delete_semester_modal.find('table tbody tr');
        const delete_semester_form = delete_semester_modal.find('form');
        const delete_semester_form_action = delete_semester_form.attr('action');
        delete_btns.on('click', function () {
            const semester_id = $(this).data('id');
            const semester_row = window.$('#semester_'+semester_id);
            delete_preview_row.find('td:nth-child(1)').html(semester_row.find('td:nth-child(1)').html());
            delete_preview_row.find('td:nth-child(2)').html(semester_row.find('td:nth-child(2)').html());
            delete_semester_form.attr('action', delete_semester_form_action+'/'+semester_id);
            delete_semester_modal.modal('show');
        });
        // validations
        add_semester_validation();
        edit_semester_validation();

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
    if(elementExist('#p_admin_semester_courses')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(3)').addClass('brown');
        window.$('.vertical.menu a i:eq(3)').removeClass('grey').addClass('brown');
        // on check and unckeck events
        window.$('.ui.checkbox').checkbox({
            onChecked: function () {
                $(this).parents('tr').find('.ui.input').removeClass('disabled');
            },
            onUnchecked: function () {
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
            const rows = window.$('tbody tr');
            const course_data = [];
            for (let i = 0; i<rows.length; i++){
                const course_id = rows[i].id;
                course_data.push({
                    id: course_id,
                    checked: window.$('#'+course_id+' .ui.checkbox').checkbox('is checked'),
                    min_capacity: window.$('#'+course_id+' .ui.input input').val()
                });
            }
            window.$.ajax({
                url: document.location.href + '/updatecourses',
                type: "POST",
                data: JSON.stringify(course_data),
                contentType: "application/json",
                success: function (result,status,xhr) {
                    // TODO show success before redirect
                    window.location = window.$('.ui.breadcrumb a').attr('href');
                },
                error: function (xhr,status,error) {
                    // TODO error handling logic
                }
            });
        });
    }
    // student page logic
    if(elementExist('#p_admin_students')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(4)').addClass('teal');
        window.$('.vertical.menu a i:eq(4)').removeClass('grey').addClass('teal');
        // delete student logic
        const delete_btns = window.$('.grey.segment table tr .red.button');
        const delete_student_modal = window.$('#delete_student.modal');
        const delete_preview_row = delete_student_modal.find('table tbody tr');
        const delete_student_form = delete_student_modal.find('form');
        const delete_student_form_action = delete_student_form.attr('action');
        delete_btns.on('click', function () {
            const student_id = $(this).data('id');
            const student_row = window.$('#student_'+student_id);
            delete_preview_row.find('td:nth-child(1)').html(student_row.find('td:nth-child(1)').html());
            delete_preview_row.find('td:nth-child(2)').html(student_row.find('td:nth-child(2)').html());
            delete_preview_row.find('td:nth-child(3)').html(student_row.find('td:nth-child(3)').html());
            delete_preview_row.find('td:nth-child(4)').html(student_row.find('td:nth-child(4)').html());
            delete_preview_row.find('td:nth-child(5)').html(student_row.find('td:nth-child(5)').html());
            delete_student_form.attr('action', delete_student_form_action+'/'+student_id);
            delete_student_modal.modal('show');
        });
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
    if(elementExist('#p_admin_student_courses')) {
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(4)').addClass('teal');
        window.$('.vertical.menu a i:eq(4)').removeClass('grey').addClass('teal');

        window.$('.menu .item').tab();
    }
    // report page logic
    if(elementExist('#p_admin_reports')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(5)').addClass('red');
        window.$('.vertical.menu a i:eq(5)').removeClass('grey').addClass('red');

        const load_btn = window.$('.blue.segment .basic.query.label .green.icon.button');
        const query_view = window.$('#query_view');
        const query_result_modal = window.$('#query_result.modal');
        load_btn.on('click', function () {
            const query_id = $(this).attr('data-id');
            const dimmer = $(this).parent().siblings('.dimmer');
            dimmer.dimmer('toggle');
            window.$.ajax({
                url: document.location.origin + '/admin/query/' + query_id,
                type: "get",
                success: function (result,status,xhr) {
                    query_view.html(result);
                    query_view.find('.ui.dropdown').dropdown();
                    query_view.find('form').on('submit', function () {
                        const url = $(this).attr('action');
                        const data = $(this).serializeArray();
                        const dimmer = $(this).find('.dimmer');
                        dimmer.dimmer('toggle');
                        window.$.ajax({
                            url: url,
                            type: "post",
                            data: data,
                            success: function(result,status,xhr){
                                query_result_modal.find('.scrolling.content').html(result);
                                query_result_modal.modal('show');
                                dimmer.dimmer('toggle');
                            },
                            error: function (xhr,status,erro) {
                                // TODO error handling logic
                                dimmer.dimmer('toggle');
                            }
                        });
                        return false;
                    });
                    dimmer.dimmer('toggle');
                },
                error: function (xhr,status,error) {
                    // TODO error handling logic
                    dimmer.dimmer('toggle');
                }
            });
        });
        const delete_btn = window.$('.blue.segment .basic.query.label .red.icon.button');
        const delete_query_modal = window.$('#delete_query.modal');
        delete_btn.on('click', function () {
            const query_id = $(this).attr('data-id');
            const query_name = $(this).parent().siblings('span').find('span').html();
            delete_query_modal.find('.content span span').html(query_name);
            const from_action = document.location.origin + '/admin/query/' + query_id;
            delete_query_modal.find('form').attr('action', from_action);
            delete_query_modal.modal('show');
        });
        delete_query_modal.modal({
            onApprove: function () {
                delete_query_modal.find('form').submit();
            }
        });
        const edit_btn = window.$('.blue.segment .basic.query.label .orange.icon.button');
        const edit_query_modal = window.$('#edit_query.modal');
        edit_btn.on('click', function () {
            const query_id = $(this).attr('data-id');
            const dimmer = $(this).parent().siblings('.dimmer');
            dimmer.dimmer('toggle');
            window.$.ajax({
                url: document.location.origin + '/admin/query/' + query_id + '/edit',
                type: 'get',
                success: function (result,status,xhr) {
                    edit_query_modal.find('.content').html(result);
                    const create_query_form = edit_query_modal.find('form');
                    const add_column_btn = edit_query_modal.find('#add_column');
                    const remove_column_btn = edit_query_modal.find('#remove_column');
                    const query_columns = edit_query_modal.find('#query_columns');
                    const add_parameter_btn = edit_query_modal.find('#add_parameter');
                    const remove_parameter_btn = edit_query_modal.find('#remove_parameter');
                    const parameters_list = edit_query_modal.find('#parameters');
                    parameters_list.find('.ui.dropdown').dropdown({
                        onChange: function (value, text, $choice) {
                            if(value === 'textbox'){
                                $choice.parents('.field').siblings('#p_query,#p_query_column').removeClass('disabled').addClass('disabled');
                                $choice.parents('.field').siblings('#p_query,#p_query_column').find('input').removeAttr('required');
                            }else if(value === 'dropdown'){
                                $choice.parents('.field').siblings('#p_query,#p_query_column').removeClass('disabled');
                                $choice.parents('.field').siblings('#p_query,#p_query_column').find('input').attr('required','required');
                            }
                        }
                    });
                    const update_url = document.location.origin + '/admin/query/' + query_id;
                    create_query_form.attr('action',update_url);
                    edit_query_modal.modal({
                        onApprove: function () {
                            let form_is_valid = false;
                            create_query_form.find('input,select').each(function(index,item){
                                if(!$(item)[0].checkValidity()){
                                    form_is_valid = false;
                                }
                            });
                            if(form_is_valid){
                                create_query_form.submit();
                            }else{
                                create_query_form.find('input[type=submit]').click();
                                return false;
                            }
                        }
                    });
                    edit_query_modal.modal('show');
                    initialize_query_builder_form(create_query_form,add_column_btn,remove_column_btn,query_columns,add_parameter_btn,remove_parameter_btn,parameters_list,edit_query_modal);
                    dimmer.dimmer('toggle');
                },
                error: function (xhr,status,erro) {
                    // TODO error handling logic
                    dimmer.dimmer('toggle');
                }
            });
        });
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
    if(elementExist('#p_admin_query_builder')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(5)').addClass('red');
        window.$('.vertical.menu a i:eq(5)').removeClass('grey').addClass('red');

        const create_query_form = window.$('#create_query');
        const add_column_btn = window.$('#create_query #add_column');
        const remove_column_btn = window.$('#create_query #remove_column');
        const query_columns = window.$('#create_query #query_columns');
        const add_parameter_btn = window.$('#create_query #add_parameter');
        const remove_parameter_btn = window.$('#create_query #remove_parameter');
        const parameters_list = window.$('#create_query #parameters');
        initialize_query_builder_form(create_query_form,add_column_btn,remove_column_btn,query_columns,add_parameter_btn,remove_parameter_btn,parameters_list);
        const view_database_btn = window.$('#create_query #view_database');
        const database_map_modal = window.$('#database_map.modal');
        view_database_btn.on('click', function () {
            database_map_modal.modal('show');
        });

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
    // scheduling page logic
    if(elementExist('#p_admin_scheduling')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(6)').addClass('orange');
        window.$('.vertical.menu a i:eq(6)').removeClass('grey').addClass('orange');

        // selectors
        const add_schedule_modal = window.$('#add_schedule.modal');
        const remove_schedule_btn = add_schedule_modal.find('.actions .orange.right.labeled.icon.button');
        const return_btn = window.$('#add_schedule.modal .actions .blue.labeled.icon.button');
        const course_groups_tab = window.$('#add_schedule.modal .scrolling.content #course_groups');
        const course_group_tab_btns = course_groups_tab.find('.top.attached.menu .left.menu');
        const approve_btn = add_schedule_modal.find('.actions .positive.right.labeled.icon.button');

        const scheduling_stage = window.$('#p_admin_scheduling').attr('data-stage');
        if(window.$.inArray(scheduling_stage,['1st','2nd']) !== -1){
            // show courses
            const courses_modal = window.$('#courses.modal');
            const menu_add_btn = window.$('#add_to_schedule_btn.large.labeled.icon.button');
            menu_add_btn.on('click', function () {
                courses_modal.modal('show');
            });

            // click on each course card
            const course_cards = window.$('.ui.course.card');
            course_cards.on('click', function () {
                const course_id = $(this).attr('data-id');
                const card_dimmer = $(this).find('.ui.inverted.dimmer');
                //
                add_schedule_modal.find('#course_info .top.attached.tabular.menu a').removeClass('active');
                add_schedule_modal.find('#course_info .top.attached.tabular.menu a:first').addClass('active');
                add_schedule_modal.find('#course_info .bottom.attached.tab.segment').removeClass('active');
                add_schedule_modal.find('#course_info .bottom.attached.tab.segment:first').addClass('active');
                //
                return_btn.show();
                if($(this).attr('data-state') === 'notscheduled'){
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
                    const course_color_preview = window.$('#add_schedule.modal .scrolling.content .tab.segment .block.preview');
                    let random_color = randomColor();
                    course_color_preview.css('background-color', random_color);
                    course_color_preview.siblings('input').val(random_color);
                    course_color_preview.on('click', function () {
                        random_color = randomColor();
                        $(this).css('background-color', random_color);
                        $(this).siblings('input').val(random_color)
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
                        success: function (result,status,xhr) {
                            //
                            const instructors_info = result.instructors_info;
                            let instructors_info_rows = '';
                            for(let i=0; i<instructors_info.length; i++){
                                if(instructors_info[i].photo === null){
                                    if(instructors_info[i].sex === 'مرد'){
                                        instructors_info[i].photo = 'instructor_photos/img_male.png';
                                    }else {
                                        instructors_info[i].photo = 'instructor_photos/img_female.png';
                                    }
                                }
                                instructors_info_rows += `
                            <div class="row">
                                <div class="photo" data-tooltip="${instructors_info[i].name}" data-position="right center">
                                    <img class="ui mini circular image" src="/storage/${instructors_info[i].photo}">
                                </div>
                                <div class="progress">
                                    <div class="ui indicating progress" data-value="${instructors_info[i].votes}" data-total="${instructors_info[0].votes}">
                                        <div class="bar"></div>
                                    </div>
                                </div>
                                <div class="votes">
                                    ${instructors_info[i].votes}
                                </div>
                            </div>
                        `;
                            }
                            if(instructors_info_rows !== ''){
                                window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html(instructors_info_rows);
                                window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors .progress').progress();
                            }else{
                                window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html('برای این درس استادی پیشنهاد نشده است.');
                            }
                            //
                            const course_conflicts = result.course_conflicts;
                            let course_conflicts_tbody = '';
                            for(let i=0; i<course_conflicts.length; i++){
                                course_conflicts_tbody += '<tr><td>'+(i+1)+'</td><td>'+ course_conflicts[i].code +'</td><td>'+ course_conflicts[i].name +'</td><td>'+ course_conflicts[i].count +'</td></tr>';
                            }
                            if(course_conflicts_tbody !== '') {
                                window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html(course_conflicts_tbody);
                            }else {
                                window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html('<tr><td colspan="4">برای این درس تداخلی وجود ندارد.</td></tr>');
                            }
                            //
                            const course_students = result.course_students;
                            let course_students_tbody = '';
                            for(let i=0; i<course_students.length; i++){
                                course_students_tbody += '<tr><td>'+(i+1)+'</td><td>'+ course_students[i].first_name +'</td><td>'+ course_students[i].last_name +'</td><td>'+ course_students[i].student_id +'</td><td>'+ course_students[i].entry_year +'</td></tr>';
                            }
                            if(course_students_tbody !== '') {
                                window.$('#add_schedule.modal .scrolling.content table.students tbody').html(course_students_tbody);
                            }else {
                                window.$('#add_schedule.modal .scrolling.content table.students tbody').html('<tr><td colspan="5">دانشجویی این درس را اخذ نکرده است.</td></tr>');
                            }
                            //
                            card_dimmer.dimmer('toggle');
                            add_schedule_modal.modal('show');
                        },
                        error: function (xhr,status,error) {
                            // TODO error handling logic
                        }
                    });
                } else {
                    card_dimmer.dimmer('toggle');
                    window.$.ajax({
                        url: document.location.origin + '/admin/scheduling/' + course_id + '/information',
                        type: "GET",
                        success: function (result,status,xhr) {
                            //
                            course_group_tab_btns.find('a.new').remove();
                            const tab_btn =  course_group_tab_btns.find('a:first-child');
                            tab_btn.removeClass('active').addClass('active');
                            course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').addClass('disabled');
                            course_groups_tab.find('.bottom.attached.tab.segment.new').remove();
                            const tab_content = course_groups_tab.find('.bottom.attached.tab.segment');
                            tab_content.removeClass('active').addClass('active');

                            const schedule_info = result.schedule_info;
                            for (let i=0; i<schedule_info.length; i++){
                                if(i==0) {
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
                                    const course_color_preview = tab_content.find('.block.preview');
                                    course_color_preview.html(schedule_info[i].course_name);
                                    course_color_preview.css('background-color', schedule_info[i].course_color);
                                    course_color_preview.on('click', function () {
                                        random_color = randomColor();
                                        $(this).css('background-color', random_color);
                                        $(this).siblings('input').val(random_color)
                                    });
                                    const dp = tab_content.find('form input[name=exam_date]').persianDatepicker({
                                        initialValue: false,
                                        observer: true,
                                        autoClose: true,
                                        format: 'YYYY/MM/DD',
                                        altField: '#add_schedule.modal .scrolling.content form:eq(' + (parseInt(schedule_info[i].group_number) - 1).toString() + ') input[name=exam_date_unix]',
                                        'toolbox': {
                                            'enabled': false
                                        }
                                    });
                                    if(schedule_info[i].exam_date_unix !== null)
                                        dp.setDate(parseInt(schedule_info[i].exam_date_unix));
                                } else {
                                    let new_tab_btn = tab_btn.clone().removeClass('active').addClass('new');
                                    new_tab_btn.attr('data-tab',(i+1).toString());
                                    new_tab_btn.html('گروه ' + (i+1).toString());
                                    course_group_tab_btns.append(new_tab_btn);
                                    course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').removeClass('disabled');

                                    let new_tab_content = tab_content.clone().removeClass('active').addClass('new');
                                    new_tab_content.attr('data-tab',(i+1).toString());
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
                                    const course_color_preview = new_tab_content.find('.block.preview');
                                    course_color_preview.html(schedule_info[i].course_name);
                                    course_color_preview.css('background-color', schedule_info[i].course_color);
                                    course_color_preview.on('click', function () {
                                        random_color = randomColor();
                                        $(this).css('background-color', random_color);
                                        $(this).siblings('input').val(random_color)
                                    });
                                    const dp = new_tab_content.find('form input[name=exam_date]').persianDatepicker({
                                        initialValue: false,
                                        observer: true,
                                        autoClose: true,
                                        format: 'YYYY/MM/DD',
                                        altField: '#add_schedule.modal .scrolling.content form:eq('+(parseInt(schedule_info[i].group_number)-1).toString()+') input[name=exam_date_unix]',
                                        'toolbox': {
                                            'enabled': false
                                        }
                                    });
                                    if(schedule_info[i].exam_date_unix !== null)
                                        dp.setDate(parseInt(schedule_info[i].exam_date_unix));
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
                            const instructors_info = result.instructors_info;
                            let instructors_info_rows = '';
                            for(let i=0; i<instructors_info.length; i++){
                                if(instructors_info[i].photo === null){
                                    if(instructors_info[i].sex === 'مرد'){
                                        instructors_info[i].photo = 'instructor_photos/img_male.png';
                                    }else {
                                        instructors_info[i].photo = 'instructor_photos/img_female.png';
                                    }
                                }
                                instructors_info_rows += `
                            <div class="row">
                                <div class="photo" data-tooltip="${instructors_info[i].name}" data-position="right center">
                                    <img class="ui mini circular image" src="/storage/${instructors_info[i].photo}">
                                </div>
                                <div class="progress">
                                    <div class="ui indicating progress" data-value="${instructors_info[i].votes}" data-total="${instructors_info[0].votes}">
                                        <div class="bar"></div>
                                    </div>
                                </div>
                                <div class="votes">
                                    ${instructors_info[i].votes}
                                </div>
                            </div>
                        `;
                            }
                            if(instructors_info_rows !== ''){
                                window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html(instructors_info_rows);
                                window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors .progress').progress();
                            }else{
                                window.$('#add_schedule.modal .scrolling.content .bottom.attached.tab .instructors').html('برای این درس استادی پیشنهاد نشده است.');
                            }
                            //
                            const course_conflicts = result.course_conflicts;
                            let course_conflicts_tbody = '';
                            for(let i=0; i<course_conflicts.length; i++){
                                course_conflicts_tbody += '<tr><td>'+(i+1)+'</td><td>'+ course_conflicts[i].code +'</td><td>'+ course_conflicts[i].name +'</td><td>'+ course_conflicts[i].count +'</td></tr>';
                            }
                            if(course_conflicts_tbody !== '') {
                                window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html(course_conflicts_tbody);
                            }else {
                                window.$('#add_schedule.modal .scrolling.content table.conflicts tbody').html('<tr><td colspan="4">برای این درس تداخلی وجود ندارد.</td></tr>');
                            }
                            //
                            const course_students = result.course_students;
                            let course_students_tbody = '';
                            for(let i=0; i<course_students.length; i++){
                                course_students_tbody += '<tr><td>'+(i+1)+'</td><td>'+ course_students[i].first_name +'</td><td>'+ course_students[i].last_name +'</td><td>'+ course_students[i].student_id +'</td><td>'+ course_students[i].entry_year +'</td></tr>';
                            }
                            if(course_students_tbody !== '') {
                                window.$('#add_schedule.modal .scrolling.content table.students tbody').html(course_students_tbody);
                            }else {
                                window.$('#add_schedule.modal .scrolling.content table.students tbody').html('<tr><td colspan="5">دانشجویی این درس را اخذ نکرده است.</td></tr>');
                            }
                            //
                            if(scheduling_stage === '2nd') {
                                const course_evaluation = result.course_evaluation;
                                if (course_evaluation.length > 0) {
                                    add_schedule_modal.find('#course_info .top.attached.tabular.menu').append(`
                                    <a class="item fw-400" data-tab="evaluations">درخواست های دانشجویان</a>
                                `);
                                    let course_evaluation_tab_content = '';
                                    course_evaluation_tab_content += `<div class="ui bottom attached tab segment" data-tab="evaluations"><div class="ui text container">`;
                                    for (let i = 0; i < course_evaluation.length; i++) {
                                        course_evaluation_tab_content += `
                                    <div class="ui fluid inverted card">
                                        <div class="ui inverted dimmer">
                                            <div class="ui loader"></div>
                                        </div>
                                        <div class="content">
                                            <div class="ui divided selection list">
                                    `;
                                        if (course_evaluation[i].suggested_weekday_1 !== null) {
                                            course_evaluation_tab_content += `
                                        <a class="item">
                                            <div class="ui blue large horizontal label fw-400" style="padding: 1rem">تغییر جلسه اول</div>
                                            <span style="font-size: 1.2rem">
                                                <span>از </span>
                                                <span>${persian_weekday(course_evaluation[i].weekday_1)}</span>
                                                <span class="p_number">${course_evaluation[i].start_time_1.substr(0, 5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].end_time_1.substr(0, 5)}</span>
                                                <span> به </span>
                                                <span>${persian_weekday(course_evaluation[i].suggested_weekday_1)}</span>
                                                <span class="p_number">${course_evaluation[i].suggested_start_time_1.substr(0, 5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].suggested_end_time_1.substr(0, 5)}</span>
                                            </span>
                                            <div style="margin-top: .5rem">
                                                <div class="ui green fluid basic label">
                                                    <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                                    <span style="line-height: 2rem">${course_evaluation[i].suggestion_reason_1}</span>
                                                </div>
                                            </div>
                                        </a>
                                        `;
                                        }
                                        if (course_evaluation[i].suggested_weekday_2 !== null) {
                                            course_evaluation_tab_content += `
                                        <a class="item">
                                            <div class="ui blue large horizontal label fw-400" style="padding: 1rem">تغییر جلسه اول</div>
                                            <span style="font-size: 1.2rem">
                                                <span>از </span>
                                                <span>${persian_weekday(course_evaluation[i].weekday_2)}</span>
                                                <span class="p_number">${course_evaluation[i].start_time_2.substr(0, 5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].end_time_2.substr(0, 5)}</span>
                                                <span> به </span>
                                                <span>${persian_weekday(course_evaluation[i].suggested_weekday_2)}</span>
                                                <span class="p_number">${course_evaluation[i].suggested_start_time_2.substr(0, 5)}</span><span> تا </span><span class="p_number">${course_evaluation[i].suggested_end_time_2.substr(0, 5)}</span>
                                            </span>
                                            <div style="margin-top: .5rem">
                                                <div class="ui green fluid basic label">
                                                    <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                                    <span style="line-height: 2rem">${course_evaluation[i].suggestion_reason_2}</span>
                                                </div>
                                            </div>
                                        </a>
                                        `;
                                        }
                                        if (course_evaluation[i].suggested_exam_date !== null) {
                                            course_evaluation_tab_content += `
                                        <a class="item">
                                            <div class="ui red large horizontal label fw-400" style="padding: 1rem">تغییر امتحان</div>
                                            <span style="font-size: 1.2rem">
                                                <span>از </span>
                                                <span>${course_evaluation[i].exam_date}</span>
                                                <span> ساعت </span><span class="p_number">${course_evaluation[i].exam_time.substr(0, 5)}</span>
                                                <span> به </span>
                                                <span>${course_evaluation[i].suggested_exam_date}</span>
                                                <span> ساعت </span><span class="p_number">${course_evaluation[i].suggested_exam_time.substr(0, 5)}</span>
                                            </span>
                                            <div style="margin-top: .5rem">
                                                <div class="ui green fluid basic label">
                                                    <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                                    <span style="line-height: 2rem">${course_evaluation[i].exam_suggestion_reason}</span>
                                                </div>
                                            </div>
                                        </a>
                                        `;
                                        }
                                        course_evaluation_tab_content += `</div></div>`;
                                        if (course_evaluation[i].privacy === 'public') {
                                            let upvotes_color = '';
                                            let downvotes_color = '';
                                            if (course_evaluation[i].upvotes > 0) {
                                                upvotes_color = ' blue-color';
                                            }
                                            if (course_evaluation[i].downvotes < 0) {
                                                downvotes_color = ' red-color';
                                            }
                                            course_evaluation_tab_content += `
                                            <div class="extra content">
                                                <div class="left floated${upvotes_color}" style="direction: ltr">
                                                    <i class="thumbs outline up big icon"></i>
                                                    <span>${course_evaluation[i].upvotes}</span>
                                                </div>
                                                <div class="right floated${downvotes_color}" style="direction: ltr">
                                                    <i class="thumbs outline down big icon"></i>
                                                    <span>${course_evaluation[i].downvotes}</span>
                                                </div>
                                            </div>
                                        </div>
                                        `;
                                        } else {
                                            course_evaluation_tab_content += `
                                            <div class="extra content" style="text-align: center">
                                                <span>درخواست شخصی</span>
                                            </div>
                                        </div>
                                        `;
                                        }
                                    }
                                    course_evaluation_tab_content += `</div></div>`;

                                    add_schedule_modal.find('#course_info').append(course_evaluation_tab_content);
                                    add_schedule_modal.find('#course_info .menu .item').tab();
                                    fix_persian_numbers('.p_number');
                                }
                            }
                            //
                            approve_btn.find('span').html('ویرایش برنامه');
                            approve_btn.find('i').removeClass('checkmark').addClass('write');
                            remove_schedule_btn.show();
                            //
                            card_dimmer.dimmer('toggle');
                            add_schedule_modal.modal('show');
                        },
                        error: function (xhr,status,error) {
                            // TODO error handling logic
                        }
                    });
                }
            });
            course_cards.hover(
                function () {
                    if($(this).attr('data-state') === 'scheduled'){
                        $(this).find('.right.corner.label i').transition('flash');
                    }else{
                        $(this).find('.right.corner.label i').addClass('checkmark');
                    }
                },
                function () {
                    if($(this).attr('data-state') === 'notscheduled'){
                        $(this).find('.right.corner.label i').removeClass('checkmark');
                    }
                }
            );
            // add new group
            course_groups_tab.find('.top.attached.menu .right.menu .green.labeled.icon.button').on('click', function () {
                //
                const new_tab_btn = course_group_tab_btns.find('a:last-child').clone().removeClass('active').addClass('new');
                let group_counter = parseInt(new_tab_btn.attr('data-tab'));
                new_tab_btn.html('گروه ' + (group_counter+1).toString());
                new_tab_btn.attr('data-tab', (group_counter+1).toString());
                course_group_tab_btns.append(new_tab_btn);
                course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').removeClass('disabled');
                //
                const new_tab_content = course_groups_tab.find('.bottom.attached.tab.segment:last-child').clone().removeClass('active').addClass('new');
                new_tab_content.attr('data-tab', (group_counter+1).toString());
                const course_id = new_tab_content.find('form input[name=course_id]').val();
                new_tab_content.find('form').form('clear');
                new_tab_content.find('form input[name=course_id]').val(course_id);
                new_tab_content.find('form input[name=group_number]').val((group_counter+1).toString());
                course_groups_tab.append(new_tab_content);
                //
                course_group_tab_btns.find('a').removeClass('active');
                course_group_tab_btns.find('a:last-child').addClass('active');
                course_groups_tab.find('.bottom.attached.tab.segment').removeClass('active');
                course_groups_tab.find('.bottom.attached.tab.segment:last-child').addClass('active');
                window.$('#add_schedule.modal .scrolling.content .menu .item').tab();
                new_tab_content.find('.ui.dropdown').dropdown();
                //
                const course_color_preview = new_tab_content.find('.block.preview');
                course_color_preview.siblings('input').val(rgb2hex(course_color_preview.css('background-color')));
                course_color_preview.on('click', function () {
                    let random_color = randomColor();
                    $(this).css('background-color', random_color);
                    $(this).siblings('input').val(random_color)
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
                    altField: '#add_schedule.modal .scrolling.content form:eq('+(group_counter).toString()+') input[name=exam_date_unix]',
                    'toolbox': {
                        'enabled': false
                    }
                });
            });
            // remove group btn
            course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').on('click', function () {
                course_group_tab_btns.find('a.new:last').remove();
                if(elementExist(course_group_tab_btns.find('a.new:last'))){
                    course_group_tab_btns.find('a.new:last').addClass('active');
                } else {
                    course_group_tab_btns.find('a:first').addClass('active');
                    course_groups_tab.find('.top.attached.menu .right.menu .red.labeled.icon.button').addClass('disabled');
                }
                course_groups_tab.find('.bottom.attached.tab.segment.new:last').remove();
                if(elementExist(course_groups_tab.find('.bottom.attached.tab.segment.new:last'))){
                    course_groups_tab.find('.bottom.attached.tab.segment.new:last').addClass('active');
                } else {
                    course_groups_tab.find('.bottom.attached.tab.segment:first').addClass('active');
                }
            });
            // return button
            return_btn.on('click', function () {
                add_schedule_modal.find('#course_info .top.attached.tabular.menu a[data-tab=evaluations]').remove();
                add_schedule_modal.find('#course_info .bottom.attached.tab.segment[data-tab=evaluations]').remove();
                courses_modal.modal('show');
            });

            // add to schedule btn
            add_schedule_modal.modal({
                onApprove: function () {
                    let schedule_data = [];
                    let forms_are_valid = true;
                    course_groups_tab.find('form').each(function (index, item) {
                        $(item).form({
                            fields: {
                                instructor_id: 'empty',
                                weekday_1: 'empty',
                                start_time_1: 'empty',
                                end_time_1: 'empty'
                            }
                        });
                        if(!$(item).form('is valid')){
                            $(item).submit();
                            forms_are_valid = false;
                        }else{
                            $(item).removeClass('error');
                            $(item).find('.field').removeClass('error');
                        }
                        let form_data = $(item).serializeArray();
                        let form_object = {};
                        for (let i = 0; i < form_data.length; i++) {
                            form_object[[form_data[i]['name']]] = form_data[i]['value'];
                        }
                        schedule_data[index] = form_object;
                    });
                    if(!forms_are_valid){
                        return false;
                    }
                    window.$.ajax({
                        url: document.location.origin + '/admin/scheduling/store',
                        type: "POST",
                        data: JSON.stringify(schedule_data),
                        contentType: "application/json",
                        success: function (result, status, xhr) {
                            document.location = document.location.origin + '/admin/scheduling';
                        },
                        error: function (xhr, status, error) {
                            // TODO error handling logic
                            document.location = document.location.origin + '/admin/scheduling';
                        }
                    });
                }
            });
            // remove schedule btn
            remove_schedule_btn.on('click', function () {
                const course_id = course_groups_tab.find('form:first input[name=course_id]').val();
                window.$.ajax({
                    url: document.location.origin + '/admin/scheduling/' + course_id + '/destroy',
                    type: "POST",
                    success: function (result,status,xhr) {
                        document.location = document.location.origin + '/admin/scheduling/';
                    },
                    error: function (xhr,status,error) {
                        document.location = document.location.origin + '/admin/scheduling';
                    }
                });
            });

            // evaluation sessions
            const evaluation_sessions_modal = window.$('#evaluation_sessions.modal');
            evaluation_sessions_modal.find('#add_session').on('click', function () {
                let last_session_number = evaluation_sessions_modal.find('[id^=session_]:last').attr('data-number');
                last_session_number = (parseInt(last_session_number) + 1).toString();
                evaluation_sessions_modal.find('table tbody').append(`
                <tr id="session_${last_session_number}" data-number="${last_session_number}">
                    <td class="collapsing">
                        <div class="ui toggle checkbox" style="display: block;">
                            <input name="session_enable" type="radio" value="${last_session_number}">
                            <label style="padding-right: 3.5rem;"></label>
                        </div>
                    </td>
                    <td>مرحله <span class="p_number">${last_session_number}</span>
                        <input type="hidden" name="session_number_${last_session_number}" value="${last_session_number}">
                    </td>
                    <td>
                        <div class="fluid field">
                            <input type="text" name="start_date_p_${last_session_number}" placeholder="تاریخ شروع" style="text-align: center">
                            <input type="hidden" name="start_date_${last_session_number}">
                        </div>
                    </td>
                    <td>
                        <div class="fluid field">
                            <input type="text" name="end_date_p_${last_session_number}" placeholder="تاریخ پایان" style="text-align: center">
                            <input type="hidden" name="end_date_${last_session_number}">
                        </div>
                    </td>
                </tr>
                `);
                evaluation_sessions_modal.find('table tbody input[name=number_of_sessions]').val(last_session_number);
                evaluation_sessions_modal.find('#remove_session').removeClass('disabled');
                init_session_date_inputs(evaluation_sessions_modal);
            });
            init_session_date_inputs(evaluation_sessions_modal);
            evaluation_sessions_modal.find('#remove_session').on('click', function () {
                let evaluation_sessions_rows = evaluation_sessions_modal.find('[id^=session_]');
                if(evaluation_sessions_rows.length > 1){
                    if(evaluation_sessions_rows.length === 2)
                        $(this).addClass('disabled');
                    evaluation_sessions_modal.find('table tbody input[name=number_of_sessions]').val(evaluation_sessions_rows.length-1);
                    let last_session_row = evaluation_sessions_modal.find('[id^=session_]:last');
                    if(last_session_row.find('input[name=session_enable]').is(':checked')){
                        evaluation_sessions_modal.find('[id^=session_]:eq('+(evaluation_sessions_rows.length-2).toString()+') .ui.toggle.checkbox').checkbox('check');
                    }
                    last_session_row.remove();
                }
            });
            const evaluation_sessions_btn = window.$('#evaluation_sessions_btn.labeled.button');
            evaluation_sessions_btn.on('click', function () {
                evaluation_sessions_modal.modal('show');
            });
            evaluation_sessions_modal.modal({
                onApprove: function () {
                    let number_of_sessions = parseInt(evaluation_sessions_modal.find('form input[name=number_of_sessions]').val());
                    let fields_validation = {};
                    for (let i=0; i<number_of_sessions; i++){
                        fields_validation['start_date_p_'+(i+1)] = 'empty';
                        fields_validation['start_date_'+(i+1)] = 'empty';
                        fields_validation['end_date_p_'+(i+1)] = 'empty';
                        fields_validation['end_date_'+(i+1)] = 'empty';
                    }
                    evaluation_sessions_modal.find('form').form({fields:fields_validation});
                    if(!evaluation_sessions_modal.find('form').form('is valid')){
                        evaluation_sessions_modal.find('form').submit();
                        return false;
                    }
                    evaluation_sessions_modal.find('form').submit();
                },
                onDeny: function () {
                    document.location = document.location.origin + '/admin/scheduling'
                }
            });
        }
        // scheduler info
        const position_info = {
            top_offset: window.$('#schedule_table table')[0].offsetTop,
            header_h: window.$('#schedule_table table thead tr')[0].offsetHeight,
            tblock_h: window.$('#schedule_table table tbody tr')[0].offsetHeight / 2,
            timecol_w: window.$('#schedule_table table tbody tr td:first-child')[0].offsetWidth,
            weekday_w: window.$('#schedule_table table thead tr th:last-child')[0].offsetWidth
        };
        const lectures_container = window.$('#schedule_table .schedule');
        // draw schedule on page load
        draw_schedule(lectures_container,course_group_tab_btns,course_groups_tab,approve_btn,remove_schedule_btn,add_schedule_modal,return_btn,position_info,scheduling_stage);
    }
    // message page logic
    if(elementExist('#p_admin_messages')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(7)').addClass('olive');
        window.$('.vertical.menu a i:eq(7)').removeClass('grey').addClass('olive');

        const formURL = document.location.origin + '/admin/messages';
        const menu_items = window.$('#messages_menu .item');
        const messages_dimmer = window.$('#messages_dimmer');
        const messages_list = window.$('#messages_list');
        const no_messages = window.$('#no_messages');
        init_message_cards(messages_list,formURL);
        menu_items.on('click', function (){
            menu_items.removeClass('active');
            $(this).addClass('active');
            let bt_state = $(this).attr('data-state');
            if(bt_state === 'inbox'){
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getinbox',
                    type: "GET",
                    success: function(data) {
                        if(data === ''){
                            no_messages.show();
                        }else{
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list,formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function () {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            }else if(bt_state === 'star'){
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getstar',
                    type: "GET",
                    success: function(data) {
                        if(data === ''){
                            no_messages.show();
                        }else{
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list,formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function () {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            }else if(bt_state === 'later'){
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getlater',
                    type: "GET",
                    success: function(data) {
                        if(data === ''){
                            no_messages.show();
                        }else{
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list,formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function () {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            }else if(bt_state === 'archive'){
                messages_dimmer.dimmer('toggle');
                window.$.ajax({
                    url: formURL + '/getarchive',
                    type: "GET",
                    success: function(data) {
                        if(data === ''){
                            no_messages.show();
                        }else{
                            no_messages.hide();
                        }
                        messages_list.html(data);
                        init_message_cards(messages_list,formURL);
                        messages_dimmer.dimmer('toggle');
                    },
                    error: function () {
                        messages_dimmer.dimmer('toggle');
                    }
                });
            }
        });
    }
    // setting page logic
    if(elementExist('#p_admin_settings')){
        // active menu icon
        window.$('.computer.menu .basic.icon.button:eq(8)').addClass('black');
        window.$('.vertical.menu a i:eq(8)').removeClass('grey').addClass('black');

        window.$('.ui.dropdown').dropdown();

        const delete_admin_modal = window.$('#delete_admin.modal');
        const delete_admin_btn = window.$('#registered_admin_list tr .red.button');
        const delete_admin_form = delete_admin_modal.find('form');
        delete_admin_btn.on('click', function () {
            const admin_id = $(this).attr('data-id');
            delete_admin_modal.find('table tbody td:eq(0)').html(window.$('#registered_admin_list #admin_'+admin_id+' td:eq(0)').html());
            delete_admin_modal.find('table tbody td:eq(1)').html(window.$('#registered_admin_list #admin_'+admin_id+' td:eq(1)').html());
            delete_admin_form.attr('action', delete_admin_form.attr('action')+'/'+admin_id+'/unregisteradmin');
            delete_admin_modal.modal('show');
        });
        delete_admin_modal.modal({
            onApprove: function () {
                delete_admin_form.submit();
            }
        });

        const date_input_names = ['prereg_start_date', 'prereg_end_date', 'eval_start_date', 'eval_end_date', 'final_date'];
        const semester_options_form = window.$('#p_admin_settings form:eq(0)');
        for (let i=0; i<date_input_names.length; i++){
            let dp = semester_options_form.find('input[name='+date_input_names[i]+'_p]').persianDatepicker({
                initialValue: false,
                observer: true,
                autoClose: true,
                format: 'YYYY/MM/DD',
                altField: '#p_admin_settings form input[name='+date_input_names[i]+']',
                'toolbox': {
                    'enabled': false
                }
            });
            if(semester_options_form.find('input[name='+date_input_names[i]+']').val() !== ''){
                dp.setDate(parseInt(semester_options_form.find('input[name='+date_input_names[i]+']').val()));
            }
        }

        // init messages
        if(elementExist('#manage_admin_panel .message.session')){
            window.$('#manage_admin_panel .message.session .close').on('click', function() {
                $(this).closest('.message').transition('fade');
            });
            setTimeout(function () {
                if(!window.$('#manage_admin_panel .message.session').hasClass('hidden'))
                    window.$('#manage_admin_panel .message.session').transition('fade');
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