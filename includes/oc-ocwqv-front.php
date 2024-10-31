<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWQV_front')) {

    class OCWQV_front {

      protected static $instance;
      function craete_btn_mobile(){
        $ocwqv_object = get_queried_object();
        $id = $ocwqv_object->ID;
        $product = wc_get_product( $id );
        if(get_option('ocwqv_quk_btn')=="yes"){
          if(wp_is_mobile()){
            if(get_option( 'ocwqv_mbl_btn' ) == "yes") {
              if(get_option( 'ocwqv_sin_pro_page' ) == "yes"){
                if(is_product()){
                  if(get_option( 'ocwqv_rd_btn_pos' ) == "after_add_cart" ){
                    if(get_option( 'ocwqv_rd_dis_pro' ) == "outofstock"){
                      if( ! $product->is_in_stock()){
                          add_action('woocommerce_product_meta_start', array( $this, 'ocwqv_create_button' ));
                      } 
                    }else{
                      if( ! $product->is_in_stock()){
                          add_action('woocommerce_product_meta_start', array( $this, 'ocwqv_create_button' ),0);
                      }else{
                          add_action('woocommerce_after_add_to_cart_form', array( $this, 'ocwqv_create_button' ));
                      }      
                    }   
                  }elseif(get_option( 'ocwqv_rd_btn_pos' ) == "before_add_cart"){
                    if(get_option( 'ocwqv_rd_dis_pro' ) == "outofstock"){
                      if( ! $product->is_in_stock()){
                          add_action('woocommerce_single_product_summary', array( $this, 'ocwqv_create_button' ));
                      } 
                    }else{   
                      if( ! $product->is_in_stock()){
                          add_action('woocommerce_single_product_summary', array( $this, 'ocwqv_create_button' ));
                      }else{
                        if ( $product->is_type( 'variable' ) ) {
                            add_action('woocommerce_single_variation', array( $this, 'ocwqv_create_button' ));
                        }else{
                            add_action('woocommerce_before_add_to_cart_form',array( $this, 'ocwqv_create_button' ));
                        }
                      }      
                    }
                  }
                }
              }
              if(get_option( 'ocwqv_shop_page' ) == "yes") {
                if(is_shop() || $ocwqv_object->taxonomy == "product_cat"){
                  if(get_option( 'ocwqv_rd_btn_pos' ) == "after_add_cart" ){
                      add_action('woocommerce_after_shop_loop_item', array( $this, 'ocwqv_create_button_shop' ), 11);
                  }elseif(get_option( 'ocwqv_rd_btn_pos' ) == "before_add_cart"){
                      add_action('woocommerce_after_shop_loop_item', array( $this, 'ocwqv_create_button_shop' ), 9);
                  }
                }
              } 
            } 
          }else{
            if(get_option( 'ocwqv_sin_pro_page' ) == "yes"){
                if(is_product()){
                    if(get_option( 'ocwqv_rd_btn_pos' ) == "after_add_cart" ){
                        if(get_option( 'ocwqv_rd_dis_pro' ) == "outofstock"){
                            if( ! $product->is_in_stock()){
                                add_action('woocommerce_product_meta_start', array( $this, 'ocwqv_create_button' ));
                            } 
                        }else{
                            if( ! $product->is_in_stock()){
                                add_action('woocommerce_product_meta_start', array( $this, 'ocwqv_create_button' ),0);
                            }else{
                                add_action('woocommerce_after_add_to_cart_form', array( $this, 'ocwqv_create_button' ));
                            }      
                        }   
                    }elseif(get_option( 'ocwqv_rd_btn_pos' ) == "before_add_cart"){
                        if(get_option( 'ocwqv_rd_dis_pro' ) == "outofstock"){
                            if( ! $product->is_in_stock()){
                                add_action('woocommerce_single_product_summary', array( $this, 'ocwqv_create_button' ));
                            } 
                        }else{   
                            if( ! $product->is_in_stock()){
                                add_action('woocommerce_single_product_summary', array( $this, 'ocwqv_create_button' ));
                            }else{
                                if ( $product->is_type( 'variable' ) ) {
                                    add_action('woocommerce_single_variation', array( $this, 'ocwqv_create_button' ));
                                }else{
                                    add_action('woocommerce_before_add_to_cart_form', array( $this, 'ocwqv_create_button' ));
                                }  
                            }      
                        }
                    }
                }
            }
            if(get_option( 'ocwqv_shop_page' ) == "yes") {
              if(is_shop() || $ocwqv_object->taxonomy == "product_cat"){
                if(get_option( 'ocwqv_rd_btn_pos' ) == "after_add_cart" ){
                    add_action('woocommerce_after_shop_loop_item', array( $this, 'ocwqv_create_button_shop' ), 11);
                }elseif(get_option( 'ocwqv_rd_btn_pos' ) == "before_add_cart"){
                    add_action('woocommerce_after_shop_loop_item', array( $this, 'ocwqv_create_button_shop' ), 9);
                }
              }
            }
          }
        }
      } 

      
      function ocwqv_create_button_shop(){
        $proID = get_the_ID();
        $product = wc_get_product( $proID ); 
        
        if(get_option( 'ocwqv_rd_dis_pro' ) == "outofstock"){
                if( ! $product->is_in_stock()){
                    ?>
                    <div class="quickview_btn_div">
                        <button class="form_option" data-id="<?php echo $proID; ?>" proname="<?php echo $product->get_title(); ?>" style="background-color: <?php echo get_option( 'ocwqv_btn_bg_clr' ) ?>; color: <?php echo get_option( 'ocwqv_font_clr' ) ?>; padding: <?php echo get_option( 'ocwqv_btn_padding' )?>; font-size: <?php echo get_option( 'ocwqv_font_size' )."px" ?>;"><?php echo get_option( 'ocwqv_head_title' );?></button>
                    </div>
                    
                    <?php
                } 
            }else{
                ?>
                <div class="quickview_btn_div">
                    <button class="form_option" data-id="<?php echo $proID; ?>" proname="<?php echo $product->get_title(); ?>" style="background-color: <?php echo get_option( 'ocwqv_btn_bg_clr' ) ?>; color: <?php echo get_option( 'ocwqv_font_clr' ) ?>; padding: <?php echo get_option( 'ocwqv_btn_padding' )?>; font-size: <?php echo get_option( 'ocwqv_font_size' )."px" ?>;"><?php echo get_option( 'ocwqv_head_title' );?></button>
                </div>    
                <?php   
            } 
      }


      function ocwqv_create_button(){
        $proID = get_the_ID();
        $product = wc_get_product( $proID );  
       ?>
            <div class="quickview_btn_div">
                <button class="form_option" data-id="<?php echo $proID; ?>" proname="<?php echo $product->get_title(); ?>" style="background-color: <?php echo get_option( 'ocwqv_btn_bg_clr' ) ?>;color: <?php echo get_option( 'ocwqv_font_clr' ) ?>; padding:<?php echo get_option('ocwqv_btn_padding' )?>; font-size: <?php echo get_option( 'ocwqv_font_size' )."px" ?>;"><?php echo get_option( 'ocwqv_head_title' ); ?>
                </button>
            </div> 
        <?php
      }


      function ocwqv_popup_div_footer(){
        ?>
        <div id="quickview_popup" class="quickview_popup_class">
        </div>
        <?php
      }


      function popup_open1() {
          $product_id =  sanitize_text_field ($_REQUEST['popup_id_pro']);
          $params = array('p' => $product_id,
          'post_type' => array('product','product_variation'));
          $query = new WP_Query($params);
          if($query->have_posts()){
            while ($query->have_posts()){
              $query->the_post();
              echo '<div class="quickview_modal-content">';
              echo '<span class="quickview_close">&times;</span>';
              echo '<div class="quickview_image">';
              echo  the_post_thumbnail('thumbnail');
              echo '</div>';
              echo '<div class="quickview_summaary">';
              do_action( 'woocommerce_single_product_summary' );
              echo '</div>';
              echo '</div>';
            }
          }
          wp_reset_postdata();
          die();                                 
      }


      function init() {
        add_action('wp_head', array( $this, 'craete_btn_mobile' ));
        add_action('wp_footer', array( $this, 'ocwqv_popup_div_footer' ));
        add_action('wp_ajax_productscomments', array( $this, 'popup_open1' ));
        add_action('wp_ajax_nopriv_productscomments', array( $this, 'popup_open1'));
      }


      public static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
      }
    }
 OCWQV_front::instance();
}