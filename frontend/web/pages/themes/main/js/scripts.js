$(document).ready(function() {

    var bdy = $('body');

    $('.property > ul > li > a').click(function(){

        var el = $(this),
            target = el.parent('li'),
            cont = el.closest('ul');

        cont.find('.active').removeClass('active');

        target.toggleClass('active');

        return false;
    });

    bdy.on('click', '.order-details > li > .extended', function(){
        var el = $(this),
            cont = el.closest('li'),
            target = cont.find('.extend');

        el.toggleClass('open');
        target.slideToggle(300);

        return false;
    });

    bdy.on('click', '.select-date-table tbody tr td .date-select', function(){
        var el = $(this),
            cont =  $('.select-date-table');

        if (!el.is('.disabled')){
            cont.find('.checked').removeClass('checked');
            el.addClass('checked');
        }

    });

    bdy.on('click', '.tables-count-list > li', function(e){

        if (e.target.tagName != 'A') {
            var el = $(this),
                target = el,
                cont = el.closest('ul');

            cont.find('.checked').removeClass('checked');
            target.addClass('checked');
        }


    });

    bdy.on('click', '.event-category-list > li', function(e){

        if (e.target.tagName != 'A') {
            var el = $(this),
                target = el,
                cont = el.closest('ul');

            cont.find('.checked').removeClass('checked');
            target.addClass('checked');
        }


    });

    bdy.on('click', '.extra-items-list > li', function(e){

        if (e.target.tagName != 'A') {
            //var el = $(this),
            //    target = el,
            //    cont = el.closest('ul');
            //
            //target.toggleClass('checked');
        }
    });


    $('select.form-control').on('change', function(){
        $(this).addClass('touched');
    });

    $('.mainnav-button').click(function(){

        var el = $(this),
            target = $(el.attr('href'));

        target.slideToggle();

        return false;
    });

    $('.plus').click(function(){
        var el = $(this);
        var input = el.siblings("input");
        var value = parseInt(input.val())

        input.val(value + 1);

        return false;
    });

    $('.minus').click(function(){
        var el = $(this);
        var input = el.siblings("input");
        var value = parseInt(input.val())

        if (value > 0) {
            input.val(value - 1);
        }

        return false;
    });


    //custom radio/chackbox class toggler
    if ($('input[type="radio"]:checked').length) {
        $('input[type="radio"]:checked').parent("label").addClass('checked');
    }
    if ($('input[type="checkbox"]:checked').length) {
        $('input[type="checkbox"]:checked').parent("label").addClass('checked');
    }
    $('label input[type="radio"]').change(
        function(){
            var el = $(this);

            radioRender(el);
        }
    );

    $('label input[type="checkbox"]').change(
        function(){
            var el = $(this);
            var parent = el.parent('label');
            parent.toggleClass('checked');
        }
    );
    //end custom radio class toggler

    $(window).trigger('resize');

});

$(window).resize(function() {
    menuCalc();
});

$(window).scroll( function(){
});

function radioRender(el) {
    var parent = el.parent('label');

    $('input[name="'+el.attr('name')+'"]').parent('label').removeClass('checked');
    $('input[name="'+el.attr('name')+'"]').prop('checked', false);

    parent.toggleClass('checked');
    el.prop('checked', true);
}

function menuCalc(){
    $('.mainnav-button').each(function(){
        var el = $(this),
            target = $(el.attr('href'));

        if (el.is(':hidden')) {
            target.show();
        } else {
            target.hide();
        }
    });
}