

jQuery(document).ready(function($) {
    /**
     * Blog Page Ajax
     **/

    var page = 1;

    function load_posts(cat) {

        var data = {
            action: 'more_post_ajax',
            pageNumber: page,
            category: cat
        };

        $.ajax({
            type: "POST",
            url: ajax_posts.ajaxurl,
            data: data
        })
            .done(function (re) {

               var result = JSON.parse(re);

                $('#property_wrapper').append(result.html);

                if(result.posts_found == 'Load More Post'){
                    $('.load-more').css('display', 'inline-block');
                }else{
                    $('.load-more').css('display', 'none');
                }

                page = result.pageNumber;

                var post = $('.post-list').length;

                $('.post_viewing').text(post);

            })

    }


    $('.load-more').click(function (event)
    {
        event.preventDefault();
        var cat = $(".gallery-filter li a.active").data('filter');
        load_posts(cat);
    });


    $('.gallery-filter').on('click', 'a', function (e)
    {
        e.preventDefault();

        $('.gallery-filter').find('a').removeClass('active');
        $(this).addClass('active');

        var cat = $(this).data('filter');


        $('#property_wrapper').empty();
        page = 0;
        load_posts(cat);
    });

    $('.filterSelect').change(function(){
       var cat = $(this).val();

        $('#property_wrapper').empty();
        page = 0;
        load_posts(cat);
    });


});