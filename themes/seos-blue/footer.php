<?php
/**
 * The template for displaying the footer
 */
?>
<footer>

	<details class="deklaracia">
	
		<summary>All rights reserved  &copy; <?php bloginfo('name'); ?></summary>
		
		<p><a href="http://wordpress.org/" title="<?php esc_attr_e( ' ', 'seos-blue' ); ?>"><?php printf( __( 'Powered by %s', 'seos-blue' ), 'WordPress' ); ?></a></p>
		
		<p><a title="Seos free wordpress themes" href="<?php echo esc_url(__('https://github.com/nargaprime', 'seos-blue')); ?>" target="_blank">Theme by Nargaprime</a></p>	
	
	</details>
	   
	</div>
	
</footer>



<?php wp_footer();?>

</body>

</html>
