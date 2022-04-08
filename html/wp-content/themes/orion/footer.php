<script src="<?php echo get_template_directory_uri() . '/js_vendor/fslightbox/fslightbox.js' ?>"></script>
<footer class="bg-primary w-full">
	<div class="container m-auto flex pt-10">
		<div class="hidden w-1/3 md:flex items-end h-full mt-auto mr-3">
			<img class="w-full" src="<?php echo get_template_directory_uri() . '/images/icon_UP.svg' ?>" alt="">
		</div>
		<div class="w-full md:w-3/4 relative">
			<div class="footer_menu flex-col   flex-wrap md:flex-nowrap  text-white text-center flex justify-end ml-auto items-end ">
				<?php
				$args = array(
					'theme_location' => 'footer-menu',
					'container' => 'nav',
					'container_class' => 'footermenu flex-col md:flex-row md:flex justify-end items-center ml-auto mr-0 border-white border-b-2 border-dashed py-3',
					'menu_class'  => 'flex justify-end items-center ml-auto flex-wrap',
					'menu_id'  => 'menufooter',
				);
				wp_nav_menu($args);
				?>
				<div class="bg-white px-2 md:px-0 py-4 rounded flex flex-col items-center justify-center w-full md:w-11/12 2xl:w-3/4 my-2">
					<div class="py-2 text-center text-primary">Entérate de nuestras novedades</div>
					<div class="pipedriveWebForms " data-pd-webforms="https://webforms.pipedrive.com/f/1sUJCthTEa9afvIRksfyuth5fOpZTCCa9l670v034MuWR2hVnCn1xaLo3805qCTQL">
						<script src="https://webforms.pipedrive.com/f/loader"></script>
					</div>
				</div>

			</div>
			<div class="paises flex text-white justify-center py-2 items-center w-full flex-wrap">
				<div class="pais flex flex-col mx-4">
					<div>CHILE</div>
					<a href="<?php echo 'tel:' . get_field('telefono_chile_peru', 'option') ?>"><?php echo get_field('telefono_chile_peru', 'option') ?></a>
				</div>
				<div class="pais flex flex-col mx-4">
					<div>MÉXICO</div>
					<a href="<?php echo 'tel:' . get_field('telefono_mexico', 'option') ?>"><?php echo get_field('telefono_mexico', 'option') ?></a>
				</div>
				<div class="rrss flex justify-center md:ml-16 w-full md:w-auto mt-4 md:mt-0">
					<a href="<?php echo get_field('linkedin', 'option') ?>" target="_blank">
						<img class="h-6 mx-2 transition-all transform scale-100 hover:scale-110" src="<?php echo get_template_directory_uri() . '/images/icon_linkedin.svg' ?>" alt="">
					</a>
					<a href="<?php echo get_field('instagram', 'option') ?>" target="_blank">
						<img class="h-6 mx-2 transition-all transform scale-100 hover:scale-110" src="<?php echo get_template_directory_uri() . '/images/icon_instagram.svg' ?>" alt="">
					</a>
				</div>
			</div>
			<div class="text-white text-center py-2 text-xs">2005-2020 ALTO S.A. Todos los derechos reservados. <a href="<?php echo get_permalink(get_page_by_path('politica-de-privacidad')); ?>">Políticas de privacidad</a></div>
		</div>




	</div>
</footer>
<script>
	window.pipedriveLeadboosterConfig = {
		base: 'leadbooster-chat.pipedrive.com',
		companyId: 7405281,
		playbookUuid: 'd407aac1-7d72-473d-a16f-32961eedc897',
		version: 2
	};
	(function() {
		var w = window;
		if (w.LeadBooster) {
			console.warn('LeadBooster already exists');
		} else {
			w.LeadBooster = {
				q: [],
				on: function(n, h) {
					this.q.push({
						t: 'o',
						n: n,
						h: h
					});
				},
				trigger: function(n) {
					this.q.push({
						t: 't',
						n: n
					});
				},
			};
		}
	})();
</script>
<script src="https://leadbooster-chat.pipedrive.com/assets/loader.js" async></script>
<?php
include 'partials/cookiemensaje.php';
?>