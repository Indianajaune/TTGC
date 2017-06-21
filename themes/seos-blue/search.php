<?php get_header(); ?>

<main id="main" role="main">

	<section>
	
		<?php if (have_posts()) : ?><!-- <span>Search Results</span> -->
		
		<?php while (have_posts()) : the_post(); ?>

		<!-- Start dynamic -->

		<article class="search-article">
			
			<h1><a  id="post-<?php the_ID(); ?>" href="<?php the_permalink();?>"> <?php the_title(); ?></a></h1>
				
			<div class="img-search">
				
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'custom-size' ); } ?>
				
			</div>
				
			<?php the_excerpt(); ?>
			
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
					   
		<?php endwhile; ?>
			   
		<div class="nextpage"> <?php mb_pagination(); ?></div>
			
		<?php else : ?>
			
		<h1 class="result"><?php _e("No results found. Try again. ", 'seos-blue'); ?></h1>
			 
		<?php endif; ?>

		<!-- End dynamic -->

	</section>
	
	<?php get_sidebar(); ?>
	
</main>

<?php get_footer(); ?>