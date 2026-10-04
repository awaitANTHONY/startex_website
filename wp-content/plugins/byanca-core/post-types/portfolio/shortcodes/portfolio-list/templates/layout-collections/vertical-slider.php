<?php

echo byanca_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params);

?>


<div class="qodef-pli-text-holder">
    <div class="qodef-pli-text-wrapper">
        <div class="qodef-pli-text">
            <div class="qodef-pli-nav-indicator">
                <div class="qodef-indicator">
                    <?php echo esc_attr($params['counter']); ?>
                </div>
                <div class="qodef-nav">
                    <?php
                    $button_params = array(
                        'type' => 'simple',
                        'text' => esc_html__('Explore More', 'byanca-core'),
                        'link' => $this_object->getItemLink(),
                    );
                    echo byanca_select_execute_shortcode('qodef_button', $button_params);
                    ?>
                </div>
            </div>

            <?php echo byanca_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', '', $params); ?>

            <?php echo byanca_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', '', $params); ?>

            <?php echo byanca_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/excerpt', '', $params); ?>
        </div>
    </div>
</div>