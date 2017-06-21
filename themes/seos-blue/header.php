<?php
/*
* Header Template
* 
*/
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet" type="text/css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 
	<header id="header-home">
       
		<div id="header-img" style="background-image: url('<?php header_image(); ?>'); min-height:<?php echo get_custom_header()->height; ?>px; width: 100%; background-repeat: no-repeat; background-size: cover; background-position: center;" >
			
			<div id="header" >
			
				<?php if(is_home() || is_front_page() ) : ?>
				
					<a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-name"><?php bloginfo('name'); ?></h1></a>
					
					<?php else : ?>
					
					<a class="site-name" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
				
				<?php endif; ?>
				
				<p class="description"><?php bloginfo('description'); ?></p>
				
			</div>
			
		</div>
		
    </header>

	<nav>
	
		<div class="nav-ico">
		
			<a href="#" id="menu-icon">	
			
				<span class="menu-button"> </span>
				
				<span class="menu-button"> </span>
				
				<span class="menu-button"> </span>
				
			</a>
			
			<?php wp_nav_menu ( array('theme_location' => 'menu-top','container' => '')); ?>
			
		</div>
		
	</nav>	
	<div class="sb-clear"></div>
	<?php  if ( is_front_page() or is_home() ) : ?>
	<?php if (!get_theme_mod( 'seos_blue_slider_activate' )) : ?>	
	<div class="sb-home-img">

		<img alt="home-img" src="<?php if (get_theme_mod( 'slider_img' )) : echo get_theme_mod( 'slider_img' );  else :  echo get_template_directory_uri() . '/img/home-img1.jpg'; endif; ?>"/>
		
		<?php if (get_theme_mod( 'seos_blue_img_slider_text' ) and !get_theme_mod( 'seos_blue_slider_activate' )) : ?>
		<p class="sb-read-more fadeInLeft">
		<a href="<?php echo get_theme_mod( 'slide_url' ); ?>"><?php echo get_theme_mod( 'seos_blue_img_slider_text' ); ?></a>
		</p>
		<?php elseif (!get_theme_mod( 'seos_blue_slider_activate' )): ?>
		<p class="sb-read-more fadeInLeft">
			<a href="<?php echo get_theme_mod( 'slide_url' ); ?>">Read More</a>
		</p>
		<?php endif; ?>

	</div>
	<?php endif; ?>
	<?php endif; ?>

	