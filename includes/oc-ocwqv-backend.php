<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWQV_admin_menu')) {

  class OCWQV_admin_menu {

    protected static $OCWQV_instance;

  function OCWQV_submenu_page() {
   add_submenu_page( 'woocommerce', 'Quick View', 'Quick View', 'manage_options', 'quick-view',array($this, 'OCWQV_callback'));
  }
  function OCWQV_callback() {
    ?>    
        <div class="wrap">
            <h2><u>Quick View</u></h2>
            <?php if($_REQUEST['message'] == 'success'){ ?>
                <div class="notice notice-success is-dismissible"> 
                    <p><strong>Record updated successfully.</strong></p>
                </div>
            <?php } ?>
        </div>
        <div class="ocwqv-container">
            <form method="post" >
              <?php wp_nonce_field( 'ocwqv_nonce_action', 'ocwqv_nonce_field' ); ?>   
                <div id="wfc-tab-general" class="tab-content current">
                    <div class="cover_div">
                        <table class="ocwqv_data_table">
                                    <h2>Quick View Button Style</h2>
                            <tr>
                                <th>Button Title</th>
                                <td>
                                    <input type="text" name="ocwqv_head_title" value="<?php if(!empty(get_option( 'ocwqv_head_title' ))){ echo get_option( 'ocwqv_head_title' ); }else{ echo "Quick View";} ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Font size</th>
                                <td>
                                    <input type="text" name="ocwqv_font_size" value="<?php if(!empty(get_option( 'ocwqv_font_size' ))){ echo get_option( 'ocwqv_font_size' ); }else{ echo "15";} ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Font color</th>
                                <td>
                                    <input type="color" name="ocwqv_font_clr" value="<?php if(!empty(get_option( 'ocwqv_font_clr' ))){ echo get_option( 'ocwqv_font_clr' ); }else{ echo "#ffffff";} ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Background Color</th>
                                <td>
                                    <input type="color" name="ocwqv_btn_bg_clr" value="<?php if(!empty(get_option( 'ocwqv_btn_bg_clr' ))){ echo get_option( 'ocwqv_btn_bg_clr' ); }else{ echo "#000000";} ?>">

                                </td>
                            </tr>
                            <tr>
                              <th>Button Position</th>
                                <td>
                                    <input type="radio" name="ocwqv_rd_btn_pos" value="before_add_cart" <?php if (get_option( 'ocwqv_rd_btn_pos' ) == "before_add_cart" ) {echo 'checked="checked"';} ?>>Before Add To Cart</br>
                                    <input type="radio" name="ocwqv_rd_btn_pos" value="after_add_cart" <?php if (get_option( 'ocwqv_rd_btn_pos' ) == "after_add_cart" || empty(get_option( 'ocwqv_rd_btn_pos' ))) {echo 'checked="checked"';} ?>>After Add To Cart
                                </td>
                            </tr>
                            <tr>
                              <th>Button Padding</th>
                                <td>
                                    <input type="text" name="ocwqv_btn_padding" value="<?php if(!empty(get_option( 'ocwqv_btn_padding' ))){ echo get_option( 'ocwqv_btn_padding' ); }else{ echo "8px 10px";} ?>">
                                    <span>give value in px(ex.6px 8px)</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="cover_div">
                     <h2>Display Setting</h2>
                        <div class="ocwqv_cover_div">
                            <table class="ocwqv_data_table">
                                <tr>
                                    <th>Product single page</th>
                                    <td>
                                        <input type="checkbox" name="ocwqv_sin_pro_page" value="yes" <?php if (get_option( 'ocwqv_sin_pro_page' ) == "yes" || empty(get_option( 'ocwqv_sin_pro_page' ))) {echo 'checked="checked"';} ?>>
                                        <strong>Add Quick View Button On single Product Page.</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Product catalogue page</th>
                                    <td>
                                        <input type="checkbox" name="ocwqv_shop_page" value="yes" <?php if (get_option( 'ocwqv_shop_page' ) == "yes" || empty(get_option( 'ocwqv_shop_page' ))) {echo 'checked="checked"';} ?>>
                                        <strong>Add Quick View Button On Shop & Catalogue Product Page.</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Product</th>
                                    <td>
                                        <input type="radio" name="ocwqv_rd_dis_pro" value="outofstock" <?php if (get_option( 'ocwqv_rd_dis_pro' ) == "outofstock" ) {echo 'checked="checked"';} ?>>Only For Out Of Stock</br>
                                        <input type="radio" name="ocwqv_rd_dis_pro" value="all" <?php if (get_option( 'ocwqv_rd_dis_pro' ) == "all" || empty(get_option( 'ocwqv_rd_dis_pro' ))) {echo 'checked="checked"';} ?>>For All Product
                                    </td>
                                </tr>
                              
                            </table>
                        </div>
                    </div>
                    <div class="cover_div">
                     <h2>General Setting</h2>
                        <div class="ocwqv_cover_div">
                            <table class="ocwqv_data_table">
                                <tr>
                                    <th>Enable on mobile</th>
                                    <td>
                                        <input type="checkbox" name="ocwqv_mbl_btn" value="yes" <?php if (get_option( 'ocwqv_mbl_btn' ) == "yes" || empty(get_option( 'ocwqv_mbl_btn' ))) {echo 'checked="checked"';} ?>>
                                        <span>Quick button on mobile </span>         
                                    </td> 
                                </tr> 
                                <tr>
                                    <th>Enable quick button</th>
                                    <td>
                                        <input type="checkbox" name="ocwqv_quk_btn" value="yes" <?php if (get_option( 'ocwqv_quk_btn' ) == "yes" || empty(get_option( 'ocwqv_quk_btn' ))) {echo 'checked="checked"';} ?>>
                                        
                                    </td> 
                                </tr> 
                            </table>
                        </div>        
                    </div>
                <input type="hidden" name="action" value="ocwqv_save_option">
                <input type="submit" value="Save changes" name="submit" class="button-primary" id="wfc-btn-space">
            </form>  
        </div>
    <?php
    }
    function OCWQV_save_options(){
        if( current_user_can('administrator') ) { 
            if($_REQUEST['action'] == 'ocwqv_save_option'){
                if(!isset( $_POST['ocwqv_nonce_field'] ) || !wp_verify_nonce( $_POST['ocwqv_nonce_field'], 'ocwqv_nonce_action' ) ){
                    print 'Sorry, your nonce did not verify.';
                    exit;
                }else{
                     $sin_page = (!empty(sanitize_text_field( $_REQUEST['ocwqv_sin_pro_page'] )))? sanitize_text_field( $_REQUEST['ocwqv_sin_pro_page'] ) : 'no';
                    update_option('ocwqv_sin_pro_page', $sin_page, 'yes');
                    $shop_page = (!empty(sanitize_text_field( $_REQUEST['ocwqv_shop_page'] )))? sanitize_text_field( $_REQUEST['ocwqv_shop_page'] ) : 'no';
                    update_option('ocwqv_shop_page', $shop_page, 'yes');
                    $mbl_btn = (!empty(sanitize_text_field( $_REQUEST['ocwqv_mbl_btn'] )))? sanitize_text_field( $_REQUEST['ocwqv_mbl_btn'] ) : 'no';
                    update_option('ocwqv_mbl_btn', $mbl_btn, 'yes');
                    $quk_btn = (!empty(sanitize_text_field( $_REQUEST['ocwqv_quk_btn'] )))? sanitize_text_field( $_REQUEST['ocwqv_quk_btn'] ) : 'no';
                    update_option('ocwqv_quk_btn', $quk_btn, 'yes');
                    update_option('ocwqv_rd_dis_pro', sanitize_text_field( $_REQUEST['ocwqv_rd_dis_pro'] ), 'yes');
                    update_option('ocwqv_head_title', sanitize_text_field( $_REQUEST['ocwqv_head_title'] ), 'yes');
                    update_option('ocwqv_font_clr',  sanitize_text_field( $_REQUEST['ocwqv_font_clr'] ), 'yes');
                    update_option('ocwqv_font_size', sanitize_text_field( $_REQUEST['ocwqv_font_size'] ), 'yes');
                    update_option('ocwqv_btn_bg_clr',sanitize_text_field( $_REQUEST['ocwqv_btn_bg_clr'] ), 'yes');
                    update_option('ocwqv_rd_btn_pos', sanitize_text_field( $_REQUEST['ocwqv_rd_btn_pos'] ),'yes');
                    update_option('ocwqv_btn_padding',sanitize_text_field( $_REQUEST['ocwqv_btn_padding']),'yes');
                }
            }
        }
    }
     function init() {
        add_action( 'admin_menu',  array($this, 'OCWQV_submenu_page'));
        add_action( 'init',  array($this, 'OCWQV_save_options'));
    }
    public static function OCWQV_instance() {
      if (!isset(self::$OCWQV_instance)) {
        self::$OCWQV_instance = new self();
        self::$OCWQV_instance->init();
      }
      return self::$OCWQV_instance;
    }
  }
  OCWQV_admin_menu::OCWQV_instance();
}

