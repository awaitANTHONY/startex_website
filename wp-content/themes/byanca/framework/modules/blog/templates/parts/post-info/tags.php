<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="qodef-tags-holder">
	<div class="qodef-tags-label"><?php esc_html__('Tags', 'byanca') ?></div>
    <div class="qodef-tags">
        <?php the_tags('', ', ', ''); ?>
    </div>
</div>
<?php } ?>