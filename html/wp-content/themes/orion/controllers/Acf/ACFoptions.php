<?php

namespace Inc\Acf;

if (!defined('ABSPATH')) {
	exit;
}



class ACFoptions
{
	function __construct()
	{
		$this->opciones();
	}

	public function opciones()
	{
		if (function_exists('acf_add_options_page')) {
			acf_add_options_page(
				array(
					'page_title' => 'Opciones',
					'menu_title' => 'Opciones',
					'menu_slug'  => 'opciones',
					'parent_slug' => '',
					'position'    => false,
					'icon_url'    => false
				)
			);
			acf_add_options_page(array(
				'page_title' => 'Datos Contacto',
				'menu_title' => 'Datos Contacto',
				'menu_slug'  => 'datos_contacto',
				'parent_slug' => 'opciones',
				'position'    => false,
				'icon_url'    => false
			));

			acf_add_options_page(array(
				'page_title' => 'Redes Sociales',
				'menu_title' => 'Redes Sociales',
				'menu_slug'  => 'rrss',
				'parent_slug' => 'opciones',
				'position'    => false,
				'icon_url'    => false
			));

			acf_add_options_page(array(
				'page_title' => 'Análisis de Trafico',
				'menu_title' => 'Análisis de Trafico',
				'menu_slug'  => 'analitica',
				'parent_slug' => 'opciones',
				'position'    => false,
				'icon_url'    => false
			));
			acf_add_options_page(array(
				'page_title' => 'Formulario de Contacto',
				'menu_title' => 'Formulario de Contacto',
				'menu_slug'  => 'formulariocontacto',
				'parent_slug' => 'opciones',
				'position'    => false,
				'icon_url'    => false
			));
			acf_add_options_page(array(
				'page_title' => 'Popup',
				'menu_title' => 'Popup inicio',
				'menu_slug'  => 'popup',
				'parent_slug' => 'opciones',
				'position'    => false,
				'icon_url'    => false
			));
		}
	}
}
