<div class="qodef-qs-filter-holder">
	<select name="qodef-qs-filter" class="qodef-qs-filter select2">
		<?php
         echo "<option value>" . esc_html__( 'Categories ', 'byanca' ) . "</option>";
			foreach ($product_categories as $product_category) { ?>
				<option value="<?php echo  esc_attr($product_category->slug); ?>"><?php echo esc_attr($product_category->name); ?></option>
			<?php }
		?>
	</select>
	<?php
	$unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'qodef_product_quickview_nonce_' . $unique_id, 'qodef_product_quickview_nonce_' . $unique_id ); ?>
</div>