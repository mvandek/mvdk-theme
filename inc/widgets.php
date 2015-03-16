<?php
/**
 * Custom Widget for displaying specific post formats
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
function mvdk_widgets_init() {
register_sidebar(
[
'name' => 'Sidebar',
'id' => 'sidebar-1',
'description'   => __( 'Verschijnt bovenin de sidebar', 'mvdk' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => 'Footer',
'id' => 'sidebar-2',
'description'   => __( 'Verschijnt onderaan de pagina', 'mvdk' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => 'Single Post - Below Content',
'id' => 'sidebar-3',
'description'   => __( 'Verschijnt onder content, naast gerelateerde artikelen', 'mvdk' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => '404 Error Page',
'id' => '404',
'description'   => __( 'Verschijnt op 404 Page Not Found pagina', 'mvdk' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
}
add_action( 'widgets_init', 'mvdk_widgets_init' );