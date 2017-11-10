<div id="feedback-panel">
    <div id="feedback-btn">
        <button class="ui blue large right labeled icon button">
            <i class="talk icon"></i>
            <span class="fw-300">ارتباط با ما</span>
        </button>
    </div>
    <div id="feedback-type">
        <div class="fb-bt bt1">
            <i class="smile icon"></i>
        </div>
        <div class="fb-bt bt2">
            <i class="frown icon"></i>
        </div>
        <div class="fb-bt bt3">
            <i class="heart icon"></i>
        </div>
    </div>
    <div id="feedback-msg">
        <div id="feedback_dimmer" class="ui dimmer">
            <div class="ui loader"></div>
        </div>
        <div id="feedback_success" class="ui dimmer">
            <div class="content">
                <div class="center">
                    <h4 class="ui inverted icon header">
                        <i class="check circle icon"></i>
                        <span class="fw-300">پیام شما با موفقیت ارسال شد!</span>
                    </h4>
                </div>
            </div>
        </div>
        <form id="feedbackForm" class="ui form" method="POST" action="{{ url('/') }}">
            {{ csrf_field() }}
            <div class="field">
                <input id="mtype" name="mtype" value="" type="hidden">
                <textarea id="message" name="message" rows="4" placeholder="پیام شما می‌تواند خالی باشد!" tabindex="10"></textarea>
            </div>
            <div class="fields">
                <div class="thirteen wide field">
                    <button id="send-btn" type="submit" class="ui fluid green button" tabindex="11">
                        <span class="fw-300">ارسال پیام</span>
                    </button>
                </div>
                <div class="three wide field">
                    <div id="msg-type">
                        <i class="smile inverted icon"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>