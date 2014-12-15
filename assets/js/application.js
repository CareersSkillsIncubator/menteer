$( document ).ready(function() {

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

        console.log($frm_data);

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

                    switch($obj.vresult){

                        case "success":

                            $("#register-error-message").addClass('hide');
                            window.location.replace("/dashboard");
                            break;

                        default:
                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);
                            $("#register-error-message").html($obj.message);
                            $("#register-error-message").removeClass('hide');
                            console.log($obj.full_message);



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
                            $("input[name=csrf_tl_token]").val($obj.csrf_hash);
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