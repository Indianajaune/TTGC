<?php
/*
Template Name: Sidebar Left
*/
?>
<?php get_header(); ?>
	
	<main id="main" role="main">
	
		<section class="section-right">

			<!-- Start dynamic -->

			<?php if(have_posts()): while (have_posts()): the_post(); ?>
			
			<article>
			   
				<?php edit_post_link('Edit', '', ''); ?>
				
				<h1><?php the_title(); ?></h1>
				
				<p class="img"><?php the_post_thumbnail(); ?> </p>
					
				<div class="content"><?php the_content();?></div>
					
			</article>
			   
			<?php endwhile; endif; ?>

			<!-- End dynamic -->

		</section>
		
		<aside class="sidebar-left">
		
			<ul>
			
				<?php if ( ! dynamic_sidebar('left') ) : ?><?php endif; ?>
				
			</ul>
			
		</aside>
		
	</main>
	
<?php get_footer(); ?>