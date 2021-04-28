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
            add_action('cmb2_admin_init', array($this, 'register_custom_metabox_taxonomy'));
            add_action('cmb2_admin_init', array($this, 'register_custom_metabox_incidencias'));
            add_action('cmb2_admin_init', array($this, 'register_custom_metabox_turnos'));
            add_action('cmb2_admin_init', array($this, 'register_custom_metabox_vehiculos'));
        }

        /**
         * CUSTOM METABOXES FOR INCIDENCIAS
         */
        public function register_custom_metabox_vehiculos()
        {
            $cmb_vehiculos_metabox = new_cmb2_box(array(
                'id'            => self::PREFIX . 'vechiulos_main_metabox',
                'title'         => esc_html__('Información Principal', parent::PLUGIN_SLUG),
                'object_types'  => array('vehiculos'),
                'context'       => 'normal',
                'priority'      => 'high',
                'classes'       => parent::PLUGIN_SLUG . '-cmb2-wrapper',
                'cmb_styles'    => false
            ));

            $cmb_vehiculos_metabox->add_field(array(
                'id'         => self::PREFIX . 'marca',
                'name'       => esc_html__('Marca', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Escriba la Marca del Vehiculo', parent::PLUGIN_SLUG),
                'type'    => 'text_medium'
            ));

            $cmb_vehiculos_metabox->add_field(array(
                'id'         => self::PREFIX . 'modelo',
                'name'       => esc_html__('Modelo', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Escriba el Modelo del Vehiculo', parent::PLUGIN_SLUG),
                'type'    => 'text_medium'
            ));

            $cmb_vehiculos_metabox->add_field(array(
                'id'         => self::PREFIX . 'placa',
                'name'       => esc_html__('Placa', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Escriba la placa del Vehiculo', parent::PLUGIN_SLUG),
                'type'    => 'text_medium'
            ));

            $cmb_vehiculos_metabox->add_field(array(
                'id'         => self::PREFIX . 'color',
                'name'       => esc_html__('Color', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Escriba el color del Vehiculo', parent::PLUGIN_SLUG),
                'type'    => 'text_medium'
            ));

            $cmb_vehiculos_metabox->add_field(array(
                'id'         => self::PREFIX . 'check_vehiculo_d1',
                'name'       => esc_html__('¿Este vehiculo es de la Corporación?', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Activar solo si en la vehiculo pertenece a la organizacion', parent::PLUGIN_SLUG),
                'type'    => 'checkbox'
            ));
        }

        /**
         * CUSTOM METABOXES FOR INCIDENCIAS
         */
        public function register_custom_metabox_incidencias()
        {
            global $wpdb;

            $post_id = 0;
            $current_turno = '';
            $date = new DateTime("now", new DateTimeZone('America/Caracas') );
            $str = $date->format('d') . '-' . $date->format('m') . '-' . $date->format('Y');
            
            $mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '".$str."%' ");
            foreach ($mypostids as $ids) {
                $post_id = (int) $ids;
            }
            $current_turno = get_post_meta($post_id, 'sig_turno', true);
            
            $cmb_incidencias_metabox = new_cmb2_box(array(
                'id'            => self::PREFIX . 'incidencias_metabox',
                'title'         => esc_html__('Información Principal', parent::PLUGIN_SLUG),
                'object_types'  => array('incidencias'),
                'context'       => 'normal',
                'priority'      => 'high',
                'classes'       => parent::PLUGIN_SLUG . '-cmb2-wrapper',
                'cmb_styles'    => false
            ));

            $cmb_incidencias_metabox->add_field(array(
                'name'       => esc_html__('Fecha de Inicio', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Seleccione la Fecha de Inicio', parent::PLUGIN_SLUG),
                'id'         => self::PREFIX . 'start_date',
                'type' => 'text_date',
                'date_format' => 'd-m-Y',
                'attributes' => array(
                    'required' => 'required',
                ),
            ));

            $cmb_incidencias_metabox->add_field(array(
                'name'       => esc_html__('Hora de Inicio', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Seleccione la Hora de Inicio', parent::PLUGIN_SLUG),
                'id'         => self::PREFIX . 'start_time',
                'type' => 'text_time',
                'attributes' => array(
                    'required' => 'required',
                    'data-timepicker' => json_encode(array(
                        'timeOnlyTitle' => __('Escoger Hora y Minutos', parent::PLUGIN_SLUG),
                        'timeFormat' => 'HH:mm',
                        'stepMinute' => 1
                    )),
                ),
                'time_format' => 'h:i A',
            ));

            $cmb_incidencias_metabox->add_field(array(
                'id'         => self::PREFIX . 'turno',
                'name'       => esc_html__('Turno / Guardia', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Escriba quienes estaban de guardia en el momento de la incidencia', parent::PLUGIN_SLUG),
                'type'    => 'text_medium',
                'attributes' => array(
                    'required' => 'required',
                    'value' => $current_turno
                )
            ));

            $cmb_incidencias_metabox->add_field(array(
                'id'         => self::PREFIX . 'observaciones',
                'name'       => esc_html__('Observaciones', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Ingrese una descripción de la incidencia', parent::PLUGIN_SLUG),
                'type'    => 'wysiwyg',
                'options' => array(
                    'wpautop' => true,
                    'media_buttons' => false,
                    'textarea_rows' => get_option('default_post_edit_rows', 3),
                    'teeny' => false
                ),
            ));

            $cmb_incidencias_galerias_metabox = new_cmb2_box(array(
                'id'            => self::PREFIX . 'incidencias_gallery_metabox',
                'title'         => esc_html__('Información de Galería', parent::PLUGIN_SLUG),
                'object_types'  => array('incidencias'),
                'context'       => 'normal',
                'priority'      => 'high',
                'classes'       => parent::PLUGIN_SLUG . '-cmb2-wrapper',
                'cmb_styles'    => false
            ));

            $cmb_incidencias_galerias_metabox->add_field(array(
                'id'         => self::PREFIX . 'gallery',
                'name'       => esc_html__('(OPCIONAL) Galería de Imágenes', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Cargue o Seleccione un listado de imagenes correspondiente a esta incidencia', parent::PLUGIN_SLUG),
                'type'    => 'file_list',
                'preview_size' => array(100, 100),
                'query_args' => array('type' => 'image'),
                'text' => array(
                    'add_upload_files_text' => __('Agregar Imágenes', parent::PLUGIN_SLUG),
                    'remove_image_text' => __('Remover Imagen', parent::PLUGIN_SLUG),
                    'file_text' => __('Imagen', parent::PLUGIN_SLUG),
                    'file_download_text' => __('Descargar', parent::PLUGIN_SLUG),
                    'remove_text' => __('Remover', parent::PLUGIN_SLUG)
                )
            ));


            $cmb_incidencias_vehiculo_metabox = new_cmb2_box(array(
                'id'            => self::PREFIX . 'incidencias_vehiculo_metabox',
                'title'         => esc_html__('Información de Transporte', parent::PLUGIN_SLUG),
                'object_types'  => array('incidencias'),
                'context'       => 'normal',
                'priority'      => 'high',
                'classes'       => parent::PLUGIN_SLUG . '-cmb2-wrapper',
                'cmb_styles'    => false
            ));

            $cmb_incidencias_vehiculo_metabox->add_field(array(
                'id'         => self::PREFIX . 'check_vehiculo',
                'name'       => esc_html__('¿Esta implicado un vehiculo?', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Activar solo si en la incidencia esta involucrado un vehiculo', parent::PLUGIN_SLUG),
                'type'    => 'checkbox'
            ));

            $arr_vehiculos = array();
            $arr_query_vehiculos = new WP_Query(array('post_type' => 'vehiculos', 'posts_per_page' => -1));
            if ($arr_query_vehiculos->have_posts()) :
                while ($arr_query_vehiculos->have_posts()) : $arr_query_vehiculos->the_post();
            $arr_vehiculos[get_the_ID()] = get_the_title();
            endwhile;
            endif;
            wp_reset_query();

            $cmb_incidencias_vehiculo_metabox->add_field(array(
                'name'    => 'Vehiculo(s) implicados',
                'id'      => self::PREFIX . 'vehiculos',
                'desc'    => 'Seleccione el/los vehiculos relacionados con la incidencia.',
                'type'    => 'pw_multiselect',
                'options' => $arr_vehiculos
            ));


            $cmb_incidencias_close_metabox = new_cmb2_box(array(
                'id'            => self::PREFIX . 'incidencias_close_metabox',
                'title'         => esc_html__('Estatus de Incidencia', parent::PLUGIN_SLUG),
                'object_types'  => array('incidencias'),
                'context'       => 'side',
                'priority'      => 'high',
                'classes'       => parent::PLUGIN_SLUG . '-cmb2-wrapper ' . parent::PLUGIN_SLUG . '-cmb2-close-incidencia',
                'cmb_styles'    => false
            ));

            $cmb_incidencias_close_metabox->add_field(array(
                'id'         => self::PREFIX . 'status',
                'name'       => esc_html__('Estatus Actual', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Seleccionar el estatus actual', parent::PLUGIN_SLUG),
                'type'             => 'select',
                'show_option_none' => true,
                'default'          => 'pendiente',
                'options'          => array(
                    'abierta'   => __('Abierta', parent::PLUGIN_SLUG),
                    'pendiente' => __('Pendiente', parent::PLUGIN_SLUG),
                    'proceso'     => __('En Proceso', parent::PLUGIN_SLUG),
                    'cerrado'     => __('Cerrado', parent::PLUGIN_SLUG)
                )
            ));

            $cmb_incidencias_close_metabox->add_field(array(
                'id'         => self::PREFIX . 'check_cierre',
                'name'       => esc_html__('¿Esta incidencia esta cerrada?', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Activar solo si esta incidencia esta cerrada / finalizada', parent::PLUGIN_SLUG),
                'type'    => 'checkbox'
            ));

            $cmb_incidencias_close_metabox->add_field(array(
                'name'       => esc_html__('Fecha de Cierre', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Seleccione la Fecha de Cierre', parent::PLUGIN_SLUG),
                'id'         => self::PREFIX . 'end_date',
                'type' => 'text_date',
                'date_format' => 'd-m-Y'
            ));

            $cmb_incidencias_close_metabox->add_field(array(
                'name'       => esc_html__('Hora de Cierre', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Seleccione la Hora de Cierre', parent::PLUGIN_SLUG),
                'id'         => self::PREFIX . 'end_time',
                'type' => 'text_time',
                'attributes' => array(
                    'data-timepicker' => json_encode(array(
                        'timeOnlyTitle' => __('Escoger Hora y Minutos', parent::PLUGIN_SLUG),
                        'timeFormat' => 'HH:mm',
                        'stepMinute' => 1
                    )),
                ),
                'time_format' => 'h:i A'
            ));
        }

        /**
         * CUSTOM METABOXES FOR TAXONOMY
         */
        public function register_custom_metabox_taxonomy()
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

        public function register_custom_metabox_turnos()
        {
            $cmb_turnos_metabox = new_cmb2_box(array(
                'id'            => self::PREFIX . 'turnos_metabox',
                'title'         => esc_html__('Información Principal', parent::PLUGIN_SLUG),
                'object_types'  => array('turnos'),
                'context'       => 'normal',
                'priority'      => 'high',
                'classes'       => parent::PLUGIN_SLUG . '-cmb2-wrapper',
                'cmb_styles'    => false
            ));

            $cmb_turnos_metabox->add_field(array(
                'id'         => self::PREFIX . 'turno',
                'name'       => esc_html__('Turno / Guardia', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Escriba los auxiliares de seguridad operativos para el dia', parent::PLUGIN_SLUG),
                'type'    => 'text_medium'
            ));

            $cmb_turnos_metabox->add_field(array(
                'id'         => self::PREFIX . 'datos_adicionales',
                'name'       => esc_html__('Datos Adicionales', parent::PLUGIN_SLUG),
                'desc'       => esc_html__('Ingrese data adicional (observaciones - numeros de telefonos - etc)', parent::PLUGIN_SLUG),
                'type'    => 'textarea'
            ));
        }
    }


endif;

new Sigsec_Metaboxes_Class;
