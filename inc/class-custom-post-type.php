<?php
/* PREVENT DIRECT ACCESS */
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * Sigsec Custom Post Types
 *
 * @link http://www.robertochoaweb.com/casos/sigsec?utm_source=plugin&utm_medium=link&utm_content=sigsec
 *
 * @package sigsec
 */

if (!class_exists('Sigsec_CPT_Class')) :

    class Sigsec_CPT_Class extends Sigsec_Main_Class
    {
        /* CAPABILITIES CONSTANT */
        const SIGSEC_CAPABILITIES =  array(
            'edit_post'             => 'edit_post',
            'read_post'             => 'read_post',
            'delete_post'           => 'delete_post',
            'edit_posts'            => 'edit_posts',
            'edit_others_posts'     => 'edit_others_posts',
            'publish_posts'         => 'publish_posts',
            'read_private_posts'    => 'read_private_posts',
        );

        /**
         * Main Sub-Constructor.
         */
        public function __construct()
        {
            add_action('init', array($this, 'create_incidencias_custom_post_types'), 0);
            add_action('init', array($this, 'create_vehiculos_custom_post_types'), 0);
        }

        /**
         * Creating incidencias custom post types
         */
        public function create_incidencias_custom_post_types()
        {
            /* CPT INCIDENCIAS */
            $labels = array(
                'name'                  => _x('Incidencias', 'Post Type General Name', parent::PLUGIN_SLUG),
                'singular_name'         => _x('Incidencia', 'Post Type Singular Name', parent::PLUGIN_SLUG),
                'menu_name'             => __('Incidencias', parent::PLUGIN_SLUG),
                'name_admin_bar'        => __('Incidencias', parent::PLUGIN_SLUG),
                'archives'              => __('Archivo de Incidencias', parent::PLUGIN_SLUG),
                'attributes'            => __('Atributos de Incidencias', parent::PLUGIN_SLUG),
                'parent_item_colon'     => __('Incidencia Padre:', parent::PLUGIN_SLUG),
                'all_items'             => __('Todas las Incidencias', parent::PLUGIN_SLUG),
                'add_new_item'          => __('Agregar Nueva Incidencia', parent::PLUGIN_SLUG),
                'add_new'               => __('Agregar Nueva', parent::PLUGIN_SLUG),
                'new_item'              => __('Nueva Incidencia', parent::PLUGIN_SLUG),
                'edit_item'             => __('Editar Incidencia', parent::PLUGIN_SLUG),
                'update_item'           => __('Actualizar Incidencia', parent::PLUGIN_SLUG),
                'view_item'             => __('Ver Incidencia', parent::PLUGIN_SLUG),
                'view_items'            => __('Ver Incidencias', parent::PLUGIN_SLUG),
                'search_items'          => __('Buscar Incidencia', parent::PLUGIN_SLUG),
                'not_found'             => __('No hay resultados', parent::PLUGIN_SLUG),
                'not_found_in_trash'    => __('No hay resultados en Papelera', parent::PLUGIN_SLUG),
                'featured_image'        => __('Imagen de Incidencia', parent::PLUGIN_SLUG),
                'set_featured_image'    => __('Colocar Imagen de Incidencia', parent::PLUGIN_SLUG),
                'remove_featured_image' => __('Remover Imagen de Incidencia', parent::PLUGIN_SLUG),
                'use_featured_image'    => __('Usar como Imagen de Incidencia', parent::PLUGIN_SLUG),
                'insert_into_item'      => __('Insertar en Incidencia', parent::PLUGIN_SLUG),
                'uploaded_to_this_item' => __('Cargado a esta incidencia', parent::PLUGIN_SLUG),
                'items_list'            => __('Listado de incidencias', parent::PLUGIN_SLUG),
                'items_list_navigation' => __('Navegación del Listado de incidencias', parent::PLUGIN_SLUG),
                'filter_items_list'     => __('Filtro del Listado de incidencias', parent::PLUGIN_SLUG),
            );

            $args = array(
                'label'                 => __('Incidencias', parent::PLUGIN_SLUG),
                'description'           => __('Incidencias dentro de la empresa', parent::PLUGIN_SLUG),
                'labels'                => $labels,
                'supports'              => array('title', 'editor'),
                'taxonomies'            => array('tipos_incidencia'),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'menu_icon'             => 'dashicons-megaphone',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capabilities'          => self::SIGSEC_CAPABILITIES,
                'show_in_rest'          => false,
            );
            register_post_type('incidencias', $args);
        }

        /**
         * Creating vehiculos custom post types
         */
        public function create_vehiculos_custom_post_types()
        {
            /* CPT VEHICULOS */
            $labels = array(
                'name'                  => _x('Vehículos', 'Post Type General Name', parent::PLUGIN_SLUG),
                'singular_name'         => _x('Vehículo', 'Post Type Singular Name', parent::PLUGIN_SLUG),
                'menu_name'             => __('Vehículos', parent::PLUGIN_SLUG),
                'name_admin_bar'        => __('Vehículos', parent::PLUGIN_SLUG),
                'archives'              => __('Archivo de Vehículos', parent::PLUGIN_SLUG),
                'attributes'            => __('Atributos de Vehículos', parent::PLUGIN_SLUG),
                'parent_item_colon'     => __('Vehículo Padre:', parent::PLUGIN_SLUG),
                'all_items'             => __('Todas las Vehículos', parent::PLUGIN_SLUG),
                'add_new_item'          => __('Agregar Nuevo Vehículo', parent::PLUGIN_SLUG),
                'add_new'               => __('Agregar Nueva', parent::PLUGIN_SLUG),
                'new_item'              => __('Nuevo Vehículo', parent::PLUGIN_SLUG),
                'edit_item'             => __('Editar Vehículo', parent::PLUGIN_SLUG),
                'update_item'           => __('Actualizar Vehículo', parent::PLUGIN_SLUG),
                'view_item'             => __('Ver Vehículo', parent::PLUGIN_SLUG),
                'view_items'            => __('Ver Vehículo', parent::PLUGIN_SLUG),
                'search_items'          => __('Buscar Vehículo', parent::PLUGIN_SLUG),
                'not_found'             => __('No hay resultados', parent::PLUGIN_SLUG),
                'not_found_in_trash'    => __('No hay resultados en Papelera', parent::PLUGIN_SLUG),
                'featured_image'        => __('Imagen del Vehículo', parent::PLUGIN_SLUG),
                'set_featured_image'    => __('Colocar Imagen del Vehículo', parent::PLUGIN_SLUG),
                'remove_featured_image' => __('Remover Imagen del Vehículo', parent::PLUGIN_SLUG),
                'use_featured_image'    => __('Usar como Imagen del Vehículo', parent::PLUGIN_SLUG),
                'insert_into_item'      => __('Insertar en Vehículo', parent::PLUGIN_SLUG),
                'uploaded_to_this_item' => __('Cargado a este Vehículo', parent::PLUGIN_SLUG),
                'items_list'            => __('Listado de Vehículos', parent::PLUGIN_SLUG),
                'items_list_navigation' => __('Navegación del Listado de Vehículos', parent::PLUGIN_SLUG),
                'filter_items_list'     => __('Filtro del Listado de Vehículos', parent::PLUGIN_SLUG),
            );

            $args = array(
                'label'                 => __('Vehículos', parent::PLUGIN_SLUG),
                'description'           => __('Vehículos dentro de la empresa', parent::PLUGIN_SLUG),
                'labels'                => $labels,
                'supports'              => array('title', 'editor', 'thumbnail'),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'menu_icon'             => 'dashicons-car',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capabilities'          => self::SIGSEC_CAPABILITIES,
                'show_in_rest'          => false,
            );
            register_post_type('vehiculos', $args);
        }
    }

    new Sigsec_CPT_Class;
endif;
