<?php
/**
 * Template Name: Contact Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

  get_header();
?>

<?php //CONTACT US variables
  $primaryBackground = get_field('primary_background', 'options');
  $primaryBackgroundSrc = $primaryBackground['url'];

  $contactFormID = get_field('contact_page_contact_form_id', 'options');
?>

<section class="site-section first-point site-boxes">
  <div class="column-wrapper-left general-section column-display-table" style="background-image: url('<?php print $primaryBackgroundSrc; ?>');">
    <div class="site-wrapper contact-form-wrapper">
      <?php
        if ($contactFormID && is_numeric($contactFormID))
          gravity_form( $contactFormID, false, false, false, true, true);
      ?>
    </div>
  </div>

  <?php if(has_post_thumbnail()): ?>
      <div class="column-wrapper-right bg-position-bottom" style="background-image: url('<?php the_post_thumbnail_url( 'full' ) ?>');"></div>
  <?php endif; ?>
</section>


<?php //Gallery variables
  $gallery = array(
      'boxTitle' => 'GALLERY',
      'subtitle' => get_field('gallery_section_subtitle', 'options'),
      'title' => get_field('gallery_section_title', 'options'),
      'description' => get_field('gallery_section_description', 'options'),
      'btnName' => get_field('gallery_button_title', 'options'),
      'btnUrl' => get_field('gallery_button_url', 'options'),
      'boxBackground' => '',
      'extraClasses' => 'light-section theme-container text-center h1-no-bottom-space wide-section',
      'boxType' => 1
  );

  print razz_pattern_box($gallery);
?>

<?php
  get_footer();
?>
