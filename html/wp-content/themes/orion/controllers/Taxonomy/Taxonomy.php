<?php 
namespace Inc\Taxonomy;

use Inc\Loop\Loop;

if ( ! defined( 'ABSPATH' ) ) {exit;}


class Taxonomy  
{
    public function hasTaxonomy($id, $taxname){
        return $taxs = get_the_terms($id, $taxname);
    }

    public function getTaxonomyNames($id, $taxname){
        $taxs = get_the_terms($id, $taxname);
        if($taxs != ''){
            $names = [];
            foreach ($taxs as $tax ) {
                $names[] = $tax->name;
            }
            return $names;
        } else { return '';}
    }

    public function getTaxonomyNameAllPosts($posttype, $taxname){

        $loop = new Loop();
        $loop->querybase($posttype);
        $ids = $loop->loop();
        $result = [];
        foreach ($ids as $id ) {
            $taxs = get_the_terms($id, $taxname);
            $names = [];
            if($taxs){
                foreach($taxs as $tax ) {
                    $names[] = $tax->name;
                }
            }
            
            $result[] = $names;
            
        }
        $result = array_reduce($result, 'array_merge', array());
        $result = array_unique($result);
        return $result;
    }

    public function getTaxonomyNameAll($taxonomy, $select = false){
        $result = [];
        $terms = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ]);
        if($select){ return wp_list_pluck( $terms, 'name','slug' ); 
        }else { return $terms;}
        
    }
}