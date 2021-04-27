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

        /**
         * Main Sub-Constructor.
         */
        public function __construct()
        {
            add_action('init', array($this, 'create_incidencias_custom_post_types'));
            add_action('init', array($this, 'create_turnos_custom_post_types'));
            add_action('init', array($this, 'create_vehiculos_custom_post_types'));
            add_action('init', array($this, 'tipos_incidencia_custom_taxonomy'));
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
                'supports'              => array('title'),
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
                'capability_type'       => 'post',
                'show_in_rest'          => false,
            );
            register_post_type('incidencias', $args);
        }

        public function create_turnos_custom_post_types() {
        
            $labels = array(
                'name'                  => _x( 'Turnos', 'Post Type General Name', parent::PLUGIN_SLUG),
                'singular_name'         => _x( 'Turno', 'Post Type Singular Name', parent::PLUGIN_SLUG),
                'menu_name'             => __( 'Turnos', parent::PLUGIN_SLUG),
                'name_admin_bar'        => __( 'Turnos', parent::PLUGIN_SLUG),
                'archives'              => __( 'Archivo de Turnos', parent::PLUGIN_SLUG),
                'attributes'            => __( 'Atributos de Turno', parent::PLUGIN_SLUG),
                'parent_item_colon'     => __( 'Turno Padre:', parent::PLUGIN_SLUG),
                'all_items'             => __( 'Todos los Turnos', parent::PLUGIN_SLUG),
                'add_new_item'          => __( 'Agregar Nuevo Turno', parent::PLUGIN_SLUG),
                'add_new'               => __( 'Agregar Nuevo', parent::PLUGIN_SLUG),
                'new_item'              => __( 'Nuevo Turno', parent::PLUGIN_SLUG),
                'edit_item'             => __( 'Editar Turno', parent::PLUGIN_SLUG),
                'update_item'           => __( 'Actualizar Turno', parent::PLUGIN_SLUG),
                'view_item'             => __( 'Ver Turno', parent::PLUGIN_SLUG),
                'view_items'            => __( 'Ver Turnos', parent::PLUGIN_SLUG),
                'search_items'          => __( 'Buscar Turno', parent::PLUGIN_SLUG),
                'not_found'             => __( 'No hay resultados', parent::PLUGIN_SLUG),
                'not_found_in_trash'    => __( 'No hay resultados en Papelera', parent::PLUGIN_SLUG),
                'featured_image'        => __( 'Imagen Destacada', parent::PLUGIN_SLUG),
                'set_featured_image'    => __( 'Colocar Imagen Destacada', parent::PLUGIN_SLUG),
                'remove_featured_image' => __( 'Remover Imagen Destacada', parent::PLUGIN_SLUG),
                'use_featured_image'    => __( 'Usar como Imagen Destacada', parent::PLUGIN_SLUG),
                'insert_into_item'      => __( 'Insertar en Turno', parent::PLUGIN_SLUG),
                'uploaded_to_this_item' => __( 'Cargado a este Turno', parent::PLUGIN_SLUG),
                'items_list'            => __( 'Listado de Turnos', parent::PLUGIN_SLUG),
                'items_list_navigation' => __( 'Navegación del Listado de Turnos', parent::PLUGIN_SLUG),
                'filter_items_list'     => __( 'Filtro del Listado de Turnos', parent::PLUGIN_SLUG),
            );
            $args = array(
                'label'                 => __( 'Turno', parent::PLUGIN_SLUG),
                'description'           => __( 'Turnos de empleados', parent::PLUGIN_SLUG),
                'labels'                => $labels,
                'supports'              => array( 'title' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => true,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'show_in_rest'          => false,
            );
            register_post_type( 'turnos', $args );
        
        }

        /**
         * Creating vehiculos custom post types
         */
        public function create_vehiculos_custom_post_types()
        {
            /* CPT VEHICULOS */
            $labels2 = array(
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

            $args2 = array(
                'label'                 => __('Vehículos', parent::PLUGIN_SLUG),
                'description'           => __('Vehículos dentro de la empresa', parent::PLUGIN_SLUG),
                'labels'                => $labels2,
                'supports'              => array('title', 'thumbnail'),
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
                'capability_type'       => 'post',
                'show_in_rest'          => false,
            );
            register_post_type('vehiculos', $args2);
        }

        /**
         * Creating tipos vehiculos custom taxonomy
         */
        public function tipos_incidencia_custom_taxonomy()
        {
            $labels3 = array(
                'name'                       => _x('Tipos de Incidencia', 'Taxonomy General Name', parent::PLUGIN_SLUG),
                'singular_name'              => _x('Tipo de Incidencia', 'Taxonomy Singular Name', parent::PLUGIN_SLUG),
                'menu_name'                  => __('Tipos de Incidencia', parent::PLUGIN_SLUG),
                'all_items'                  => __('Todos los Tipos', parent::PLUGIN_SLUG),
                'parent_item'                => __('Tipo Padre', parent::PLUGIN_SLUG),
                'parent_item_colon'          => __('Tipo Padre:', parent::PLUGIN_SLUG),
                'new_item_name'              => __('Nuevo Tipo', parent::PLUGIN_SLUG),
                'add_new_item'               => __('Agregar Nuevo Tipo', parent::PLUGIN_SLUG),
                'edit_item'                  => __('Editar Tipo', parent::PLUGIN_SLUG),
                'update_item'                => __('Actualizar Tipo', parent::PLUGIN_SLUG),
                'view_item'                  => __('Ver Tipo', parent::PLUGIN_SLUG),
                'separate_items_with_commas' => __('Separar tipos por comas', parent::PLUGIN_SLUG),
                'add_or_remove_items'        => __('Agregar o Remover Tipos', parent::PLUGIN_SLUG),
                'choose_from_most_used'      => __('Escoger de los más usados', parent::PLUGIN_SLUG),
                'popular_items'              => __('Tipos Populares', parent::PLUGIN_SLUG),
                'search_items'               => __('Buscar Tipos', parent::PLUGIN_SLUG),
                'not_found'                  => __('No hay resultados', parent::PLUGIN_SLUG),
                'no_terms'                   => __('No hay tipos', parent::PLUGIN_SLUG),
                'items_list'                 => __('Listado de Tipos', parent::PLUGIN_SLUG),
                'items_list_navigation'      => __('Navegación del Listado de Tipos', parent::PLUGIN_SLUG),
            );
            $args3 = array(
                'labels'                     => $labels3,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
            );
            register_taxonomy('tipos_incidencia', array('incidencias'), $args3);
        }
    }
endif;

new Sigsec_CPT_Class;
