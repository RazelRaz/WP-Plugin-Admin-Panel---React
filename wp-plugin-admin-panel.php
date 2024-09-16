<?php
/*
 * Plugin Name:       WP Plugin Admin Panel
 * Description:       This is a basic Plugin
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Razel Ahmed
 * Author URI:        https://razelahmed.com
 */

class Rz_Wp_Plugin_Admin_Settings_Panel {
  private static $instance;
  public static function getInstance() {

    //if there is no instance
    if ( ! self::$instance ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct() {
    $this->register_constants();
    $this->require_classes();
  }

  private function require_classes() {

    require_once __DIR__ ."/includes/settings-menu.php";

    new Admin_Menu_SA_WP_Plugin_Settings_Menu();
  }

  private function register_constants() {
    define( 'RA_ADMIN_URL', plugin_dir_url(__FILE__) );
    define( 'RA_ADMIN_PATH', plugin_dir_path(__FILE__) );
  }


}

Rz_Wp_Plugin_Admin_Settings_Panel::getInstance();
 