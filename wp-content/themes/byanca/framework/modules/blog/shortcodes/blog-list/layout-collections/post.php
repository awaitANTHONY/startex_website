<li class="qodef-bl-item qodef-item-space">
	<div class="qodef-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			byanca_select_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="qodef-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="qodef-bli-info">
	                <?php
	                    if ( $post_info_author == 'yes' ) {
			                byanca_select_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                byanca_select_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_date == 'yes' ) {
			                byanca_select_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php byanca_select_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="qodef-bli-excerpt">
		        <?php byanca_select_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
		        <?php byanca_select_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', 'simple', $params ); ?>
	        </div>
        </div>
	</div>
</li>