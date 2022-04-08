<?php
$id = pll_get_post(get_the_ID(), pll_default_language());

use Inc\Lang\Lang;
?>
<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?> <?php bloginfo('description'); ?> </title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/images/favicon.png' ?>" />
</head>
<?php wp_head(); ?>

<body>
	<style>
		p {
			margin: 2rem 0rem !important;
		}

		h2 {
			margin: 1rem 0rem !important;
			font-size: 1.6rem !important;
			font-weight: bold !important;
		}

		h3 {
			margin: 0.5rem 0rem !important;
			font-size: 1.1rem !important;
			font-weight: bold !important;
		}
	</style>
	<?php get_header(); ?>
	<div class="politicas mx-2 md:mx-0">
		<div class="header_page relative h-40 overflow-hidden">
			<img class="w-full  top-0 absolute h-screen" src="<?php echo get_template_directory_uri() . '/images/contacto_bg.jpg' ?>" alt="" style="z-index: -1">
			<div class="overlay relative w-full flex items-center h-full top-0 ">
				<div class="md:container w-full m-auto flex flex-col md:flex-row items-center justify-between">
					<div class="md:w-1/2">
						<div class="mt-24 md:mt-0 text-lg md:text-4xl font-altobold text-center text-white"><?php echo get_field(Lang::langField('pregunta'), $id) ?></div>
						<div class="text-sm md:text-base mb-16 md:mb-0 text-center text-white"><?php echo get_field(Lang::langField('mensaje'), $id) ?></div>
					</div>

				</div>
			</div>
		</div>
		<div class="container m-auto">
			<div class="text-primary mt-16 text-2xl font-altobold mb-8"><?php echo get_the_title(); ?></div>
			<?php require('partials/the_content.php'); ?>
		</div>
	</div>
	</div>
	<?php get_footer(); ?>
	<?php wp_footer() ?>
</body>

</html>