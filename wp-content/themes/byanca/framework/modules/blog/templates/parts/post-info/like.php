<?php if(byanca_select_core_plugin_installed()) { ?>
    <div class="qodef-blog-like">
        <?php if( function_exists('byanca_select_get_like') ) byanca_select_get_like(); ?>
    </div>
<?php } ?>