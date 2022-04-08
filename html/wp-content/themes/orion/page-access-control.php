<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?> <?php bloginfo('description'); ?> </title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/images/favicon.png' ?>" />
</head>
<?php wp_head(); ?>
<?php if (!post_password_required()) { ?>

	<body>
		<?php get_header(); ?>
		<?php
		include('partials/traduccion.php');
		include(get_template_directory() . '/partials/pages/products/base.php');
		?>
		<?php
		include get_stylesheet_directory() . '/partials/shared/btn_contacto.php';
		get_footer(); ?>
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