<?php
/* PREVENT DIRECT ACCESS */
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * Sigsec Admin Dashboard Class
 *
 * @link http://www.robertochoaweb.com/casos/sigsec?utm_source=plugin&utm_medium=link&utm_content=sigsec
 *
 * @package sigsec
 */

if (!class_exists('Sigsec_Dashboard_Class')) :

    class Sigsec_Dashboard_Class extends Sigsec_Main_Class
    {
        public function __construct()
        {
            add_action('wp_dashboard_setup', array($this, 'add_dashboard_widget'));
            add_action('admin_notices',  array($this, 'general_admin_notice'));
            remove_action('welcome_panel', 'wp_welcome_panel');
            add_action('welcome_panel', array($this, 'st_welcome_panel'));
            add_action('admin_notices', array($this, 'my_custom_dashboard'));
        }

        public function my_custom_dashboard()
        {
            $screen = get_current_screen();
            if ($screen->base == 'dashboard') {
?>
                <style type="text/css">
                    div#wpcontent div.wrap {
                        display: none;
                    }

                    div#wpcontent div.my-dashboard {
                        display: block;
                    }
                </style>
                <div class="wrap my-dashboard">
                    <h2>Dashboard</h2>

                    <div id="welcome-panel" class="welcome-panel">
                        <?php wp_nonce_field('welcome-panel-nonce', 'welcomepanelnonce', false); ?>
                        <?php do_action('welcome_panel'); ?>
                    </div>

                    <div id="dashboard-widgets-wrap">
                        <?php wp_dashboard(); ?>
                        <div class="clear"></div>
                    </div><!-- dashboard-widgets-wrap -->

                </div><!-- wrap -->
            <?php
            }
        }


        public function st_welcome_panel()
        {
            ob_start();
            ?>
            <div class="custom-main-welcome-dashboard">
                <div class="custom-main-welcome-item">
                    <h2><?php _e('Fecha', parent::PLUGIN_SLUG); ?></h2>
                    <div class="custom-item-value">
                        <?php echo date('d-m-Y'); ?>
                    </div>
                </div>
                <div class="custom-main-welcome-item">
                    <h2><?php _e('Guardia / Turno', parent::PLUGIN_SLUG); ?></h2>
                    <div class="custom-item-value">
                        Fausto de Mingo <br />Jesús Dávila
                    </div>
                </div>
                <div class="custom-main-welcome-item">
                    <h2><?php _e('Nro de incidencia del día', parent::PLUGIN_SLUG); ?></h2>
                    <div class="custom-item-value custom-big-number">
                        01
                    </div>
                </div>
                <div class="custom-main-welcome-item">
                    <h2><?php _e('Novedades Activas', parent::PLUGIN_SLUG); ?></h2>
                    <div class="custom-item-value custom-big-number">
                        01
                    </div>
                </div>


            </div>
            <?php
            $content = ob_get_clean();
            echo $content;
        }



        public function general_admin_notice()
        {
            global $pagenow;
            if ($pagenow == 'options-general.php') {
                echo '<div class="notice notice-warning is-dismissible">
                     <p>This is an example of a notice that appears on the settings page.</p>
                 </div>';
            }
        }

        public function add_dashboard_widget()
        {
            global $wp_meta_boxes;

            wp_add_dashboard_widget('custom_latest_incidencias_widget', __('Últimas Incidencias', parent::PLUGIN_SLUG), array($this, 'custom_latest_incidencias'));
            wp_add_dashboard_widget('custom_pending_incidencias_widget', __('Incidencias Pendientes', parent::PLUGIN_SLUG), array($this, 'custom_pending_incidencias'));
        }

        public function custom_pending_incidencias()
        {
            ob_start();
            $arr_incidencias = new WP_Query(array('post_type' => 'incidencias', 'posts_per_page' => 8, 'order' => 'DESC', 'orderby' => 'date', 'meta_query' => array(array('key' => 'sig_check_cierre', 'value' => 'Yes', 'compare' => '!='))));
            if ($arr_incidencias->have_posts()) :
            ?>
                <table class="table-sigsec" cellspacing="0" cellpadding="0">
                    <tr>
                        <th>#</th>
                        <th><?php _e('Fecha/Hora', parent::PLUGIN_SLUG); ?></th>
                        <th><?php _e('Tipo', parent::PLUGIN_SLUG); ?></th>
                        <th><?php _e('Descripción', parent::PLUGIN_SLUG); ?></th>
                        <th><?php _e('Estatus', parent::PLUGIN_SLUG); ?></th>
                    </tr>

                    <?php
                    while ($arr_incidencias->have_posts()) : $arr_incidencias->the_post();
                        $arr_tipo = get_the_terms(get_the_ID(), 'tipos_incidencia');
                        $fecha = get_post_meta(get_the_ID(), 'sig_start_date', true);
                        $hora = get_post_meta(get_the_ID(), 'sig_start_time', true);
                    ?>
                        <tr>
                            <td><a onclick="showDetails(<?php echo get_the_ID(); ?>)"><?php echo get_the_ID(); ?></a></td>
                            <td><?php echo $fecha . '<br/>' . $hora; ?></td>
                            <td><?php foreach ($arr_tipo as $item) {
                                    echo $item->name;
                                } ?></td>
                            <td><?php echo get_the_title(); ?></td>
                            <td><span class="badge badge-danger">Pendiente</span></td>
                        </tr>
                        <tr id="details-<?php echo get_the_ID(); ?>">
                            <td colspan="5" class="custom-details-table hidden-table">
                                <h3><?php _e('Observaciones', parent::PLUGIN_SLUG); ?></h3>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'sig_observaciones', true)); ?>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>

                </table>
            <?php
            endif;
            wp_reset_query();
            ?>

            <?php
            $content = ob_get_clean();
            echo $content;
        }

        public function custom_latest_incidencias()
        {
            ob_start();
            $arr_incidencias = new WP_Query(array('post_type' => 'incidencias', 'posts_per_page' => 8, 'order' => 'DESC', 'orderby' => 'date'));
            if ($arr_incidencias->have_posts()) :
            ?>
                <table class="table-sigsec" cellspacing="0" cellpadding="0">
                    <tr>
                        <th>#</th>
                        <th><?php _e('Fecha/Hora', parent::PLUGIN_SLUG); ?></th>
                        <th><?php _e('Tipo', parent::PLUGIN_SLUG); ?></th>
                        <th><?php _e('Descripción', parent::PLUGIN_SLUG); ?></th>
                        <th><?php _e('Estatus', parent::PLUGIN_SLUG); ?></th>
                    </tr>

                    <?php
                    while ($arr_incidencias->have_posts()) : $arr_incidencias->the_post();
                        $arr_tipo = get_the_terms(get_the_ID(), 'tipos_incidencia');
                        $fecha = get_post_meta(get_the_ID(), 'sig_start_date', true);
                        $hora = get_post_meta(get_the_ID(), 'sig_start_time', true);
                    ?>
                        <tr>
                            <td><a onclick="showDetails(<?php echo get_the_ID(); ?>)"><?php echo get_the_ID(); ?></a></td>
                            <td><?php echo $fecha . '<br/>' . $hora; ?></td>
                            <td><?php foreach ($arr_tipo as $item) {
                                    echo $item->name;
                                } ?></td>
                            <td><?php echo get_the_title(); ?></td>
                            <td><span class="badge badge-danger">En Proceso</span></td>
                        </tr>
                        <tr id="details-<?php echo get_the_ID(); ?>">
                            <td colspan="5" class="custom-details-table hidden-table">
                                <h3><?php _e('Observaciones', parent::PLUGIN_SLUG); ?></h3>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'sig_observaciones', true)); ?>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>

                </table>
            <?php
            endif;
            wp_reset_query();
            ?>

<?php
            $content = ob_get_clean();
            echo $content;
        }
    }
endif;

new Sigsec_Dashboard_Class;
