<?php

/************************************* Home Page Feature Image ***********************************************/	

		
		if ( ! function_exists( 'seos_blue_home_page_slide_img' ) ) :
	function seos_blue_home_page_slide_img( $wp_customize ) {
	
		$wp_customize->add_section( 'seos_blue_featured_slider_section' , array(
			'title'       => __( 'Home Page Featured IMG', 'seos-blue' ),
			'description' => __( 'Post your Title, IMG and URL. Featured IMG will appear only on your home page.', 'seos-blue' ),
			'priority'		=> 3,
		) );
		
		$wp_customize->add_setting( 'seos_blue_slider_activate', array (
			'sanitize_callback' => 'sanitize_text_field',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_blue_deactivate', array(
					'label'		=> __( 'Activate Read More button.', 'seos-blue' ),
					'section'	=> 'seos_blue_featured_slider_section',
					'settings'	=> 'seos_blue_slider_activate',
					'type'		=> 'select',
					'choices'	=> array
					(
						'Read More'	=> 'Deactivate',
						''	=> 'Activate'
						
					)
				) 
			) 
		);
		
		$wp_customize->add_setting( 'seos_blue_img_slider_text', array (
			'sanitize_callback' => 'sanitize_text_field',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_blue_img_slider_text', array(
			'label'    => __( 'Your Title Text:', 'seos-blue' ),
			'section'  => 'seos_blue_featured_slider_section',
			'settings' => 'seos_blue_img_slider_text',
			'type' => 'text',
		) ) );

		$wp_customize->add_setting( 'slider_img', array (
			'sanitize_callback' => 'esc_url_raw',
            'default' => get_template_directory_uri() . '/img/home-img1.jpg',
		) );
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( 
			$wp_customize, 
			'slider_img', 
			array(
				'label'      => __( 'Your IMG Upload:', 'seos-blue' ),
				'section'    => 'seos_blue_featured_slider_section',
				'settings'   => 'slider_img',
			) ) );
			
		$wp_customize->add_setting( 'slide_url', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slide_url', array(
			'label'    => __( 'Enter your image url', 'seos-blue' ),
			'section'  => 'seos_blue_featured_slider_section',
			'settings' => 'slide_url',
		) ) );	

	}
endif;
		add_action('customize_register', 'seos_blue_home_page_slide_img');