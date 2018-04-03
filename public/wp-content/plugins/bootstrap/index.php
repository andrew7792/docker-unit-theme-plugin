<?php
/*
Plugin Name: Include Bootstrap
Plugin URI: http://my-site.org/plugins/bootstrap-include/
Description: This is a plugin included Bootstrap to theme
Author: Andrew7792
Version: 1.0
Author URI: http://localhost/
*/
 add_action( 'wp_enqueue_scripts',  'load_bootstrap_scripts'  );
     function load_bootstrap_scripts(){
             wp_enqueue_style( 'bootstrap-styles', plugin_dir_url( __FILE__ ) . 'css/bootstrap.css' );
             wp_enqueue_script('jquery');
     };
