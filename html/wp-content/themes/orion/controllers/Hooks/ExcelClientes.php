<?php 
namespace Inc\Hooks;

class ExcelClientes
{
    public function __construct()
    {
        add_filter('all_admin_notices', array($this, 'showLink'));
    }

    public static function showLink(){
        $screen = get_current_screen();
        if ($screen->post_type == 'clientes') {
            global $post;
            $content = '<div class="exportaexcel" id="clientes">';
            $content .= '<input type="hidden" name="path" id="path" value="'.get_template_directory_uri().'">';
            $content .= '<div class="clientes">';
            $content .= '<div class="todos">TODOS</div>';
            $content .= '<div class="label">Tipo Cliente</div>';
            $content .= '<select name="cliente" id="cliente">';
            $content .= '<option value="lead">Lead</option>';
            $content .= '<option value="cliente">Cliente</option>';
            $content .= '</select>';
            $content .= '</div>';
            $content .= '<div class="sedes">';
            $content .= '<div class="todos">TODAS</div>';
            $content .= '<div class="label">Sedes</div>';
            $content .= '<select name="sede" id="sede">';
            $content .= '<option value="chamisero">Chamisero</option>';
            $content .= '<option value="chamisero">Chamisero</option>';
            $content .= '<option value="chamisero">Chamisero</option>';
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
