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

});