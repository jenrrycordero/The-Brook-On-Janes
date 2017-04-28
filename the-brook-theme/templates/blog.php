<?php
/**
 * Template Name: Blog Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

  get_header();


$item_src   = $_GET['item_type'];
$catbyslug  = ($item_src) ? get_category_by_slug($item_src) : '';
$cat_id_src = (string)$catbyslug->term_id;
$load_cat	= (get_field('blog_categories') <> null) ? get_field('blog_categories') : '';

if(is_array($load_cat) || is_object($load_cat)) {
	$cat_string = '';

	foreach ($load_cat as $key => $value) {
		$cat_string .= $value.',';
	}
}
else {
	$cat_string = '';
}
$count_posts = wp_count_posts('post');

$paged 		= ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
$args 		= array('post_type' => 'post', 'paged' => $paged, 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC');
$query 		= new WP_Query($args);

$count = count($query);
?>

<?php
	$gallery_filter = $terms = get_terms(array(
		'taxonomy' => 'category',
		'hide_empty' => false,
	));
?>

<div class="space-box theme-container first-point">
	<div class="white-space-box text-center filter-box">
		<ul class="gallery-filter">
			<li><a href="#" data-filter="all" class="active filter">All</a></li>
			<?php
			foreach ($gallery_filter as $filter_name): ?>
				<li><a href="#" data-filter="<?php echo $filter_name->slug ?>"
					   class="<?php echo $active ?> filter"><?php echo $filter_name->name ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<!--style="background-image: url('<?php //echo get_template_directory_uri() . '/theme-assets/blogBackground.jpg'; ?>')"-->
<section class="blog-page theme-container">
	<div class="container no-padding-xs">

		<div class="row filter-select-box">
			<div class="col-xs-12 select-filter-xs2">
				<select title="Select a filter" id="filter-selector" class="filterSelect">
					<option value="all" class="active filter" data-filter="all">All</option>

					<?php foreach($gallery_filter as $filter_name): ?>
						<option value="<?php echo $filter_name->slug ?>" class="<?php echo $active ?> filter"><?php echo $filter_name->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 blog-post-container no-padding-xs">
				<?php
				$current_cat = array();
				if( $query->have_posts() ):
					$press_output = '<div class="press-wrap"><ul id="property_wrapper" class="press-gallery '.$odd_even.'">';

					while( $query->have_posts() ):
						$query->the_post();
						global $post;

						$text = get_the_content();

						if ( '' != $text ) {
							$text = strip_shortcodes( $text );
							$text = apply_filters('the_content', $text);
							$text = str_replace(']]>', ']]>', $text);
							$excerpt_length = 40;
							$excerpt_more = apply_filters('excerpt_more', ' ' . '...');
							$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
						}

						$categories = get_the_category();
						$post_cats = '';
						foreach ($categories as $cat):
							$post_cats .= ' '.$cat->slug;
						endforeach;

						$blogSubTitle = get_field('blog_subtitle');
						$author_name  = get_field('custom_author') ? get_field('custom_author') : get_the_author();

						$image = get_the_post_thumbnail( $post->ID, 'blog-thumbnail') ? get_the_post_thumbnail( $post->ID, 'blog-thumbnail') : '<img src="'.get_stylesheet_directory_uri().'/theme-assets/images/blog-default.jpg'.'" alt="Blog Default Image" class="center-block">';
						$press_output .= '<li class="all auto-height row post-list'.$post_cats.' ">';
							$press_output .= '<div class="col-sm-6 image-content no-padding-xs">'.$image.'</div>';

							$press_output .= '<div class="col-sm-6 text-content"><div class="center-content">';
								$press_output .= '<h3 class="blog-category">'.$post_cats.'</h3>';
								$press_output .= '<span class="blog-author-date">'.$author_name.'&nbsp; | &nbsp; '.get_the_date( 'n-j-y' ).'</span>';
								$press_output .= '<h2 class="blog-sub-title">'.$blogSubTitle.'</h2>';
								$press_output .= '<h1 class="h1 title">'.get_the_title().'</h1>';
								$press_output .= '<div class="excerpt-content">'.$text.'</div>';
								$press_output .= '<a href="'.get_permalink().'" class="btn site-btn-primary">VIEW MORE <span class="arrow-left"></span></a>';
							$press_output .= '</div></div>';

							$press_output .= '<span class="clearfix"></span>';
						$press_output .= '</li>';

					endwhile;

					wp_reset_query();
					$press_output .= '</ul></div><div class="clearfix"></div>';
				endif;
				?>

				<?php echo $press_output; ?>

				<div class="press-alm"><a class="load-more link-hover colored btn site-btn-primary" data-hover="View More" href="#"><span>VIEW MORE</span><div class="view-more-box"><span class="scroll-down-arrow"></span></div></a></div><div class="clearfix"></div>
			</div>
		</div><!--/.row-->
	</div><!--/.container-->

	<div class="extra-box">
		<div class="extra-white-space"></div>
	</div>
</section>


<?php
	/*wp_enqueue_script( 'post-ajax-js');*/
  get_footer();
?>
