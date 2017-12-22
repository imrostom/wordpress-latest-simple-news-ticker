<?php
/*
Plugin Name: Latest Simple News Ticker
Plugin URI:  https://github.com/rostomali/latest-simple-news-ticker
Description: A Simple Wordpress News Ticker Plugin.
Version:     1.0
Author:      Rostom Ali
Author URI:  https://imrostom.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


//Add Plugin File Here

include('lib/simpleTicker-shortcode.php');
include('lib/simpleTicker-option-page.php');

//Add Here Plugin FrontEnd Css And Js File

function simpleTicker_plugin_files(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('simpleTicker_js',plugins_url('js/jquery.simpleTicker.js',__FILE__));
}
add_action('wp_enqueue_scripts','simpleTicker_plugin_files');

//Add Here Plugin Admin Panel Css And Js File

function simpleTicker_plugin_files_color(){
	wp_enqueue_style( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-script',plugins_url('js/color.script.js',__FILE__));
}
add_action('admin_enqueue_scripts','simpleTicker_plugin_files_color');





