<?php
/**
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 * For more information on hooks, actions, and filters, see https://codex.wordpress.org/ 
 */


/*********************************************************************************************************
* Basic
**********************************************************************************************************/


	function seos_blue_scripts() {
	
		wp_register_script( 'seos-blue-jq', get_template_directory_uri() . '/js/jq.js', array(), '1.0.0', true );
		wp_enqueue_script( 'seos-blue-jq' );
		
		wp_register_script( 'seos-blue-top', get_template_directory_uri() . '/js/top.js', array(), '1.0.0', true );
		wp_enqueue_script( 'seos-blue-top' );	
		
		if (is_singular() && comments_open()) {wp_enqueue_script('comment-reply');}
	
		wp_register_style( 'seos_fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
		wp_enqueue_style( 'seos_fontawesome' );

	
	}
	add_action( 'wp_enqueue_scripts', 'seos_blue_scripts' );

		function seos_blue_admin_scripts() {
		
		wp_register_style( 'seos_admin', get_template_directory_uri() . '/css/admin.css' );
		wp_enqueue_style( 'seos_admin' );
	
	}
	add_action( 'admin_enqueue_scripts', 'seos_blue_admin_scripts' );
	
	function seos_blue_theme_add_editor_styles() {
		add_editor_style( 'editor-style.css' );
	}		
	add_action( 'admin_init', 'seos_blue_theme_add_editor_styles' );
			
	if ( ! isset( $content_width ) ) $content_width = 640;

/*********************************************************************************************************
* After Setup
**********************************************************************************************************/		
		
	if ( ! function_exists( 'seosblue_setup' ) ) :	
		function seosblue_setup() {

			load_theme_textdomain( 'seos-blue-languages', get_template_directory() . '/languages' );
			
			add_theme_support( 'automatic-feed-links' );

			add_theme_support( 'title-tag' );

			add_theme_support( 'post-thumbnails' );
			
			add_theme_support( 'woocommerce' );
			
			add_theme_support( 'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

		}
	endif;
		add_action( 'after_setup_theme', 'seosblue_setup' );

/*********************************************************************************************************
* Register Sidebar
**********************************************************************************************************/


	function seosblue_widgets_init() {
		register_sidebar( array(
			'id'          => ('sidebar'),
			'name'        => __( 'Sidebar', 'seos-blue'),
			'description' => __( ' ', 'seos-blue' ),
		) );
		
		register_sidebar( array(
			'id'          => ('left'),
			'name'        => __( 'Sidebar Left', 'seos-blue'),
			'description' => __( ' ', 'seos-blue' ),
		) );

}

		add_action( 'widgets_init', 'seosblue_widgets_init' );



/*********************************************************************************************************
* Register Nav Menu
**********************************************************************************************************/


		register_nav_menus(array(
			'menu-top' => __('Menu top', 'seos-blue')
		));

/********************************** Include *************************************/

require get_template_directory() . '/inc/home-page-img.php';
require get_template_directory() . '/inc/premium-options.php';



/*********************************************************************************************************
* Search Form
**********************************************************************************************************/


		function my_search_form( $form ) {
			$form = '<form method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
			<input type="text" value="' . get_search_query() . '" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="'. esc_attr__( ' ','seos-blue' ) .'" />
			</form>';
			return $form;
		}

		add_filter( 'get_search_form', 'my_search_form' );


/*********************************************************************************************************
* Pagination. 
**********************************************************************************************************/


		if ( ! function_exists( 'mb_pagination' ) ) :

		function mb_pagination() {
			global $wp_query;
			$current = max( 1, get_query_var('paged') );

			$pagination_return = paginate_links( array(
				'format' => '?paged=%#%',
				'current' => $current,
				'total' => $wp_query->max_num_pages,
				'next_text' => '&raquo;',
				'prev_text' => '&laquo;'
			) );

			if ( ! empty( $pagination_return ) ) {
				echo '<div class="pagination">';
				echo '<div class="total-pages">';
				echo '</div>';
				echo $pagination_return;
				echo '</div>';
			}
		}
		endif; 

 	$seosblue_page = array(
		'before'           => '<p>' . __( 'Pages:', 'seos-blue' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page', 'seos-blue' ),
		'previouspagelink' => __( 'Previous page', 'seos-blue' ),
		'pagelink'         => '%',
		'echo'             => 1
	);
 
        wp_link_pages( $seosblue_page);



/*********************************************************************************************************
* Load CSS
**********************************************************************************************************/


		function seosblue_css() {		   
				wp_enqueue_style('seosblue_style', get_stylesheet_uri());
			}

		add_action('wp_enqueue_scripts', 'seosblue_css');



/*********************************************************************************************************
* Custom header
**********************************************************************************************************/



		$seosblue_custom_header_logo  = array(
			'width'        => 1300,
			'height'        => 100,
			'random-default' => true,
			'flex-height'            => true,
			'flex-width'             => false,
			'header-text'            => false,
		);

		add_theme_support( 'custom-header', $seosblue_custom_header_logo );



/*********************************************************************************************************
* Custom Colors Customize
**********************************************************************************************************/


		function seosblue_colors($wp_customize) {


/********************************************
* Hover color
*********************************************/
    

		$wp_customize->add_setting('seosblue_hover_color', array(        
  	      'default' => 'CE0000',
		    'sanitize_callback' => 'sanitize_hex_color'
  	  ));  
	
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seosblue_hover_color', array(
		'label' => __('Hover Color', 'seos-blue'),       
  	      'section' => 'colors',
  	      'settings' => 'seosblue_hover_color'
  	  )));


 /********************************************
* Header Color
*********************************************/ 
 

		$wp_customize->add_setting('seosblue_header_color', array(         
		'default'     => 'FFFFFF',
		 'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seosblue_header_color', array(
		'label' => __('Header Color', 'seos-blue'),        
		 'section' => 'colors',
		'settings' => 'seosblue_header_color'
		)));


 /********************************************
* Nav Hover Color
*********************************************/ 
 

		$wp_customize->add_setting('seosblue_nav_hover_color', array(         
		'default'     => '2e93db',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seosblue_nav_hover_color', array(
		'label' => __('Nav Hover Color', 'seos-blue'),        
		'section' => 'colors',
		'settings' => 'seosblue_nav_hover_color'
		)));
			
 /********************************************
* Footer Background
*********************************************/ 
	

		$wp_customize->add_setting('seosblue_footer_background_color', array(         
		'default'     => '2e93db',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seosblue_footer_background_color', array(
		'label' => __('Footer Background Color', 'seos-blue'),        
		'section' => 'colors',
		'settings' => 'seosblue_footer_background_color'
		)));
		
}
		add_action('customize_register', 'seosblue_colors');	
?><?php
		function seosblue_customize_css() {
    ?>
		<style type="text/css">
		header, header p, header h1 {color:<?php echo get_theme_mod('seosblue_header_color'); ?>;}   
		a:hover, details a:hover {color:<?php echo get_theme_mod('seosblue_hover_color'); ?>;}
		nav ul li a:hover, nav ul ul li a:hover {color:<?php echo get_theme_mod('seosblue_nav_hover_color'); ?>;}     
 		footer {background:<?php echo get_theme_mod('seosblue_footer_background_color'); ?>;}
 		.option-con {border:<?php echo get_theme_mod('seosblue_footer_background_color'); ?>;}    
		</style>
    <?php
	

	
}
		add_action('wp_head', 'seosblue_customize_css');



/*********************************************************************************************************
* Custom Background Color
**********************************************************************************************************/


		$custom_background = array(
			'default-color'          => 'FFFFFF',
			'wp-head-callback'       => '_custom_background_cb',
		);
		add_theme_support( 'custom-background', $custom_background );
		
		

/*********************************************************************************************************
* Excerpt
**********************************************************************************************************/


		function new_excerpt_more( $more ) {
			return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'seos-blue') . '</a>';
		}
			add_filter( 'excerpt_more', 'new_excerpt_more' );

		function custom_excerpt_length( $length ) {
			return 50;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


		
		
		
		
/***********************************************************************************
 * Seos Blue How To Use
***********************************************************************************/

		function seos_blue_support($wp_customize){
			class Seos_Blue_Customize extends WP_Customize_Control {
				public function render_content() { ?>
				<div class="seos-blue-info"> 
					<div class="button media-button button-primary button-large media-button-select">
						<a style="color: #fff;" href="<?php echo esc_url( 'http://seosthemes.info/seos-blue-free-wordpress-theme/' ); ?>" title="<?php esc_attr_e( 'Seos Blue Read More', 'seos-blue' ); ?>" target="_blank">
						<?php _e( 'Seos Blue how to use Premium', 'seos-blue' ); ?>
						</a>
					</div>
				</div>
				<?php
				}
			}
		}
		add_action('customize_register', 'seos_blue_support');

		function customize_styles_seos_blue_read_more( $input ) { ?>
			<style type="text/css">
				#customize-theme-controls #accordion-section-seos_blue_buy_section .accordion-section-title,
				#customize-theme-controls #accordion-section-seos_blue_buy_section > .accordion-section-title {
					background: #555555;
					color: #FFFFFF;
				}

				.seosblue-info button a {
					color: #FFFFFF;
				}	
				#customize-controls a{
									color: #FFFFFF;
				}
				
				#customize-theme-controls  #accordion-section-seos_blue_slider_section .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section1 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section2 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section3 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section4 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section5 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section6 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section7 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section8 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section9 .accordion-section-title,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section10 .accordion-section-title {
					background: #FF0000;
                    box-shadow: inset 0 0 0 #333333, inset 0 1px 84px #333333, inset 0 0 0 #333333;
					color: #FFFFFF;
					border:none;
				}
				#customize-theme-controls  #accordion-section-seos_blue_slider_section .accordion-section-title:hover, 
				#customize-theme-controls  #accordion-section-seos_blue_slider_section1 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section2 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section3 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section4 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section5 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section6 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section7 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section8 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section9 .accordion-section-title:hover,
				#customize-theme-controls  #accordion-section-seos_blue_slider_section10 .accordion-section-title:hover {
				    background: #A50000;
				}
			</style>
		<?php }
		
		add_action( 'customize_controls_print_styles', 'customize_styles_seos_blue_read_more');

		if ( ! function_exists( 'seos_magazine_buy' ) ) :
			function seos_magazine_buy( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_buy_section', array(
				'title'			=> __('Buy Premium', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 1,
			));
			$wp_customize->add_setting( 'seos_blue_buy_setting', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_buy_setting', array(
						'label'		=> __('Buy Premium', 'seos-blue'),
						'section'	=> 'seos_blue_buy_section',
						'settings'	=> 'seos_blue_buy_setting',
					)
				)
			);
		}
		endif;
				add_action('customize_register', 'seos_magazine_buy');
				
/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_slider' ) ) :
			function seos_blue_slider( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section', array(
				'title'			=> __('Seos Blue Slider', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 1,
			));
			$wp_customize->add_setting( 'seos_blue_slider_setting', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_slider_setting', array(
						'label'		=> __('Seos Blue Slider', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section',
						'settings'	=> 'seos_blue_slider_setting',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_slider');		
		
/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_1' ) ) :
			function seos_blue_1( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section1', array(
				'title'			=> __('Header Logo', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 1,
			));
			$wp_customize->add_setting( 'seos_blue_setting1', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting1', array(
						'label'		=> __('Header Logo', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section1',
						'settings'	=> 'seos_blue_setting1',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_1');			

/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_2' ) ) :
			function seos_blue_2( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section2', array(
				'title'			=> __('Home Page Boxes', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 2,
			));
			$wp_customize->add_setting( 'seos_blue_setting2', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting2', array(
						'label'		=> __('Home Page Boxes', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section2',
						'settings'	=> 'seos_blue_setting2',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_2');

/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_3' ) ) :
			function seos_blue_3( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section3', array(
				'title'			=> __('Home Page Featured', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 3,
			));
			$wp_customize->add_setting( 'seos_blue_setting3', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting3', array(
						'label'		=> __('Home Page Featured', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section3',
						'settings'	=> 'seos_blue_setting3',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_3');

/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_4' ) ) :
			function seos_blue_4( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section4', array(
				'title'			=> __('Menu Colors', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 4,
			));
			$wp_customize->add_setting( 'seos_blue_setting4', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting4', array(
						'label'		=> __('Menu Colors', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section4',
						'settings'	=> 'seos_blue_setting4',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_4');
		
/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_5' ) ) :
			function seos_blue_5( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section5', array(
				'title'			=> __('Testimonial Colors', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 5,
			));
			$wp_customize->add_setting( 'seos_blue_setting5', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting5', array(
						'label'		=> __('Testimonial Colors', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section5',
						'settings'	=> 'seos_blue_setting5',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_5');

/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_6' ) ) :
			function seos_blue_6( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section6', array(
				'title'			=> __('Sidebar Colors', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 6,
			));
			$wp_customize->add_setting( 'seos_blue_setting6', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting6', array(
						'label'		=> __('Sidebar Colors', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section6',
						'settings'	=> 'seos_blue_setting6',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_6');
		
/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_7' ) ) :
			function seos_blue_7( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section7', array(
				'title'			=> __('Header Options', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 7,
			));
			$wp_customize->add_setting( 'seos_blue_setting7', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting7', array(
						'label'		=> __('Header Options', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section7',
						'settings'	=> 'seos_blue_setting7',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_7');
		
/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_8' ) ) :
			function seos_blue_8( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section8', array(
				'title'			=> __('Back to Top', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 8,
			));
			$wp_customize->add_setting( 'seos_blue_setting8', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting8', array(
						'label'		=> __('Back to Top', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section8',
						'settings'	=> 'seos_blue_setting8',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_8');
		
/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_9' ) ) :
			function seos_blue_9( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section9', array(
				'title'			=> __('Footer Options', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 9,
			));
			$wp_customize->add_setting( 'seos_blue_setting9', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting9', array(
						'label'		=> __('Footer Options', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section9',
						'settings'	=> 'seos_blue_setting9',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_9');
		
/************************************************************************/
	 

		if ( ! function_exists( 'seos_blue_10' ) ) :
			function seos_blue_10( $wp_customize ) {
			$wp_customize->add_section( 'seos_blue_slider_section10', array(
				'title'			=> __('WooCommerce Options', 'seos-blue'),
				'description'	=> __('	Learn more about Seos Blue Premium. ','seos-blue'),
				'priority'		=> 10,
			));
			$wp_customize->add_setting( 'seos_blue_setting10', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			)); 
			$wp_customize->add_control(
				new Seos_Blue_Customize(
					$wp_customize,'seos_blue_setting10', array(
						'label'		=> __('WooCommerce Options', 'seos-blue'),
						'section'	=> 'seos_blue_slider_section10',
						'settings'	=> 'seos_blue_setting10',
					)
				)
			);
		}
		endif;
		 
		add_action('customize_register', 'seos_blue_10');

if (!current_user_can('manage_options')) {
	
    remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 );
    remove_action('wp_footer', 'wp_admin_bar_render', 1000);

    function remove_admin_bar_style() {  
  	echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';	
    }
    add_filter('admin_head','remove_admin_bar_style');

    function remove_admin_bar_style_frontend() {
        echo '<style>html{ padding-top: 0px !important; }</style>';
    }
    add_filter('wp_head','remove_admin_bar_style_frontend');
}			