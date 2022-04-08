<?php

namespace Inc\Loop;

use DateTime;
use WP_Query;
use Inc\Formulas\Fecha;
use Inc\Formulas\GetIP;

if (!defined('ABSPATH')) {
    exit;
}
class Loop
{
    private static $loaded = false;
    private $argsbase;
    private $paged;
    
    public function __construct()
    {
        $this->setup();
    }
    public function setup()
    {
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;
    }

    private function UpdateDatePost($id)
    {
        $codePost = array(
            'ID'            => $id,
            'post_date'     => date("Y-m-d H:i:s"),
            'post_date_gmt'     => date("Y-m-d H:i:s")
        );
        wp_update_post($codePost);
    }

   


    private function changeDate($date)
    {
        return DateTime::createFromFormat('d/m/Y', $date)->format('F dS, Y');
    }

    public function argDate($fromD, $toD)
    {
        $argsbase = $this->argsbase;
        $argsbase['date_query'] =  array(
            'after' => $this->changeDate($fromD),
            'before' => $this->changeDate($toD),
            'inclusive' => true,


        );
        $merge = $argsbase;
        $this->argsbase = $merge;
        return $merge;
    }

    public function querybase($posttype, $posts_per_page = (-1))
    {
        $args2 = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order'   => 'ASC',
            'posts_per_page' => $posts_per_page,
            'tax_query' => array(
                'relation' => 'AND',
            )
        );
        $this->argsbase = $args2;
        return $this->argsbase;
    }


    public function filterTaxonomy($taxkey, $taxvalue, $field = 'slug', $operator = 'IN')
    {

        $argsbase = $this->argsbase;
        $argsbase["tax_query"][] =
            array(
                'taxonomy' => $taxkey,
                'field' => $field,
                'terms' => $taxvalue,
                'operator' => $operator
            );
        $merge = $argsbase;
        // $merge = array_merge($argsbase, $merge1);



        $this->argsbase = $merge;
        return $merge;
    }
    public function idtoslug($ids)
    {
        $slug = [];
        foreach ($ids as $id) {
            $post = get_post($id);
            $slug = $post->post_name;
            $slug[] = $slug;
        }
        return $slug;
    }
    public function busca($title = '')
    {
        global $post;
        $args = $this->argsbase;
        $query = new WP_Query($args);
        $found = false;
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                if ($title != '') {
                    if (get_the_title() == $title) {
                        $title = get_the_title();
                        $code_id = get_the_ID();
                        $found = true;
                    }
                } else {
                    $title = get_the_title();
                    $code_id = get_the_ID();
                    $found = true;
                }

            endwhile;
            wp_reset_query();
        endif;
        if ($found) {
            return array(
                "title" => $title,
                "id" => $code_id
            );
        } else {
            return array(
                "title" => false,
                "id" => false
            );
        }
    }

    public function loop()
    {
        $args = $this->argsbase;
        $query = new WP_Query($args);
        $found = false;
        $ids = [];
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $ids[] = get_the_ID();
            endwhile;
            wp_reset_query();
        endif;
        if (sizeof($ids) > 0) {
            return $ids;
        } else {
            return false;
        }
    }
    public function addPaged($paged)
    {
        $argsbase = $this->argsbase;
        $argsbase['paged'] = $paged;
        $this->argsbase = $argsbase;
        return $argsbase;
    }
    public function loopPaged($paged)
    {
        $argsbase = $this->argsbase;
        $argsbase[] = ['paged' => $paged];

        $args = $argsbase;
        $query = new WP_Query($args);
        $found = false;
        $ids = [];
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $ids[] = get_the_ID();
            endwhile;
        // wp_reset_query();
        endif;
        if (sizeof($ids) > 0) {
            return $ids;
        } else {
            return false;
        }
    }

   
}
