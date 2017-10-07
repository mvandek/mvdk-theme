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
'name' => esc_html__( 'Sidebar Top', 'mvdk' ),
'id' => 'sidebar-10',
'description'   => esc_html__( 'Verschijnt bovenin de sidebar', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => esc_html__( 'Sidebar Bottom', 'mvdk' ),
'id' => 'sidebar-15',
'description'   => esc_html__( 'Verschijnt onderin de sidebar', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => esc_html__( 'Footer', 'mvdk' ),
'id' => 'sidebar-20',
'description'   => esc_html__( 'Verschijnt onderaan de pagina', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => esc_html__( 'Single Post - Below Content', 'mvdk' ),
'id' => 'sidebar-30',
'description'   => esc_html__( 'Verschijnt onder content, naast gerelateerde artikelen', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => esc_html__( 'Search Sidebar', 'mvdk' ),
'id' => 'sidebar-search',
'description'   => esc_html__( 'Verschijnt onder sidebar Single Post - Below Content', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
]
);
register_sidebar(
[
'name' => esc_html__( '404 Error Page', 'mvdk' ),
'id' => 'page-404',
'description'   => esc_html__( 'Verschijnt op 404 Page Not Found pagina', 'mvdk' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h2 class="widget-title">',
'after_title' => '</h2>'
]
);
}
add_action( 'widgets_init', 'mvdk_widgets_init' );