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


    /* ==== login ====*/

    $('#submit-login').click(function(e) {

        e.preventDefault();

        var identity = $('#login-email').val();
        var password = $('#login-password').val();

        var form_data = {
            identity: identity,
            password: password,
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


});