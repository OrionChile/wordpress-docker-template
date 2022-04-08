<?php
if ($en == '') {
	$titleMostRead = 'Artículos más leídos';
} else {
	$titleMostRead = 'Most read articles';
}
?>
<div class="flex-col m-auto justify-center items-center bg-gray-200 pt-4 pb-16">
	<h2 class="text-xl font-altobold text-center my-8 text-gray-600"><?php echo $titleMostRead; ?></h2>
	<div class="container m-auto w-3/4">

		<div direction="horizontal" slideperview="3" class="slider-swiper">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 5,
					);
					$query = new WP_Query($args);
					while ($query->have_posts()) : $query->the_post();
						$catID = get_the_category();
					?>
						<div class="swiper-slide">
							<div class="card mx-4 shadow relative bg-white h-96">
								<div class="imag mb-4 h-40 overflow-hidden">
									<img class="w-full" src="<?php echo get_the_post_thumbnail_url(get_the_ID()) ?>" alt="">
								</div>

								<div class="py-2 px-4">
									<div class="lin1">
										<div class="text-xs"><?php echo get_the_date("d M Y", get_the_ID()); ?></div>
										<div class="text-gray-800 mb-1 text-xs"> <?php echo $catID[0]->name;  ?></div>
									</div>
									<div class="titulo font-altobold mb-2 h-16"><?php echo get_the_title(get_the_ID()); ?></div>
									<div class="extract text-sm overflow-hidden h-16"><?php the_excerpt(get_the_ID()); ?></div>
									<a class="bg-primary absolute bottom-2 right-4 text-white rounded-full py-1 px-3 text-xs mt-4 hover:bg-secondary transition-all" href="<?php the_permalink(get_the_ID()); ?>">VER MÁS</a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		</div>
	</div>



</div>