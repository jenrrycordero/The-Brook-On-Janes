<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Venue_Brookwood
 */

get_header();

$primaryBackground = get_field('primary_background', 'options');
$primaryBackground_url = $primaryBackground['url'];

$theme_header_logo = get_field('theme_header_logo', 'options');

$addressText = get_field('theme_residence_address', 'options');
$residencePhone = get_field('theme_residence_phone', 'options');

?>
	<section id="main-banner" class="site-section theme-container">
		<div class="parallax-header section-background" style="height: 900px; background: url(<?php echo $primaryBackground_url; ?>);" id='parallax-header'>

			<div class="wrap-parallax">
				<div class="container">
					<div class="welcome-post">
						<?php
						if ($theme_header_logo) {
							$theme_header_logo_src = $theme_header_logo['url'];
							print '<img alt="Site logo" src="' . $theme_header_logo_src . '" class="home_banner_logo"/>';
						}
						?>
						<h1 class="h1 404-error">404 ERROR !</h1>
						<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'the-brook-theme' ); ?></h2>

						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'the-brook-theme' ); ?></p>

						<a href="<?php echo esc_url(home_url('/')); ?>" class="back-home">Go back to Home Page</a>

						<div class="home-banner-address"><?php echo $addressText; ?></div>
						<div class="home-banner-phone"><a href="tel:<?php echo $residencePhone; ?>" style="cursor: pointer"><?php echo $residencePhone; ?></a></div>

					</div>

				</div>

			</div>
		</div><!-- parallax-header -->
	</section>

<?php
get_footer();
