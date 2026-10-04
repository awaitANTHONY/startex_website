<?php
$image_size          = isset( $image_size ) ? $image_size : 'full';
$image_meta          = get_post_meta( get_the_ID(), 'qodef_blog_list_featured_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
$blog_list_image_id  = ! empty( $image_meta ) ? byanca_select_get_attachment_id_from_url( $image_meta ) : '';

$general_style = array();
if ( $has_featured ) {
	if ( ! empty( $blog_list_image_id ) ) {
		$image_src = wp_get_attachment_image_src( $blog_list_image_id, $image_size );
		if (!empty($image_src)) {
			$general_style[] = 'background-image: url(' . $image_src[0] . ')';
		}
	} else {
		$general_style[] = 'background-image: url(' . get_the_post_thumbnail_url( get_the_ID(), $image_size ) . ')';
	}
} else {
	$general_style[] = 'background-color: #deebe9';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
	    <div class="qodef-post-content-main" <?php byanca_select_inline_style($general_style); ?>>
		    <div class="qodef-post-heading">
		        <?php byanca_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
	        </div>
	        <div class="qodef-post-text">
	            <div class="qodef-post-text-inner">
	                <div class="qodef-post-text-main">
	                    <div class="qodef-post-mark">
	                        <span class="icon_link_alt qodef-link-mark"></span>
	                    </div>
	                    <?php byanca_select_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="qodef-post-info-top">
	        <?php byanca_select_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
	        <?php byanca_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
	    </div>
	    <div class="qodef-post-additional-content">
	        <?php the_content(); ?>
	    </div>
	    <div class="qodef-post-info-bottom clearfix">
	        <div class="qodef-post-info-bottom-left">
	            <?php byanca_select_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
	        </div>
	        <div class="qodef-post-info-bottom-right">
	            <?php byanca_select_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
	        </div>
	    </div>
    </div>
</article>