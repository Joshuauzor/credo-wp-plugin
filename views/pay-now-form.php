<?php

if (!defined('ABSPATH')) {exit;}
$form_id = Credo_Pay::gen_rand_string();
if (!empty($atts['custom_currency'])) {
    if (preg_match('/^[a-z\d]* [a-z\d]*$/', $atts['custom_currency'])) {
        $currencies = explode(", ", $atts['custom_currency']);
    } else {
        $currencies = explode(",", $atts['custom_currency']);
    }
}
?>

<div>
  <form id="<?php echo esc_attr($form_id) ?>" class="credo-simple-pay-now-form" <?php echo esc_attr($data_attr); ?> >
    <div id="notice"></div>
    <?php if (empty($atts['email'])): ?>

      <label class="pay-now"><?php _e('Email', 'credo-pay')?></label>
      <input class="credo-form-input-text" id="credo-customer-email" type="email" placeholder="<?php _e('Email', 'credo-pay')?>" required /><br>

    <?php endif;?>

    <?php if (empty($atts['firstname'])): ?>

      <label class="pay-now"><?php _e('First Name', 'credo-pay')?> (Optional) </label>
      <input class="credo-form-input-text" id="credo-first-name" type="text" placeholder="<?php _e('First Name', 'credo-pay')?>" /><br>

    <?php endif;?>

    <?php if (empty($atts['lastname'])): ?>

      <label class="pay-now"><?php _e('Last Name', 'credo-pay')?> (Optional) </label>
      <input class="credo-form-input-text" id="credo-last-name" type="text" placeholder="<?php _e('Last Name', 'credo-pay')?>" /><br>

    <?php endif;?>

    <?php if (empty($atts['phone'])): ?>

      <label class="pay-now"><?php _e('Phone Number', 'credo-pay')?> (Optional) </label>
      <input class="credo-form-input-text" id="credo-phone" type="text" placeholder="<?php _e('Phone Number', 'credo-pay')?>" /><br>

    <?php endif;?>

    <?php if (empty($atts['amount'])): ?>

      <label class="pay-now"><?php _e('Amount', 'credo-pay');?></label>
      <input class="credo-form-input-text" id="credo-amount" type="text" placeholder="<?php _e('Amount', 'credo-pay');?>" required /><br>

    <?php endif;?>

    <?php if (empty($atts['currency'])): ?>
      <label class="pay-now"><?php _e('Currency', 'credo-pay');?></label>
      <?php if (!empty($atts['custom_currency'])) {?>

      <select class="credo-form-select" id="credo-currency" required>
        <?php foreach ($currencies as $currency): ?>
          <option value="<?php echo esc_html($currency) ?>"><?php echo esc_html($currency) ?></option>
        <?php endforeach;?>
      </select>

      <?php } else {?>


      <?php if ($atts['country'] == "NG"): ?>
        <select class="credo-form-select" id="credo-currency" required>
          <option value="NGN">NGN</option>
          <option value="USD">USD</option>
        </select>
      <?php endif;?>

      <?php if ($atts['country'] == "KE"): ?>
        <select class="credo-form-select" id="credo-currency" required>
          <option value="KES">KES</option>
        </select>
      <?php endif;?>

      <?php if ($atts['country'] == "UG"): ?>
        <select class="credo-form-select" id="credo-currency" required>
          <option value="UGX">KES</option>
        </select>
      <?php endif;?>

      <?php if ($atts['country'] == "GH"): ?>
        <select class="credo-form-select" id="credo-currency" required>
          <option value="GHS">GHS</option>
          <option value="USD">USD</option>
        </select>
      <?php endif;?>

      <?php if ($atts['country'] == "ZA"): ?>
        <select class="credo-form-select" id="credo-currency" required>
          <option value="ZAR">ZAR</option>
        </select>
      <?php endif;?>

      <?php if ($atts['country'] == "US"): ?>
        <select class="credo-form-select" id="credo-currency" required>
          <option value="NGN">NGN</option>
          <option value="USD">USD</option>
        </select>
      <?php endif;?>

        <?php
}?>

    <?php endif;?>
    <br>

    <?php wp_nonce_field('credo-pay-nonce', 'credo_sec_code');?>
    <button value="submit" class='credo-pay-now-button' href='#'><?php _e($btn_text, 'credo-pay')?></button>
  </form>
</div>
