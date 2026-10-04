<div class="qodef-portfolio-list-holder qodef-grid-list qodef-disable-bottom-space <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
    <?php echo byanca_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/filter', '', $params); ?>
    <div class="qodef-pl-inner qodef-outer-space <?php echo esc_attr($holder_inner_classes); ?> clearfix">
        <?php
        if ($query_results->have_posts()):
            $params['counter'] = 1;
            while ($query_results->have_posts()) : $query_results->the_post();
                echo byanca_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item', $item_type, $params);
                $params['counter']++;
            endwhile;
        else:
            echo byanca_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
        endif;

        wp_reset_postdata();
        ?>
    </div>
</div>