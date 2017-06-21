<?php
/*
Template Name: Full Width
*/
 get_header(); ?>
	
<main id="main" role="main">

	<!-- Start dynamic -->

	<?php if(have_posts()): while (have_posts()): the_post(); ?>
		
	<article class="full-width"><?php edit_post_link('Edit', '', ''); ?>
		   
		<h1><?php the_title(); ?></h1>
			
		<p class="img"><?php the_post_thumbnail(); ?> </p>
				 
		<div class="content"><?php the_content();?></div>
					
	</article>
		   
	<?php endwhile; endif; ?>

	<!-- End dynamic -->

</main>

<?php get_footer(); ?>