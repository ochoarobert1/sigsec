<?php
/* PREVENT DIRECT ACCESS */
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * Sigsec Custom Metaboxes
 *
 * @link http://www.robertochoaweb.com/casos/sigsec?utm_source=plugin&utm_medium=link&utm_content=sigsec
 *
 * @package sigsec
 */

if (!class_exists('Sigsec_Metaboxes_Class')) :

    class Sigsec_Metaboxes_Class extends Sigsec_Main_Class
    {
        const PREFIX = 'sig_';
        /**
         * Main Sub-Constructor.
         */
        public function __construct()
        {
            add_action('cmb2_admin_init', array($this, 'register_custom_metabox'));
        }

        /**
         * REMOVE / HIDE MENU ON USERS
         */
        public function register_custom_metabox()
        {
            $cmb_term_metabox = new_cmb2_box(array(
                'id'            => self::PREFIX . 'term_metabox',
                'title'         => esc_html__('Prioridad', parent::PLUGIN_SLUG),
                'object_types'     => array('term'),
                'taxonomies'       => array('tipos_incidencia'),
            ));

            $cmb_term_metabox->add_field(array(
                'name'       => esc_html__('Seleccione la Prioridad', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Seleccionar entre las opciones', parent::PLUGIN_SLUG),
                'id'         => self::PREFIX . 'priority',
                'type'             => 'select',
                'show_option_none' => true,
                'default'          => 'baja',
                'options'          => array(
                    'baja' => __('Baja Prioridad', parent::PLUGIN_SLUG),
                    'media'   => __('Media Prioridad', parent::PLUGIN_SLUG),
                    'alta'     => __('Alta Prioridad', parent::PLUGIN_SLUG),
                    'critica'     => __('Prioridad Crítica', parent::PLUGIN_SLUG),
                )
            ));
        }
    }

    new Sigsec_Metaboxes_Class;
endif;
