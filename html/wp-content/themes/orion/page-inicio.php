<?php
$id = pll_get_post(get_the_ID(), pll_default_language());

use Inc\Lang\Lang;
?>
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
	<?php get_header();  ?>
	<?php
	include get_stylesheet_directory() . '/partials/solicitademo.php';
	?>
	<div class="page-inicio w-full">
		<div class="main_slider w-full">
			<div direction="horizontal" slideperview="1" class="slider-swiper">
				<div class="swiper-container">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<!-- Slides -->
						<?php
						$slides = 0;
						while (have_rows('slider', $id)) : the_row();
							$image = get_sub_field('image');
							$imagemobile = get_sub_field('image_movil');
							$text = get_sub_field(Lang::langField('texto'));
							$btntexto = get_sub_field(Lang::langField('btn_texto'));
							$pidedemo = get_sub_field('pide_demo');
							$link = get_sub_field('link');
							$slides++;
						?>

							<div class="swiper-slide">
								<?php if ($slides > 1) { ?>
									<div class="absolute z-10 bg-black opacity-30 w-full h-full"></div>
								<?php } ?>
								<img class="hidden md:block md:w-full h-96 md:h-screen bg" src="<?php echo $image['url'] ?>" alt="">
								<img class="md:hidden w-full bg" src="<?php echo $imagemobile['url'] ?>" alt="">
								<div class="absolute top-44 xxl:top-64 m-auto right-0 left-0 z-20 ">
									<div class="container text-xl text-center md:text-left px-10 md:pl-16 2xl:pl-20 md:pt-4 2xl:pt-24 md:text-3xl 2xl:text-5xl m-auto flex flex-col items-center md:items-start">
										<div class="text-white mb-4 md:mb-0 md:w-1/2 md:mr-24 font-alto" data-aos="fade-left">
											<?php echo $text; ?>
										</div>
										<?php if (!$pidedemo) { ?>
											<a href="<?php echo $link ?>">

												<button class="bg-white text-base text-primary py-1 px-10 mt-1 md:mt-16 font-altobold rounded-full"><?php echo $btntexto ?></button>
											</a>
										<?php } else { ?>
											<button data-popup="solicitademo" class="call_popup bg-white text-base text-primary py-1 px-10 mt-1 md:mt-16 font-altobold rounded-full"><?php echo $btntexto ?></button>
										<?php } ?>
									</div>
								</div>

							</div>
						<?php
						endwhile;
						?>
					</div>
					<!-- If we need pagination -->
					<div class="absolute bottom-0 left-0 w-full h-20 md:h-40 m-auto">
						<div class="container m-auto">
							<div class="swiper-pagination vertical"></div>
						</div>
					</div>
					<!-- If we need navigation buttons -->
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
			</div>
		</div>
		<div class="bajada -mt-2 md:-mt-16 h-64">
			<div class="container m-auto flex justify-center relative z-10">
				<div class="bg-white py-8 mx-2 md:mx-0 px-2 md:px-16 shadow-lg flex justify-center text-center md:w-3/4 2xl:w-1/2 m-auto rounded-2xl absolute top-0 md:leading-10"><?php echo get_field('bajada') ?></div>
			</div>
		</div>
		<div class="acciones">
			<div class="container m-auto flex flex-col justify-center items-center mt-4 mb-16">
				<div class="my-4 text-center text-xl md:text-2xl">
					<?php echo get_field('titulo_acciones') ?>
				</div>
				<div class="flex justify-around mt-16 w-3/4">
					<?php
					while (have_rows('acciones')) : the_row();
						$image = get_sub_field('image');
						$text = get_sub_field('texto');
					?>
						<div class="flex flex-col items-center mx-8 w-full">
							<img class="icon h-12 md:h-16" src="<?php echo $image['url'] ?>" alt="icon">
							<div class="text  text-center mt-4 text-sm"><?php echo $text; ?></div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<div class="resultados bg-primary text-white">
			<div class="container m-auto flex flex-col justify-center items-center">
				<div class="my-4 text-2xl pt-12">
					<?php echo get_field('titulo_resultados') ?>
				</div>
				<div class="flex flex-col md:flex-row justify-between 2xl:justify-around mt-8 mb-16 2xl:w-3/4">
					<?php
					while (have_rows('resultados')) : the_row();
						$titulo = get_sub_field('titulo');
						$numero = get_sub_field('numero');
						$bajada = get_sub_field('bajada');
					?>
						<div class="flex flex-col items-center md:mx-4 2xl:mx-8 w-full my-4 md:my-0">
							<div class="text-center text-sm uppercase"><?php echo $titulo; ?></div>
							<div class="text-center text-xl font-altobold"><?php echo $numero; ?></div>
							<div class="text-center text-xs"><?php echo $bajada; ?></div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<div class="tecnologia">
			<div class="container m-auto flex flex-col justify-center items-center mt-4 mb-16">
				<div class="my-4 text-2xl">
					<?php echo get_field('tecnologia_titulo') ?>
				</div>
				<div class="flex flex-col md:flex-row h-full">
					<div class="iconos md:w-1/4 h-full flex flex-row md:flex-col justify-between">
						<?php
						while (have_rows('tecnologia')) : the_row();
							$image = get_sub_field('image');
							$text = get_sub_field('texto');
						?>
							<div class="flex flex-col items-center my-6 mx-8 ">
								<img class="icon h-10" src="<?php echo $image['url'] ?>" alt="icon">
								<div class="text  text-center mt-4 text-sm"><?php echo $text; ?></div>
							</div>
						<?php endwhile; ?>
					</div>
					<div class="md:w-3/4">
						<img src="<?php echo get_field('tecnologia_imagen')['url'] ?>" alt="">
					</div>
				</div>
				<button data-popup="solicitademo" class="bg-primary text-base text-white py-1 px-10 mt-1 md:mt-16 font-altobold rounded-full call_popup uppercase">Pide tu demo</button>
			</div>
		</div>
		<?php
		$citas['title'] = get_field(Lang::langField('titulo_casos'));
		$citas['bg'] = 'bg-secondary';
		$citas['id'] = 7;
		include get_stylesheet_directory() . '/partials/_citas.php';
		?>
	</div>
	<div class="soluciones w-full">
		<div class="m-auto flex flex-col w-full justify-center relative">
			<?php
			$parnum = 1;
			while (have_rows('soluciones')) : the_row();
				$image = get_sub_field('imagen');
				$logo = get_sub_field('logo');
				$titulo = get_sub_field('titulo');
				$bajada = get_sub_field('bajada');
				$link = get_sub_field('link');
				$parnum++;
				if ($parnum % 2 === 0) {
					$par = true;
				} else {
					$par = false;
				}
			?>
				<div class="flex flex-col mb-12 md:mb-0 items-center <?php echo $par ? 'md:flex-row' : 'md:flex-row-reverse' ?> w-full ">
					<div class="md:w-1/2 relative">
						<img src="<?php echo $logo['url'] ?>" alt="" class="absolute left-0 right-0 top-0 bottom-0 m-auto w-16 md:w-32">
						<img src="<?php echo $image['url'] ?>" alt="" class="w-full">
					</div>
					<div class="md:w-1/2 flex flex-col items-center mt-4 md:mt-0 <?php echo $par ? 'md:pl-8 md:items-start' : 'md:pr-8 md:items-end' ?>">
						<div class="text-2xl font-altobold"><?php echo $titulo ?></div>
						<div class="my-4 text-base"><?php echo $bajada ?></div>
						<a href="<?php echo $link; ?>">
							<button class="bg-primary text-base text-white py-1 px-10 mt-1 md:mt-2 font-altobold rounded-full">VER MÁS</button>
						</a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<div class="clientes bg-bgDarkGray text-white flex flex-col items-center">
		<div class="mt-10 text-2xl text-white">
			<?php echo get_field('titulocliente') ?>
		</div>
		<div class="container m-auto pb-16">
			<div direction="horizontal" slideperview="4" class="slider-swiper">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
						while (have_rows('logosclientes')) : the_row();
							$image = get_sub_field('imagen');
						?>
							<div class="swiper-slide flex justify-center">

								<img class="w-32 mb-8" class="bg" src="<?php echo $image['url'] ?>" alt="background image">

							</div>
						<?php endwhile; ?>
					</div>
					<div class="swiper-pagination small"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	<?php get_footer();  ?>
	<?php wp_footer() ?>
</body>

</html>