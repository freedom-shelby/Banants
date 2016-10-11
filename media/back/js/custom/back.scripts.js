/**
 * Loader
 */
var body = $("body");

$(document).on({
    ajaxStart: function() {
        body.addClass("loading");
    },
    ajaxStop: function() {
        body.removeClass("loading");

        /**
         * При завершении AJAX Задествовать скрипт для Photo Galleries
         */
        if($('#photo-paginate').length > 0) {
            runScripts();
        }
    }
});
/** #Loader */

$(document).ready(function(){
    // Базовый объект с параметрами
    var App = {};
    // Базовый урл сайта
    App.baseURL = $('#main').attr('data-base-url');
    // Текуший язык
    App.currentLangIso = $('#main').attr('data-current-lang-iso');
    // Приставка к URL
    App.uriExt = $('#main').attr('data-uri-ext');
    // Метод возвращающий относительный урл
    App.URL = function(uri){
        return this.baseURL + uri + App.uriExt;
    };

    /**
     * Sortable Node Scripts
     */
    $('.sortable').nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div > span',
        helper:	'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div',
        maxLevels: 4,
        isTree: true,
        expandOnHover: 700,
        startCollapsed: false,
        rootID: null,
        listType: 'ol',
        disableParentChange: false,
        excludeRoot: true
    });

    // Сортировка для турниной таблици
    $('.sortable-table').sortable({
        stop: function( e, ui ){
            $(this).find('tr').each(function(i){
                $(this).find('td:first input').val(i+1);
            });
        }
    });

    $('#show-invisible-items').change(function() {
        if($(this).is(":checked")) {
            $(document).find('.invisible-item').show();
        }else{
            $(document).find('.invisible-item').hide();
        }
    });

//        $('.expandEditor').attr('title','Click to show/hide item editor');
//        $('.disclose').attr('title','Click to show/hide children');
//        $('.deleteMenu').attr('title', 'Click to delete item.');
//
//        $('.disclose').on('click', function() {
//            $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
//            $(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
//        });
//
//        $('.expandEditor, .itemTitle').click(function(){
//            var id = $(this).attr('data-id');
//            $('#menuEdit'+id).toggle();
//            $(this).toggleClass('ui-icon-triangle-1-n').toggleClass('ui-icon-triangle-1-s');
//        });

    $('#serialize').click(function(){
        serialized = $('ol.sortable').nestedSortable('serialize');
        $('#serializeOutput').text(serialized+'\n\n');
    });

    $('#toHierarchy').click(function(e){
        hiered = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
        hiered = dump(hiered);
        (typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
            $('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;
    });

    $('#toArray').click(function(e){
        arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
        arraied = dump(arraied);
        (typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?
            $('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
    });

    $(document).on('click','button[name="article-node-save"]',function(){
        var data = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
        $.ajax({
            type: 'POST',
            //url: '/Admin/Categories/Save.html',
            url: App.URL('Admin/Categories/Save'),
            data: {data: JSON.stringify(data)},
            //data: {data: data},
            async: false
        }).success(function(response){
            $(document).find('#messages').html(response);
        });
    });

    $(document).on('click','button[name="menu-node-save"]',function(){
        var data = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
        $.ajax({
            type: 'POST',
            //url: '/Admin/Categories/Save.html',
            url: App.URL('Admin/Menus/Save'),
            data: {data: JSON.stringify(data)},
            //data: {data: data},
            async: false
        }).success(function(response){
            $(document).find('#messages').html(response);
        });
    });

    /**
     * Отображение картинок для матерялов
     */
    if($('#photo-paginate').length > 0) {
        getPhotos($('#photo-paginate').attr('data-server-url'));
    }

    $(document).on('click','#photo-paginate .pagination a', function(e){
        if(e.preventDefault){
            e.preventDefault();
        }else if(e.stopPropagation){
            e.stopPropagation();
        }else{
            return false;
        }
        getPhotos($(this).attr('href'));
    });

    function getPhotos(url){

        // var url = photoUrl ? photoUrl : App.URL('Admin/Server/getPhotos');

        $.get({
            url: url,
            async: true
        }).success(function(html){
            $('#photo-paginate').html(html);
        }).error(function(){
            alert('Cant get photos');
        });
    }

    /**
     * Отображение картинок для Албомов
     */
    // if($('#photo-paginate').length > 0){
    //     getPhotosForGallery();
    // }
    //
    // $(document).on('click','#photo-paginate .pagination a', function(e){
    //     if(e.preventDefault){
    //         e.preventDefault();
    //     }else if(e.stopPropagation){
    //         e.stopPropagation();
    //     }else{
    //         return false;
    //     }
    //     getPhotosForGallery($(this).attr('href'));
    // });
    //
    // function getPhotosForGallery(photoUrl){
    //
    //     var url = photoUrl ? photoUrl : App.URL('Admin/Server/getPhotosForGallery');
    //
    //     $.get({
    //         url: url,
    //         async: true
    //     }).success(function(html){
    //         $('#photo-paginate').html(html);
    //     }).error(function(){
    //         alert('Cant get photos');
    //     });
    // }



    /**
     * Инициализация ContextMenu для Редактирования Article.New и Article.Edit
     */
    $(function(){
        $.contextMenu({
            selector: '.article-context-menu',
            //callback: function(key, options) {
            //    var m = "global: " + key;
            //    window.console && console.log(m) || alert(m);
            //},
            items: {
                "setAsDefault": {
                    name: "Set As Default",
                    //icon: function($element, key, item){ return 'glyphicon glyphicon-ok'; },
                    icon: "edit",
                    callback: function(key, options) {
                        var photo = $(this).find('.img-responsive');
                        var photoId = photo.attr('data-photo-id');
                        var photoUrl = photo.attr('src');
                        $(document).find('#article-photo-id').val(photoId);
                        $(document).find('#article-photo-url').attr('src', photoUrl);
                    }
                }
            }
        });
    });

    /**
     * Confirm Remove
     */
    $(document).on('click','a.remove-confirm',function(){
        return confirm('Are You sure to delete this item');
    });
});

function dump(arr,level) {
    var dumped_text = "";
    if(!level) level = 0;

    //The padding given at the beginning of the line.
    var level_padding = "";
    for(var j=0;j<level+1;j++) level_padding += "    ";

    if(typeof(arr) == 'object') { //Array/Hashes/Objects
        for(var item in arr) {
            var value = arr[item];

            if(typeof(value) == 'object') { //If it is an array,
                dumped_text += level_padding + "'" + item + "' ...\n";
                dumped_text += dump(value,level+1);
            } else {
                dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
        }
    } else { //Strings/Chars/Numbers etc.
        dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
    }
    return dumped_text;
}
/** #Sortable Node Scripts **/

/**
 * Инициализация Редактора TinyMCE
 */
tinymce.init({
    selector: '.tinymce',
    height: 500,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_css: [
        '/media/assets/css/style.css'
    ],
    body_id: 'content',
    extended_valid_elements :"script[language|type|src]",
    style_formats: [
        {title: 'Custom', items: [
            {
                title: 'Header',
                block: 'p',
                classes: 'article-header'
            },
            {
                title: 'Pull Left',
                selector: 'div, a, img, p',
                classes: 'article-pull-left'
            },
            {
                title: 'Pull Right',
                selector: 'img, p',
                classes: 'article-pull-right'
            },
            {
                title: 'Red text',
                inline: 'span',
                styles: {
                    color: '#ff0000'
                }
            }
        ]}
    ],
    style_formats_merge: true
});

/**
 * Скрипти для DragAndDrop-а после AJAX -а
 */
var runScripts = function(){

    // There's the gallery and the trash
    var $gallery = $(document).find( "#gallery" ),
        $photoGallery = $(document).find( "#photo-gallery" );

    // Let the gallery items be draggable
    $( "li", $gallery ).draggable({
        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
        revert: "invalid", // when not dropped, the item will revert back to its initial position
        containment: "document",
        helper: "clone",
        cursor: "move"
    });

    // Let the gallery items be draggable
    $( "li", $photoGallery ).draggable({
        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
        revert: "invalid", // when not dropped, the item will revert back to its initial position
        containment: "document",
        helper: "clone",
        cursor: "move"
    });

    // Let the trash be droppable, accepting the gallery items
    $photoGallery.droppable({
        accept: "#gallery > li",
        classes: {
            "ui-droppable-active": "ui-state-highlight"
        },
        drop: function( event, ui ) {
            dragToGallery( ui.draggable );
        }
    });

    // Let the gallery be droppable as well, accepting items from the trash
    $gallery.droppable({
        accept: "#photo-gallery li",
        classes: {
            "ui-droppable-active": "custom-state-active"
        },
        drop: function( event, ui ) {
            recycleImage( ui.draggable );
        }
    });

    // Image deletion function
    // a href = link/to/trash/script/when/we/have/js/off
    var recycle_icon = "<a href='#' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";
    function dragToGallery( $item ) {
        $item.fadeOut(function() {
            var $list = $( "ul", $photoGallery ).length ?
                $( "ul", $photoGallery ) :
                $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $photoGallery );

            $item.find( "a.ui-icon-refresh" ).remove();
            $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
                $item
                    .animate({ width: "48px" })
                    .find( "img" )
                    .animate({ height: "36px" });
            });
        });
    }

    // Image recycle function
    // a href = link/to/recycle/script/when/we/have/js/off
    var gallery_icon = "<a href='#' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
    function recycleImage( $item ) {
        $item.fadeOut(function() {
            $item
                .find( "a.ui-icon-trash" )
                .remove()
                .end()
                .css( "width", "96px")
                .append( gallery_icon )
                .find( "img" )
                .css( "height", "72px" )
                .end()
                .appendTo( $gallery )
                .fadeIn();
        });
    }

    // Image preview function, demonstrating the ui.dialog used as a modal window
    function viewLargerImage( $link ) {
        var src = $link.attr( "href" ),
            title = $link.siblings( "img" ).attr( "alt" ),
            $modal = $( "img[src$='" + src + "']" );

        if ( $modal.length ) {
            $modal.dialog( "open" );
        } else {
            var img = $( "<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />" )
                .attr( "src", src ).appendTo( "body" );
            setTimeout(function() {
                img.dialog({
                    title: title,
                    width: 400,
                    modal: true
                });
            }, 1 );
        }
    }

    // Resolve the icons behavior with event delegation
    $(document).find( "ul.gallery > li" ).on( "click", function( event ) {
        var $item = $( this ),
            $target = $( event.target );

        if ( $target.is( "a.ui-icon-refresh" ) ) {
            if( ! hasUniqueImage($item)){
                alert('Photo has already exist in photo gallery');
                return false;
            }
            dragToGallery( $item );
        } else if ( $target.is( "a.ui-icon-zoomin" ) ) {
            viewLargerImage( $target );
        } else if ( $target.is( "a.ui-icon-trash" ) ) {
            recycleImage( $item );
        }

        return false;
    });

    /**
     * Проверяет принедлежит ли картинка текущему албому
     */
    function hasUniqueImage($item) {
        var photoId = $item.attr( "data-photo-id" );

        var img = $photoGallery.find('li').filter(function() {
             return $( this ).attr( "data-photo-id" ) == photoId;
         });

         if(img.length > 0){
             return false;
         }

         return true;
    }
};