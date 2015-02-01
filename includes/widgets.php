<?php
/**
* Registers theme widget areas
*
* @uses register_sidebar()
*
* @since Maarten van de Kamp - V2
*/
function maartenvandekamp_widgets_init() {
register_sidebar(
array(
'name' => 'Sidebar',
'id' => 'sidebar-1',
'description'   => __( 'Verschijnt bovenin de sidebar', 'esplanade' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
)
);
register_sidebar(
array(
'name' => 'Footer',
'id' => 'sidebar-2',
'description'   => __( 'Verschijnt onderaan de pagina', 'esplanade' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
)
);
register_sidebar(
array(
'name' => 'Single Post - Below Content',
'id' => 'sidebar-3',
'description'   => __( 'Verschijnt onder content, naast gerelateerde artikelen', 'esplanade' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
)
);
register_sidebar(
array(
'name' => '404 Error Page',
'id' => '404',
'description'   => __( 'Verschijnt op 404 Page Not Found pagina', 'maartenvandekamp' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>'
)
);
}
add_action( 'widgets_init', 'maartenvandekamp_widgets_init' );