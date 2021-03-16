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
        }

        /**
         * REMOVE / HIDE MENU ON USERS
         */
        public function custom_hide_menu()
        {
            $user = wp_get_current_user();
            $allowed_roles = array('contributor');
            if (array_intersect($allowed_roles, $user->roles)) {
                ob_start();
?>
                <style type="text/css">
                    body.wp-admin #adminmenu #menu-posts {
                        display: none
                    }

                    body.wp-admin #adminmenu #menu-comments {
                        display: none
                    }

                    body.wp-admin #adminmenu #menu-tools {
                        display: none
                    }
                </style>
<?php
                $content = ob_get_clean();
                echo $content;
            }
        }
    }

    new Sigsec_Functions_Class;
endif;
