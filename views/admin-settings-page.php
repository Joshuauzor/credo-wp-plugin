<?php

  if ( ! defined( 'ABSPATH' ) ) { exit; }

?>
<?php global $admin_settings; ?>

  <div class="wrap">
    <h1>Credo Payment Forms Settings</h1>
    <form id="credo-pay" action="options.php" method="post" enctype="multipart/form-data">
      <?php settings_fields( 'credo-settings-group' ); ?>
      <?php do_settings_sections( 'credo-settings-group' ); ?>
      <table class="form-table">
        <tbody>

          <!-- Public Key -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[public_key]"><?php _e( 'Pay Button Public Key', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[public_key]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'public_key' ) ); ?>" />
              <p class="description">Your Pay Button public key</p>
            </td>
          </tr>
          <!-- Secret Key -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[secret_key]"><?php _e( 'Pay Button Secret Key', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[secret_key]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'secret_key' ) ); ?>" />
              <p class="description">Your Pay Button secret key</p>
            </td>
          </tr>

          <!-- Switch to Live -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[go_live]"><?php _e( 'Go Live', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-checkbox">
              <fieldset>
                <?php $go_live = esc_attr( $admin_settings->get_option_value( 'go_live' ) ); ?>
                <label>
                  <input type="checkbox" name="credo_options[go_live]" <?php checked( $go_live, 'yes' ); ?> value="yes" />
                  <?php _e( 'Switch to live account', 'credo-pay' ); ?>
                </label>
              </fieldset>
            </td>
          </tr>
          <!-- Method -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[method]"><?php _e( 'Payment Method', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <select class="regular-text code" name="credo_options[method]">
                <?php $method = esc_attr( $admin_settings->get_option_value( 'method' ) ); ?>
                <option value="both" <?php selected( $method, 'both' ) ?>>Card and Account</option>
              
              </select>
              <p class="description">(Optional) default: Card and Account</p>
            </td>
          </tr>
      
          
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[modal_title]"><?php _e( 'Modal Title', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[modal_title]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'modal_title' ) ); ?>" />
              <p class="description">(Optional) default: Credo PAY</p>
            </td>
          </tr>
          <!-- Modal Description -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[modal_desc]"><?php _e( 'Modal Description', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[modal_desc]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'modal_desc' ) ); ?>" />
              <p class="description">(Optional) default: Credo PAY MODAL</p>
            </td>
          </tr>
          <!-- Modal Logo -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[modal_logo]"><?php _e( 'Modal Logo', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[modal_logo]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'modal_logo' ) ); ?>" />
              <p class="description">(Optional) - Full URL (with 'http') to the custom logo. default: Credo logo</p>
            </td>
          </tr>
          <!-- Successful Redirect URL -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[success_redirect_url]"><?php _e( 'Success Redirect URL', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[success_redirect_url]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'success_redirect_url' ) ); ?>" />
              <p class="description">(Optional) Full URL (with 'http') to redirect to for successful transactions. default: ""</p>
            </td>
          </tr>
          <!-- Failed Redirect URL -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[failed_redirect_url]"><?php _e( 'Failed Redirect URL', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[failed_redirect_url]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'failed_redirect_url' ) ); ?>" />
              <p class="description">(Optional) Full URL (with 'http') to redirect to for failed transactions. default: ""</p>
            </td>
          </tr>
          <!-- Pay Button Text -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[btn_text]"><?php _e( 'Pay Button Text', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <input class="regular-text code" type="text" name="credo_options[btn_text]" value="<?php echo esc_attr( $admin_settings->get_option_value( 'btn_text' ) ); ?>" />
              <p class="description">(Optional) default: PAY NOW</p>
            </td>
          </tr>
          <!-- Currency -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[currency]"><?php _e( 'Charge Currency', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <select class="regular-text code" name="credo_options[currency]">
                <?php $currency = esc_attr( $admin_settings->get_option_value( 'currency' ) ); ?>
                <option value="" <?php selected($currency, '') ?>>Any (Let Customer decide or use Shortcode)</option>
                <option value="NGN" <?php selected($currency, 'NGN') ?>>NGN</option>
              </select>
              <p class="description">(Optional) default: NGN</p>
            </td>
          </tr>
          <!-- Country -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[country]"><?php _e( 'Charge Country', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-text">
              <select class="regular-text code" name="credo_options[country]">
                <?php $country = esc_attr( $admin_settings->get_option_value( 'country' ) ); ?>
                <option value="NG" <?php selected( $country, 'NG' ) ?>>NG: Nigeria</option>
              
              </select>
              <p class="description">(Optional) default: NG</p>
            </td>
          </tr>

          <!-- Styling -->
          <tr valign="top">
            <th scope="row">
              <label for="credo_options[theme_style]"><?php _e( 'Form Style', 'credo-pay' ); ?></label>
            </th>
            <td class="forminp forminp-checkbox">
              <fieldset>
                <?php $theme_style = esc_attr( $admin_settings->get_option_value( 'theme_style' ) ); ?>
                <label>
                  <input type="checkbox" name="credo_options[theme_style]" <?php checked( $theme_style, 'yes' ); ?> value="yes" />
                  <?php _e( 'Use default theme style', 'credo-pay' ); ?>
                </label>
                <p class="description">Override the form style and use the default theme's style</p>
              </fieldset>
            </td>
          </tr>

        </tbody>
      </table>
      <?php submit_button(); ?>
    </form>

  </div>
