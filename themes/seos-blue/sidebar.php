<?php
		if ( ! is_active_sidebar( 'sidebar' ) ) {
		return;
	}
?>
	<aside>
		<ul>
			<?php if ( ! dynamic_sidebar('sidebar') ) : ?><?php endif; ?>
		</ul>
	</aside>