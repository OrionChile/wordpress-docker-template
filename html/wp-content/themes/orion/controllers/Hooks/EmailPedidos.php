<?php 
namespace Inc\Hooks;

class EmailPedidos
{
    public function __construct()
    {
        add_filter('edit_form_after_editor', array($this, 'showLink'));
    }

    public static function showLink(){
        $screen = get_current_screen();
        if ($screen->post_type == 'pedidos') {
            global $post;
            // $ganancia = strip_tags(get_the_term_list($post->ID, 'ganancia'));
            // $tiempo = strip_tags(get_the_term_list($post->ID, 'tiempo'));
            // $franquicia = sanitize_title(get_field('franquicia',$post->ID ));
            // $rubro = sanitize_title(get_field('rubro',$post->ID ));
            // $local = sanitize_title(get_field('local',$post->ID ));
            // $region = sanitize_title(get_field('region',$post->ID ));
            // $content =  '<div class="linkreal">';
            // $content .= '<p >link para el punto de venta</>';
            // $content .= '<a target="_blank" href="'.home_url().'?franquicia='.$franquicia.'&rubro='.$rubro.'&local='.$local.'&region='.$region.'">Link Punto Venta</a>';
            // $content .= '</div>';
            $content = '<div class="validacompra">';
            $content .= '<input type="hidden" name="path" id="path" value="'.get_template_directory_uri().'">';
            $content .= '<div class="btn">';
            $content .= '<img class="loader" src="'.get_template_directory_uri().'/img/loading.png" alt=""> ';
            $content .= 'Valida Compra y envia email';
            $content .= '</div>';
            $content .= '</div>';
            echo $content;

        }

    }

}
?>
