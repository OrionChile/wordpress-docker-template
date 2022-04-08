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
	<div class="alto-checks">
		<?php require('partials/_video.php'); ?>
		<div class="plataforma_checks bg-bgBlueDark py-24 px-4 md:px-0" id="caracteristicas">
			<div class="container m-auto flex flex-col items-center">
				<div class="text-primary font-altobold text-center text-xl mb-2"><?php echo get_field('titulo_plataforma') ?></div>
				<div class="text-white text-center italic"><?php echo get_field('subtitulo_plataforma') ?></div>
				<div class="flex-col md:flex-row flex-wrap flex justify-center my-10 md:w-3/4">
					<?php
					while (have_rows('plataforma_checks')) : the_row();
						$text = get_sub_field('texto');
					?>
						<div class=" flex md:w-1/2 my-2 items-center">
							<img class="w-6 mr-2" src="<?php echo get_template_directory_uri() . '/images/check_isotipo.svg' ?>" alt="">
							<div class="text md:w-3/4 text-white text-left mt-2 font-bold"><?php echo $text; ?></div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>

		</div>
		<div class="caracteristicas relative bg-white py-12 md:py-32 px-2 flex flex-col items-center" id="integra">
			<img class="right absolute right-0 -top-32 w-32 md:w-96" src="<?php echo get_template_directory_uri() . '/images/icon_bg_right.svg' ?>" alt="">
			<img class="left absolute left-0 -bottom-24 md:-bottom-52 w-24 md:w-72" src="<?php echo get_template_directory_uri() . '/images/icon_bg_left.svg' ?>" alt="">
			<div class="bg-gradient-to-r from-secondary to-primary mt-10 flex justify-center items-center py-1 px-1 animate-pulse rounded-full">
				<a href="<?php echo get_field('link_principal') ?>" class="rounded-full bg-white px-8 py-1 md:text-xl  text-bgBlueDark transition-all font-altobold   hover:text-white hover:bg-bgBlueDark"><?php echo get_field('titulo_principal') ?></a>
			</div>
			<div class="caracteristica_principal md:w-1/3 flex flex-col items-center justify-center mx-auto py-16">

				<div class="flex">
					<img class="h-20 mr-4 md:mr-16" src="<?php echo get_field('principal_imagen')['url'] ?>" alt="">
					<div class="text-bgBlueDark"><?php echo get_field('principal_bajada') ?></div>
				</div>
			</div>
			<div class="line border-t-2 border-gray-200 md:w-1/3 m-auto"></div>
			<div class="m-auto flex-row flex-wrap flex w-full justify-center my-10">
				<?php
				while (have_rows('caracteristicas')) : the_row();
					$image = get_sub_field('imagen');
					$text = get_sub_field('texto');
				?>
					<div class="flex flex-col items-center my-6 md:my-0 md:mx-8 w-1/2 md:w-auto">
						<img class="icon h-16" src="<?php echo $image['url'] ?>" alt="icon">
						<div class="text-xs uppercase text-center mt-4 text-bgBlueDark font-bold"><?php echo $text; ?></div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<div class="respaldo_alto bg-bgBlueLight flex flex-col-reverse md:flex-row" id="respaldo">
			<div class="md:w-1/2">
				<img class="w-full" src="<?php echo get_field('respaldo_imagen')['url']; ?>" alt="respaldo imagen">
			</div>
			<div class="flex flex-col items-center md:items-start justify-center md:w-1/2 py-9">
				<div class="w-3/4 m-auto flex flex-col items-start">
					<div class="text-white font-altobold mt-10 md:mt-0 text-left md:w-3/4 text-3xl  mb-8"><?php echo get_field('titulo_respaldo') ?></div>
					<div class="m-auto flex-col flex w-full justify-center my-10 text-white md:text-xl tracking-wide leading-6 md:leading-10">
						<?php
						echo get_field('respaldo_checks');
						?>

					</div>

				</div>

			</div>
		</div>

		<div class="conoce_mas flex flex-col md:flex-row">
			<div class="text md:w-1/2">
				<div class="cifras bg-bgBlueLight py-8  md:h-full">
					<div class="container m-auto flex flex-col items-center" data-aos="fade-right">
						<div class="titulo text-white font-altobold text-xl uppercase my-2 "><?php echo get_field('titulo_conoce_mas') ?></div>
						<div class="m-auto flex flex-wrap justify-center my-10 w-3/4">
							<?php
							while (have_rows('cifras_conoce_mas')) : the_row();
								$image = get_sub_field('imagen');
								$text = get_sub_field('texto');
							?>
								<div class="flex items flex-col items-center justify-center w-full md:w-1/2 py-8  md:h-60">
									<img class="icon h-20" src="<?php echo $image['url'] ?>" alt="icon">
									<div class="text-center mt-2 text-white"><?php echo $text; ?></div>
								</div>
							<?php endwhile; ?>
						</div>
						<div class="bg-gradient-to-r from-secondary to-primary mt-6 flex justify-center items-center py-1 px-1 animate-pulse rounded-full mx-auto">
							<a href="https://www.alto-company.com" target="_blank" class="border-gray-400 uppercase bg-bgBlueDark rounded-full md:text-xl py-2 px-8 font-altobold text-white hover:bg-white hover:text-bgBlueDark text-center "><?php echo get_field('conoce_mas_boton') ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="image md:w-1/2">
				<img class="image h-full" src="<?php echo get_field('conoce_mas_imagen')['url'] ?>" alt="conoce mas">
			</div>
		</div>
		<div class="check_pais bg-bgBlueDark py-8 md:py-32 flex flex-col" >
			<div class="container m-auto">
				<div class="text-primary font-altobold text-center text-xl mb-8 md:mb-32"><?php echo get_field('titulo_pais') ?></div>
				<img class="mapa w-3/4 m-auto" data-aos="fade-up" src="<?php echo get_field('mapa')['url'] ?>" alt="">
				<img class="tabla w-3/4 m-auto mt-24" src="<?php echo get_field('tabla')['url'] ?>" alt="" id="check-pais">
			</div>

		</div>
	</div>

	<?php get_footer(); ?>
	<?php wp_footer() ?>
</body>

</html>