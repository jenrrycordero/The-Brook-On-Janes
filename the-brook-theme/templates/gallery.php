<?php
/**
 * Template Name: Gallery Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

  get_header();
?>

<?php
    $gallery_filter = $terms = get_terms( array(
        'taxonomy' => 'media_category',
        'hide_empty' => true,
    ) );
?>

<div class="space-box theme-container first-point">
    <div class="white-space-box text-center hidden-xs">
        <ul class="gallery-filter">
            <li><a href="#" data-filter="all" class="active filter">All</a></li>

            <?php foreach($gallery_filter as $filter_name): ?>
                <li><a href="#" data-filter="<?php echo $filter_name->slug ?>" class="<?php echo $active ?> filter"><?php echo $filter_name->name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

  <section class="gallery-page inside-section theme-container">
  	<div class="container" id="gallery_section">
        <div class="row visible-xs">
            <div class="col-xs-12 select-filter-xs">
                <select title="Select a filter" id="filter-selector">
                    <option value="all" class="active filter" data-filter="all">All</option>

                    <?php foreach($gallery_filter as $filter_name): ?>
                        <option value="<?php echo $filter_name->slug ?>" class="<?php echo $active ?> filter"><?php echo $filter_name->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <ul class="isotope-gallery">
  		<?php
            $gallery = get_field('gallery', false, false);
            $maxImages = 8;
            $counter = 0;
            $hasMoreImages = false;

            $item_count = $array_count = 0;
            $item_class = array();

            $filter_class = array();
            //$gallery_filter = '';

            foreach ($gallery as $image_id) {
                $image_category = get_the_terms($image_id, 'media_category');
                $image_full = wp_get_attachment_image_src($image_id, 'full', true);
                $image_thumb = wp_get_attachment_image_src($image_id, 'gallery-thumbnail', true);

                if ($item_count == 0 || $item_count == 4 || $item_count == 8) {
                    $image_src = wp_get_attachment_image_src($image_id, 'gallery-thumbnail', true);
                } else {
                    $image_src = wp_get_attachment_image_src($image_id, 'gallery-thumbnail', true);
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

                $item_meta    = get_post_meta($image_id);
                $image_link   = $item_meta['video_link'][0] ? $item_meta['video_link'][0] : $image_full[0];
                $image_class  = $item_meta['video_link'][0] ? 'effects-sadie with-play-icon' : 'effects-sadie';

                $image_output = set_image_field($image_src[0], $image_class, $image_link, false, $ms_title, $ms_caption, null, 'foobox fbx-link gallery-image', true, $image_thumb[0]);

                if ($counter++ >= $maxImages) {
                    //$style = "display: none;";
                    $class = "hiddenItems";
                    $hasMoreImages = true;
                }

                //$gallery_output .= '<li class="' . $this_class . '" style="' . $style . '">' . $image_output . '</li>';
                $gallery_output .= '<li class="' . $this_class .' '. $class . '">' . $image_output . '</li>';

                if ($item_count == 8)
                    $item_count = 0;
                else
                    $item_count++;

                $array_count++;
            }

            //$gallery_output = '<ul class="isotope-gallery">' . $gallery_output . '</ul>';

            //echo $gallery_filter . $gallery_output;
            echo apply_filters("the_content", $gallery_output);
  		?>
        </ul>
  	</div><!-- .gallery-section -->

    <?php //if ($hasMoreImages) :?>
        <!--<div class="load-more-wrapper">
          <div class="btn">VIEW MORE
              <div class="view-more-box">
                  <span class="scroll-down-arrow secondary-hover"></span>
              </div>
          </div>
        </div>-->
    <?php //endif; ?>


    <div class="extra-box">
        <div class="extra-white-space"></div>
    </div>

  </section><!-- .gallery-page -->

  <?php
  	wp_enqueue_script('isotope-js');
  	wp_enqueue_script('packery-mode-js');
  ?>

  <?php  //Amenities variables
    $amenities = array(
        'boxTitle' => 'AMENITIES',
        'subtitle' => get_field('amenities_subtitle', 'options'),
        'title' => get_field('amenities_title', 'options'),
        'description' => get_field('amenities_description', 'options'),
        'btnName' => get_field('amenities_button_name', 'options'),
        'btnUrl' => get_field('amenities_button_url', 'options'),
        'boxBackground' => '',
        'extraClasses' => 'light-section theme-container text-center h1-no-bottom-space wide-section wide-section-2',
        'boxType' => 1
    );

    print razz_pattern_box($amenities);
  ?>

  <script>
      <?php global $post; ?>
      var page_id = '<?php echo $post->ID; ?>';
  </script>


<?php
  get_footer();
?>
