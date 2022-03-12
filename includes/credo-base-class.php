<?php
/**
 * Credo base class
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Credo_Pay')) {

    /**
     * Main Plugin Class
     */
    class Credo_Pay
    {

        private $plugin_name = 'credo-payment-forms';
        private $inline_base_url = 'https://credocentral.com/';

        private $api_base_url = 'https://credo-js.nugitech.com/';

        private $verify_base_url = 'https://api.credocentral.com/credo-payment/v1';

        /**
         * Instance variable
         * @var $instance
         */
        protected static $instance = null;

        /**
         * Class constructor
         */
        public function __construct()
        {

            $this->_include_files();
            $this->_init();

            add_action('admin_notices', array($this, 'admin_notices'));

            add_action('wp_ajax_process_payment', array($this, 'process_payment'));
            add_action('wp_ajax_nopriv_process_payment', array($this, 'process_payment'));

        }

        /**
         * Includes all required files
         *
         * @return void
         */
        private function _include_files()
        {

            require_once Credo_DIR_PATH . 'includes/credo-shortcode.php';
            require_once Credo_DIR_PATH . 'includes/credo-admin-settings.php';
            require_once Credo_DIR_PATH . 'includes/credo-payment-list-class.php';
            require_once Credo_DIR_PATH . 'includes/vc-elements/simple-vc-pay-now-form.php';

            if (is_admin()) {
                require_once Credo_DIR_PATH . 'includes/credo-tinymce-plugin-class.php';
            }

        }

        /**
         * Initialize all the included classe
         *
         * @return void
         */
        private function _init()
        {

            global $admin_settings;
            global $payment_list;

            new Credo_Shortcode;

            $admin_settings = Credo_Admin_Settings::get_instance();
            $payment_list = Credo_Payment_List::get_instance();

            if (is_admin()) {
                Credo_Tinymce_Plugin::get_instance();
            }

            if ($admin_settings->get_option_value('go_live') === 'yes') {
                $this->api_base_url = 'https://credo-js.nugitech.com/';
            }

        }

        /**
         * Exposes the api base url
         *
         * @return string credo api base url
         */
        public function get_api_base_url()
        {

            return $this->api_base_url;

        }

        /**
         * Exposes the inline script base url
         *
         * @return string credo inline base url
         */
        public function get_inline_base_url()
        {

            return $this->inline_base_url;

        }

        /**
         * Adds admin settings page to the dashboard
         *
         * @return void
         */
        public function admin_notices()
        {

            $options = get_option('credo_options');
            $no_public_key = (bool) (!array_key_exists('public_key', $options) || empty($options['public_key']));
            $no_secret_key = (bool) (!array_key_exists('secret_key', $options) || empty($options['secret_key']));

            if ($no_secret_key || $no_public_key) {
                echo '<div class="updated"><p>';
                echo __('Credo payment form plugin is installed. - ', 'credo-pay');
                echo "<a href=" . esc_url(add_query_arg('page', $this->plugin_name, admin_url('admin.php'))) . " class='button-primary'>" . __('Enter your Credo "Pay Checkout" Public Key and Secret Key to start accepting payments', 'credo') . "</a>";
                echo '</p></div>';
            }

        }

        /**
         * Processes payment record information
         *
         * @return void
         */
        public function process_payment()
        {

            global $admin_settings;
            check_ajax_referer('credo-pay-nonce', 'credo_sec_code');

            $credo_ref = sanitize_text_field($_POST['credo_ref']);

            $secret_key = $admin_settings->get_option_value('secret_key');
   

            $txn = $this->_fetchTransaction($credo_ref, $secret_key);

            if (!empty($txn->id) && $this->_is_successful($txn)) {
                if ($txn->paymentStatus->name == 'Successful') {
                    $status = 'success';
                }
                $args = array(
                    'post_type' => 'payment_list',
                    'post_status' => 'publish',
                    'post_title' => $credo_ref,
                );

                $payment_record_id = wp_insert_post($args, true);

                if (!is_wp_error($payment_record_id)) {

                    $post_meta = array(
                        '_credo_payment_amount' => $txn->totalAmount,
                        '_credo_payment_fullname' => $txn->customerName, 
                        '_credo_payment_customer' => $txn->customerEmail,
                        '_credo_payment_status' => $status,
                        '_credo_payment_tx_ref' => $credo_ref,
                    );

                    $this->_add_post_meta($payment_record_id, $post_meta);

                }
            }
            $redirect_url_key = $status === 'success' ? 'success_redirect_url' : 'failed_redirect_url';

            echo json_encode(array('status' => $status, 'redirect_url' => $admin_settings->get_option_value($redirect_url_key)));
            die();

        }

        public static function gen_rand_string($len = 4)
        {

            if (version_compare(PHP_VERSION, '5.3.0') <= 0) {
                return substr(md5(rand()), 0, $len);
            }
            return bin2hex(openssl_random_pseudo_bytes($len / 2));

        }

        /**
         * Fetches transaction from credo enpoint
         *
         * @param $tx_ref string the transaction to fetch
         *
         * @return string
         */
        private function _fetchTransaction($credo_ref, $sckey)
        {

            $url = $this->verify_base_url . '/transactions' . '/' . $credo_ref . '/verify';
            $args = array(
                'headers' => array(
                    'Authorization' => $sckey,
                    'Accept' => 'application/json'
                )
            );
            $response = wp_remote_get( $url, $args );
            $body = wp_remote_retrieve_body( $response );
            $res = json_decode($body);

            if ($res->paymentStatus->name == 'Successful') {
                return $res;
            } else {
                return 400;
            }

        }

     

        /**
         * Checks if payment is successful
         *
         * @param $data object the transaction object to do the check on
         *
         * @return boolean
         */
        private function _is_successful($data)
        {

            return $data->paymentStatus->name === 'Successful' || $data->approvalStatus->name === 'Accepted';

        }

        /**
         * Adds metadata to payment list post type
         *
         * @param [int]   $post_id  The ID of the post to add metadata to
         * @param [array] $data     Collection of the data to be added to the post
         */
        private function _add_post_meta($post_id, $data)
        {

            foreach ($data as $meta_key => $meta_value) {
                update_post_meta($post_id, $meta_key, $meta_value);
            }

        }

        /**
         * Gets the instance of this class
         *
         * @return object the single instance of this class
         */
        public static function get_instance()
        {

            if (null == self::$instance) {
                self::$instance = new self;
            }

            return self::$instance;

        }

    }

}
