<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Venue_Brookwood
 */

?>

	</div><!-- #content -->

	<?php //Footer variables
		$footerLogo = get_field('theme_footer_logo', 'options');
		$footerLogoSrc = $footerLogo['url'];
		$footerPartnerLogo = get_field('theme_partner_logo', 'options');
		$footerPartnerLogoSrc = $footerPartnerLogo['url'];

		$addressText = get_field('theme_residence_address', 'options');
		$addressUrl = get_field('theme_residence_address_link', 'options');
		$phoneNumber = get_field('theme_residence_phone', 'options');
		$socialItems = get_field('social_items', 'options');
	?>

	<footer class="footer-site-section">
		<div class="content">
			<div class="row">
				<div class="col-xs-12 text-center">
					<img src="<?= $footerLogoSrc; ?>" alt="footer logo" class="center-block footer-logo"/>
					<div class="contact-address">
						<a href="<?= $addressUrl; ?>" target="_blank"><?= $addressText; ?></a>
						<span class="contact-phone"><a href="tel:<?= $phoneNumber; ?>"><?= $phoneNumber; ?></a></span>
					</div>
					<ul class="menu-social-icons">
						<?php
						foreach ($socialItems as $socialItem)
							print '<li><a href="' . $socialItem['link'] . '" target="_blank" title="' . $socialItem['title'] . '" class="fa ' . $socialItem['class'] . '"></a></li>';
						?>
					</ul>
					<img src="<?= $footerPartnerLogoSrc; ?>" alt="footer Partner Logo" class="center-block partner_logo"/>

					<div class="scroll-top-box">
						<div class="arrow-up" id="scroll-top">
							<span class="scroll-up-arrow"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row copyright">
				<div class="col-xs-12 text-center">
					<?php
					$footerHtml = get_field('footer_content', 'options');
					if ($footerHtml && $footerHtml<>null)
						print $footerHtml;
					?>
				</div>
			</div>
		</div>
	</footer>


</div><!-- #page -->

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWTsw4oYEwJ6wP4lrZ3v5Cr2ZiQ9wWvPA&callback=initMap" type="text/javascript"></script>
<script>
	<?php
		$seo_script = get_field('seo_json_code', 'options');
		if($seo_script){
			$seo_script = strip_tags($seo_script);
			echo $seo_script;
		}
	?>

	/*-- Map Script --*/
	var map;

	function initMap() {

		if ( typeof mapStyle == "undefined" ) return;

		try {
			styles = JSON.parse( mapStyle );
		}
		catch (e) {
			console.log("there was an error parsing the style for the map.");
		}
		lat = parseFloat( mapLat );
		lng = parseFloat( mapLong );
		image = mapIcon;

		var option = {
			coord:{
				lat: lat,
				lng: lng
			},
			zoom:13
		};

		map = new google.maps.Map(document.getElementById('map'), {
			center: option.coord,
			zoom: option.zoom,
			styles: styles,
			disableDefaultUI: true,
			scrollwheel: false,
			navigationControl: false,
			mapTypeControl: false,
			scaleControl: false,
			draggable: false
		});

		var marker = new google.maps.Marker({
			position: option.coord,
			map: map,
			icon: image
		});
	}
</script>

<?php echo do_shortcode('[razz_virtual_tours]'); ?>

<?php wp_footer(); ?>

</body>
</html>
