/**
 * Created by Hovhannisyan on 03.06.2016.
 */
"use strict";
function resizeFont(block){
    var initialSize = 1;
    var parentHeight = block.outerHeight(true);

    block.find('.adaptive-row').each(function(n){
        var currentRow = $(this);
        var currentHeight = currentRow.outerHeight(true);
        var ratio =  parentHeight / currentHeight;
        var newFontSize = ratio * initialSize;

        if(ratio < 1) {
            currentRow.css({
                'font-size': newFontSize * 1.4 + 'em',
                'line-height': newFontSize + 1.2 + 'em'
            });
        }
    });
}

$(document).ready(function(){
    $('.adaptive-text').each(function(){
        resizeFont($(this));
    });
});
