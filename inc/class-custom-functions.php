<?php
/* PREVENT DIRECT ACCESS */
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * Sigsec Custom Functions
 *
 * @link http://www.robertochoaweb.com/casos/sigsec?utm_source=plugin&utm_medium=link&utm_content=sigsec
 *
 * @package sigsec
 */

if (!class_exists('Sigsec_Functions_Class')) :

    class Sigsec_Functions_Class extends Sigsec_Main_Class
    {

        /**
         * Main Sub-Constructor.
         */
        public function __construct()
        {
            add_action('admin_head', array($this, 'custom_hide_menu'), 99);
            add_filter('manage_edit-tipos_incidencia_columns', array($this, 'add_priority_col'));
            add_filter('manage_edit-tipos_incidencia_sortable_columns', array($this, 'add_priority_col'));
            add_filter('manage_tipos_incidencia_custom_column',   array($this, 'manage_priority_col'), 10, 3);

            add_filter('manage_incidencias_posts_columns', array($this, 'set_custom_edit_incidencias_columns'));
            add_action('manage_incidencias_posts_custom_column', array($this, 'custom_incidencias_column'), 10, 2);
        }

        /**
         * REMOVE / HIDE MENU ON USERS
         */
        public function custom_hide_menu()
        {
            $user = wp_get_current_user();
            $allowed_roles = array('contributor', 'editor');
            if (array_intersect($allowed_roles, $user->roles)) {
                ob_start();
?>
                <style type='text/css'>
                    body.wp-admin #adminmenu #menu-posts {
                        display: none
                    }

                    body.wp-admin #adminmenu #menu-comments {
                        display: none
                    }

                    body.wp-admin #adminmenu #menu-tools {
                        display: none
                    }

                    body.wp-admin #adminmenu #menu-pages {
                        display: none
                    }
                </style>
                <?php
                $content = ob_get_clean();
                echo $content;
            }
        }

        public function add_priority_col($new_columns)
        {
            unset($new_columns['posts']);
            $new_columns['priority'] = 'Prioridad';
            return $new_columns;
        }
        public  function manage_priority_col($value, $name, $id)
        {
            $priority = get_term_meta($id, 'sig_priority', true);
            switch ($name) {
                case 'priority':
                    echo 'Prioridad ' . ucfirst($priority);
                    break;
                default:
                    break;
            }
        }



        public function set_custom_edit_incidencias_columns($columns)
        {
            unset($columns['date']);
            $columns['sig_check_cierre'] = __('Estatus', parent::PLUGIN_SLUG);
            $columns['prioridad'] = __('Prioridad', parent::PLUGIN_SLUG);

            return $columns;
        }

        public function custom_incidencias_column($column, $post_id)
        {
            switch ($column) {

                case 'prioridad':
                    $terms = get_the_terms($post_id, 'tipos_incidencia');
                    foreach ($terms as $item) {
                        $term_id = $item->term_id;
                    }
                    $priority = get_term_meta($term_id, 'sig_priority', true);
                    echo 'Prioridad ' . $priority;
                    break;

                case 'sig_check_cierre':
                    $cierre = get_post_meta($post_id, 'sig_check_cierre', true);
                    if ($cierre == 'yes') {
                ?>
                        <span class="badge badge-danger"><?php _e('Pendiente', parent::PLUGIN_SLUG); ?></span>
                    <?php
                    } else {
                    ?>
                        <span class="badge badge-success"><?php _e('Finalizado', parent::PLUGIN_SLUG); ?></span>
<?php
                    }
                    break;
            }
        }
    }




    new Sigsec_Functions_Class;
endif;
