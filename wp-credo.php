<?php
  /*
  Plugin Name: Credo Payment Forms
  Plugin URI: http://credocentral.com/
  Description: Credo payment gateway forms, accept local and international payments securely.
  Version: 1.0.2
  Author: Godswill Adie, Joshua Uzor
  Author URI: https://twitter.com/joshuauzor
  Copyright: © 2016 Credo 
  License: MIT License
  */

  // if ( ! defined( 'ABSPATH' ) ) {
  //   exit;
  // }

  if ( ! defined( 'credo_PAY_PLUGIN_FILE' ) ) {
    define( 'credo_PAY_PLUGIN_FILE', __FILE__ );
  }

  // Plugin folder path
  if ( ! defined( 'Credo_DIR_PATH' ) ) {
    define( 'Credo_DIR_PATH', plugin_dir_path( __FILE__ ) );
  }

  //Plugin folder path
  if ( ! defined( 'Credo_DIR_URL' ) ) {
    define( 'Credo_DIR_URL', plugin_dir_url( __FILE__ ) );
  }

  require_once( Credo_DIR_PATH . 'includes/credo-base-class.php' );

  global $credo_pay_class;

  $credo_pay_class = Credo_Pay::get_instance();

?>
