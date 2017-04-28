<?php
/**
 * Template Name: Amenities Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

  get_header();

?>

<?php //First Section variables
  $primaryBackground = get_field('primary_background', 'options');
  $primaryBackgroundSrc = $primaryBackground['url'];

  $firstSectionImage = get_field('right_image');
  $firstSectionSrc = $firstSectionImage['url'];

  $firstSectionExtraCode = get_field('left_column_extra_code');

  $firstSection = array(
      'boxTitle' => get_field('left_column_mini_title'),
      'subtitle' => get_field('left_column_subtitle'),
      'title' => get_field('left_column_title'),
      'description' => get_field('left_column_description'),
      'btnName' => '',
      'btnUrl' => '',
      'boxBackground' => $primaryBackgroundSrc,
      'extraClasses' => 'column-wrapper-left height1 amenities-section-1',
      'boxType' => 0
  );
?>
<section class="site-section first-point site-boxes">
  <?php print razz_pattern_box($firstSection, $firstSectionExtraCode); ?>
  <div class="column-wrapper-right height2" style="background-image: url('<?php print $firstSectionSrc; ?>');"></div>
</section>

<?php //Gallery variables
  /*
  $gallery = array(
      'boxTitle' => 'GALLERY',
      'subtitle' => get_field('gallery_section_subtitle', 'options'),
      'title' => get_field('gallery_section_title', 'options'),
      'description' => get_field('gallery_section_description', 'options'),
      'btnName' => get_field('gallery_button_title', 'options'),
      'btnUrl' => get_field('gallery_button_url', 'options'),
      'boxBackground' => '',
      'extraClasses' => 'light-section theme-container text-center h1-no-bottom-space wide-section amenities-gallery',
      'boxType' => 1
  );

  print razz_pattern_box($gallery);
  */
  $virtual_tour = array(
    'boxTitle' => get_field( 'vt_mini_title', 'options' ),
    'subtitle' => get_field( 'vt_section_subtitle', 'options' ),
    'title' => get_field( 'vt_section_title', 'options' ),
    'description' => get_field( 'vt_section_description', 'options' ),
    'btnName' => get_field( 'vt_button_title', 'options' ),
    'btnUrl' => get_field( 'vt_button_url', 'options' ),
    'btnIcon' => get_field( 'vt_button_icon', 'options' ),
    'boxBackground' => '',
    'extraClasses' => 'light-section theme-container text-center h1-no-bottom-space wide-section amenities-gallery',
    'boxType' => 1
  );

  print razz_pattern_box($virtual_tour);
?>

<?php //Second Section variables
  $secondaryBackground = get_field('secondary_background', 'options');
  $secondaryBackgroundSrc = $secondaryBackground['url'];

  $secondSectionImage = get_field('left_image');
  $secondSectionImageSrc = $secondSectionImage['url'];

  $secondSectionExtraCode = get_field('right_column_extra_code');

  $secondSection = array(
      'boxTitle' => get_field('right_column_mini_title'),
      'subtitle' => get_field('right_column_subtitle'),
      'title' => get_field('right_column_title'),
      'description' => get_field('right_column_description'),
      'btnName' => '',
      'btnUrl' => '',
      'boxBackground' => $secondaryBackgroundSrc,
      'extraClasses' => 'column-wrapper-right amenities-section-2 height3',
      'boxType' => 0
  );
?>
<section class="site-section site-boxes">
  <div class="column-wrapper-left height4" style="background-image: url('<?php print $secondSectionImageSrc; ?>');"></div>
  <?php print razz_pattern_box($secondSection, $secondSectionExtraCode); ?>
</section>

<?php //Contact variables
  $contact = array(
      'boxTitle' => 'CONTACT US',
      'subtitle' => get_field('contact_section_subtitle', 'options'),
      'title' => get_field('contact_section_title', 'options'),
      'description' => get_field('contact_section_description', 'options'),
      'btnName' => 'LET’S CONNECT',
      'btnUrl' => get_field('contact_button_url', 'options'),
      'boxBackground' => '',
      'extraClasses' => 'light-section theme-container text-center h1-no-bottom-space wide-section',
      'boxType' => 1
  );

  print razz_pattern_box($contact);
?>

<?php
  get_footer();
?>
