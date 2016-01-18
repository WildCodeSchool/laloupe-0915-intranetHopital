var SEARCH = (function( $ ) {
    'use strict';

    var $grid = $('.section');

    var init = function() {


            // None of these need to be executed synchronously
            setTimeout(function() {
                setupSearching();
            }, 100);

            // instantiate the plugin
            $grid.shuffle({
                itemSelector: 'figure',
            });
        },

        setupSearching = function() {
            // Advanced filtering
            $('.js-shuffle-search').on('keyup change', function() {
                var val = this.value.toLowerCase();
                $grid.shuffle('shuffle', function($el, shuffle) {

                    // Only search elements in the current group
                    if (shuffle.group !== 'all' && $.inArray(shuffle.group, $el.data('groups')) === -1) {
                        return false;
                    }

                    var text = $.trim( $el.find('figcaption').text() ).toLowerCase();
                    return text.indexOf(val) !== -1;
                });
            });
        };

    return {
        init: init
    };
}( jQuery ));