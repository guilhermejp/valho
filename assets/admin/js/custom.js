$( document ).ready(function() {

    // Toggle Search
    $('.show-search').click(function(){
        $('.search-form').css('margin-top', '0');
        $('.search-input').focus();
    });

    $('.close-search').click(function(){
        $('.search-form').css('margin-top', '-60px');
    });


    // Fullscreen
    function toggleFullScreen() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
            (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
    }

    $('.toggle-fullscreen').click(function(){
        toggleFullScreen();
    });

    // tooltips
    $( '[data-toggle~="tooltip"]' ).tooltip({
        container: 'body'
    });

    function unblockUI(item) {
        $(item).unblock();
    }

    // Waves
    Waves.displayEffect();

    // Push Menu
    $('.push-sidebar').click(function(){
        var hidden = $('.sidebar');

        if (hidden.hasClass('visible')){
            hidden.removeClass('visible');
            $('.page-inner').removeClass('sidebar-visible');
        } else {
            hidden.addClass('visible');
            $('.page-inner').addClass('sidebar-visible');
        }
    });

    var sidebarAndContentHeight = function () {
        var content = $('.page-inner'),
            sidebar = $('.page-sidebar'),
            body = $('body'),
            height,
            footerHeight = $('.page-footer').outerHeight(),
            pageContentHeight = $('.page-content').height();

        content.attr('style', 'min-height:' + sidebar.height() + 'px !important');

        if (body.hasClass('page-sidebar-fixed')) {
            height = sidebar.height() + footerHeight;
        } else {
            height = sidebar.height() + footerHeight;
            if (height  < $(window).height()) {
                height = $(window).height();
            }
        }

        if (height >= content.height()) {
            content.attr('style', 'min-height:' + height + 'px !important');
        }
    };

    sidebarAndContentHeight();

    window.onresize = sidebarAndContentHeight;

    // Panel Control
    $('.panel-collapse').click(function(){
        $(this).closest(".panel").children('.panel-body').slideToggle('fast');
    });

    $('.panel-reload').click(function() {
        var el = $(this).closest(".panel").children('.panel-body');
        blockUI(el);
        window.setTimeout(function () {
            unblockUI(el);
        }, 1000);

    });

    $('.panel-remove').click(function(){
        $(this).closest(".panel").hide();
    });

    // Slimscroll
    $('.slimscroll').slimscroll({
        allowPageScroll: true
    });

    $('.page-sidebar-fixed .page-sidebar-inner').slimScroll();

    $(".table-sortable").sortable({
        connectWith: '.sortable',
        items: 'tbody tr',
        helper: 'original',
        //revert: true,
        //placeholder: 'panel-placeholder',
        forcePlaceholderSize: true,
        opacity: 0.95,
        cursor: 'move'
    });

    if($('.btn-save-order').length > 0){
        $('.btn-save-order').click(function(){
            $('.btn-save-order').attr('disabled', 'disabled');
            var params = $('[name=id]').serialize();
            var regex = new RegExp('=', 'g');
            params = params.replace(regex, '[]=');
            $.get(base_url+'admin/launch/order', params, function(){
                $('.btn-save-order').removeAttr('disabled');
            });
        });
    }

    if($('.btn-save-launch-order').length > 0){
        $('.btn-save-launch-order').click(function(){
            $.post(location.href, $('[name="position[]"]').serialize(), function(){
                  history.go(0);
            });
        });
    }

    $('.fileupload').fileupload();
    // Load existing files:
    $('.fileupload').addClass('fileupload-processing');
    $('.fileupload').each(function(){
        var fileuploadobj = $(this);
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            method: 'POST',
            data: fileuploadobj.serialize(),
            url: fileuploadobj.attr('action'),
            dataType: 'json',
            context: fileuploadobj[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
			$('.fileupload .input-legend').hide();
			$('.fileupload.with-legend .input-legend').show();
            enablesort();
        });
    });
    enablesort();

    $('.money-mask').mask("#.##0,00", {reverse: true});
    $('.number-mask').mask("#0", {reverse: true});

    $('.datetimepicker-input').each(function(){
        var value = $('.datetimepicker-input').val();
        $(this).datetimepicker({
            locale: 'pt-BR',
            format: 'dd/mm/yyyy hh:ii',
            useCurrent: false,
            showTodayButton: true
            //minDate: moment().format()
        });
        console.log(value);
        if(value == ''){
            console.log('sdff');
            $(this).datetimepicker('setDate', undefined);
        }
    });
	
	if ($(".summernote").length){
		$('.summernote').summernote({
			height: 350,
			placeholder: 'Clique aqui para come&ccedil;ar a editar sua p&aacute;gina...'
		});
		
		$('form').submit(function(){
			$('#content').val($('.summernote').summernote('code'));
		});
	}

    if(typeof calendarFunction == 'function'){ calendarFunction(); }
    
});

function enablesort(){
    $(".table-enable-sort").sortable({
        connectWith: '.sortable',
        items: 'tbody tr',
        helper: 'original',
        //revert: true,
        //placeholder: 'panel-placeholder',
        forcePlaceholderSize: true,
        opacity: 0.95,
        cursor: 'move'
    });
}
