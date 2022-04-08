<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<title><?php echo get_bloginfo('name'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/images/favicon.png' ?>" />
</head>
<?php wp_head(); ?>
<?php if (!post_password_required()) { ?>

	<body>
		<?php get_header(); ?>

		<div class="contanier m-auto flex flex-col justify-center items-center" style="padding: 16rem 0">
			<div class="flex justify-center items-center">

				<div class="text-lg">Página no encontrada | </div>
				<div class="text-base font-bold ml-2">Error 404</div>
			</div>
			<a href="<?php echo home_url() ?>">
				<button class="bg-primary text-white py-1 mt-2 px-4 rounded ">Volver al inicio</button>
			</a>

		</div>

		<?php get_footer(); ?>
	<?php
} else {
	echo '<div class="clave" id="wp">';
	echo get_the_password_form($post->ID);
	echo '</div>';
}
	?>
	<?php wp_footer() ?>
	</body>

</html>