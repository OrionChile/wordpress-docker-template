<?php
include('traduccion.php');
if ($en == '') {
	$msg = 'Este sitio web utiliza cookies para mejorar su experiencia.';
	$btn = 'Aceptar';
} else {
	$msg = 'This web site uses cookies for a better experience.';
	$btn = 'Accept';
}
?>
<div class="cookiemsg bg-gray-600 text-white w-full">
	<div class="container text-xs flex flex-row-reverse md:flex-row justify-center py-2 items-center">
		<div><?php echo $msg; ?></div>
		<button class="mx-2 py-1 px-3 rounded-full bg-white text-gray-600 hover:bg-gray-400 transition-all"><?php echo $btn; ?></button>
	</div>
</div>