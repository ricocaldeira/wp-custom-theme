<?php
$cms_modals_btn_text = $cms_modals_heading = $cms_modals_size = $cms_btn_block = $cms_modals_mode = $image = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$modal_id = rand(0, 999);
$image_url = '';
if (!empty($atts['image'])) {
    $attachment_image = wp_get_attachment_image_src($atts['image'], 'elementy-thumbnail-wide');
    $attachment_image_full = wp_get_attachment_image_src($atts['image'], 'full');
    $image_url = $attachment_image[0];
    $image_url_full = $attachment_image_full[0];
}
$cms_modals_mode = (!empty($atts['cms_modals_mode'])) ? $atts['cms_modals_mode'] : 'modal-bootstrap';
?>
<?php if ( $cms_modals_mode == 'modal-bootstrap' ) : ?>
	<button type="button" class="vc_general cms-button lg cms-shape-rounded <?php echo ($cms_btn_block) ? 'btn-block' : ''; ?>" data-toggle="modal" data-target="#myModal-<?php echo esc_attr($modal_id);?>">
		<?php echo esc_attr($cms_modals_btn_text); ?>
	</button>

	<!-- Modal -->
	<div class="modal fade" id="myModal-<?php echo esc_attr($modal_id);?>" tabindex="-1" role="dialog" aria-labelledby="myModal-<?php echo esc_attr($modal_id);?>Label">
		<div class="modal-dialog <?php echo esc_attr($cms_modals_size); ?>" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?php echo esc_attr($cms_modals_heading); ?></h4>
				</div>
				<div class="modal-body">
					<?php echo wpb_js_remove_wpautop( $content, true ); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
	
<?php if ( $cms_modals_mode == 'modal-custom-layout' ) : ?>
	<div class="pb-70 modal-custom-layout">
		<div class="modal-featured">
			<a href="" class="" data-toggle="modal" data-target="#myModal-<?php echo esc_attr($modal_id);?>">
				<img src="<?php echo esc_url($image_url);?>" alt="" />
			</a>
			<h2 class="text-center">
				<a href="" class="" data-toggle="modal" data-target="#myModal-<?php echo esc_attr($modal_id);?>">
					<?php echo esc_attr($cms_modals_heading); ?>
				</a>
			</h2>
		</div>
		<div class="modal fade" id="myModal-<?php echo esc_attr($modal_id);?>" tabindex="-1" role="dialog" aria-labelledby="myModal-<?php echo esc_attr($modal_id);?>Label">
			<div class="modal-dialog <?php echo esc_attr($cms_modals_size); ?>" role="document">
				<div class="modal-body">
					<div class="modal-content border-none border-rad-0">
						<button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span class="icon_close" aria-hidden="true"></span></button>
						<img src="<?php echo esc_url($image_url_full);?>" alt="" />
						<div class="pt-20 p-40">
							<h3 class="mb-0 text-center"><?php echo esc_attr($cms_modals_heading); ?></h3>
							<?php echo wpb_js_remove_wpautop( $content, true ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
<?php endif; ?>