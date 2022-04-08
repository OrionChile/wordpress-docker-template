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
<?php if (!post_password_required()) { ?>

	<body>
		<style>
			p {
				margin: 2rem 0rem;
			}
		</style>
		<?php get_header(); ?>

		<div class="contacto">
			<div class="header_page relative">
				<img class="w-full absolute  h-full 2xl:h-screen " src="<?php echo get_template_directory_uri() . '/images/contacto_bg.jpg' ?>" alt="" style="z-index: -1">
				<div class="overlay relative w-full flex items-center h-full top-0 ">
					<div class="md:container w-full m-auto flex flex-col md:flex-row items-center justify-between">
						<div class="md:w-1/2">
							<div class="mt-24 md:mt-0 text-lg md:text-4xl font-altobold text-center text-white"><?php echo get_field(Lang::langField('pregunta'), $id) ?></div>
							<div class="text-sm md:text-base mb-16 md:mb-0 text-center text-white"><?php echo get_field(Lang::langField('mensaje'), $id) ?></div>
						</div>
						<div class="md:w-1/2 w-full">
							<div class="relative flex items-center justify-center w-full mb-24  md:mt-24">
								<div class="absolute bg-white w-full h-full opacity-80 mt-16 md:mt-0 md:rounded-3xl box-content py-16  px-2 md:py-4"></div>
								<div class="flex flex-col items-center">
									<div class="pipedriveWebForms w-full px-2" data-pd-webforms="https://webforms.pipedrive.com/f/1CanhWPVUWKxVuHif23OLozKChmEzkZ0ggzEgUc3ES0JXzUWhzXgTeIrAJ58TJRbJ">

										<script src="https://webforms.pipedrive.com/f/loader"></script>
									</div>
									<div class="text-black text-center py-2 text-sm z-20">Al presionar enviar acepto las <a class='text-primary ' href="<?php echo get_permalink(get_page_by_path('politica-de-privacidad')); ?>">Políticas de privacidad</a> de ALTO</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
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