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
            add_action('init', array($this, 'create_custom_post_types'), 99);
        }

        /**
         * Creating admin custom post types
         */
        public function create_custom_post_types()
        {
        }
    }

    new Sigsec_CPT_Class;
endif;
