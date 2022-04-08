<?php
require('partials/header/menumovil.php');
require('partials/header/menufixed.php');
require('partials/header/menudesktop.php');
require('partials/popup/popup_inicio.php');
require('partials/_loader_page.php');
?>
<input type="hidden" class="homepage" id="homepage" value="<?php echo home_url() ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/tailwindcss/output.css' ?>">

<style>
	@font-face {
		font-family: 'alto';
		src: url(<?php echo get_template_directory_uri() . '/fonts/MarkLight.otf' ?>) format("opentype")
	}

	@font-face {
		font-family: 'altobold';
		src: url(<?php echo get_template_directory_uri() . '/fonts/MarkBold.otf' ?>) format("opentype");
	}

	@font-face {
		font-family: 'altomedium';
		src: url(<?php echo get_template_directory_uri() . '/fonts/MarkMedium.otf' ?>) format("opentype");
	}
</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GMCDSTBLBN"></script>
<script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
		dataLayer.push(arguments);
	}
	gtag('js', new Date());

	gtag('config', 'G-GMCDSTBLBN');
</script>

<?php
$facebook = get_field('facebook_pixel', 'option');
$google = get_field('codigo_google_analytics', 'option');
$hotjar = get_field('hotjar', 'option');
?>

<?php if ($google != '') {  ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-<?php echo $google; ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-<?php echo $google; ?>');
		//   UA-112302423-1
	</script>
<?php } ?>

<?php if ($facebook != '') {  ?>
	<!-- facebook -->
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = 'https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.2&appId=<?php echo $facebook; ?>&autoLogAppEvents=1';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
<?php } ?>

<?php if ($hotjar != '') {  ?>
	<!-- Hotjar Tracking Code -->
	<script>
		(function(h, o, t, j, a, r) {
			h.hj = h.hj || function() {
				(h.hj.q = h.hj.q || []).push(arguments)
			};
			h._hjSettings = {
				hjid: <?php echo $hotjar; ?>,
				hjsv: 6
			};
			a = o.getElementsByTagName('head')[0];
			r = o.createElement('script');
			r.async = 1;
			r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
			a.appendChild(r);
		})(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
	</script>
<?php } ?>