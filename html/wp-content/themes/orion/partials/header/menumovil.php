<aside class="menumovil z-40 fixed h-screen w-full top-0 bg-primary text-white py-4 px-8 transform -translate-x-full transition-all">
	<img class="cerrar absolute top-8 right-5" src="<?php echo get_template_directory_uri() . '/images/icon_close.svg' ?>" alt="">
	<div class="menu_movil top-20">
		<a class="logo" href="<?php echo home_url(); ?>">
			<img class="h-8 mt-3 mb-5" src="<?php echo get_template_directory_uri() . '/images/logoblanco.svg'  ?>" alt="logo">
		</a>
		<?php
		$args = array(
			'theme_location' => 'header-menu',
			'container' => 'nav',
			'container_class' => 'mt-8',
			'link_before' => '<span class="sr-text">',
			'link_after' => '</span><div class="linea"></div>'
		);
		wp_nav_menu($args);
		?>
	</div> <!-- menu_movil -->
</aside> <!-- menumovil -->