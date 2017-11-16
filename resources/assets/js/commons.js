export function feedbackInit() {
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

