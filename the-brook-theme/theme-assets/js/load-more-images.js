/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work? 
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function($) {

var $event = $.event,
    $special,
    resizeTimeout;

$special = $event.special.debouncedresize = {
    setup: function() {
        $( this ).on( "resize", $special.handler );
    },
    teardown: function() {
        $( this ).off( "resize", $special.handler );
    },
    handler: function( event, execAsap ) {
        // Save the context
        var context = this,
            args = arguments,
            dispatch = function() {
                // set correct event type
                event.type = "debouncedresize";
                $event.dispatch.apply( context, args );
            };

        if ( resizeTimeout ) {
            clearTimeout( resizeTimeout );
        }

        execAsap ?
            dispatch() :
            resizeTimeout = setTimeout( dispatch, $special.threshold );
    },
    threshold: 350
};

})(jQuery);

jQuery(document).ready(function($) {
    /**
     * Blog Page Ajax
     **/

    var page = 1;

    function load_images(cat, page_id) {
        var data = {
            action: 'more_images_ajax',
            pageNumber: page,
            category: cat,
            page_id : page_id
        };

        $.ajax({
            type: "POST",
            url: ajax_images.ajaxurl,
            data: data
        })
            .done(function (re) {
               var result = JSON.parse(re);
                $isotope_container.isotope("remove", $isotope_container.find(".gallery-item"));
                var $items = $(result.html);
                $isotope_container.isotope('insert', $items);
                $isotope_container.isotope({filter: ':not(.hiddenItems)'});

                var count = $isotope_container.find('.hiddenItems').length;

                if(count > 0){
                    $('.load-more-wrapper .btn').show();
                }else{
                    $('.load-more-wrapper .btn').hide();
                }

                window.FOOBOX.init();
            })

    }

    var $isotope_container = $('.isotope-gallery'),
        $filters = $('.gallery-filter'),
        $filterSelect = $('#filter-selector');

    jQuery.fn.extend({
        isInViewPort: function(offset) {
            const $w = jQuery(window);
            const $this = jQuery(this);

            if ( !offset ) offset=0;

            const viewPortTop = $w.scrollTop();
            const viewPortBottom = viewPortTop + $w.height() + offset;

            const eTop = $this.offset().top;
            const eBotom = eTop + $this.height();
            return (
                eTop < viewPortBottom //The top of the element is INSIDE (less than) the viewPort bottom limit
                &&
                eBotom > viewPortTop // the element isnt outside of the viewport.
            );
        }
    });

    $(window).on('scroll', function () {
        if ($('.isotope-gallery').find($('.hiddenItems')).length > 0) {

            const eTop = $('.isotope-gallery').offset().top;
            const eBottom = eTop + $('.isotope-gallery').height();

            if ($window.scrollTop() >= eBottom - 500) {
                var $isotope_container = $('.isotope-gallery');
                var count = $isotope_container.find('.hiddenItems').length;

                if (count < 8) {
                    $isotope_container.find('.hiddenItems').removeClass('hiddenItems');
                } else {
                    var flag = 0;
                    $isotope_container.find('.hiddenItems').each(function (index, value) {
                        if (flag < 8) {
                            $(this).removeClass('hiddenItems');
                            flag++;
                        }
                    })
                }

                $isotope_container.isotope();
                var re_count = $isotope_container.find('.hiddenItems').length;

                jQuery('.fbx-instance').on('foobox.beforeShow', function(e) {
                    console.log();
                    if(jQuery(".fbx-modal .fbx-inner .fbx-stage .fbx-item-current iframe").length){
                        jQuery('.fbx-next').hide();
                        jQuery('.fbx-prev').hide();
                    }else{
                        jQuery('.fbx-next').show();
                        jQuery('.fbx-prev').show();
                    }
                });
            }
        }

    });

    $('.load-more').click(function (event)
    {
        event.preventDefault();
        var cat = $(".gallery-filter li a.active").data('filter');
        load_posts(cat);
    });

    $isotope_container.isotope({
        layoutMode: 'masonry',
        itemSelector : '.gallery-item',
        filter: ':not(.hiddenItems)'
    });


    var count = $isotope_container.find('.hiddenItems').length;

    if(count > 0){
        $('.load-more-wrapper .btn').show();
    }else{
        $('.load-more-wrapper .btn').hide();
    }

    $filters.on('click', 'a', function (e)
    {
        e.preventDefault();
        $filters.find('a').removeClass('active');
        $(this).addClass('active');

        var filter = $(this).data('filter');

        load_images(filter, page_id);
        $isotope_container.isotope();


        jQuery('.fbx-instance').on('foobox.beforeShow', function(e) {
            console.log();
            if(jQuery(".fbx-modal .fbx-inner .fbx-stage .fbx-item-current iframe").length){
                jQuery('.fbx-next').hide();
                jQuery('.fbx-prev').hide();
            }else{
                jQuery('.fbx-next').show();
                jQuery('.fbx-prev').show();
            }
        });

    });

    $filterSelect.on('change', function(){
        var filtro = '.'+ $(this).val();

        load_images(filter, page_id);
        $isotope_container.isotope();

        jQuery('.fbx-instance').on('foobox.beforeShow', function(e) {
            console.log();
            if(jQuery(".fbx-modal .fbx-inner .fbx-stage .fbx-item-current iframe").length){
                jQuery('.fbx-next').hide();
                jQuery('.fbx-prev').hide();
            }else{
                jQuery('.fbx-next').show();
                jQuery('.fbx-prev').show();
            }
        });
    });

    $(window).load(function(e) {
        $isotope_container.isotope();
    });

    $(window).on('debouncedresize', function() {
        $isotope_container.isotope();
    });
});