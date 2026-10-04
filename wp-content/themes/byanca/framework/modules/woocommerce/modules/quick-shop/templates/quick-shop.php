<a class="qodef-quick-shop-opener" href="javascript:void(0)"><?php echo esc_attr($quick_shop_opener_text);?></a>
<div class="qodef-quick-shop-holder">
    <div class="qodef-qs-table">
        <div class="qodef-qs-table-cell">
            <div class="qodef-qs-inner">
                <a class="qodef-qs-close icon_close" href="javascript:void(0)"></a>
                <div class="qodef-qs-content-container">
	                <?php byanca_select_get_module_template_part( 'modules/quick-shop/templates/filter', 'woocommerce', '', $filter_params ); ?>
					<?php byanca_select_get_module_template_part( 'modules/quick-shop/templates/products-holder', 'woocommerce', '', $list_params ); ?>
                </div>
            </div>
        </div>
    </div>
</div>