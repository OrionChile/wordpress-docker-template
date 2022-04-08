<?php if (get_field('popup_activo', 'option')) { ?>
	<?php
	pll_current_language() == 'es' ? $en = '' : $en = 'en';
	?>
	<div class="popup_main absolute w-full h-full flex justify-center items-center top-0 left-0 z-20">
		<div class="bg-black absolute w-full h-screen opacity-70" style="z-index:-1"></div>
		<div class="popup md:w-1/4">
			<div class="popup_inicio relative flex flex-col bg-white rounded-b-3xl">
				<input type="hidden" class="popactivo" value="<?php echo get_field('popup_activo', 'option'); ?>">
				<div class="cerrar absolute -top-5 right-3 md:-right-5 md:top-1">
					<img class="close cursor-pointer transform scale-100 hover:scale-110 transition-all" src="<?php echo get_template_directory_uri() . '/images/input_close.svg' ?>" alt="">
				</div>
				<div class="w-full">
					<img class="bg" src="<?php echo get_field('popup_imagen', 'option')['url']; ?>" alt="">
				</div>
				<div class="flex justify-center">
					<?php if (get_field('popup_texto' . $en, 'option') !== '') { ?>
						<div class="py-5"><?php echo get_field('popup_texto' . $en, 'option'); ?></div>
					<?php } ?>
					<?php
					if (get_field('popup_mostrar_boton', 'option')) {
					?>
						<a href="<?php echo get_field('popup_link' . $en, 'option'); ?>" target="<?php echo get_field('popup_ventana_link', 'option'); ?>"><?php echo get_field('popup_texto_boton' . $en, 'option'); ?></a>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>