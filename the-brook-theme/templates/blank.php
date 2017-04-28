<?php
/**
 * Template Name: Blank Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

  get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container template-wrapper">
				<div class="row">
          <?php
    			while ( have_posts() ) : the_post();

    				the_content();

    			endwhile; // End of the loop.
    			?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
  get_footer();
?>
