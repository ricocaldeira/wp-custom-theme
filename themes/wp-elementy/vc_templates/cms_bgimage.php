<?php
$image = $css_animation = $css_animation_delay = $bg_image_position = $cms_layout = $images = $custom_links = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$bg_image_position = (!empty($bg_image_position)) ? $bg_image_position : 'center center';
$image_url = '';
if (!empty($image)) {
    $attachment_image = wp_get_attachment_image_src($image, 'full');
    $image_url = $attachment_image[0];
}
$cms_layout = (!empty($cms_layout)) ? $cms_layout : 'single';

switch ($cms_layout) {
	case 'single':
		?>
			<div class="cms-bgimage-wrap <?php echo esc_attr($css_animation); ?> <?php echo esc_attr($el_class); ?>">
				<div class="cms-bgimage-inner">
					<div class="pos-abs clearfix">
						<div class="cms-bgimage" style="background-image: url(<?php echo $image_url; ?>); background-position: <?php echo esc_attr($bg_image_position); ?>;"></div>
					</div>
				</div>
			</div>
		<?php
		break;

	case 'list':
		?>
			<?php if (!empty($images)) : ?>
				<div class="cms-show-listimage clearfix <?php echo esc_attr($el_class); ?>">
					<div class="cms-show-listimage-inner">
						<?php
							$images = explode(',', $images);
							$index = 1;
							foreach ($images as $img_id) {
								$attachment_image = wp_get_attachment_image_src($img_id, 'full');
		    					?>
		    					<img class="<?php echo esc_attr($css_animation); ?>" src="<?php echo esc_url($attachment_image[0]); ?>" alt="" data-wow-duration="1s" data-wow-delay="<?php echo $index*150 ?>ms">
		    					<?php
		    					$index = $index + 2;
							}
						?>
					</div>
				</div>
			<?php endif; ?>
		<?php
		break;
	
	default:
		$custom_links = explode( "\n", $custom_links );

		//var_dump($custom_links); exit;
		?>
			<div class="cms-show-lists-app clearfix <?php echo esc_attr($el_class); ?>">
				<?php
					$images = explode(',', $images);
					$index = 0;
					foreach ($images as $img_id) {
						
						$attachment_image = wp_get_attachment_image_src($img_id, 'full');
						if ( isset( $custom_links[ $index ] ) && '' !== $custom_links[ $index ] ) {
							?>
								<a href="<?php echo esc_url(strip_tags($custom_links[$index]));?>">
	    							<img class="" src="<?php echo esc_attr($attachment_image[0]); ?>" alt="">
	    						</a>
							<?php
						} else {
							echo '<img class="" src="'.esc_attr($attachment_image[0]).'" alt="">';
						}

    					$index++;
					}
				?>
			</div>
		<?php
		break;
}