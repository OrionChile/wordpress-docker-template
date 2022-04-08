<?php

namespace Inc\Sliders;

use Inc\Loop\Loop;

if (!defined('ABSPATH')) {
    exit;
}


class Sliders
{
    public function swiperGallery(int $slidesPerView = 1, string $class, int $delay = 2800, string $acfField, int $ID)
    {
        $gallery = get_field($acfField, $ID);

        $content = '<div class="w100 swiperGallery ' . $class . '">';
        $content .= '<input type="hidden" class="slidesperview" value="' . $slidesPerView . '">';
        $content .= '<input type="hidden" class="delay" value="' . $delay . '">';
        $content .= '<div class="swiper-wrapper">';


        $gallery = get_field($acfField, $ID);
        foreach ($gallery as $slide) {

            $content .= '<div class="swiper-slide">';
            $content .= '<a data-fslightbox="slide-' . $class . '" href="' . $slide['url'] . '">';
            $content .= '<img class="sl" src="' . $slide['url'] . '" alt="">';
            $content .= '</a>';
            $content .= '</div>';
        }


        $content .= '</div>';
        $content .= '<div class="swiper-pagination"></div>';
        $content .= '<div class="swiper-button-prev"></div>';
        $content .= '<div class="swiper-button-next"></div>';
        $content .= '</div>';

        return $content;
    }
}
