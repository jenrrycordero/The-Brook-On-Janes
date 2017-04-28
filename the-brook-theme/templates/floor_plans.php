<?php
/**
 * Template Name: Floor Plans Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

get_header();

the_post();
?>
<div id="primary" class="inside-section theme-container first-point">
    <main id="main" class="site-main" role="main">
        <div class="container template-wrapper">
            <div class="row">

                <?php
                $shorcode = get_field('floor_plans_shortcode');
                echo do_shortcode($shorcode);
                ?>
            </div>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
