<div class="container m-auto flex flex-col items-center justify-center">
	<h3 class="font-altobold mt-16 text-2xl w-3/4 text-center"><?php the_field('titulo' . $en, $id); ?></h3>
	<div class="text-center mt-8 mb-8 w-3/4"><?php the_field('bajada' . $en, $id); ?></div>
</div>


<div class="products relative w-full overflow-x-hidden">

	<img src="<?php echo get_field('imagen_inicial')['url']; ?>" alt="" class="absolute top-0 -left-48">
	<img src="<?php echo get_field('imagen_final')['url']; ?>" alt="" class="absolute w-96 bottom-0 right-0">
	<img class="absolute top-1/4 -right-24" src="<?php echo get_template_directory_uri() . '/images/iconU.svg' ?>" alt="">
	<img class="absolute bottom-1/4 -left-16" src="<?php echo get_template_directory_uri() . '/images/iconD.svg' ?>" alt="">
	<div class="container m-auto">
		<?php
		$parnum = 1;
		while (have_rows('producto', $id)) : the_row();
			if ($parnum % 2 !== 0) {
				$par = true;
			} else {
				$par = false;
			}
			$parnum++;
		?>

			<div class="flex relative items-center flex-col justify-center my-16 md:my-32 <?php echo $par ? 'md:flex-row' : 'md:flex-row-reverse' ?>">
				<div class="md:w-1/4 mx-16">
					<img src="<?php echo get_sub_field('imagen')["url"]; ?>" alt="" class="w-full">
				</div>
				<div class="md:w-1/3 border-l-4 border-primary flex flex-col items-start">
					<h7 class="pl-8 text-xl  font-altobold "><?php the_sub_field('titulo' . $en); ?></h7>
					<div class="pl-8 text base pt-8"> <?php the_sub_field('bajada' . $en);  ?> </div>
				</div>
			</div>

		<?php endwhile; ?>
	</div>
</div>