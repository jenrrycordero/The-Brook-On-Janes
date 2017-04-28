<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<div class="share-post">
		<span class="share-text">Share</span>
		<div class="share-icons">
			<span st_title="<?= get_the_title() ?>" st_image="<?= get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?>" st_url="<?= get_permalink() ?>" class="st_facebook_large share-icon fa fa-facebook"></span>
			<span st_title="<?= get_the_title() ?>" st_image="<?= get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?>" st_url="<?= get_permalink() ?>" class="st_twitter_large share-icon fa fa-twitter"></span>
			<span st_title="<?= get_the_title() ?>" st_image="<?= get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?>" st_url="<?= get_permalink() ?>" class="st_googleplus_large share-icon fa fa-google-plus"></span>
			<span st_title="<?= get_the_title() ?>" st_image="<?= get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?>" st_url="<?= get_permalink() ?>" class="st_pinterest_large share-icon fa fa-pinterest"></span>
		</div>
	</div>

	<div class="post-navigation">
		<?php
			$args = array('post_type' => 'page', 'posts_per_page' => 9999);
			$page_args = new WP_Query($args);

			if($page_args->have_posts()):

				while($page_args->have_posts()): $page_args->the_post();

					if( get_page_template_slug( $post->ID ) == 'templates/blog.php' ){
						echo '<a class="default-btn" href="'.get_the_permalink().'">Back</a>';
					}

				endwhile;

			endif;

			wp_reset_query();

			$next = get_permalink(get_adjacent_post(false,'',true));
			echo '<a class="default-btn" href="'.$next.'">Next Post</a>';
			
		?>
		<div class="clearfix"></div>
	</div>
</article><!-- #post-## -->

<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
<script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"5bcd85c8-7bb0-4131-b8cd-0ef8ef88c544"});var st_type="wordpress4.3";</script>