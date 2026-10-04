<?php do_action('byanca_select_action_before_page_header'); ?>

<aside class="qodef-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
	<div class="qodef-vertical-menu-area-inner <?php echo esc_attr($menu_area_position_class); ?>">
		<div class="qodef-vertical-area-background"></div>
		<?php if(!$hide_logo) {
			byanca_select_get_logo();
		} ?>
		<?php byanca_select_get_header_vertical_main_menu(); ?>
        <?php if(byanca_select_is_header_widget_area_active('one')): ?>
            <div class="qodef-vertical-area-widget-holder">
                <?php byanca_select_get_header_widget_area_one(); ?>
            </div>
         <?php endif; ?>
	</div>
</aside>

<?php do_action('byanca_select_action_after_page_header'); ?>