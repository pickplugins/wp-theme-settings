<?php
/*
Plugin Name: WP Theme Settings
Plugin URI: https://www.pickplugins.com/item/site-builder/?ref=dashboard
Description: Zero coding skill required to build your own WordPress site.
Version: 1.0.0
Text Domain: site-builder
Domain Path: /languages
Author: PickPlugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class wpThemeSettingsPlugin{

    public function __construct(){

        $this->define_constants();
        $this->declare_classes();
        $this->load_script();
        $this->load_functions();

        //register_activation_hook( __FILE__, array( $this, 'activation' ) );
        //add_action( 'plugins_loaded', array( $this, 'textdomain' ));

    }

    public function activation() {



    }

    public function textdomain() {

        $locale = apply_filters( 'plugin_locale', get_locale(), 'wp-theme-settings' );
        load_textdomain('wp-theme-settings', WP_LANG_DIR .'/wp-theme-settings/wp-theme-settings-'. $locale .'.mo' );
        load_plugin_textdomain( 'wp-theme-settings', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
    }



    public function load_functions() {

        require_once( PLUGIN_DIR . 'functions-settings.php');

    }


    public function load_script() {

        add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
        add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    }



    public function declare_classes() {

        require_once( PLUGIN_DIR . 'class-wp-theme-settings.php');


    }

    public function define_constants() {

        $this->define('PLUGIN_URL', plugins_url('/', __FILE__)  );
        $this->define('PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
        $this->define('PLUGIN_NAME', __('WP Theme Settings', 'site-builder') );
        $this->define('PLUGIN_SUPPORT', 'http://www.pickplugins.com/questions/'  );

    }

    private function define( $name, $value ) {
        if( $name && $value )
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
    }





    public function front_scripts(){



    }

    public function admin_scripts(){

        wp_enqueue_script('jquery');
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script('jquery-ui-datepicker');



    }


} new wpThemeSettingsPlugin();