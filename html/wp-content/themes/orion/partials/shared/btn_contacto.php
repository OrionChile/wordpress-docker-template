<?php
if($en == '') {
    $contactlink = 'contacto';
  
}else {
    $contactlink = 'contact';
}
?>
<div class="btncontacto">
<a href="<?php echo get_permalink( get_page_by_path($contactlink) ); ?>" >
    <img class="" src="<?php echo get_template_directory_uri() . '/img/boton_contacto.svg' ?>" alt=""> 
</a>

</div>
