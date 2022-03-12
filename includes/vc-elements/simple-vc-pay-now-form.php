<?php
  /**
   * Visual Composer element for a simple PAY NOW form
   */
  if ( ! defined( 'ABSPATH' ) ) { exit; }

  /**
   * Simple PAY NOW form Class
   */
  class credo_VC_Simple_Form {

    /**
     * Class Constructor
     */
    function __construct() {

      add_action( 'init', array( $this, 'credo_simple_form_mapping' ) );

    }

    /**
     * Visual Composer Form elements mapping
     *
     * @return void
     */
    public function credo_simple_form_mapping() {

      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
        return;
      }

      // Map the block with vc_map()
      vc_map(
        array(
          'name' => __('Credo Simple Form', 'credo-pay'),
          'base' => 'credo-pay-button',
          'description' => __('Credo Simple Pay Now Form', 'credo-pay'),
          'category' => __('Credo Forms', 'credo-pay'),
          'icon' => Credo_DIR_URL . 'assets/images/credo-icon.png',
          'params' => array(
            array(
              'type' => 'textfield',
              'class' => 'title-class',
              'holder' => 'p',
              'heading' => __( 'Amount', 'credo-pay' ),
              'param_name' => 'amount',
              'value' => __( '', 'credo-pay' ),
              'description' => __( 'If left blank, user will be asked to enter the amount to complete the payment.', 'credo-pay' ),
              'admin_label' => false,
              'weight' => 0,
              'group' => 'Form Attributes',
            ),

            array(
              'type' => 'checkbox',
              'heading' => __( "Use logged-in user's email?", 'credo-pay' ),
              'description' => __( "Check this if you want the logged-in user's email to be used. If unchecked or user is not logged in, they will be asked to fill in their email address to complete payment.", 'credo-pay' ),
              'param_name' => 'use_current_user_email',
              'std' => '',
              'value' => array(
                __( 'Yes', 'credo-pay' ) => 'yes'
              ),
              'group' => 'Form Attributes'
            ),

            array(
              'type' => 'textfield',
              'heading' => __( 'Button Text', 'credo-pay' ),
              'param_name' => 'content',
              'value' => __( '', 'credo-pay' ),
              'description' => __( '(Optional) The text on the PAY NOW button. Default: "PAY NOW"', 'credo-pay' ),
              'admin_label' => false,
              'weight' => 0,
              'group' => 'Form Attributes',
            ),

          )
        )
      );

    }

  }

  // Element Class Init
  new credo_VC_Simple_Form();
?>
