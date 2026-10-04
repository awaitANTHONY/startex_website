<?php do_action( 'byanca_select_action_before_footer_content' ); ?>
</div> <!-- close div.content_inner -->
	</div> <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="qodef-page-footer <?php echo esc_attr($holder_classes); ?>">
				<?php
					if($display_footer_top) {
						byanca_select_get_footer_top();
					}
					if($display_footer_bottom) {
						byanca_select_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
		<?php do_action( 'byanca_select_action_after_footer' ); ?>
	</div> <!-- close div.qodef-wrapper-inner  -->
</div> <!-- close div.qodef-wrapper -->
<?php do_action( 'byanca_select_action_after_footer_content' ); ?>
<?php wp_footer(); ?>
</body>
</html>