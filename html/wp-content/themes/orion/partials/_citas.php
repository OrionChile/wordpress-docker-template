	<?php

	use Inc\Lang\Lang;
	?>
	<div class="casoexito <?php echo $citas['bg'] ?>">
		<div class="container m-auto flex flex-col justify-center items-center">
			<div class="mt-8 text-2xl text-center">
				<?php echo $citas['title']; ?>
			</div>
			<div class="flex-col flex w-full items-center justify-center my-10">
				<?php
				while (have_rows('casos', $citas['id'])) : the_row();
					$texto = get_sub_field(Lang::langField('texto'));
					$imagen2 = get_sub_field('imagen');
					$nombre = get_sub_field('nombre');
					$cargo = get_sub_field(Lang::langField('cargo'));
				?>
					<div class="w-3/4 text-center">
						<?php echo $texto; ?>
					</div>
					<div class="flex items-center mx-8 pt-8">
						<img class="icon w-12" src="<?php echo $imagen2['url'] ?>" alt="icon">
						<div class="ml-4">
							<div class="text-sm text-left font-bold"><?php echo $nombre; ?></div>
							<div class="text-xs text-left "><?php echo $cargo; ?></div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>