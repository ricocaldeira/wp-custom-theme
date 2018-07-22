<?php
/**
 * social share list
 * @author Duong Tung
 */
function wp_elementy_social_share() {
    ?>
    <ul class="woo-social-share-wrap">
        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><i aria-hidden="true" class="social_facebook"></i></a></li>
        <li><a target="_blank" href="https://twitter.com/home?status=<?php esc_html_e('Check out this product', 'wp-elementy');?>:%20<?php echo get_the_title();?>%20-%20<?php the_permalink();?>"><i aria-hidden="true" class="social_twitter"></i></a></li>
        <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>"><i aria-hidden="true" class="social_googleplus"></i></a></li>
    </ul>
    <?php
}
add_action('woocommerce_share', 'wp_elementy_social_share');

/**
 * For product Tab
 * @author Duong Tung
 */
add_filter( 'woocommerce_product_tabs', 'wp_elementy_woo_rename_tab', 98 );
function wp_elementy_woo_rename_tab( $tabs ) {
    $tabs['reviews']['title'] = esc_html__( 'Ratings', 'wp-elementy' );
    if (!empty($tabs['additional_information'] )) {
        $tabs['additional_information']['title'] = esc_html__( 'Parameters', 'wp-elementy' );
    }

    return $tabs;
}

/**
 * Filter number product to show
 * @author Duong Tung
 */
function wp_elementy_woo_product_page() {
	global $opt_theme_options;

	$number_product = '';
	$number_product = (!empty($opt_theme_options['woo_number_per_page'])) ? $opt_theme_options['woo_number_per_page'] : '12';

	return $number_product;
}
add_filter( 'loop_shop_per_page', 'wp_elementy_woo_product_page', 20 );

/**
 * Filter number columns per row
 * @author Duong Tung
 */
function wp_elementy_woo_col_per_row() {
	global $opt_theme_options;
	$col_perpage = '';

	if ( !empty($opt_theme_options['woo_columns_layout']) ) {
		$col_perpage = $opt_theme_options['woo_columns_layout'];
	} else {
		$col_perpage = 3;
	}

	return $col_perpage;
}
add_filter('loop_shop_columns', 'wp_elementy_woo_col_per_row');

/**
 * Check archive has pagination or not
 * @author Duong Tung
 */
function wp_elementy_woo_has_pagination() {
	global $wp_query;
	$woo_has_paging = false;

	if ($wp_query->max_num_pages <= 1) $woo_has_paging = true;

	return $woo_has_paging;
}

/**
 * show button Add to wishlist
 * @author Duong Tung
 */
function wp_elementy_add_to_wishlist_custom_btn() {
	if (class_exists( 'YITH_WCWL' )) {
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
}

/**
 * Get the product thumbnail for the loop.
 */
function wp_elementy_template_loop_product_thumbnail() {
	echo '<div class="cms-woo-thumbnail">';
	echo '<a href="' . get_the_permalink() . '">';
	echo woocommerce_get_product_thumbnail();
	echo '</a>';
	echo '</div>';
}

/**
 * Custom Product Filter Price - Default Widget
 * @author Duong Tung
 */
add_action( 'widgets_init', 'wp_elementy_override_woocommerce_widgets', 15 );
function wp_elementy_override_woocommerce_widgets() { 
    if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
        unregister_widget( 'WC_Widget_Price_Filter' );

        include_once( 'widgets/woo-price-filter.php' );
        register_widget( 'Custom_WC_Widget_Price_Filter' );
    } 

    if (class_exists('WC_Widget_Recent_Reviews')) {
    	unregister_widget('WC_Widget_Recent_Reviews');

    	include_once( 'widgets/woo-recent-review.php' );
        register_widget( 'Custom_WC_Widget_Recent_Reviews' );
    }
}

add_action( 'wp_ajax_product_remove', 'product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'product_remove' );
function product_remove() {
    $cart = WC()->instance()->cart;
    $item_key = $_POST['product_key'];
    if($item_key){
       $result = $cart->remove_cart_item($item_key);
    }
    exit();
}

/* Ajax update cart total number */
add_filter('woocommerce_add_to_cart_fragments', 'wp_elementy_woo_mini_total_cart_fragment');
function wp_elementy_woo_mini_total_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="cart_total"><?php echo ''.$woocommerce->cart->cart_contents_count; ?></span>
    <?php
    $fragments['span.cart_total'] = ob_get_clean();
    return $fragments;
}

/* Ajax update cart item */
add_filter('woocommerce_add_to_cart_fragments', 'wp_elementy_woo_mini_cart_item_fragment');
function wp_elementy_woo_mini_cart_item_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <div class="shopping_cart_dropdown">
        <div class="shopping_cart_dropdown_inner">
            <?php
                $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
            ?>
            <ul class="cart_list product_list_widget">
            <?php do_action( 'woocommerce_before_mini_cart_contents' ); ?>
            <?php if ( ! WC()->cart->is_empty() ) : ?>
                <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                            $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                            $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                                <div class="pull-left">
                                    <?php
                                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-item_key="%s" data-product_sku="%s">&times;</a>',
                                            esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                            esc_html__( 'Remove this item', 'wp-elementy' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $cart_item_key ),
                                            esc_attr( $_product->get_sku() )
                                        ), $cart_item_key );
                                        ?>
                                        <?php if ( ! $_product->is_visible() ) : ?>
                                            <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '&nbsp;'; ?>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url( $product_permalink ); ?>">
                                                <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '&nbsp;'; ?>
                                            </a>
                                        <?php endif; ?>
                                </div>
                                <div class="product-desc">
                                    <h5><?php echo esc_html($product_name); ?></h5>
                                    <?php echo WC()->cart->get_item_data( $cart_item ); ?>
                                    <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                                </div>
                            </li>
                            <?php
                        }
                    }
                ?>
                <?php do_action( 'woocommerce_mini_cart_contents' ); ?>
                <?php else : ?>
                    <li class="empty"><?php esc_html_e( 'No products in the cart.', 'wp-elementy' ); ?></li>
                <?php endif; ?>

            </ul><!-- end product list -->
        </div>

        <?php if ( ! WC()->cart->is_empty() ) : ?>

            <p class="total"><strong><?php esc_html_e( 'Subtotal', 'wp-elementy' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

            <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

            <p class="buttons">
                <?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
            </p>
        <?php endif; ?>
    </div>
    <?php
    $fragments['div.shopping_cart_dropdown'] = ob_get_clean();
    return $fragments;
}

/** Forms ****************************************************************/

if ( ! function_exists( 'woocommerce_form_field' ) ) {

	/**
	 * Outputs a checkout/address form field.
	 *
	 * @subpackage	Forms
	 * @param string $key
	 * @param mixed $args
	 * @param string $value (default: null)
	 * @todo This function needs to be broken up in smaller pieces
	 */
	function woocommerce_form_field( $key, $args, $value = null ) {
		
		$defaults = array(
			'type'              => 'text',
			'label'             => '',
			'description'       => '',
			'placeholder'       => '',
			'maxlength'         => false,
			'required'          => false,
			'id'                => $key,
			'class'             => array(),
			'label_class'       => array(),
			'input_class'       => array(),
			'return'            => false,
			'options'           => array(),
			'custom_attributes' => array(),
			'validate'          => array(),
			'default'           => '',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );
		
		$label_required = $args['required']?'*':'';
		if(!empty($args['label'])){
			$args['placeholder'] = $args['label'].' '.$label_required;
		} else {
			$args['placeholder'] = $args['placeholder'].' '.$label_required;
		}
		if ( ( ! empty( $args['clear'] ) ) ) {
			$after = '<div class="clear"></div>';
		} else {
			$after = '';
		}

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'wp-elementy'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}

		switch ( $args['type'] ) {
			case 'country' :

				$countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

				if ( sizeof( $countries ) == 1 ) {

					$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						//$field .= '<label class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']  . '</label>';
					}

					$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

					$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys($countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" placeholder="' . esc_attr( $args['label'] ) . '" />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				} else {

					$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">'
							//. '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required  . '</label>'
							. '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . '>'
							. '<option value="">'.__( 'Select a country&hellip;', 'wp-elementy' ) .'</option>';

					foreach ( $countries as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'. $cvalue .'</option>';
					}

					$field .= '</select>';

					$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . esc_html__( 'Update country', 'wp-elementy' ) . '" /></noscript>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				}

				break;
			case 'state' :

				/* Get Country */
				$country_key = $key == 'billing_state'? 'billing_country' : 'shipping_country';
				$current_cc  = WC()->checkout->get_value( $country_key );
				$states      = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {

					$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field" style="display: none">';

					if ( $args['label'] ) {
						//$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</label>';
					}
					$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				} elseif ( is_array( $states ) ) {

					$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] )
						//$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
						<option value="">'.__( 'Select a state&hellip;', 'wp-elementy' ) .'</option>';

					foreach ( $states as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>' . $cvalue .'</option>';
					}

					$field .= '</select>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				} else {

					$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						//$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
					}
					$field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . $args['placeholder'] . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				}

				break;
			case 'textarea' :

				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					//$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required  . '</label>';
				}

				$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '" placeholder="' . $args['placeholder'] . '" ' . $args['maxlength'] . ' ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>'. esc_textarea( $value  ) .'</textarea>';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</p>' . $after;

				break;
			case 'checkbox' :

				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">
						<label class="checkbox ' . implode( ' ', $args['label_class'] ) .'" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" '.checked( $value, 1, false ) .' /> '
						 . $args['label'] . $required . '</label>';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</p>' . $after;

				break;
			case 'password' :

				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					//$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
				}

				$field .= '<input type="password" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</p>' . $after;

				break;
			case 'text' :

				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					//$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</label>';
				}

				$field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</p>' . $after;

				break;
			case 'email' :
				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';
				$field .= '<input type="email" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				break;
			case 'tel' :
				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';
				$field .= '<input type="tel" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				break;
			case 'select' :

				$options = $field = '';

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						if ( "" === $option_key ) {
							// If we have a blank option, select2 needs a placeholder
							if ( empty( $args['placeholder'] ) ) {
								$args['placeholder'] = $option_text ? $option_text : esc_html__( 'Choose an option', 'wp-elementy' );
							}
							$custom_attributes[] = 'data-allow_clear="true"';
						}
						$options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';
					}

					$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						//$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
					}

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select '.esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;
				}

				break;
			case 'radio' :

				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					$field .= '<label for="' . esc_attr( current( array_keys( $args['options'] ) ) ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required  . '</label>';
				}

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						$field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
						$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) .'">' . $option_text . '</label>';
					}
				}

				$field .= '</p>' . $after;

				break;
			default :

				$field = '';

				break;
		}

		$field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

		if ( $args['return'] ) {
			return $field;
		} else {
			echo $field;
		}
	}
}

/**
 * Get shop info from theme option
 */
function wp_elementy_show_shop_info() {
	global $opt_theme_options;

	if ( !empty($opt_theme_options['woo_shop_intro']) ) {
 		$woo_shop_info_1 = ( !empty($opt_theme_options['woo_shop_info_1']) ) ? $opt_theme_options['woo_shop_info_1'] : esc_html__('Free Shipping', 'wp-elementy');
 		$woo_shop_info_2 = ( !empty($opt_theme_options['woo_shop_info_2']) ) ? $opt_theme_options['woo_shop_info_2'] : esc_html__('24/7 Customer Services', 'wp-elementy');
 		$woo_shop_info_3 = ( !empty($opt_theme_options['woo_shop_info_3']) ) ? $opt_theme_options['woo_shop_info_3'] : esc_html__('Payment Options', 'wp-elementy');
 		$woo_shop_info_4 = ( !empty($opt_theme_options['woo_shop_info_4']) ) ? $opt_theme_options['woo_shop_info_4'] : esc_html__('30 Days returns', 'wp-elementy');

 		?>
 		<div class="pt-110-b-80-cont mt-130 clearfix">
 			<div class="container">
 				<div class="row">
 					<div class="col-md-3 col-sm-6 text-center">
 						<i class="icon icon-basic-globe"></i>
 						<h6><?php echo esc_html($woo_shop_info_1); ?></h6>
 					</div>
 					<div class="col-md-3 col-sm-6 text-center">
 						<i class="icon icon-basic-life-buoy"></i>
 						<h6><?php echo esc_html($woo_shop_info_2); ?></h6>
 					</div>
 					<div class="col-md-3 col-sm-6 text-center">
 						<i class="icon icon-ecommerce-creditcard"></i>
 						<h6><?php echo esc_html($woo_shop_info_3); ?></h6>
 					</div>
 					<div class="col-md-3 col-sm-6 text-center">
 						<i class="icon icon-basic-clockwise"></i>
 						<h6><?php echo esc_html($woo_shop_info_4); ?></h6>
 					</div>
 				</div>
 			</div>
 		</div>
 		<?php
	}
}

/**
 * Get shop gallery
 */
function wp_elementy_show_shop_clients_gallery() {
	global $opt_theme_options;

	if ( !empty($opt_theme_options['woo_shop_clients']) ) {
		$woo_clients_gallery_ids = '';
		$woo_clients_gallery_ids = ( !empty($opt_theme_options['woo_clients_gallery']) ) ? explode(',', $opt_theme_options['woo_clients_gallery']) : '';
		?>
			<div class="p-100-cont clearfix">
				<div class="container">
					<div class="row">
						<?php foreach ($woo_clients_gallery_ids as $image_id): ?>
                            <?php
                            $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                            if($attachment_image[0] != ''):?>
                                <div class="col-xs-6 col-sm-2 client-item">
                                    <img src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php
	}
}
