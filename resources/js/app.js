//

$(function () {

    $('#superSidebarToggle').on('click', function () {

        $('#superSidebar')
            .toggleClass('open');

        $('#superSidebarOverlay')
            .toggleClass('open');

    });


    $('#superSidebarOverlay').on('click', function () {

        $('#superSidebar')
            .removeClass('open');

        $(this)
            .removeClass('open');

    });

});

