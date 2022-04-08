<?php 
namespace Inc\Hooks;

class ExcelPedidos
{
    public function __construct()
    {
        add_filter('all_admin_notices', array($this, 'showLink'));
    }

    public static function showLink(){
        $screen = get_current_screen();
        if ($screen->post_type == 'pedidos') {
            global $post;
            $content = '<div class="exportaexcel">';
            $content .= '<input type="hidden" name="path" id="path" value="'.get_template_directory_uri().'">';
            $content .= '<div class="sedes">';
            $content .= '<div class="todos">TODAS</div>';
            $content .= '<div class="label">Sedes</div>';
            $content .= '<select name="sede" id="sede">';
            $content .= '</select>';
            $content .= '</div>';
            $content .= '<div class="fecha">';
            $content .= '<div class="label" id="fecha">Fecha</div>';
            $content .= '<div class="label" id="desde">Desde</div>';
            $content .= '<div class="label" id="hasta">Hasta</div>';
            $content .= '<div class="todos">TODOS</div>';
            $content .= '<input type="text" name="inpdesde" id="inpdesde">';
            $content .= '<input type="text" name="inphasta" id="inphasta">';
            $content .= '</div>';
            $content .= '<div class="btndescarga">DESCARGAR PEDIDOS A EXCEL</div>';
            $content .= '<div class="loader">';
            $content .= '<img src="'.get_template_directory_uri().'/img/loader.svg" alt=""> ';
            $content .= '</div>';
            $content .= '</div>';

            echo $content;

        }

    }

}
?>
