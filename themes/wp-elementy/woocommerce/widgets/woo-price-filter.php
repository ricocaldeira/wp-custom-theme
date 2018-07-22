<?php
class Custom_WC_Widget_Price_Filter extends WC_Widget_Price_Filter {
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		global $wp, $wp_the_query;

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		}

		if ( ! $wp_the_query->post_count ) {
			return;
		}

		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';

		wp_enqueue_script( 'wc-price-slider' );

		// Remember current filters/search
		$fields = '';

		if ( get_search_query() ) {
			$fields .= '<input type="hidden" name="s" value="' . get_search_query() . '" />';
		}

		if ( ! empty( $_GET['post_type'] ) ) {
			$fields .= '<input type="hidden" name="post_type" value="' . esc_attr( $_GET['post_type'] ) . '" />';
		}

		if ( ! empty ( $_GET['product_cat'] ) ) {
			$fields .= '<input type="hidden" name="product_cat" value="' . esc_attr( $_GET['product_cat'] ) . '" />';
		}

		if ( ! empty( $_GET['product_tag'] ) ) {
			$fields .= '<input type="hidden" name="product_tag" value="' . esc_attr( $_GET['product_tag'] ) . '" />';
		}

		if ( ! empty( $_GET['orderby'] ) ) {
			$fields .= '<input type="hidden" name="orderby" value="' . esc_attr( $_GET['orderby'] ) . '" />';
		}

		if ( ! empty( $_GET['min_rating'] ) ) {
			$fields .= '<input type="hidden" name="min_rating" value="' . esc_attr( $_GET['min_rating'] ) . '" />';
		}

		if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
			foreach ( $_chosen_attributes as $attribute => $data ) {
				$taxonomy_filter = 'filter_' . str_replace( 'pa_', '', $attribute );

				$fields .= '<input type="hidden" name="' . esc_attr( $taxonomy_filter ) . '" value="' . esc_attr( implode( ',', $data['terms'] ) ) . '" />';

				if ( 'or' == $data['query_type'] ) {
					$fields .= '<input type="hidden" name="' . esc_attr( str_replace( 'pa_', 'query_type_', $attribute ) ) . '" value="or" />';
				}
			}
		}

		// Find min and max price in current result set
		$prices = $this->get_filtered_price();
		$min    = floor( $prices->min_price );
		$max    = ceil( $prices->max_price );

		if ( $min === $max ) {
			return;
		}

		$this->widget_start( $args, $instance );

		if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}

		/**
		 * Adjust max if the store taxes are not displayed how they are stored.
		 * Min is left alone because the product may not be taxable.
		 * Kicks in when prices excluding tax are displayed including tax.
		 */
		if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
			$tax_classes = array_merge( array( '' ), WC_Tax::get_tax_classes() );
			$class_max   = $max;

			foreach ( $tax_classes as $tax_class ) {
				if ( $tax_rates = WC_Tax::get_rates( $tax_class ) ) {
					$class_max = $max + WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max, $tax_rates ) );
				}
			}

			$max = $class_max;
		}

		echo '<form method="get" action="' . esc_url( $form_action ) . '">
			<div class="cms-filter-price-wrap">
				<div class="price_slider" style="display:none;"></div>

				<div class="row mb-20">
					<div class="col-xs-6">
						<input type="text" id="min_price" class="form-control" name="min_price" value="' . esc_attr( $min_price ) . '" data-min="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_min_amount', $min ) ) . '" placeholder="' . esc_attr__( 'FROM', 'wp-elementy' ) . '" />
					</div>
					<div class="col-xs-6">
						<input type="text" id="max_price" class="form-control" name="max_price" value="' . esc_attr( $max_price ) . '" data-max="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_max_amount', $max ) ) . '" placeholder="' . esc_attr__( 'TO', 'wp-elementy' ) . '" />
					</div>
				</div>
				<button type="submit" class="cms-button btn-block">' . esc_html__( 'Filter', 'wp-elementy' ) . '</button>
				' . $fields . '
				<div class="clear"></div>
			</div>
		</form>';


		/*echo '<form method="get" action="' . esc_url( $form_action ) . '">
			<div class="cms-filter-price-wrap">
				<div class="row mb-20">
					<div class="col-xs-6">
						<input type="text" class="form-control" name="min_price" value="' . esc_attr( $min_price ) . '" placeholder="' . esc_attr__('FROM', 'wp-elementy' ) . '" maxlength="100"/>
					</div>
					<div class="col-xs-6">
						<input type="text" class="form-control" name="max_price" value="' . esc_attr( $max_price ) . '" placeholder="' . esc_attr__( 'TO', 'wp-elementy' ) . '" maxlength="100" />
					</div>
				</div>
				<button type="submit" class="cms-button btn-block">' . esc_html__( 'Filter', 'wp-elementy' ) . '</button>
				' . $fields . '
			</div>
		</form>';*/

		$this->widget_end( $args );
	}
}