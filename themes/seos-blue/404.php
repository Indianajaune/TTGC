<?php
/**
 * The template for displaying 404 pages (not found)
 */
?>
<?php get_header(); ?>

	<main id="main" role="main">

		<section>

			<article>

				<h1 id="post-title"><?php _e('404 - Page not found', 'seos-blue'); ?></h1>
				
				<p><?php _e('It seems we can’t find what you’re looking for. Perhaps searching will help', 'seos-blue'); ?></p>
				<?php get_search_form(); ?>

			</article>

		</section>

		<?php get_sidebar(); ?>

	</main>

<?php get_footer(); ?>