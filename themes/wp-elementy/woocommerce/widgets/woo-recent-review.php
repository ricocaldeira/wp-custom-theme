<?php
class Custom_WC_Widget_Recent_Reviews extends WC_Widget_Recent_Reviews {
	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		global $comments, $comment;

		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

		if ( $comments ) {
			$this->widget_start( $args, $instance );

			echo '<ul class="product_list_widget">';

			foreach ( (array) $comments as $comment ) {

				$_product = wc_get_product( $comment->comment_post_ID );

				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

				$rating_html = wc_get_rating_html( $rating );
				?>
					<li class="clearfix">
						<a class="woo-featured-wg" href="<?php echo esc_url( get_permalink( $_product->id ) ); ?>" title="<?php echo esc_attr( $_product->get_title() ); ?>">
							<?php echo balanceTags($_product->get_image()); ?>
						</a>
						<div class="woo-widget-product-desc">
							<a class="product-title" href="<?php echo esc_url( get_permalink( $_product->id ) ); ?>" title="<?php echo esc_attr( $_product->get_title() ); ?>">
								<?php echo esc_html($_product->get_title()); ?>
							</a>
							<?php echo balanceTags($rating_html); ?>
							<?php printf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'wp-elementy' ) . '</span>', get_comment_author() ); ?>
						</div>
					</li>
				<?php
			}

			echo '</ul>';

			$this->widget_end( $args );
		}

		$content = ob_get_clean();

		echo balanceTags($content);

		$this->cache_widget( $args, $content );
	}
}