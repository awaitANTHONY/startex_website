<ul class="qodef-membership-dashboard-nav clearfix">
	<?php
	$nav_items = byanca_membership_get_dashboard_navigation_items();
	$user_action = isset($_GET['user-action']) ? $_GET['user-action'] : 'profile';
	foreach ( $nav_items as $nav_item ) { ?>
		<li <?php if($user_action == $nav_item['user_action']){ echo 'class="qodef-active-dash"'; } ?>>
			<a href="<?php echo byanca_select_get_plugin_module_template_part($nav_item['url']); ?>">
                <?php if(isset($nav_item['icon'])){ ?>
                    <span class="qodef-dash-icon">
						<?php echo byanca_select_get_plugin_module_template_part($nav_item['icon']); ?>
					</span>
                <?php } ?>
                <span class="qodef-dash-label">
				    <?php echo byanca_select_get_plugin_module_template_part($nav_item['text']); ?>
                </span>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>">
             <span class="qodef-dash-icon">
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            </span>
			<?php esc_html_e( 'Log out', 'byanca-membership' ); ?>
		</a>
	</li>
</ul>