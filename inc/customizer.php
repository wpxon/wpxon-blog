<?php
/**
 * wpxon Theme Customizer.
 *
 * @package wpxon
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wpxon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';  
	//  link color
	$wp_customize->add_setting( 'link_color' , array(
	    'default'     => '',
	    'transport'   => 'postMessage', 
	    'sanitize_callback' => 'sanitize_hex_color',
	) ); 
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'link_color', 
		array(
			'label'      => __( 'Link Color', 'wpxon-blog' ),
			'section'    => 'colors',
			'settings'   => 'link_color',
		) ) 
	);
	//  link hover color
	$wp_customize->add_setting( 'link_hvr_color' , array(
	    'default'     => '',
	    'transport'   => 'postMessage', 
	    'sanitize_callback' => 'sanitize_hex_color',
	) ); 
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'link_hvr_color', 
		array(
			'label'      => __( 'Link Hover Color', 'wpxon-blog' ),
			'section'    => 'colors',
			'settings'   => 'link_hvr_color',
		) ) 
	);
	
	// header deault text
	$wp_customize->add_setting( 'header_default_text' , array(
	    'default'     => '',
	    'transport'   => 'postMessage', 
	    'sanitize_callback' => 'sanitize_text_field',
	) ); 
	$wp_customize->add_control( 'header_default_text', array(
	    'label' => __( 'Header Default Text', 'wpxon-blog' ),
	    'priority' =>1,
		'section'	=> 'header_image',
		'setting'	=> 'header_default_text',
		'type'	 => 'text', 
        'description'   => __( 'Write header default text here.', 'wpxon-blog' )
	) ); 

	// footer settings
	$wp_customize->add_section( 'v_copyright' , array(
	    'title'      => __( 'Footer Settings', 'wpxon-blog' ),
	    'priority'   => 90,
	) );
	$wp_customize->add_setting( 'v_copyright_text' , array(
	    'default'     => '',
	    'transport'   => 'postMessage', 
	    'sanitize_callback' => 'sanitize_text_field',
	) ); 
	$wp_customize->add_control( 'v_copyright_text', array(
	    'label' => __( 'Copyright Text', 'wpxon-blog' ),
		'section'	=> 'v_copyright',
		'setting'	=> 'v_copyright_text',
		'type'	 => 'textarea',
        'description'   => __( 'Write copyright text here.', 'wpxon-blog' )
	) ); 
}
add_action( 'customize_register', 'wpxon_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wpxon_customize_preview_js() {
	wp_enqueue_script( 'wpxon_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wpxon_customize_preview_js' );
