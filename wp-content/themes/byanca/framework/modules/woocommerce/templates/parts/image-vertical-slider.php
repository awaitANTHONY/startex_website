<div class="qodef-pli-image">
    <?php
    if (has_post_thumbnail()) {
        $image_src = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } else {
        $image_src = SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/assets/img/product_featured_image.jpg';
    }
    $style = 'style=background-image:url(' . $image_src . ')';
    ?>
    <div class="qodef-pli-background-image" <?php echo esc_attr($style); ?>></div>
</div>