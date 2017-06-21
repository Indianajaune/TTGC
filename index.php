<?php get_header(); ?>

	<main id="main" role="main">
	
		<section>

			<!-- Start dynamic -->

			<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
			
			<article>

                <?php edit_post_link('Edit', '', ''); ?>
				
				<h1><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h1>
				
				<p class="img-search"><?php the_post_thumbnail(); ?> </p>
				
				<div class="content"><?php the_content();?></div>
				
				<div class="entry-meta">
							
					<i class="fa fa-calendar"></i>  <?php echo get_the_date(); ?>

					/ <i class="fa fa-user"></i> <?php _e('Author: ', 'seos-blue'); ?> <?php the_author(); ?> 
							
					<?php if (get_the_category_list( esc_html__( ', ', 'seos-blue' ) )):?> / <i class="fa fa-folder-open"></i> <span class="cat-links"> <?php echo esc_html__( ' Posted in: ' , 'seos-blue' ); ?> </span> <?php echo get_the_category_list( esc_html__( ', ', 'seos-blue' ) );?><?php endif; ?> 
							
					<?php if (get_the_tags() != null): ?>
							
					<p class="seos-tags"><i class="fa fa-tags"></i>
								
						<?php _e('Tags: ', 'seos-blue'); ?><?php the_tags("<span>", " ", "</span>"); ?>
								
					</p>
							
					<?php endif; ?>
							
				</div><!-- .entry-meta -->
				
			</article>
		   
			<?php endwhile; endif; ?>

			<!-- End dynamic -->

		</section>
		
<?php get_sidebar(); ?>

	</main>
	
<?php get_footer(); ?>