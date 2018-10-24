<?php 
function acethehimalaya_widgets_init() {
	register_sidebar(array(
		'name' => esc_html__('Sidebar', 'acethehimalaya'),
		'id' => 'sidebar-1',
		'description' => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s"> <div class="widget-wrap">',
		'after_widget' => '</div></section>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	));

	register_sidebar(array(
		'name' => esc_html__('Trip Single Sidebar', 'acethehimalaya'),
		'id' => 'trip-sidebar',
		'description' => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s"> <div class="widget-wrap">',
		'after_widget' => '</div></section>',
		'before_title' => '<h5 class="widget-title hidden-title">',
		'after_title' => '</h5>',
	));

    register_sidebar( array(
        'name'          => esc_html__( 'Right Trip Advisor Widgets', 'acethehimalaya' ),
        'id'            => 'right-trip-advisor-widgets',
        'description'   => esc_html__( 'Add 6 widgets here.', 'acethehimalaya' ),
        'before_widget' => '<li>',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
     register_sidebar( array(
        'name'          => esc_html__( 'Left Trip Advisor Widget', 'acethehimalaya' ),
        'id'            => 'left-trip-advisor-widget',
        'description'   =>  esc_html__( 'Add one widget here.', 'acethehimalaya' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );     
}

add_action('widgets_init', 'acethehimalaya_widgets_init');