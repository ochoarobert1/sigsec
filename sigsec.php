<?php
/*
* Plugin Name: Sigsec - Administrador de Seguridad
* Plugin URI: http://www.robertochoaweb.com/casos/sigsec?utm_source=plugin&utm_medium=link&utm_content=sigsec
* Description: Plugin para gestión de seguridad interna en D1.
* Plugin Date: 15-03-2021
* Version: 1.0.0
* Author: Robert Ochoa
* Author URI: http://www.robertochoaweb.com/casos/sigsec?utm_source=plugin&utm_medium=link&utm_content=sigsec
* License: GNU General Public License v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: sigsec
* Domain Path: /languages
* Requires at least: 5.2
* Requires PHP: 7.3.1

    Copyright 2021 Robert Ochoa (email : ochoa.robert1@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* PREVENT DIRECT ACCESS */
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/** Display verbose errors */
if (!defined('IMPORT_DEBUG')) {
    define('IMPORT_DEBUG', WP_DEBUG);
}

if (!class_exists('Sigsec_Main_Class')) :
    class Sigsec_Main_Class
    {
        const PLUGIN_SLUG = 'sigsec';
        const PLUGIN_VERSION = '1.0.0';

        /**
         * Main Constructor.
         */
        public function __construct()
        {
            /* ADMIN ENQUEUE SCRIPTS / STYLES */
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts_styles'), 99);
        }

        /**
         * Main enqueue scripts / styles.
         */
        public function admin_enqueue_scripts_styles()
        {
            wp_enqueue_script(self::PLUGIN_SLUG . '-admin-script', plugins_url('/js/sigsec-admin-script.js', __FILE__), array('jquery'), self::PLUGIN_VERSION, true);
            wp_enqueue_style(self::PLUGIN_SLUG . '-google-fonts', 'https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700;900&display=swap', false, self::PLUGIN_VERSION, 'all');
            wp_enqueue_style(self::PLUGIN_SLUG . '-admin-style', plugins_url('/css/sigsec-admin-style.css', __FILE__), false, self::PLUGIN_VERSION, 'all');
        }

        
    }

    new Sigsec_Main_Class;
endif;
