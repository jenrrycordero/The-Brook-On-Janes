<?php
/**
 * Venue Brookwood functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * * Created by Igor Bencheci on 6/16/2016
 *
 * @package Venue_Brookwood
 */

// Exclude doyble declaration of acf class (evite conflicts)
if (!class_exists('acf')) :
    // 1. customize ACF path
    add_filter('acf/settings/path', 'my_acf_settings_path');
    function my_acf_settings_path($path)
    {
        // update path
        $path = get_stylesheet_directory() . '/acf/';
        // return
        return $path;
    }

    // 2. customize ACF dir
    add_filter('acf/settings/dir', 'my_acf_settings_dir');
    function my_acf_settings_dir($dir)
    {
        // update path
        $dir = get_stylesheet_directory_uri() . '/acf/';
        // return
        return $dir;
    }

    // 3. Hide ACF field group menu item
    //add_filter('acf/settings/show_admin', '__return_false');

    // 4. Include ACF
    include_once(get_stylesheet_directory() . '/acf/acf.php');
endif;

if (!function_exists('venue_brookwood_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function venue_brookwood_setup()
    {

        load_theme_textdomain('the-brook-theme', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        register_nav_menus(array('primary' => esc_html__('Primary', 'the-brook-theme')));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('venue_brookwood_custom_background_args', array(
                'default-color' => 'ffffff', 'default-image' => ''))
        );
    }
endif;
add_action('after_setup_theme', 'venue_brookwood_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function venue_brookwood_content_width()
{
    $GLOBALS['content_width'] = apply_filters('venue_brookwood_content_width', 640);
}

add_action('after_setup_theme', 'venue_brookwood_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function venue_brookwood_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'the-brook-theme'),
        'id' => 'the-brook-theme-sidebar',
        'description' => esc_html__('Add widgets here.', 'the-brook-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'venue_brookwood_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function venue_brookwood_scripts()
{
    wp_enqueue_style('the-brook-theme-style', get_stylesheet_uri());

    wp_enqueue_style('theme-owl-carousel', get_template_directory_uri() . '/theme-assets/css/owl.carousel.css');

    wp_enqueue_style('theme-bootstrap', get_template_directory_uri() . '/theme-assets/css/bootstrap.min.css');

    wp_enqueue_style('theme-font-awesome', get_template_directory_uri() . '/theme-assets/css/font-awesome.min.css');

    wp_enqueue_style('animate', get_template_directory_uri() . '/theme-assets/css/animate.css');

    wp_enqueue_style('theme-vb-style', '/wp-content/uploads/theme-style.css', array(), getThemeStyleVersion(), 'all');

    wp_enqueue_style('theme-custom-style', get_template_directory_uri() . '/theme-assets/css/custom.css', array(), '1.0.6' );

    wp_enqueue_script('the-brook-theme-navigation', get_template_directory_uri() . '/theme-assets/js/navigation.js', array(), '20151217', true);

    wp_enqueue_script('theme-owl-carousel', get_template_directory_uri() . '/theme-assets/js/owl.carousel.min.js');

    wp_register_script('isotope-js', get_template_directory_uri() . '/theme-assets/js/isotope.min.js', true);

    wp_register_script('masonry-mode-js', get_template_directory_uri() . '/theme-assets/js/masonry.pkgd.min.js', true);

/*    wp_register_script('post-ajax-js', get_template_directory_uri() . '/theme-assets/js/post-ajax-js.js', true);*/

    /*  wp_enqueue_script( 'wow-js', get_template_directory_uri() . '/theme-assets/js/wow.min.js', true );*/
    wp_enqueue_script('theme-general-js', get_template_directory_uri() . '/theme-assets/js/theme-general.js', array('jquery'), '3.2.1');


    /* Load more script Post*/
    wp_register_script('load-more-posts', get_template_directory_uri() . '/theme-assets/js/load-more-posts.js', true);
    wp_enqueue_script('load-more-posts', get_template_directory_uri() . '/theme-assets/js/load-more-posts.js', array(), '20161012', true);

    /* Load more script Gallery */
    wp_register_script('load-more-images', get_template_directory_uri() . '/theme-assets/js/load-more-images.js', array(), '3.2.3', true);
    wp_enqueue_script( 'load-more-images' );

    wp_localize_script('load-more-posts', 'ajax_posts', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    wp_localize_script('load-more-images', 'ajax_images', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'venue_brookwood_scripts');


/**********************************************************************************************************************
 *      LOAD MORE POST
 */

function more_post_ajax()
{

    header("Content-Type: text/html");

    $response = array();
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $cat = $_POST['category'];
    $offset = $page * 4;
    $processedPosts = $offset;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'offset' => $offset,
    );

    if ($cat != 'all') {
        $args['category_name'] = $cat;
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) :

        while ($query->have_posts()):
            $query->the_post();
            $processedPosts++;
            $text = get_the_content();

            if ('' != $text) {
                $text = strip_shortcodes($text);
                $text = apply_filters('the_content', $text);
                $text = str_replace(']]>', ']]>', $text);
                $excerpt_length = 40;
                $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
                $text = wp_trim_words($text, $excerpt_length, $excerpt_more);
            }

            $categories = get_the_category();
            $post_cats = '';
            foreach ($categories as $cat):
                $post_cats .= ' ' . $cat->slug;
            endforeach;

            $blogSubTitle = get_field('blog_subtitle');

            $image = get_the_post_thumbnail($post->ID, 'blog-thumbnail') ? get_the_post_thumbnail($post->ID, 'blog-thumbnail') : '<img src="' . get_stylesheet_directory_uri() . '/theme-assets/images/blog-default.jpg' . '" alt="Blog Default Image" class="center-block">';
            ?>

            <li class="all auto-height row post-list<?= $post_cats ?>">
                <div class="col-sm-6 image-content no-padding-xs"><?= $image ?></div>

                <div class="col-sm-6 text-content">
                    <div class="center-content">
                        <h3 class="blog-category"><?= $post_cats ?></h3>
                        <span class="blog-author-date"><?= get_the_author() ?>
                            &nbsp; | &nbsp; <?= get_the_date('n-j-y') ?></span>
                        <h2 class="blog-sub-title"><?= $blogSubTitle ?></h2>
                        <h1 class="h1 title"><?= get_the_title() ?></h1>
                        <div class="excerpt-content"><?= $text ?></div>
                        <a href="<?= get_permalink() ?>" class="btn site-btn-primary">VIEW MORE <span
                                class="arrow-left"></span></a>
                    </div>
                </div>

                <span class="clearfix"></span>
            </li>

            <?php
        endwhile;
        wp_reset_postdata();

    endif;
    $response['status'] = true;

    $response['html'] = ob_get_contents();
    $response['pageNumber'] = $page+1;

    if ( $query->found_posts > $processedPosts ) {
        $response['posts_found'] = 'Load More Post';
    } else {
        $response['posts_found'] = 'No more Posts';
    }

    ob_end_clean();

    echo json_encode($response);

    wp_die();
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

/*End of Load More stuff --------------------------------------*/


/**************** ----  FILE INCLUDES  ------ ********************/

// functions specific for the theme.
require get_template_directory() . '/theme-assets/theme-functions.php';


/**
 * Add new image size
 */
add_action('after_setup_theme', 'razz_theme_setup');

function razz_theme_setup()
{
    add_image_size('blog-thumbnail', 780, 680, true);
    add_image_size('gallery-thumbnail', 480, 480, true);
}

/**
 * Add new rewrite rule
 */
function create_new_url_querystring()
{
    add_rewrite_rule(
        'blog/([^/]*)$',
        'index.php?name=$matches[1]',
        'top'
    );
    add_rewrite_tag('%blog%', '([^/]*)');
}

add_action('init', 'create_new_url_querystring', 999);
/**
 * Modify post link
 * This will print /blog/post-name instead of /post-name
 */
function append_query_string($url, $post, $leavename)
{
    if ($post->post_type == 'post') {
        $url = home_url(user_trailingslashit("blog/$post->post_name"));
    }
    return $url;
}

add_filter('post_link', 'append_query_string', 10, 3);


/**********************************************************************************************************************
 *      LOAD MORE IMAGES
 */

function more_images_ajax()
{

    header("Content-Type: text/html");

    $response = array();
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $cat = $_POST['category'];
    $page_id = $_POST['page_id'];
    $offset = $page * 8;
    $processedPosts = $offset;

    $gallery = get_field('gallery', $page_id, false);
    $maxImages = 8;
    $counter = 0;

    $gallery_output = '';
    $item_count = 0;

    foreach ($gallery as $image_id) {
        $image_category = get_the_terms($image_id, 'media_category');
        $control = false;
        if(is_array($image_category)){
            foreach ($image_category as $category) {
                $this_class .= ' ' . $category->slug;
                if($cat == $category->slug){
                    $control = true;
                }
            }
        }

        if($cat == 'all' || $control){
            //--
            $image_full = wp_get_attachment_image_src($image_id, 'full', true);
            $image_thumb = wp_get_attachment_image_src($image_id, 'gallery-thumbnail', true);

            if ($item_count == 0 || $item_count == 4 || $item_count == 8) {
                $image_src = wp_get_attachment_image_src($image_id, 'gallery-thumb-rect', true);
            } else {
                $image_src = wp_get_attachment_image_src($image_id, 'gallery-thumb-sq', true);
            }

            $image_details = wp_get_attachment($image_id);
            $ms_title = $image_details['title'];
            $ms_caption = $image_details['caption'];
            $this_class = 'all gallery-item ' . $item_class[$item_count];

            if(is_array($image_category)){
                foreach ($image_category as $category) {
                    $this_class .= ' ' . $category->slug;
                }
            }

            $image_output = set_image_field($image_src[0], 'effects-sadie', $image_full[0], false, $ms_title, $ms_caption, null, 'foobox fbx-link gallery-image', true, $image_thumb[0]);

            if ($counter++ >= $maxImages) {
                $class = "hiddenItems";
                $hasMoreImages = true;
            }

            $gallery_output .= '<li class="' . $this_class .' '. $class . '">' . $image_output . '</li>';

            if ($item_count == 8)
                $item_count = 0;
            else
                $item_count++;
            //--
        }


    }

    //$gallery_output = '<ul class="isotope-gallery">' . $gallery_output . '</ul>';

    $response['html'] = $gallery_output;
    echo json_encode($response);
    die();
}

add_action('wp_ajax_nopriv_more_images_ajax', 'more_images_ajax');
add_action('wp_ajax_more_images_ajax', 'more_images_ajax');