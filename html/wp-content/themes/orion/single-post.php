<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?> <?php bloginfo('description'); ?> </title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/images/favicon.png' ?>" />
	<?php wp_head(); ?>
</head>

<body>
	<style>
		p {
			margin: 3rem 0px;
		}
	</style>
	<?php get_header();
	include('partials/traduccion.php');
	$catID = get_the_category();
	while (have_posts()) : the_post();
	?>

		<div class="post" id="page">
			<div class="bg-primary md:h-96 w-full text-white flex justify-center items-center relative">
				<div class="container flex flex-col md:flex-row justify-between items-end mt-24 mb-4">
					<div class="tx">
						<div class="font-altobold text-2xl"><?php the_title(); ?></div>
						<div class="row">
							<div class="text-sm"><?php echo get_the_date(); ?></div>
							<div class="text-gray-200"><?php echo $catID[0]->name;  ?></div>
						</div>
						<div class="row2">
							<?php if (get_field('mostrar_usuario')) {
								//imagen personalizada
								if (get_field('personalizado')) {
							?>
									<div class="thumb"><img src="<?php echo get_field('avatar')['url']; ?>" alt=""></div>
									<div class="name"><?php the_field('autor'); ?></div>

								<?php } else { ?>
									<div class="thumb"><?php echo get_field('usuario_del_wordpress')['user_avatar']; ?></div>
									<div class="name"><?php echo get_field('usuario_del_wordpress')["user_firstname"] . ' ' . get_field('usuario_del_wordpress')["user_lastname"]; ?></div>
								<?php } ?>
							<?php } ?>
							<?php if (get_field('imagen_autor') !== '') { ?>

							<?php } ?>
							<?php if (get_field('autor') !== '') { ?>

							<?php } ?>
						</div>
					</div>
					<div class="mt-4 md:mt-0 w-full md:w-96">
						<?php echo get_the_post_thumbnail(); ?>
					</div>
				</div>
				<img class="absolute -bottom-20 w-32 left-0 hidden md:block" src="<?php echo get_template_directory_uri() . '/images/iconD.svg' ?>" alt="">
			</div>
			<div class="blog">


				<div class="container m-auto my-4">

					<div class="content"> <?php the_content(); ?> </div>
					<div class="rrss flex items-center justify-end">

						<a class="linkedin mx-2 hover:scale-110 transition-all scale-100 transform" target="_blank" href="<?php echo "https://www.linkedin.com/shareArticle?mini=true&summary=" . get_the_excerpt() . "&title=" . get_the_title() . "&url=" . get_the_permalink(); ?>">
							<img src="<?php echo get_template_directory_uri() . '/images/linkedin_gray.svg' ?>" alt="">
						</a>
						<a class="facebook mx-2 hover:scale-110 transition-all scale-100 transform" href="<?php echo "https://www.facebook.com/sharer/sharer.php?u=" . get_the_permalink(); ?>">
							<img src="<?php echo get_template_directory_uri() . '/images/facebook_gray.svg' ?>" alt="">
						</a>
						<a class="twitter mx-2 hover:scale-110 transition-all scale-100 transform" href="<?php echo "https://twitter.com/share?url=" . get_the_permalink(); ?>">
							<img src="<?php echo get_template_directory_uri() . '/images/twitter_gray.svg' ?>" alt="">
						</a>

						<p>Compartir</p>
					</div>


				</div>

				<?php
				require('partials/shared/noticias_moreread.php')
				?>
			</div>
		</div>
	<?php endwhile; ?>
	<?php get_footer(); ?>
	<?php wp_footer() ?>
</body>

</html>