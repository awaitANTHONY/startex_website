<?php $params['title_styles'] = $this_object->getTitleStyles( $params ); ?>
<article class="qodef-pl-item qodef-item-space <?php echo esc_attr($this_object->getItemClasses($params)); ?>">
    <div class="qodef-pl-item-inner">

	    <?php byanca_select_get_module_template_part( 'templates/parts/image', 'woocommerce', 'vertical-slider', $params ); ?>

		<div class="qodef-pli-text-holder">
		    <div class="qodef-pli-text-wrapper">
		        <div class="qodef-pli-text">

			        <?php byanca_select_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>

			        <?php byanca_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>

			        <?php byanca_select_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>

			        <?php byanca_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>

		        </div>
		    </div>
		</div>

    </div>
</article>