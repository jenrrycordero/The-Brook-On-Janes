<?php

// Define Admin Panel Tab [name: Theme Settings]
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' 	=> 'Theme Settings',
    'menu_title'	=> 'Theme Settings',
    'menu_slug' 	=> 'theme-settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));
}

function getThemeStyleVersion()
{
  return 'v.1.1';
}

/** From "The Millenium" Project
 * Get Media Attachment Information Array
 **/
function wp_get_attachment( $attachment_id ) {

  $attachment = get_post( $attachment_id );
  return array(
    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
    'caption' => $attachment->post_excerpt,
    'description' => $attachment->post_content,
    'href' => get_permalink( $attachment->ID ),
    'src' => $attachment->guid,
    'title' => $attachment->post_title
  );
}

/** From "The Millenium" Project
 * Similar to in_array function, but this in_array_r can also be use on multi-dimensional arrays
 **/
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

/** From "The Millenium" Project
 * Theme Helper Function
 **/
function set_image_field($img_url, $img_class = null, $img_link = null, $img_target = false, $img_title = null, $img_caption = null, $img_bg = null, $link_class = null, $bg_full = false, $thumb_url = null) {
	if($img_url <> null) {
		$link_class 		= ($link_class <> null) ? 'class="'.$link_class.'"' : '';
		$new_img 			= ($thumb_url <> null) ? '<img src="'.$thumb_url.'" alt="'.$img_title.'">' : '<img src="'.$img_url.'" alt="'.$img_title.'">';
		$new_bg 			= ($img_bg <> null) ? $img_bg : $img_url;
		$new_background		= ($img_class == 'effects-zoe') ? 'style="background-image: url('.$new_bg.')"' : '';
		$new_target 		= ($img_target) ? 'target="_blank"' : '';
		$new_bg_full		= ($bg_full) ? '<span class="image" style="background-image: url('.$new_bg.')"></span>' : '';
		$new_link_before 	= ($img_link <> null) ? '<a '.$link_class.' '.$new_background.' '.$new_target.' rel="foobox" href="'.$img_link.'">' : '';
        $new_link_after     = '<div class="background-overlay"></div><div class="image-overlay"><i class="fa fa-play-circle" aria-hidden="true"></i><i class="icomon"></i></div>';
		$new_link_after    .= ($img_link <> null) ? '</a>' : '';

		$img_output = sprintf('<div class="image-wrap %s">%s%s%s%s</div>', $img_class, $new_link_before, $new_bg_full, $new_img, $new_link_after);

		return $img_output;
	}
	else {
		return false;
	}
}


function is_thank_you_page() {

  if (is_page_template('templates/thank_you.php'))
    return true;

  return false;
}


/** razz_pattern_box()
 * @param array() $section_info: Information of the section.
 * @param string $extraCode: Extra HTML code before button.
 * @return string $output: HTML string with the styled information of the section.
 **/
function razz_pattern_box($section_info, $extraCode = ''){
    ob_start();
    ?>
        <div class="general-section <?= $section_info['extraClasses'] ?>" style="background-image: url('<?= $section_info['boxBackground']; ?>');">
            <div class="site-wrapper">
                <div class="wrapper-width">
                    <h3 class="h3 <?php if($section_info['boxType']){ print 'secondary-color'; } ?>"><?= $section_info['boxTitle']; ?></h3>

                    <?php if ($section_info['subtitle']): ?>
                        <h2 class="h2 <?php if($section_info['boxType']){ print 'secondary-color'; } ?>"><?= $section_info['subtitle'] ?></h2>
                    <?php endif; ?>

                    <?php if ($section_info['title']): ?>
                        <h1 class="h1 <?php if($section_info['boxType']){ print 'primary-color'; } ?>"><?= $section_info['title'] ?></h1>
                    <?php endif; ?>

                    <?php if ($section_info['description']): ?>
                        <p><?= $section_info['description'] ?></p>
                    <?php endif; ?>

                    <?= $extraCode ?>

                    <?php if ($section_info['btnName'] && $section_info['btnUrl'] && !$section_info['btnIcon']): ?>
                        <a href="<?= $section_info['btnUrl'] ?>" class="btn <?php if($section_info['boxType']){ print 'site-btn-primary'; }else{ print 'site-btn-default'; } ?>">
                            <?= $section_info['btnName'] ?> <span class="arrow-left"></span>
                        </a>
                    <?php elseif($section_info['btnIcon'] && $section_info['btnName'] && $section_info['btnUrl']): ?>
                        <a class="btn site-btn-primary vt-button" href="<?= $section_info['btnUrl'] ?>" class="btn <?php if($section_info['boxType']){ print 'site-btn-primary'; }else{ print 'site-btn-default'; } ?>">
                            <img src="<?= $section_info['btnIcon']['url'] ?>" style="max-width:<?= $section_info['btnIcon']['width'] / 2; ?>px;" alt="">
                            <?= $section_info['btnName'] ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php

    $output = ob_get_contents();

    ob_end_clean();

    return $output;
}

?>
