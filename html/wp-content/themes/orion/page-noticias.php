<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?> <?php bloginfo('description'); ?> </title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/images/favicon.png' ?>" />
	<?php wp_head(); ?>
</head>

<body>
	<?php get_header();
	include('partials/traduccion.php');
	if ($en == '') {
		$ver = 'VER MÁS';
	} else {
		$ver = 'SEE MORE';
	}
	?>
	<div class="noticias" id="page">
		<div class="superior relative" style="z-index: -1;">
			<div class="center absolute text-white w-full h-full flex justify-center items-center flex-col">
				<h2 class="font-altobold text-2xl text-center"><?php echo get_field('titulo' . $en, $id) ?></h2>
				<p class="text-base mt-1 text-center"><?php echo get_field('bajada' . $en, $id) ?></p>
			</div>
			<img class="hidden md:block w-full" src="<?php echo get_field('header', $id)['url'] ?>" alt="">
			<img class="block w-full md:hidden" src="<?php echo get_field('header_mobile', $id)['url'] ?>" alt="">

		</div>
		<div class="blog">
			<div class="container m-auto">
				<div class="grid grid-cols-1 md:grid-cols-3 -mt-24 gap-4">

					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 6,
						'paged'          => $paged
					);
					$post_query = new WP_Query($args);
					if ($post_query->have_posts()) {
						while ($post_query->have_posts()) {
							$post_query->the_post();
							$catID = get_the_category();
					?>
							<div class="card shadow-md relative flex flex-col justify-between">
								<div class="imag overflow-hidden h-64">
									<img class="w-full min-h-full" src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
								</div>

								<div class="texto p-5">
									<div class="lin1">
										<div class="fecha text-gray-800 text-xs"><?php echo get_the_date(); ?></div>
										<div class="text-xs text-gray-500"> <?php echo $catID[0]->name;  ?></div>
									</div>
									<div class="titulo font-altobold text-xl mb-2"><?php the_title(); ?></div>
									<div class="extract text-sm mb-10"><?php the_excerpt(); ?></div>
									<div class="bottom-4 right-4 flex items-center justify-between">
										<div class="rrss flex items-center  justify-end mr-4">
											<a class="linkedin mx-2 hover:scale-110 transition-all scale-100 transform" target="_blank" href="<?php echo "https://www.linkedin.com/shareArticle?mini=true&summary=" . get_the_excerpt() . "&title=" . get_the_title() . "&url=" . get_the_permalink(); ?>">
												<img class="w-6" src="<?php echo get_template_directory_uri() . '/images/linkedin_gray.svg' ?>" alt="">
											</a>
											<a class="facebook mx-2 hover:scale-110 transition-all scale-100 transform " href="<?php echo "https://www.facebook.com/sharer/sharer.php?u=" . get_the_permalink(); ?>">
												<img class="w-6" src="<?php echo get_template_directory_uri() . '/images/facebook_gray.svg' ?>" alt="">
											</a>
											<a class="twitter mx-2 hover:scale-110 transition-all scale-100 transform" href="<?php echo "https://twitter.com/share?url=" . get_the_permalink(); ?>">
												<img class="w-6" src="<?php echo get_template_directory_uri() . '/images/twitter_gray.svg' ?>" alt="">
											</a>
										</div>
										<a class="bg-primary text-white rounded-full py-1 px-3 text-xs hover:bg-secondary hover:text-black transition-all" href="<?php the_permalink(); ?>"><?php echo $ver; ?></a>
									</div>
								</div>
							</div>



					<?php }
					}
					?>
				</div>
				<div class="pagination flex justify-center w-full m-8">
					<?php
					echo paginate_links(array(
						'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
						'total'        => $post_query->max_num_pages,
						'current'      => max(1, get_query_var('paged')),
						'format'       => '?paged=%#%',
						'show_all'     => false,
						'type'         => 'plain',
						'end_size'     => 2,
						'mid_size'     => 1,
						'prev_next'    => true,
						'prev_text'    => sprintf('<i></i> %1$s', __('Recientes', 'text-domain')),
						'next_text'    => sprintf('%1$s <i></i>', __('Antiguas', 'text-domain')),
						'add_args'     => false,
						'add_fragment' => '',
					));
					?>
				</div>






			</div>
			<?php
			require('partials/shared/noticias_moreread.php')
			?>
		</div>
	</div>
	<?php
	get_footer(); ?>
	<?php wp_footer() ?>
</body>

</html>