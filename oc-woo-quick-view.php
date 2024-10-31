  
<?php
/**
 * Plugin Name: Quick View Woocommerce
 * Description: This plugin allows create to product quick view.
 * Version: 1.0
 * Author: Ocean Infotech
 * Author URI: https://www.xeeshop.com
 * Copyright: 2019 
 */
if (!defined('ABSPATH')) {
  die('-1');
}
if (!defined('OCWQV_PLUGIN_NAME')) {
  define('OCWQV_PLUGIN_NAME', 'Woo Call Price');
}
if (!defined('OCWQV_PLUGIN_VERSION')) {
  define('OCWQV_PLUGIN_VERSION', '1.0.0');
}
if (!defined('OCWQV_PLUGIN_FILE')) {
  define('OCWQV_PLUGIN_FILE', __FILE__);
}
if (!defined('OCWQV_PLUGIN_DIR')) {
  define('OCWQV_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('OCWQV_DOMAIN')) {
  define('OCWQV_DOMAIN', 'ocwcp');
}
if (!defined('OCWQV_BASE_NAME')) {
define('OCWQV_BASE_NAME', plugin_basename(OCWQV_PLUGIN_FILE));
}

//Main class  
if (!class_exists('OCWQV')) {

  class OCWQV {

    protected static $OCWQV_instance;
           /**
       * Constructor.
       *
       * @version 3.2.3
       */
    //Load required js,css and other files
    function __construct() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        //check plugin activted or not
        add_action('admin_init', array($this, 'OCWQV_check_plugin_state'));
    }

    //Add JS and CSS on Backend
    function OCWQV_load_admin_script_style() {
      wp_enqueue_style( 'OCWQV_admin_css', OCWQV_PLUGIN_DIR . '/css/admin_style.css', false, '1.0.0' );
    }


    function OCWQV_load_script_style() {
      wp_enqueue_style( 'OCWQV_front_css', OCWQV_PLUGIN_DIR . '/css/style.css', false, '1.0.0' );
      wp_enqueue_script( 'OCWQV_front_js', OCWQV_PLUGIN_DIR . '/js/front.js', false, '1.0.0' );
      wp_localize_script( 'OCWQV_front_js', 'ajax_url', admin_url('admin-ajax.php') );
      $translation_array_img = OCWQV_PLUGIN_DIR;
      
      wp_localize_script( 'OCWQV_front_js', 'object_name', $translation_array_img );
    }


    function OCWQV_show_notice() {

        if ( get_transient( get_current_user_id() . 'ocwqverror' ) ) {

          deactivate_plugins( plugin_basename( __FILE__ ) );

          delete_transient( get_current_user_id() . 'ocwqverror' );

          echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';

        }
    }


    function OCWQV_check_plugin_state(){
      if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
        set_transient( get_current_user_id() . 'ocwqverror', 'message' );
      }
    }


    function init() {
      add_action('admin_notices', array($this, 'OCWQV_show_notice'));
      add_action('admin_enqueue_scripts', array($this, 'OCWQV_load_admin_script_style'));
      add_action('wp_enqueue_scripts',  array($this, 'OCWQV_load_script_style'));
      add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
    }

    function plugin_row_meta( $links, $file ) {
        if (OCWQV_BASE_NAME === $file ) {
            $row_meta = array(
                'rating'    =>  '<a href="#" target="_blank"><img src="'.OCWQV_PLUGIN_DIR.'/images/star.png" class="OCWQV_rating_div"></a>',
            );

            return array_merge( $links, $row_meta );
        }

        return (array) $links;
    }


    //Load all includes files
    function includes() {
      //Admn site Layout
      include_once('includes/oc-ocwqv-backend.php');
      //Custom Functions
      include_once('includes/oc-ocwqv-front.php');
      //Add Option backend on product page
      /*include_once('includes/ocwcp-admin-product.php');*/
    }


    //Plugin Rating
    public static function OCWQV_do_activation() {
      set_transient('ocwcp-first-rating', true, MONTH_IN_SECONDS);
    }


    public static function OCWQV_instance() {
      if (!isset(self::$OCWQV_instance)) {
        self::$OCWQV_instance = new self();
        self::$OCWQV_instance->init();
        self::$OCWQV_instance->includes();
      }
      return self::$OCWQV_instance;
    }
  }
  add_action('plugins_loaded', array('OCWQV', 'OCWQV_instance'));

  register_activation_hook(OCWQV_PLUGIN_FILE, array('OCWQV', 'OCWQV_do_activation'));
}

	