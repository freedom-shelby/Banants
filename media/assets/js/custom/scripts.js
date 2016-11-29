$(document).ready(function() {

    /**
     * Функции для Quiz
     */
    $( "#quizzes" ).submit(function(e) {
        e.preventDefault();

        var isPrivate = detectPrivateMode(
            function(is_private) {
                var a = typeof is_private === 'undefined' ? 2 : is_private ? true : false;
            }
        );

// console.log(a)
        $.ajax({
            type: 'POST',
            data: {'quiz': $(document).find('#home input[name="quiz"]:checked').val(), 'is_private': isPrivate},
            url: '/server/quiz.html',
            dataType: 'json',
            async: true
        }).success(function(data){
            //console.log(data);
            if(data.status == 'ok'){
                // $("#home").addClass("hidden");
                // $("#home_thanks").removeClass("hidden");
                $("#home #quizzes").html(data.html);
                quizPercentage();
            }else {
                if(data.status == 'nok'){
                    $("#home").addClass("hidden");
                    $("#home_error").removeClass("hidden");
                }else{
                    alert('Ответ не принят');
                }
            }
        });
    });

    if($('#home #quizzes').length > 0) {
        quizPercentage();
    }

    $( window ).load(function() {
        if($('#home').length > 0) {
            quizDoResponsive();
        }
    });

    // Сделать опрос респонсивном
    function quizDoResponsive() {
        var leftBarChildrens = 0;
        var leftBar;
        var content;
        var quiz;
        var dif;

        $('.leftbar').children().not('#home').each(function(){
            leftBarChildrens += $(this).outerHeight(true);
        });

        if($('.content').length > 0) {
            content = $('.content').outerHeight(true);
        }
        if($('#content').length > 0) {
            content = $('#content').outerHeight(true);
        }

        leftBar = $('#home').outerHeight(true) + leftBarChildrens;
        dif = content - leftBar;

        // Если dif + (то есть true) то надо растянуть опрос
        if(dif > 0){
            quiz = content - leftBarChildrens;
            $('#home').outerHeight(quiz, true);
        }
    }

    // Нарисовка статистики Опроса по процентам
    function quizPercentage() {
        $("#quizzes div.percent").each(function() {
            var s = $(this).text() + ' 100%';
            $(this).css({"background-size": s});
        });
    }

/* dialog */
    $(function() {
        $('.dialog').each(function(i, item){
            $( ".dialog" + i).dialog({
                autoOpen: false,
                draggable: false,
                modal:true,
                width: 'auto',
                height: 'auto',
                dialogClass: "loadingDialog",
                autoReposition: true,
                maxWidth: 480,
                position: {
                    my: "center",
                    at: "center",
                    of: window
                },

                open: function(){
                    jQuery('.ui-widget-overlay').bind('click',function(){
                        jQuery('#dialog,#login').dialog('close');
                    })
                }
            })

        });

        $( ".photo1" ).click(function() {
            var calldialog = $(this).data().calldialog;
            $('.' + calldialog).dialog( "open" );
        });

        $(window).resize(function() {
            $("#login").dialog("option", "position", {my: "center", at: "center", of: window});
        });

        $('.navigation .submenu_parent > a').on('click', function(e){
            e.preventDefault();
        });
    });

    if($(".container_top_slideshow").length > 0) {
        $(".container_top_slideshow").owlCarousel({
            navigation : true,
            pagination: true,
            slideSpeed : 300,
            paginationSpeed : 400,
            navigationText: false,
            singleItem: true,
            autoPlay : 4000
        });
    }

   
    if($('.leftbar_images_slider').length > 0) {
        $(".leftbar_images_slider").owlCarousel({
            navigation : false,
            pagination: true,
            slideSpeed : 300,
            paginationSpeed : 400,
            navigationText: false,
            singleItem: true
        });
    }

    if($('.news_slider').length > 0) {
        $(".news_slider").owlCarousel({
            navigation : false,
            pagination: true,
            slideSpeed : 300,
            paginationSpeed : 400,
            navigationText: false,
            singleItem: true
        });
    }

    if($('.infrastruct_slider').length > 0) {
        $(".infrastruct_slider").owlCarousel({
            navigation : false,
            pagination: true,
            slideSpeed : 300,
            paginationSpeed : 400,
            navigationText: false,
            singleItem: true
        });
    }

    if($('.tournament_slider').length > 0) {
        $(".tournament_slider").owlCarousel({
            navigation : true,
            pagination: true,
            slideSpeed : 300,
            paginationSpeed : 400,
            navigationText: false,
            singleItem: true,
            afterInit : attachEvent
        });
    }

    if($('.shooter_slider').length > 0) {
        $(".shooter_slider").owlCarousel({
            navigation : true,
            pagination: true,
            slideSpeed : 300,
            paginationSpeed : 400,
            navigationText: false,
            singleItem: true,
            afterInit : attachEvent
        });
    }

    function attachEvent(elem){
        elem.parent().find('.tournament_slider_next').on('click',function(){
            elem.trigger('owl.next')
        })

        elem.parent().find('.tournament_slider_prev').on('click',function(){
            elem.trigger('owl.prev')
        })
    }

    if($('.carousel_slider').length) {
        $('.carousel_slider').owlCarousel({
            //autoPlay: 3000,
            items : 3,
            navigation : false,
            pagination: true,
            navigationText: false,
            responsive: false,
            autoPlay : 3000
        });
    }

    if($('.dialog_slider').length) {
        $('.dialog_slider').owlCarousel({
            //autoPlay: 3000,
            items : 6,
            navigation : false,
            pagination: true,
            navigationText: false,
            responsive: false,
            autoPlay : 8000
        });
    }


    //if($( "#accordion" ).length) {
    //    $(function() {
    //       $( "#accordion" ).accordion({
    //          event: "mouseover",
    //          autoHeight:false,
    //          heightStyle: "content",
    //          collapsible: true,
    //          alwaysOpen: false,
    //          header: 'span',
    //          active:2,
    //          header: '.accordion_title'
    //          //active: false
    //       });
    //    });
    // }

    if($( "#item_tabs" ).length) {
        $(document).ready(function() {
            $(function() {
                $( "#item_tabs" ).tabs();
            });
        });
    }

    /*if($('.leftbar_images_slider_item').length && $('.content_middle_slider_item').length) {
      var $container = ['.leftbar_images_slider_item', '.content_middle_slider_item'];
      var itemSelector = ['.leftbar_slider_images', '.content_slider_images'];

      $container.forEach(function(item, key) {
         $(item).imagesLoaded(function(){
             $(item).masonry({
                 itemSelector: itemSelector[key],
                 columnWidth: 1
             });
          });
      });           
   }     */


    if($(".content_middle_slider").length > 0) {
        $(".content_middle_slider").owlCarousel({
            navigation : false,
            pagination: true,
            slideSpeed : 300,
            paginationSpeed : 400,
            navigationText: false,
            singleItem: true
        });
    }

    if($('.fancybox').length) {
        $('.fancybox').fancybox({
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
    }

    /* navigation on hover dropdown show */
    $('.navigation li').hover(function() {
        $(this).find('.submenu').stop(false, true).fadeIn(100);
        $(this).addClass('navigation_active_item');
    }, function() {
        $(this).find('.submenu').stop(false, true).fadeOut(100);
        if($(this).find('.submenu:visible')) {
            $(this).removeClass('navigation_active_item');
        }
    })

});

/*Video*/
$(document).ready(function() {
    if($(".various").length > 0) {
        $(".various").fancybox({
            maxWidth   : 800,
            maxHeight  : 600,
            fitToView  : false,
            width     : '70%',
            height    : '70%',
            autoSize   : false,
            closeClick : false,
            openEffect : 'none',
            closeEffect    : 'none',
            helpers: {
                overlay: {
                    locked: false
                }
            },
            beforeShow  : function() {
                // Find the iframe ID
                var id = $.fancybox.inner.find('iframe').attr('id');
                console.log('id', id);
            }
        });
    }

    $('.photo1 a').click(function(e){
        e.preventDefault();
    });

    //"http://img.youtube.com/vi/"+vid+"/0.jpg";

    /*  Video  */

    $('.widget.widget-with-tabs').banantsTabsWidget();

    //"http://img.youtube.com/vi/"+vid+"/0.jpg";

    /*--------------------------------------------- Form Validation ---------------------------------*/

    function validateForm() {
        var x = document.forms["clearfix"]["username"].value;
        if (x == null || x == "") {
            alert("Fill out the form");
            return ("Registration is done successfully");
        }
    }
});

$(document).ready(function () {
    size_li = $("#myList li").length;
    x=3;
    $('#myList li:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('#myList li:lt('+x+')').show();
    });
    $('#showLess').click(function () {
        x=(x-5<0) ? 3 : x-5;
        $('#myList li').not(':lt('+x+')').hide();
    });
});
