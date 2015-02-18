$( document ).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $('.profile-save').click(function (e) {

        $(".rotator").removeClass('hide');

    });

    // intake next arrow usability
    $('.arrow-next').click(function (e) {

        e.preventDefault();

        var $page = $("input[name=turnpage]").val();
        var $pageupdate = $("input[name=turnpageupdate]").val();

        $(".arrow-prev").show();
        $(".arrow-next").show();

        // did user answer the question?

        if ($page == 1){

            if($("input[name=1]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 1 answer missing.');
                $(".intake-err").show();

            }
        }

        if ($page == 2){

            if($("input[name=2]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 2 answer missing.');
                $(".intake-err").show();

            }
        }

        if ($page == 3){

            if($("input[name=3]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 3 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 4){

            if($("input[name=4]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 4 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 5){

            if($("input[name=5]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 5 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 6){

            if($("input[name=6]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 6 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 7){

            if($("input[name=7]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 7 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 8){

            if($("textarea[name=8]").val()!='') {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 8 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 9){

            if($('.field9 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 9 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 10){

            if($('.field10 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 10 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 11){

            if($("textarea[name=11]").val()!='') {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 11 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 12){

            if($('.field12 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 12 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 13){

            if($('.field13 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 13 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 14){

            if($('.field14 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 14 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 15){

            if($('.field15 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 15 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 16){

            if($("input[name=16]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 16 answer missing.');
                $(".intake-err").show();

            }

        }

        $page = parseInt($page) + 1;

        $("input[name=turnpage]").val($page);

        if($page == 17)
            $(".arrow-next").hide();


        if($page == 16 && $pageupdate == 1)
            $(".arrow-next").hide();

    });

    // intake previous arrow usability
    $('.arrow-prev').click(function (e) {

        e.preventDefault();

        var $page = $("input[name=turnpage]").val();

        $page = parseInt($page) - 1;

        // did user answer the question?

        if ($page == 1){

            if($("input[name=1]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 1 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 2){

            if($("input[name=2]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 2 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 3){

            if($("input[name=3]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 3 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 4){

            if($("input[name=4]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 4 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 5){

            if($("input[name=5]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 5 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 6){

            if($("input[name=6]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 6 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 7){

            if($("input[name=7]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 7 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 8){

            if($("textarea[name=8]").val()!='') {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 8 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 9){

            if($('.field9 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 9 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 10){

            if($('.field10 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 10 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 11){

            if($("textarea[name=11]").val()!='') {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 11 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 12){

            if($('.field12 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 12 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 13){

            if($('.field13 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 13 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 14){

            if($('.field14 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 14 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 15){

            if($('.field15 .token').length){

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 15 answer missing.');
                $(".intake-err").show();

            }

        }

        if ($page == 16){

            if($("input[name=16]").is(':checked')) {

                $(".intake-err").hide();

            }else{

                $(".intake-err").html('Question 16 answer missing.');
                $(".intake-err").show();

            }

        }


        $(".arrow-prev").show();
        $(".arrow-next").show();

        if($page == 1)
            $(".arrow-prev").hide();

        $("input[name=turnpage]").val($page);


    });


    $('.check-next').click(function (e) {

        e.preventDefault();

        var hash = window.location.hash;

        if (hash == '#q1')
            $('.prev').show();

    });

    $('.check-prev').click(function (e) {

        e.preventDefault();

        var hash = window.location.hash;

        if (hash == '#q2')
            $('.prev').hide();

    });


    /* ==== save questionnaire ====*/

    $('.submit-registration').click(function(e) {

        e.preventDefault();

        var $frm = $('#question_form');
        var $frm_data = JSON.stringify($frm.serializeArray());

        //console.log($frm_data);

        var form_data = {
            frm_data: $frm_data,
            first_name: $("input[name=first_name]").val(),
            last_name: $("input[name=last_name]").val(),
            email: $("input[name=email]").val(),
            password: $("input[name=password]").val(),
            password_confirm: $("input[name=password_confirm]").val(),
            csrf_tl_token: $("input[name=csrf_tl_token]").val(),
            is_ajax: '1'
        };

        $.ajax( {
            url: "/auth/create_user",
            type: 'POST',
            data: form_data,
            success: function(msg) {

                if(msg != undefined) {
                    var $obj = jQuery.parseJSON(msg);

                    $("input[name=first_name]").parent().removeClass('has-error');
                    $("input[name=last_name]").parent().removeClass('has-error');
                    $("input[name=email]").parent().removeClass('has-error');
                    $("input[name=password]").parent().removeClass('has-error');
                    $("input[name=password_confirm]").parent().removeClass('has-error');

                    switch($obj.vresult){

                        case "success":

                            $("#register-error-message").addClass('hide');
                            window.location.replace("/dashboard");
                            break;

                        default:
                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);

                            //console.log($obj.full_message);

                            // highlight fields that are incorrect

                            if ($obj.full_message.indexOf('First Name') >= 0)
                                $("input[name=first_name]").parent().addClass('has-error');

                            if ($obj.full_message.indexOf('Last Name') >= 0)
                                $("input[name=last_name]").parent().addClass('has-error');

                            if ($obj.full_message.indexOf('Email') >= 0)
                                $("input[name=email]").parent().addClass('has-error');

                            if ($obj.full_message.indexOf('valid email address') >= 0) {
                                $("input[name=email]").parent().addClass('has-error');
                                $obj.message = 'Email address is not valid.';
                            }
                            if ($obj.full_message.indexOf('Email Address field must contain a unique value') >= 0) {
                                $("input[name=email]").parent().addClass('has-error');
                                $obj.message = 'Email address already taken.';
                            }

                            if ($obj.full_message.indexOf('Password field') >= 0)
                                $("input[name=password]").parent().addClass('has-error');

                            if ($obj.full_message.indexOf('characters in length') >= 0) {
                                $("input[name=password]").parent().addClass('has-error');
                                $obj.message = 'Password must be at least 8 characters.';
                            }

                            if ($obj.full_message.indexOf('Password Confirmation') >= 0)
                                $("input[name=password_confirm]").parent().addClass('has-error');

                            if ($obj.full_message.indexOf('does not match the Password Confirmation') >= 0) {
                                $("input[name=password]").parent().addClass('has-error');
                                $("input[name=password_confirm]").parent().addClass('has-error');
                                $obj.message = 'Password fields must match.';
                            }

                            $("#register-error-message").html($obj.message);
                            $("#register-error-message").removeClass('hide');

                    }

                }

            }

        });

    });


    /* ==== update questionnaire ====*/

    $('.update-registration').click(function(e) {

        e.preventDefault();

        var $frm = $('#question_form');
        var $frm_data = JSON.stringify($frm.serializeArray());

        //console.log($frm_data);

        var form_data = {
            frm_data: $frm_data,
            csrf_tl_token: $("input[name=csrf_tl_token]").val(),
            is_ajax: '1'
        };

        $.ajax( {
            url: "/auth/update_user",
            type: 'POST',
            data: form_data,
            success: function(msg) {

                if(msg != undefined) {
                    var $obj = jQuery.parseJSON(msg);


                    switch($obj.vresult){

                        case "success":

                            window.location.replace("/dashboard?update=1");
                            break;

                        default:
                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);

                            //console.log($obj.full_message);


                            $("#register-error-message").html($obj.message);
                            $("#register-error-message").removeClass('hide');

                    }

                }

            }

        });

    });

    /* ==== login ====*/

    $('#submit-login').click(function(e) {

        e.preventDefault();

        var identity = $('#login-email').val();
        var password = $('#login-password').val();

        var remember = $('#check-1').prop( "checked" );

        var form_data = {
            identity: identity,
            password: password,
            remember: remember,
            csrf_tl_token: $("input[name=csrf_tl_token]").val(),
            is_ajax: '1'
        };

        $.ajax( {
            url: "/auth/login",
            type: 'POST',
            data: form_data,
            success: function(msg) {

                if(msg != undefined) {
                    var $obj = jQuery.parseJSON(msg);

                    switch($obj.vresult){

                        case "success":

                            $("#login-error-message").addClass('hide');
                            window.location.replace("/dashboard");
                            break;

                        default:
                            if($obj.message == '')
                                $obj.message = "Username or Password Incorrect";

                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);
                            $("#login-error-message").html($obj.message);
                            $("#login-error-message").removeClass('hide');


                    }

                }

            }

        });

    });

    $('#submit-reset-password').click(function(e) {

        e.preventDefault();

        var $email = $('#forgot-email').val();

        var form_data = {
            email: $email,
            csrf_tl_token: $("input[name=csrf_tl_token]").val(),
            is_ajax: '1'
        };

        $.ajax( {
            url: "/auth/forgot_password",
            type: 'POST',
            data: form_data,
            success: function(msg) {

                if(msg != undefined) {
                    var $obj = jQuery.parseJSON(msg);

                    switch($obj.vresult){

                        case "success":

                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);
                            $("#forgot-error-message").addClass('hide');
                            $("#forgot-success-message").removeClass('hide');
                            break;

                        default:
                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);
                            $("#forgot-error-message").removeClass('hide');
                    }

                }

            }

        });

    });

    $('#submit-set-password').click(function(e) {
        e.preventDefault();

        var $code = $("input[name=code]").val();
        var $user_id = $("input[name=user_id]").val();
        var $new = $('#new-password').val();
        var $new_confirm = $('#new-password-confirm').val();

        var form_data = {
            new : $new,
            user_id: $user_id,
            new_confirm : $new_confirm,
            csrf_tl_token: $("input[name=csrf_tl_token]").val(),
            is_ajax: '1'
        };

        $.ajax( {
            url: "/auth/reset_password/" + $code,
            type: 'POST',
            data: form_data,
            success: function(msg) {

                if(msg != undefined) {
                    var $obj = jQuery.parseJSON(msg);

                    switch($obj.vresult){

                        case "success":

                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);
                            $("#reset-message-success").removeClass('hide');
                            $("#reset-message-fail").addClass('hide');
                            $("#reset-message-success").html($obj.message);
                            break;

                        default:
                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);
                            $("#reset-message-success").addClass('hide');
                            $("#reset-message-fail").removeClass('hide');
                            $("#reset-message-fail").html($obj.message);
                    }
                }
            }
        });
    });

});

$(function() {

    var $window = $(window);
    var sectionTop = $('.top').outerHeight() + 20;
    var $createDestroy = $('#switch-create-destroy');

    // initialize highlight.js
    hljs.initHighlightingOnLoad();

    // navigation
    $('a[href*="#"]').on('click', function(event) {
        event.preventDefault();
        var $target = $($(this).attr('href').slice('#'));

        if ($target.length) {
            $window.scrollTop($target.offset().top - sectionTop);
        }
    });

    // initialize all the inputs
    $('.switcher')
        .not("[data-switch-no-init]")
        .bootstrapSwitch();

    $('[data-switch-get]').on("click", function() {
        var type = $(this).data('switch-get');

        alert($('#switch-' + type).bootstrapSwitch(type));
    });

    $('[data-switch-set]').on('click', function() {
        var type = $(this).data('switch-set');

        $('#switch-' + type).bootstrapSwitch(type, $(this).data('switch-value'));
    });

    $('[data-switch-toggle]').on('click', function() {
        var type = $(this).data('switch-toggle');

        $('#switch-' + type).bootstrapSwitch('toggle' + type.charAt(0).toUpperCase() + type.slice(1));
    });

    $('[data-switch-set-value]').on('input', function(event) {
        event.preventDefault();
        var type = $(this).data('switch-set-value');
        var value = $.trim($(this).val());

        if ($(this).data('value') == value) {
            return;
        }

        $('#switch-' + type).bootstrapSwitch(type, value);
    });

    $('[data-switch-create-destroy]').on('click', function() {
        var isSwitch = $createDestroy.data('bootstrap-switch');

        $createDestroy.bootstrapSwitch(isSwitch ? 'destroy' : null);
        $(this).button(isSwitch ? 'reset' : 'destroy');
    });
});