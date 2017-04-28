<?php
/**
 * Template Name: Home Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venue_Brookwood
 */

  get_header();

  $bannerBackground    = get_field('banner_image_background');
  $parallax_background = $bannerBackground['url'];
  $theme_header_logo = get_field('theme_header_logo', 'options');

  $welcomeBannerTitle = get_field('welcome_banner_title');
  $welcomeBannerSubtitle = get_field('welcome_banner_subtitle');
  $welcomeBannerVideoUrl = get_field('welcome_banner_video_url');
  $welcomeBannerButtonTitle = get_field('welcome_banner_button_title');
  $welcomeBannerButtonUrl = get_field('welcome_banner_button_url');
  $welcomeBannerButtonIcon = get_field('welcome_banner_button_icon');
  $welcomeBannerVideoUrl = ($welcomeBannerVideoUrl) ? $welcomeBannerVideoUrl : '#';

  $videoBkg = get_field('banner_video_url');
  $videoAutopPlay = get_field('banner_video_autoplay');
  $videoAutopPlayStr = ($videoAutopPlay == true) ? 'true' : 'false';

  $addressText = get_field('theme_residence_address', 'options');
  $residencePhone = get_field('theme_residence_phone', 'options');

  $addScrollToClass = get_field('welcome_banner_scroll_class');

?>
	<section id="main-banner" class="site-section theme-container">
      <div class="parallax-header section-background" style="height: 900px; background: url(<?php echo $parallax_background; ?>);" id='parallax-header'>
          <?php
              if ( $videoBkg && $videoAutopPlay ) : ?>
             <div id="video-background" class="player" data-property="{videoURL:'<?php echo $videoBkg;?>',containment:'#home-parallax-header',startAt:0,mute:true,<?php print 'autoPlay:' . $videoAutoPlayStr . ','; ?>loop:true,opacity:1,optimizeDisplay:true,showYTLogo:false,showControls:false}"></div>
          <style>
              iframe#mbYTP_video-background {
                 max-width: 20000% !important;
              }
              div.YTPOverlay{ background-color: rgba(0,0,0,0.2); }
          </style>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/2.9.1/jquery.mb.YTPlayer.min.js'></script>
          <script>
          jQuery(document).ready(function($){
              $videoBg = jQuery("#video-background");

              if ( $videoBg.length > 0 )
                  $videoBg.YTPlayer();
          });
          </script>
          <?php endif; ?>

          <div class="wrap-parallax">
              <div class="container">
                  <div class="welcome-post">
                    <?php
                    if ($theme_header_logo) {
                      $theme_header_logo_src = $theme_header_logo['url'];
                      print '<img alt="Site logo" src="' . $theme_header_logo_src . '" class="home_banner_logo"/>';
                    }
                    ?>
                    <h1 class="h1"><?php print $welcomeBannerTitle; ?></h1>
                    <?php if($welcomeBannerSubtitle){ ?><h3 class="h3"><?php print $welcomeBannerSubtitle; ?></h3><?php }?>

                    <div class="home-banner-address"><?php echo $addressText; ?></div>
                    <div class="home-banner-phone"><a href="tel:<?php echo $residencePhone; ?>"><?php echo $residencePhone; ?></a></div>

                    <?php if ($welcomeBannerButtonTitle && $welcomeBannerVideoUrl && !$welcomeBannerButtonIcon) : ?>
                      <?php $scrollClass = ($addScrollToClass) ? 'scroll-down-to' : ''; ?>
                      <a href="<?php print $welcomeBannerVideoUrl; ?>" class="btn primary-btn foobox <?php print $scrollClass; ?>"><?php print $welcomeBannerButtonTitle; ?></a>
                    <?php elseif($welcomeBannerButtonTitle && $welcomeBannerButtonUrl && $welcomeBannerButtonIcon): ?>
                      <a href="<?php print $welcomeBannerButtonUrl; ?>" class="btn vt-button site-btn-primary">
                        <?php print $welcomeBannerButtonTitle; ?>
                         <img src="<?= $welcomeBannerButtonIcon['url'] ?>" style="max-width:<?= $welcomeBannerButtonIcon['width'] / 2; ?>px;" alt="">
                      </a>
                    <?php endif; ?>
                  </div>

                  <div class="scroll-down scroll-down-home">
                    <span class="scroll-down-arrow scroll-down-arrow-home"></span>
                  </div>
              </div>

          </div>
      </div><!-- parallax-header -->
    </section>

<?php  //Floor Plans variables
  $floorPlansBackgroundImage = get_field('floor_plans_background_image');
  $floorPlansBackgroundImageSrc = $floorPlansBackgroundImage['url'];

  $floorPlansExtraCode = get_field('floor_plans_extra_code');

  $secondaryBackground = get_field('secondary_background', 'options');
  $secondaryBackgroundSrc = $secondaryBackground['url'];

  $floorPlans = array(
      'boxTitle' => 'FLOOR PLANS',
      'subtitle' => get_field('floor_plans_section_subtitle'),
      'title' => get_field('floor_plans_section_title'),
      'description' => get_field('floor_plans_section_description'),
      'btnName' => get_field('floor_plans_button_title'),
      'btnUrl' => get_field('floor_plans_button_url'),
      'boxBackground' => $secondaryBackgroundSrc,
      'extraClasses' => 'column-wrapper-right',
      'boxType' => 0
  );
?>

  <section class="site-section first-point site-boxes">
      <div class="column-wrapper-left" style="background-image: url('<?php print $floorPlansBackgroundImageSrc; ?>');"></div>
      <?php print razz_pattern_box($floorPlans, $floorPlansExtraCode); ?>
  </section>


<?php  //Amenities variables
    $amenities = array(
        'boxTitle' => get_field('amenities_mini_title'),
        'subtitle' => get_field('amenities_subtitle'),
        'title' => get_field('amenities_title'),
        'description' => get_field('amenities_description'),
        'btnName' => get_field('amenities_button_name'),
        'btnUrl' => get_field('amenities_button_url'),
        'boxBackground' => '',
        'extraClasses' => 'light-section theme-container text-center h1-no-bottom-space wide-section',
        'boxType' => 1
    );

    print razz_pattern_box($amenities);
?>


<?php //Gallery variables
    $galleryBackgroundImage = get_field('gallery_background_image');
    $galleryBackgroundImageSrc = $galleryBackgroundImage['url'];

    $gallery = array(
        'boxTitle' => get_field('gallery_mini_title'),
        'subtitle' => get_field('gallery_section_subtitle'),
        'title' => get_field('gallery_section_title'),
        'description' => get_field('gallery_section_description'),
        'btnName' => get_field('gallery_button_title'),
        'btnUrl' => get_field('gallery_button_url'),
        'boxBackground' => '',
        'extraClasses' => '',
        'boxType' => 0
    );
?>
  <section class="home-section-gallery" style="background-image: url('<?= $galleryBackgroundImageSrc ?>')">
      <?php print razz_pattern_box($gallery); ?>
  </section>

<?php //Neighborhood variables

    $neighborhood = array(
        'boxTitle' => 'NEIGHBORHOOD',
        'subtitle' => get_field('neighborhood_section_subtitle'),
        'title' => get_field('neighborhood_section_title'),
        'description' => get_field('neighborhood_section_description'),
        'btnName' => get_field('neighborhood_button_title'),
        'btnUrl' => get_field('neighborhood_button_url'),
        'boxBackground' => $secondaryBackgroundSrc,
        'extraClasses' => 'home-neighborhood text-center h1-no-bottom-space',
        'boxType' => 0
    );

    print razz_pattern_box($neighborhood);
?>


<?php //Contact variables

    $contactBackground = get_field('contact_background_image');
    $contactBackgroundSrc = $contactBackground['url'];

    $primaryBackground = get_field('primary_background', 'options');
    $primaryBackground = $primaryBackground['url'];

    $contact = array(
        'boxTitle' => get_field('contact_mini_title'),
        'subtitle' => get_field('contact_section_subtitle'),
        'title' => get_field('contact_section_title'),
        'description' => get_field('contact_section_description'),
        'btnName' => get_field('contact_button_title'),
        'btnUrl' => get_field('contact_button_url'),
        'boxBackground' => '',
        'extraClasses' => '',
        'boxType' => 0
    );

    $extraCode = "<p class='contact-address'>".$addressText."</p>";
    $extraCode .= "<p class='contact-phone'><a href='tel:".$residencePhone."'>".$residencePhone."</a></p>";
?>

  <section class="home-contact-section theme-container" style="background-image: url('<?= $primaryBackground ?>')">
      <div class="container-fluid">
          <div class="col-sm-7 no-padding-xs"><img src="<?= $contactBackgroundSrc; ?>" class="img-responsive center-block"/></div>
          <div class="col-sm-5">
              <?php print razz_pattern_box($contact, $extraCode); ?>
          </div>
      </div>
  </section>

<?php
  get_footer();
?>
