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

		<div class="quienes-somos">
			<div class="header_page relative">
				<img class="h-1/4 md:w-full" src="<?php echo get_field('inicial_imagen', $id)['url'] ?>" alt="">
				<div class="overlay absolute w-full flex flex-col-reverse md:flex-row items-center top-0 md:top-auto bottom-0 h-3/4">
					<div class="w-1/4 md:w-1/2 align-bottom">
						<img class="mt-12 md:-mb-12 2xl:-mb-36" src="<?php echo get_field('icono_up', $id)['url'] ?>" alt="">
					</div>
					<div class="w-full md:w-3/4 ">
						<div class="text-white pl-4 md:pl-16 font-altobold text-lg md:text-2xl"><?php echo get_field(Lang::langField('texto_inicial'), $id) ?></div>
					</div>
				</div>
			</div>
			<div class="mapa mt-5 md:mt-0 mb-16">
				<div class="container m-auto flex flex-col-reverse md:flex-row items-center justify-center">
					<div class="md:w-1/2 flex flex-col mt-8 md:mt-16">
						<div class="text-2xl text-center"><?php echo get_field(Lang::langField('titulo_historia'), $id) ?></div>
						<div class="text base  2xl:w-3/4 m-auto"><?php echo get_field(Lang::langField('texto_historia'), $id) ?></div>
					</div>
					<div class="md:w-1/2 -mt-6 flex relative">
						<div class="flag-popup absolute flex items-center" style="top: 18%;left: 25%;z-index: 5;">
							<img class="bottom-0 right-0 h-12" src="<?php echo get_template_directory_uri() . '/images/bandera.svg' ?>" alt="">
							<div class="result hidden flex-col items-start justify-start bg-white shadow-lg ml-4 px-4 py-1 rounded">
								<div class="text-gray-700 text-xs">Mexico</div>
								<div class="text-gray-800 text-xs"><?php echo get_field('telefono_mexico', 'option') ?></div>
							</div>
						</div>
						<div class="flag-popup absolute flex items-center" style="top: 62%;left: 53%;z-index: 5;">
							<img class="bottom-0 right-0 h-12" src="<?php echo get_template_directory_uri() . '/images/bandera.svg' ?>" alt="">
							<div class="result hidden flex-col items-start justify-start bg-white shadow-lg ml-4 px-4 py-1 rounded">
								<div class="text-gray-700 text-xs">Chile</div>
								<div class="text-gray-800 text-xs"><?php echo get_field('telefono_chile_peru', 'option') ?></div>
							</div>
						</div>
						<img class="w-full relative" src="<?php echo get_field('titulo_imagen', $id)['url'] ?>" alt="">
					</div>
				</div>
			</div>
			<div class="ceo bg-secondary">
				<div class="container m-auto flex flex-col md:flex-row py-16">
					<div class="md:w-3/4 flex">
						<img class="h-12" src="<?php echo get_template_directory_uri() . '/images/comillas.png' ?>" alt="">
						<div class="cita w-3/4"><?php echo get_field(Lang::langField('ceo_cita'), $id) ?></div>
					</div>
					<div class="md:w-1/4 flex flex-col items-center justify-center">
						<img class="w-36" src="<?php echo get_field('ceo_imagen', $id)['url'] ?>" alt="">
						<div class="text-base mt-2"><?php echo get_field('nombre', $id) ?></div>
						<div class="text-xs"><?php echo get_field(Lang::langField('cargo'), $id) ?></div>
					</div>
				</div>
			</div>
			<?php
			$citas['title'] = 'Lo que dicen nuestros clientes';
			$citas['bg'] = 'bg-white';
			$citas['id'] = 7;
			include get_stylesheet_directory() . '/partials/_citas.php';
			?>
			<div class="solicita_demo bg-secondary py-16">
				<div class="container m-auto flex flex-col md:flex-row">
					<div class="md:w-1/2 flex flex-col items-center justify-center">
						<div class="text-2xl text-center">
							<?php echo get_field(Lang::langField('titulo_solicita_demo'), $id) ?>
							<img class="" src="<?php echo get_field('solicita_demo_imagen')['url'] ?>" alt="">
						</div>
					</div>
					<div class="md:w-1/2 form">
						<div class="pipedriveWebForms" data-pd-webforms="https://webforms.pipedrive.com/f/1CanhWPVUWKxVuHif23OLozKChmEzkZ0ggzEgUc3ES0JXzUWhzXgTeIrAJ58TJRbJ">
							<script src="https://webforms.pipedrive.com/f/loader"></script>
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