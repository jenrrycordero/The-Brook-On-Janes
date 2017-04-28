<?php
/**
 * Template Name: Neighborhood
 * @package Venue_Brookwood
 */

  get_header();

  $customMapEnabled = get_field('enable_custom_map');
  $nbhdMapShortCode = get_field('nbhd_map_shortcode');
?>

	<div class="space-box theme-container first-point hidden-xs">
		<div class="white-space-box text-center">
			<?php echo get_field('theme_residence_address', 'options'); ?>
		</div>
	</div>

	<section class="inside-section theme-container inside-section-neighborhood">
		<div class="neighborhood-address-xs visible-xs">
			<?php echo get_field('theme_residence_address', 'options'); ?>
		</div>

  <?php
    if ($customMapEnabled) {
  ?>
      <div class="hidden">
        <?php
        $map_icon = get_field('map_icon');
        if ($map_icon) {
          $map_icon_src = $map_icon['url'];
        }
        ?>
        <script>
          var mapStyle = '<?php the_field('map_style');?>';
          var mapLat = <?php echo get_field('latitude'); ?>;
          var mapLong = <?php echo get_field('longitude'); ?>;

          var mapIcon = "<?php echo $map_icon_src ?>";
        </script>
      </div>

      <div id="map" style="width: 100%; height: 655px;">
        <!--Here comes the custom map-->
      </div>
  <?php
    }
  else
    echo do_shortcode($nbhdMapShortCode);
  ?>

		<div class="extra-box">
			<div class="extra-white-space"></div>
		</div>
	</section>

	<?php  //Amenities variables
		$extra_bg = get_field('neighborhood_extra_image');
		$extra_bgSrc = $extra_bg['url'];

		$amenities = array(
			'boxTitle' => 'AMENITIES',
			'subtitle' => get_field('amenities_subtitle', 'options'),
			'title' => get_field('amenities_title', 'options'),
			'description' => get_field('amenities_description', 'options'),
			'btnName' => get_field('amenities_button_name', 'options'),
			'btnUrl' => get_field('amenities_button_url', 'options'),
			'boxBackground' => $extra_bgSrc,
			'extraClasses' => 'light-section theme-container light-overlay text-center h1-no-bottom-space wide-section wide-section-2',
			'boxType' => 1
		);

		print razz_pattern_box($amenities);
	?>
<?php
  if ($customMapEnabled) :
?>
<?php
  endif;

   the_post();
   get_footer();
?>
