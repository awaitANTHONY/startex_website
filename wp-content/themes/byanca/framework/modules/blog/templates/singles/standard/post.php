<?php
$show_category_in_heading = false;

switch ($post_format) {
	case 'standard':
	case 'audio':
		if ( has_post_thumbnail() ) {
			$show_category_in_heading = true;
		}
		break;
	case 'gallery':
		$image_gallery_val = get_post_meta( get_the_ID(), 'qodef_post_gallery_images_meta', true );
		if ( ! empty( $image_gallery_val ) || has_post_thumbnail() ) {
			$show_category_in_heading = true;
		}
		break;
	case 'video':
		$video_type = get_post_meta(get_the_ID(), "qodef_video_type_meta", true);
		$has_video_link = ($video_type === 'self' && get_post_meta(get_the_ID(), "qodef_post_video_custom_meta", true) !== '') || ($video_type === 'social_networks' && get_post_meta(get_the_ID(), "qodef_post_video_link_meta", true) !== '');
		if ( $has_video_link ) {
			$show_category_in_heading = true;
		}
		break;
	default:
		if ( has_post_thumbnail() ) {
			$show_category_in_heading = true;
		}
		break;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php byanca_select_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
	        <?php if ( $show_category_in_heading ) {
                byanca_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params);
            } ?>
        </div>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-info-top">
	                <?php byanca_select_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
	                <?php if ( ! $show_category_in_heading ) {
		                byanca_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params);
	                } ?>
                    <?php byanca_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-text-main">
	                <div class="qodef-single-post-title">
                        <?php byanca_select_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    </div>
                    <?php the_content(); ?>
                    <?php do_action('byanca_select_action_single_link_pages'); ?>
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
        </div>
    </div>
</article>