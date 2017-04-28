<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Venue_Brookwood
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				// Post Category
				$categories = get_the_category();
				$post_category = '';
				foreach ($categories as $cat):
					$post_category .= ' '.$cat->slug;
				endforeach;

				// Post Author
				$post_author  = get_field('custom_author') ? get_field('custom_author') : get_the_author();

				// Post Date
				$post_date = get_the_date( 'n-j-y' );

				// Post Title
				$post_title = get_the_title();

				// Post Subtitle
				$post_subtitle = get_field('blog_subtitle');

				// Post Image
				$post_image = get_field('post_banner_image') ? '<img src="'.get_field('post_banner_image').'" alt="Post Image">' : get_the_post_thumbnail( $post->ID, 'full');

				$post_content = get_the_content();
			?>
			
			<div class="post-meta">
				<div class="meta-wrapper">
					<h4 class="category"><?php echo $post_category; ?></h4>
					<h5 class="author-date"><?php echo $post_author.' | '.$post_date; ?></h5>
					<h2 class="subtitle"><?php echo $post_subtitle; ?></h2>
					<h1 class="title"><?php echo $post_title; ?></h1>
				</div>

				<div class="share-post">
					<div class="share-icons">
						<span st_title="<?= get_the_title() ?>" st_image="<?= $image_url ?>" st_url="<?= get_permalink() ?>" class="st_facebook_large share-icon fa fa-facebook"></span>
						<span st_title="<?= get_the_title() ?>" st_image="<?= $image_url ?>" st_url="<?= get_permalink() ?>" class="st_twitter_large share-icon fa fa-twitter"></span>
						<span st_title="<?= get_the_title() ?>" st_image="<?= $image_url ?>" st_url="<?= get_permalink() ?>" class="st_instagram_large share-icon fa fa-instagram"></span>
						<span st_title="<?= get_the_title() ?>" st_image="<?= $image_url ?>" st_url="<?= get_permalink() ?>" class="st_googleplus_large share-icon fa fa-google-plus"></span>
					</div>
				</div>
			</div>

			<div class="post-image">
				<?php echo $post_image; ?>
			</div>

			<div class="post-content">
				<?php echo wpautop($post_content); ?>
			</div>
		</main><!-- #main -->
		
		<div class="back-wrapper">
		<?php
			$args = array('post_type' => 'page', 'posts_per_page' => 9999);
			$page_args = new WP_Query($args);

			if($page_args->have_posts()):

				while($page_args->have_posts()): $page_args->the_post();

					if( get_page_template_slug( $post->ID ) == 'templates/blog.php' ){
						echo '<a href="'.get_permalink().'"><img style="max-width: 148.5px;" src="'.get_template_directory_uri().'/theme-assets/images/left-arrow.png" alt="Go Back"></a>';
					}

				endwhile;

			endif;

			wp_reset_query();
		?>
		</div>

	</div><!-- #primary -->

	<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
	<script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"5bcd85c8-7bb0-4131-b8cd-0ef8ef88c544"});var st_type="wordpress4.3";</script>

<?php
get_sidebar();
get_footer();
