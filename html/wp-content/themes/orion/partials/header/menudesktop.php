<header class="homepage">
	<div class="text-white">
		<div class="container m-auto flex justify-between  relative py-8 w-full">
			<div class="btn_menumovil z-15 md:hidden">
				<img src="<?php echo get_template_directory_uri() . '/images/menumovil.svg' ?>" alt="">
			</div>
			<a class="logo" href="<?php echo home_url(); ?>">
				<img class="-mt-3 md:mt-0 h-8" src="<?php echo get_template_directory_uri() . '/images/logoblanco.svg' ?>" alt="">
			</a>
			<?php
			$args = array(
				'theme_location' => 'header-menu',
				'container' => 'nav',
				'container_class' => 'mainmenu hidden md:flex justify-end  items-center w-full',
				'menu_class'  => 'flex justify-between items-center md:w-3/4 2xl:w-1/2',
				'menu_id'  => 'menu',
				'link_before' => '<span class="sr-text">',
				'link_after' => '</span>'
			);
			wp_nav_menu($args);
			?>
			<div class="rrss flex justify-center ">
				<a href="<?php echo get_field('linkedin', 'option') ?>" target="_blank">
					<img class="h-6 mx-2 transition-all transform scale-100 hover:scale-110" src="<?php echo get_template_directory_uri() . '/images/icon_linkedin.svg' ?>" alt="">
				</a>
				<a href="<?php echo get_field('instagram', 'option') ?>" target="_blank">
					<img class="h-6 mx-2 transition-all transform scale-100 hover:scale-110" src="<?php echo get_template_directory_uri() . '/images/icon_instagram.svg' ?>" alt="">
				</a>
			</div>
		</div>
	</div>

</header>

<input type="hidden" name="home" id="home" value="<?php echo home_url(); ?>">