## POPUP

### propia
Funciona con la clase **.call_popup** en el boton que quiera dispara el landing que este en la propiedad **data-popup**
la llamada se ve asi

```sh
<div class="button call_popup" data-popup="popup_forma">Boton</div>
```

la idea es importar el popup que estan todos en la carpeta

```sh
\parts\popup\popup_forma.php
```

y la estructura del archivo es esta

 ```html
  <div class="popup_main" >
        <div class="popup"> 
        <!-- aqui va el popup la clase con el mismo nombre del nombre archivo-->
        <div class="popup"> 
            <!-- lo que este dentro de la clase cerrar sera el btn de cerrar-->
            <div class="cerrar"> Cerrar</div>
        </div>
        </div>
    </div>
```

### fslightbox
este es un script que tenemos la version pro que se importa en el php al final del archivo donde lo vas a usar y se maneja todo dentro del html
https://fslightbox.com/

dependencia del script

```html
<script src="<?php echo get_template_directory_uri() . '/js_vendor/fslightbox/fslightbox.js' ?>"></script>
```

Y asi se muestra, lo que esta en href es lo que se despliega en el lightbox y lo que va en el data-fslightbox es que asocia las galerias entre si


```html
<a data-fslightbox="first-lightbox" href="/img/1.jpg" data-caption="<h1>Example title</h1>">First Lightbox</a>
<a data-fslightbox="first-lightbox" href="/img/2.jpg" data-caption="<h1>Example title</h1>">Second Lightbox</a>
```

