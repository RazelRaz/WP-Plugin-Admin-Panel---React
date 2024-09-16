<?php

class Admin_Menu_SA_WP_Plugin_Settings_Menu {
  public function __construct() {
    add_action("admin_menu", array( $this,"admin_menu") );
    add_action("admin_enqueue_scripts", array( $this,"admin_enqueue_scripts"), );
    add_action("wp_ajax_rz_settings_post_view", array( $this,"rz_settings_post_view"), );
    add_action("wp_ajax_rz_settings_get_post_view", array( $this,"rz_settings_get_post_view"), );
  }

  public function admin_enqueue_scripts($hook) {
    // var_dump($hook);
    if ( 'toplevel_page_rz_settings' !== $hook ) {
      return;
    }


    wp_enqueue_style( 'wp-components' );

    $main_asset = require RA_ADMIN_PATH . 'assets/js/settings/main.asset.php';
    wp_enqueue_script( 'rz_settings', RA_ADMIN_URL . 'assets/js/settings/main.js', $main_asset['dependencies'], $main_asset['version'], array(
      'in_footer' => true
    )  );

    wp_localize_script( 'rz_settings', 'rzSettings', array(
      'ajaxUrl' => admin_url('admin-ajax.php'),
    ) );

  }

  public function admin_menu() {
    add_menu_page(
      'RZ Settings',
      'RZ Settings',
      'manage_options',
      'rz_settings',
      array( $this,'rz_settings_callback'),
      'dashicons-hammer',
      64,
    );

    add_submenu_page(
      'rz_settings',
      'QR Code Settings',
      'QR Code Settings',
      'manage_options',
      'rz_qr_code_settings',
      array( $this,'rz_settings_callback')
    );

  }

  public function rz_settings_callback(){
      echo '<div id="rz-settings-callback"></div>';
  }

  public function rz_settings_post_view() {
    // print_r($_POST);

    // TODO: Nonce need to be verified
    $data = array(
      'heading' => isset( $_POST['heading'] ) ? sanitize_text_field( $_POST['heading'] ) : '',
      'show' => isset( $_POST['show'] ) && 'on' == $_POST['show'] ? 1 : 0,
    );


    update_option( 'rz_settings_post_view', $data, false );


    wp_send_json_success();
  }


  public function rz_settings_get_post_view() {
    $data = get_option( 'rz_settings_post_view',  array() );

    wp_send_json_success( $data );
  }




}

