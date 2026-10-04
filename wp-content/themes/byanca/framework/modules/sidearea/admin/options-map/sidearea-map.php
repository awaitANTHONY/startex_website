<?php

if ( ! function_exists( 'byanca_select_sidearea_options_map' ) ) {
	function byanca_select_sidearea_options_map() {

        byanca_select_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'byanca'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = byanca_select_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'byanca'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'byanca'),
                'description'   => esc_html__('Choose a type of Side Area', 'byanca'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'byanca'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'byanca'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'byanca'),
                ),
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'byanca'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'byanca'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = byanca_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'byanca'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'byanca'),
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'byanca'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'byanca'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'icon_pack',
                'label'         => esc_html__('Select Side Area Icon Source', 'byanca'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'byanca'),
                'options'       => byanca_select_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = byanca_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'byanca'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'byanca'),
                'options'       => byanca_select_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = byanca_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'byanca'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'byanca'),
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'byanca'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'byanca'),
            )
        );

        $side_area_icon_style_group = byanca_select_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'byanca'),
                'description' => esc_html__('Define styles for Side Area icon', 'byanca')
            )
        );

        $side_area_icon_style_row1 = byanca_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'byanca')
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'byanca')
            )
        );

        $side_area_icon_style_row2 = byanca_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'byanca')
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'byanca')
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'byanca'),
                'description' => esc_html__('Choose a background color for Side Area', 'byanca')
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'byanca'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'byanca'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        byanca_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'byanca'),
                'description'   => esc_html__('Choose text alignment for side area', 'byanca'),
                'options'       => array(
                    ''       => esc_html__('Default', 'byanca'),
                    'left'   => esc_html__('Left', 'byanca'),
                    'center' => esc_html__('Center', 'byanca'),
                    'right'  => esc_html__('Right', 'byanca')
                )
            )
        );
    }

    add_action('byanca_select_action_options_map', 'byanca_select_sidearea_options_map', byanca_select_set_options_map_position( 'sidearea' ) );
}