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
	<div class="pruebalo">

		<div class="formularios relative bg-white flex py-32" id="forms">
			<img class="right absolute right-0 -top-6 md:-top-12 w-28 md:w-44" src="<?php echo get_template_directory_uri() . '/images/icon_bg_right.svg' ?>" alt="">
			<img class="left absolute left-0 -bottom-24 md:-bottom-52 w-24 md:w-64" src="<?php echo get_template_directory_uri() . '/images/icon_bg_left.svg' ?>" alt="">
			<div class="container flex flex-col md:flex-row m-auto">
				<div class="md:w-1/2 flex flex-col">
					<div class="text-secondary text-xl md:text-2xl font-altobold md:w-3/4">¿QUIERES PROBAR NUESTRA PLATAFORMA O SOLICITAR MÁS INFORMACIÓN?</div>
					<p class="text-base mt-4">Déjanos tus datos y te contactaremos</p>
				</div>
				<div class="md:w-1/2">
					<div class="pipedriveWebForms" data-pd-webforms="https://webforms.pipedrive.com/f/2TW9AZTsKesD1pjmVekTExj9kl7Nd3XpgDQCbaaA1m0U2igWpSE3BX8lJ2KaNs1VN">
						<script src="https://webforms.pipedrive.com/f/loader"></script>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php get_footer(); ?>
	<?php wp_footer() ?>
</body>

</html>