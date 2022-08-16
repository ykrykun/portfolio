<?php
global $product, $woocommerce_quick_view_options;

$elements = $woocommerce_quick_view_options['dataToShow']['enabled'];
unset($elements['placebo']);
?> 

<?php

do_action( 'woocommerce_quick_view_modal_start' );

if($woocommerce_quick_view_options['modalArrows'] == "1" && $woocommerce_quick_view_options['openEffect'] == "modal") {
	echo '<a href="#" class="quick-view-arrows quick-view-arrow-previous"></a>';
}

if(isset($elements['im'])) {

	if ( has_post_thumbnail($product->get_id())) { 
		$product_image_id = get_post_thumbnail_id($product->get_id());
		$thumbnail = wp_get_attachment_image_src( $product_image_id, 'full' ); 
		$product_image_src = $thumbnail[0];
	} else { 
		$product_image_src = wc_placeholder_img_src();
	}
	$html = sprintf('<img src="%s" alt="%s" class="woocommerce-quick-view-image-src">', $product_image_src, wp_strip_all_tags( $product->get_title() ) );
?>
	<div class="woocommerce-quick-view-image">
		<?php echo apply_filters( 'woocommerce_quick_view_image_html', $html ); ?>

		<?php
		if(isset($elements['gl'])) {
			echo '<div class="woocommerce-quick-view-gallery-images">';

			$attachment_ids = $product->get_gallery_image_ids();

			if ( $attachment_ids && has_post_thumbnail() ) {
				$count = 0;
				array_unshift($attachment_ids, $product_image_id);
				foreach ( $attachment_ids as $attachment_id ) {
					if($count == 4) {
						break;
					}
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id  ), $attachment_id );
					$count++;
				}
			}
			echo '</div>';
		}
		?>
	</div>
<?php } ?>

<div id="quick-view-modal" class="product woocommerce-quick-view-content <?php echo isset($elements['im']) ? 'woocommerce-quick-view-content-image' : 'woocommerce-quick-view-content-no-image' ?>">

	<?php 

	do_action( 'woocommerce_quick_view_modal_content_start' );

	foreach ($elements as $elementKey => $elementData) {

		switch ($elementKey) {

			// Title
			case 'ti':
				$title =  $product->get_title();
				if(!empty($title)) {
					echo 
					'<h1 class="woocommerce-quick-view-title">
						' . apply_filters( 'woocommerce_quick_view_title', $title ) . '
					</h1>';
				}
			break;

			// Rating
			case 're':
				$rating =  wc_get_rating_html( $product->get_average_rating() );
				if(!empty($rating)) {
					echo 
					'<div class="woocommerce-quick-view-rating">
						' . apply_filters( 'woocommerce_quick_view_rating', $rating ) . '
					</div>';
				}
			break;

			// Price
			case 'pr':
				$price =  $product->get_price_html();
				if(!empty($price)) {
					echo 
					'<div class="woocommerce-quick-view-price">
						' . apply_filters( 'woocommerce_quick_view_price', $price ) . '
					</div>';
				}
			break;

			// Short Description
			case 'sd':
				$short_description =  $product->get_short_description();
				if(!empty($short_description)) {
					echo 
					'<div class="woocommerce-quick-view-short-description">
						' . apply_filters( 'woocommerce_quick_view_short_description', wpautop( do_shortcode( $short_description) ) ) . '
					</div>';
				}
			break;

			// Description
			case 'de':
				$description =  $product->get_description();
				if(!empty($description)) {
					echo 
					'<div class="woocommerce-quick-view-short-description">
						' . apply_filters( 'woocommerce_quick_view_description', wpautop( do_shortcode( $description) ) ) . '
					</div>';
				}
			break;

			// Stock Status
			case 'st':
				$stock_status = wc_get_stock_html( $product );
				if(!empty($stock_status)) {
					echo 
					'<div class="woocommerce-quick-view-stock">' .
						apply_filters( 'woocommerce_quick_view_stock', $stock_status) .
					'</div>';
				}
			break;

			// SKU
			case 'sk': 
				$sku = $product->get_sku();
				if(!empty($sku)) {
					echo 
					'<div class="woocommerce-quick-view-sku">' .
						__('SKU: ', 'woocommerce-quick-view') . 
						apply_filters( 'woocommerce_quick_view_sku', $sku) .
					'</div>';
				}
			break;

			// Tags
			case 'tg': 
				$tags = wc_get_product_tag_list( 
							$product->get_id(), 
							', ', 
							'<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' '
							, '</span>' );
				if(!empty($tags)) {
					echo 
					'<div class="woocommerce-quick-view-tags">' .
						apply_filters( 'woocommerce_quick_view_tags', $tags) .
					'</div>';
				}
			break;

			// Categories
			case 'ct': 
				$categories = wc_get_product_category_list( 
								$product->get_id(), 
								', ', 
								'<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', 
								'</span>' 
							);
				if(!empty($categories)) {
					echo 
					'<div class="woocommerce-quick-view-categories">' .
						apply_filters( 'woocommerce_quick_view_categories', $categories) .
					'</div>';
				}
			break;

			case 'ca':
				ob_start();
				woocommerce_template_single_add_to_cart(); 
				$addToCart = ob_get_contents();
				ob_end_clean();				
				echo '
				<div class="woocommerce-quick-view-add-to-cart">
					' . $addToCart . 
				'</div>';
			break; 

			case 'rm':
				echo 
				'<div class="woocommerce-quick-view-read-more">' .
						printf('<a href="%s" class="woocommerce-quick-view-read-more-btn btn button">%s</a>', get_permalink($product->get_id()), __('Read More', 'woocommerce-quick-view') ) . 
				'</div>';
			break;

			case 'at':
				echo 
				'<div class="woocommerce-quick-view-attributes">' .
					do_action( 'woocommerce_product_additional_information', $product ) . 
				'</div>';
			break;

		}
	}
	?>

	<?php do_action( 'woocommerce_quick_view_modal_content_end' ); ?>
</div>

<?php
if($woocommerce_quick_view_options['modalArrows'] == "1" && $woocommerce_quick_view_options['openEffect'] == "modal") {
	echo '<a href="#" class="quick-view-arrows quick-view-arrow-next"></a>';
}
?>

<?php do_action( 'woocommerce_quick_view_modal_end' ); ?>