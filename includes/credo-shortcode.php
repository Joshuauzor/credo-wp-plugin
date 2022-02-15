<?php
/**
 * Shortcode Class
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Credo_Shortcode')) {

    class Credo_Shortcode
    {

        /**
         * Class instance variable
         *
         * @var $instance
         */
        protected static $instance = null;

        public function __construct()
        {

            add_action('wp_enqueue_scripts', array($this, 'load_css_files'));
            add_shortcode('credo-pay-button', array($this, 'pay_button_shortcode'));

            // echo do_shortcode('$credo-pay-button');

        }

        /**
         * Get the instance of this class
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

        // public function test(){}

        /**
         * Generates Pay Now button from shortcode
         *
         * @param  array $attr Array of attributes from the shortcode
         *
         * @return string      Pay Now button html content
         */
        public function pay_button_shortcode($attr, $content = "")
        {
            global $admin_settings;

            if (!$admin_settings->is_public_key_present()) {
                return;
            }

            $btn_text = empty($content) ? $this->pay_button_text() : $content;
            $email = $this->use_current_user_email($attr) ? wp_get_current_user()->user_email : '';
            if (!empty($this->get_logo_url($attr))) {
                $attr['logo'] = $this->get_logo_url($attr);
            }

            $atts = shortcode_atts(array(
                'amount' => '',
                'currency' => [],
                'email' => $email,
                'country' => $admin_settings->get_option_value('country'),
                'currency' => $admin_settings->get_option_value('currency'),
                'recurring_payment' => $admin_settings->get_option_value('recurring_payment'),
                // 'paymentOptions' => [
                //     'CARD' => 'CARD',
                //     'BANK' => 'BANK',
                //     'USSD' => 'USSD',
                // ]
                'paymentOptions' => 'CARD',
            ), $attr);

            $this->load_js_files();

            ob_start();
            $this->render_payment_form($atts, $btn_text);
            $form = ob_get_contents();
            ob_end_clean();

            return $form;

        }

        public function render_payment_form($atts, $btn_text)
        {

            $data_attr = '';
            foreach ($atts as $att_key => $att_value) {

   
                $data_attr .= ' data-' . $att_key . '="' . $att_value . '"';
            }

            include Credo_DIR_PATH . 'views/pay-now-form.php';

        }

        /**
         * Loads javascript files
         *
         * @return void
         */
        public function load_js_files()
        {

            global $admin_settings;
            global $credo_pay_class;

            $args = array(
                'cb_url' => admin_url('admin-ajax.php'),
                'country' => $admin_settings->get_option_value('country'),
                'currency' => $admin_settings->get_option_value('currency'),
                'desc' => $admin_settings->get_option_value('modal_desc'),
                'logo' => $admin_settings->get_option_value('modal_logo'),
                'method' => $admin_settings->get_option_value('method'),
                'pbkey' => $admin_settings->get_option_value('public_key'),
                'title' => $admin_settings->get_option_value('modal_title'),
            );

            wp_enqueue_script('credo_inline_js', $credo_pay_class->get_inline_base_url() . 'inline.js', true);
            wp_enqueue_script('credo_js', Credo_DIR_URL . 'assets/js/credo.js', array('credo_inline_js', 'jquery'), true);

            wp_localize_script('credo_js', 'credo_options', $args);

        } 
        /**
         * Loads css files
         *
         * @return void
         */
        public function load_css_files()
        {

            global $admin_settings;

            if ('yes' !== $admin_settings->get_option_value('theme_style')) {
                wp_enqueue_style('credo_css', Credo_DIR_URL . 'assets/css/credo.css', false);
            }

        }

        /**
         * Get pay now button text
         *
         * @return string Button text
         */
        private function pay_button_text()
        {

            global $admin_settings;

            $text = $admin_settings->get_option_value('btn_text');
            if (empty($text)) {
                $text = 'PAY NOW';
            }

            return $text;

        }

        /**
         * Checks if the loggedin user email should be used
         *
         * @param  array $attr attributes from shortcode
         *
         * @return boolean
         */
        private function use_current_user_email($attr)
        {

            return isset($attr['use_current_user_email']) && $attr['use_current_user_email'] === 'yes';

        }

        private function get_logo_url($attr)
        {

            global $admin_settings;

            $logo = $admin_settings->get_option_value('modal_logo');
            if (!empty($attr['logo'])) {
                $logo = strpos($attr['logo'], 'http') != false ? $attr['logo'] : wp_get_attachment_url($attr['logo']);
            }

            return $logo;

        }

    }

}
