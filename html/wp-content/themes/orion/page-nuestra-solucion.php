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
	<div class="soluciones">
		<div class="gif py-16 md:py-36">
			<div class="container m-auto flex flex-col md:flex-row items-center">
				<div class="md:text-2xl font-altobold md:w-1/2">
					<div class="md:w-3/4">
						<?php echo get_field('texto_gif') ?>

					</div>
				</div>
				<div class="md:w-1/2 flex justify-center mt-8 md:mt-0">
					<img src="<?php echo get_field('gif')['url'] ?>" alt="">
				</div>
			</div>
		</div>
		<div class="caracteristicas bg-bgBlueDark flex flex-col">
			<div class="container m-auto flex flex-col w-full items-center justify-center py-8 md:py-16 px-4 md:px-0">
				<div class="text-primary font-altobold text-center text-xl  mb-4 md:mb-16 uppercase">Áreas de acción</div>

				<?php
				while (have_rows('caracteristicas')) : the_row();
					$image = get_sub_field('imagen');
					$titulo = get_sub_field('titulo');
					$bajada = get_sub_field('bajada');
					$checks = get_sub_field('checks');
					$scroll = get_sub_field('scroll');
					$scrollmovil = get_sub_field('scrollmovil');
				?>

					<div scroll="<?php echo $scroll ?>" scrollmovil="<?php echo $scrollmovil ?>" class="caracteristicas_checks flex flex-col md:flex-row items-center md:items-start justify-center mx-8 my-4 md:my-16 w-full" id="<?php echo sanitize_title($titulo) ?>">
						<div class="icon_container md:w-1/2 py-8 md:py-0">
							<img class="icon w-16 md:w-80" src="<?php echo $image['url'] ?>" alt="icon">
						</div>

						<div class="flex flex-col items-start md:w-1/3" data-aos="fade-left">
							<div class="text uppercase text-left mt-2 text-3xl  font-altobold  font-bold text-white"><?php echo $titulo; ?></div>
							<div class="text  text-left text-sm mt-2 mb-16  text-white"><?php echo $bajada; ?></div>
							<div class="checks text-white"><?php echo $checks; ?></div>
						</div>

					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<div class="informacion_confiable bg-bgBlueDark pt-16 pb-32 px-2">
			<div class="container m-auto flex flex-col items-center justify-center">
				<div class="text-primary font-altobold text-center text-2xl mb-2"><?php echo get_field('titulo_informacion') ?></div>
				<div class="text-white text-center text-lg md:w-4/6 my-16 mx-auto"><?php echo get_field('bajada_informacion') ?></div>
				<img class="mx-auto my-16" data-aos="fade-up" src="<?php echo get_field('imagen_informacion')['url'] ?>" alt="">
				<div class="mx-auto text-white text-center">
					<?php echo get_field('tag_informacion') ?>
				</div>
				<div class="bg-gradient-to-r from-secondary to-primary mt-10 flex justify-center items-center py-1 px-1 animate-pulse rounded-full">
					<a href="<?php echo get_permalink(get_page_by_path('como-funciona')) . '?li=check-pais'; ?>" class="border-gray-400 bg-bgBlueDark rounded-full text-lg md:text-xl py-1 px-6 md:px-10 font-altomedium tracking-widest text-white hover:bg-white hover:text-bgBlueDark text-center ">DÓNDE OPERAMOS</a>
				</div>
			</div>
		</div>
		<div class="cifras_convincentes bg-bgBlueLight py-8 md:py-40">
			<div class="container m-auto flex flex-col items-center">
				<div class="titulo text-white font-altobold text-xl uppercase my-16"><?php echo get_field('titulo_cifras') ?></div>
				<div class="m-auto flex flex-wrap justify-center my-10 w-3/4">
					<?php
					while (have_rows('cifras')) : the_row();
						$image = get_sub_field('imagen');
						$text = get_sub_field('texto');
					?>
						<div class="flex items flex-col items-center justify-center md:w-1/2 py-8  md:h-80">
							<img class="icon w-36" src="<?php echo $image['url'] ?>" alt="icon">
							<div class="text-center mt-2 text-white"><?php echo $text; ?></div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php require('partials/_citas.php'); ?>
		<div class="botones_accion bg-bgBlueDark flex flex-col pt-20 pb-40">
			<div class="container m-auto flex flex-col md:flex-row justify-around items-center">
				<div class="bg-gradient-to-r from-secondary to-primary mt-10 flex justify-center items-center py-1 px-1 animate-pulse rounded-full">
					<a href="<?php echo get_permalink(get_page_by_path('pruebalo')) . '?li=forms'; ?>" class="border-gray-400 bg-bgBlueDark rounded-full text-xl md:text-xl py-2 px-12 font-altomedium tracking-widest  text-white hover:bg-white hover:text-bgBlueDark text-center ">PIDE TU DEMO</a>
				</div>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
	<?php wp_footer() ?>
</body>

</html>