/**
 * Created by SUR0 on 02.03.2016.
 */
"use strict";
(function( $ ) {
    $.fn.banantsTabsWidget = function() {

        var options = {
            debug: false,
            activeTabClass: 'active',
            beforeActiveTabClass: 'lighter',
            afterActiveTabClass: 'darken',
            tabsWidthPercentage: 55,
            shiftDistortion: 10, //сдвиг искажения углов (величина которую нужно добавить к позиции чтоб огранизовать 0евое положение)
            freeSpacePercentage: 10. //суммарный процент который нужно оставить свободным с 2х сторон табов
        };

        this.each(function(){

            actionTabs($(this),$(this).find('.widget-tabs > div.active').index());

            $(this).find('.widget-tabs > div').click({obj:$(this)},function(e){
                if($(this).hasClass('active')) return;
                actionTabs(e.data.obj, $(this).index());
            });
        });



        /**
         * Подсчитывает размеры табов
         * @param el
         * @returns {number}
         */
        function calcTabsWidth(el){
          return $(el).width() * options.tabsWidthPercentage / 100;
        }

        /**
         * Подсчитывает необходимые отступы от левого края для каждого таба
         * @param count
         * @param tabWidth
         * @param totalWidth
         * @returns {Array}
         */
        function calcTabsLeftOffsets(count,tabWidth,totalWidth){
            var freeSpace = Math.floor((totalWidth-tabWidth) * options.freeSpacePercentage / 100);
            var oneElWidth = Math.floor((totalWidth-tabWidth - freeSpace) / count);
            var output = [];
            for(var i = 0; i < count; i++){
                output.push((Math.floor(freeSpace/2)) + options.shiftDistortion + (i * oneElWidth) )
            }

            return output;
        }

        /**
         * Возвращает максимальную величину(кол-во табов) из правой и левой частей относительно активного элемента
         * @param count
         * @param selectedIndex
         * @returns {number}
         */
        function getMaxVertex(count,selectedIndex){
            var index = selectedIndex > -1 ? selectedIndex : 0;
            return selectedIndex >= (count - (selectedIndex + 1)) ? selectedIndex : (count - (selectedIndex + 1));
        }

        function actionTabs(obj,activeIndex){
            //находим все табы для блока
            var tabs = $(obj).find('.widget-tabs > div');
            if(options.debug) console.log('Total tabs ',tabs);
            var tabsWidth = calcTabsWidth(obj);
            if(options.debug) console.log('Each tab width ',tabsWidth);
            var tabsLeftOffsets = calcTabsLeftOffsets(tabs.length,tabsWidth,obj.width());
            if(options.debug) console.log('Tabs left offsets ',tabsLeftOffsets);
            var activeItemIndex = activeIndex;//$(obj).find('.widget-tabs > div').removeClass('active');
            if(options.debug) console.log('Active item index ',activeItemIndex);
            var maxVertex = getMaxVertex(tabs.length,activeItemIndex);
            if(options.debug) console.log('Max vertex ',maxVertex);
            var verticalAvailableSpace = Math.floor($(tabs[0]).height() / 2);
            if(options.debug) console.log('Vertical available space ',verticalAvailableSpace);
            var oneVerticalPieceHeight = Math.floor(verticalAvailableSpace / (maxVertex + 1));
            if(options.debug) console.log('One vertical piece height ',oneVerticalPieceHeight);

            for(var i = 0; i <= tabs.length; i++){
                var item = $(tabs[i]);
                item.css({height:'',width:'',left:'','z-index':''});
                item.removeClass(options.activeTabClass);
                item.removeClass(options.beforeActiveTabClass);
                item.removeClass(options.afterActiveTabClass);
                if(i < activeItemIndex){
                    item.addClass(options.beforeActiveTabClass);
                    item.css('height',item.height() - (oneVerticalPieceHeight * Math.abs(i-activeItemIndex+1) + oneVerticalPieceHeight) + "px");
                }
                else if(i == activeItemIndex){
                    item.addClass(options.activeTabClass);
                }
                else{
                    item.addClass(options.afterActiveTabClass);
                    item.css('height',item.height() - (oneVerticalPieceHeight * (i - maxVertex)) + "px");
                }

                item.css({
                    width:tabsWidth + "px",
                    left: tabsLeftOffsets[i],
                    'z-index': (i <= activeItemIndex ? i : tabs.length - i) + (i == activeItemIndex ? tabs.length : 0)
                });
            }

            obj.find('.widget-tabs-body > div').removeClass('active');
            obj.find('.widget-tabs-body > div.tab' + (activeItemIndex+1)).addClass('active');

        }



    };
})(jQuery);