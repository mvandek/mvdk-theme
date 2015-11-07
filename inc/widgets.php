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
'name' => __( 'Sidebar Top', 'mvdk' ),
'id' => 'sidebar-10',
'description'   => __( 'Verschijnt bovenin de sidebar', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => __( 'Sidebar Bottom', 'mvdk' ),
'id' => 'sidebar-15',
'description'   => __( 'Verschijnt onderin de sidebar', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => __( 'Footer', 'mvdk' ),
'id' => 'sidebar-20',
'description'   => __( 'Verschijnt onderaan de pagina', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => __( 'Single Post - Below Content', 'mvdk' ),
'id' => 'sidebar-30',
'description'   => __( 'Verschijnt onder content, naast gerelateerde artikelen', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => __( '404 Error Page', 'mvdk' ),
'id' => 'page-404',
'description'   => __( 'Verschijnt op 404 Page Not Found pagina', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h2 class="widget-title">',
'after_title' => '</h2>'
]
);
}
add_action( 'widgets_init', 'mvdk_widgets_init' );