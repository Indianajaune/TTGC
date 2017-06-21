<?php get_header(); ?>

<!-- Start dynamic -->

<main id="main" role="main">

	<section>

		<!-- Start dynamic -->

		<?php if(have_posts()): while (have_posts()): the_post(); ?> 
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		 
			<?php edit_post_link('Edit', '', ''); ?>
					
			<h1><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
					
			<div class="content"><?php the_content();?></div>
							
			<?php if (comments_open() || get_comments_number()) { comments_template(); } ?> 
							
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
		
			<?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> previous - ', 'seos-blue')); ?>
		  
			<?php next_post_link('%link', __('next <span class="meta-nav">&rarr;</span>', 'seos-blue')); ?>
		 
		</article>
				   
		<?php endwhile; endif; ?>

		<!-- End dynamic -->

	</section>
	
	<?php get_sidebar(); ?>

</main>

<!-- End dynamic -->

<?php get_footer(); ?>