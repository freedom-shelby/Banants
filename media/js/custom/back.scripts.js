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


    $('#show-invisible-articles').change(function() {
        if($(this).is(":checked")) {
            $(document).find('.invisible-article').show();
        }else{
            $(document).find('.invisible-article').hide();
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

    $(document).on('click','button[name="save"]',function(){
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


$(document).ready(function() {
    $('a.remove-confirm').on('click',function(){
        return confirm('Are You sure to delete this item');
    });
});
