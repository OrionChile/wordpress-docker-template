<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>">
	<title><?php echo get_bloginfo('name'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/images/favicon.png' ?>" />
	<?php wp_head(); ?>
</head>

<body>
	<?php get_header(); ?>
	<?php require('partials/_pruebalo_fixed.php'); ?>
	<div class="condiciones mx-2 md:mx-0 py-16">
		<div class="container m-auto">
			<div class="text-secondary text-2xl font-altobold mb-8"><?php echo get_the_title(); ?></div>
			<?php require('partials/the_content.php'); ?>
		</div>
	</div>
	</div>
	<?php get_footer(); ?>
	<?php wp_footer() ?>
</body>

</html>