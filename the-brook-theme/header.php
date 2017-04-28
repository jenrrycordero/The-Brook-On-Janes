<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Venue_Brookwood
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <!-- FONTS DEFINITIONS -------->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700" rel="stylesheet">
    <script src="https://use.typekit.net/pzk7yui.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <?php wp_head(); ?>
<script type="application/ld+json">
	{
  	"@context": "http://schema.org",
  	"@type": "LocalBusiness",
  	"address": {
    "@type": "PostalAddress",
    "addressLocality": “Bolingbrook”,
    "addressRegion": “IL”,
    "postalCode”:”60440”,
    "streetAddress": “401 Janes Ave“
  	},
  	"description": "The Brook on Janes is a brand new luxury apartment community located in an ideal location near Bolingbrook.",
  	"name": “The Brook on Janes“,
  	"telephone": “630-755-3564",
  	"openingHours": [ “Mo,Tu,We,Th,Fr 09:00-18:00, “Sa 10:00-17:00”, “Su 11:00-17:00” ],
  	"geo": {
    "@type": "GeoCoordinates",
    "latitude": "41.708857",
    "longitude": "-88.039303"
 		}, 			
  	"sameAs" : [ "https://www.facebook.com/The-Brook-on-Janes-1771388039776882/",
    "https://twitter.com/TheBrookOnJanes",
    "https://plus.google.com/113571168727949936689/"]
	}
</script>
</head>

<body <?php body_class('the-brook-theme'); ?>>
<?php
// Google Tag Manager Plugin
if (function_exists('gtm4wp_the_gtm_tag'))
    gtm4wp_the_gtm_tag();
?>
<div id="page" class="site">
    <?php
    $TextLogo = get_field('theme_page_logo', 'options');
    $applyNowLink = get_field('theme_apply_link', 'options');
    $applyNowLinkTitle = get_field('theme_apply_link_title', 'options');
    $residentLink = get_field('theme_resident_link', 'options');
    $residentLinkTitle = get_field('theme_resident_link_title', 'options');
    $residencePhone = get_field('theme_residence_phone', 'options');

    $partnerLogo = get_field('theme_partner_logo', 'options');
    $addressText = get_field('theme_residence_address', 'options');

    ?>

    <header id="masthead" class="site-header" role="banner">
        <div class="header-wrapper container theme-container">
            <div class="site-branding">
                <?php
                if ($TextLogo) {
                    $logoSrc = $TextLogo['url'];
                    print '<a href="' . esc_url(home_url('/')) . '" class="site-title"><img alt="logo" src="' . $logoSrc . '" width="80" class="logos_icon"/></a>';
                }
                ?>
            </div><!-- .site-branding -->

            <div class="nav-wrapper">
                <nav id="site-contacts" class="secondary-navigation" role="navigation">
                    <ul class="residence-links">
                        <?php
                        if ($applyNowLinkTitle && $applyNowLink != null)
                            print '<li class="nav-link"><a class="" href="' . $applyNowLink . '" target="_blank">' . $applyNowLinkTitle . '</a></li>';
                        if ($residentLinkTitle && $residentLink != null)
                            print '<li class="nav-link"><a class="" href="' . $residentLink . '" target="_blank">' . $residentLinkTitle . '</a></li>';
                        if ($residencePhone && $residencePhone != null && $applyNowLink != null)
                            print '<li class="nav-link phone hidden-xs"><a class="" href="tel:' . $residencePhone . '"><span class="fa fa-phone"></span><span class="content">' . $residencePhone . '</span></a></li>';
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="button_container" id="menu_btn">
            <span class="top"></span>
            <span class="middle"></span>
            <span class="bottom"></span>
        </div>
        <div id="menu_btn_text" class="hidden-xs">
            <span id="btn_title_1">MENU</span>
            <span id="btn_title_2">CLOSE</span>
        </div>


        <div class="overlay" id="overlay">
            <nav class="overlay-menu">
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>

                <ul class="menu-social-icons">
                    <?php
                    $socialItems = get_field('social_items', 'options');

                    foreach ($socialItems as $socialItem) {
                        print '<li><a href="' . $socialItem['link'] . '" target="_blank" title="' . $socialItem['title'] . '" class="fa ' . $socialItem['class'] . '"></a></li>';
                    }
                    ?>
                </ul>
            </nav>

            <div class="overlay-footer">
                <?php
                if ($partnerLogo) {
                    $partnerLogoSrc = $partnerLogo['url'];
                    print '<img alt="logo" src="' . $partnerLogoSrc . '" class="partner_logo"/>';
                }
                ?>

                <div class="overlay-address"><?php print $addressText ?></div>
                <div class="overlay-phone"><a href="tel:'<?php print $residencePhone ?>'"><?php print $residencePhone; ?></a></div>

            </div>

        </div><!--/.overlay-->

    </header><!-- #masthead -->

    <?php
        $tertiary_background = get_field('tertiary_background', 'options');
        $tertiary_backgroundSrc = $tertiary_background['url'];
    ?>
    <div id="general-background" style="background-image: url('<?php print $tertiary_backgroundSrc; ?>');"></div>

    <div id="content" class="site-content">
        <?php if (!is_front_page() && !is_thank_you_page() && !is_404() && !is_single()):
            $bannerBackground = get_field('header_background');
            if (isset($bannerBackground['url'])) {
                $parallax_background = $bannerBackground['url'];
            } else {
                $parallax_background = "";
            }

            $pageTitle = get_field('page_title');
            ?>
            <section id="main-banner" class="site-section theme-container">
                <div id="parallax-header-page" class="parallax-header section-background"
                     style="height: 360px; background: url(<?php echo $parallax_background; ?>);">
                    <div class="wrap-parallax">
                        <div class="container text-center">
                            <h3 class="h3 secondary-color"><?= $post->post_title; ?></h3>
                            <h1 class="h1 primary-color"><?= $pageTitle; ?></h1>
                            <div class="page-banner-description tertiary-color"><?= $post->post_content; ?></div>

                            <div class="scroll-down">
                                <span class="scroll-down-arrow page-scroll-down"></span>
                            </div>
                        </div>
                    </div>
                </div><!-- parallax-header -->
            </section>
        <?php endif; ?>
