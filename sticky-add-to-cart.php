<?php
/**
 Plugin Name:   Sticky Add to Cart
 Plugin URI:    spider-soft.co
 Description:   Show sticky add to cart at the bottom on mobile screen. Also included add to wishlist and social media chat (coming soon).
 Version:       1.0.0
 Author:        Spider Soft
 Author URI:    spider-soft.co/about-us
 WC tested up to: current
 License:       GPL2
 Text Domain:   sticky-add-to-cart
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit; //prevent access file directly
}

//Check Woocommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins',
get_option( 'active_plugins' ) ) ) ) {

        //front end actions
        if( wp_is_mobile() ){
            add_action( 'init', 'sticky_atc_remove_add_to_cart');
        }

        function sticky_atc_remove_add_to_cart(){
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        }

        function sticky_atc_action() {
            sticky_atc_btn(); ?>
            <style type="text/css">
                .sticky_atc_btn form.cart{margin:0;text-align:center;}
                .sticky_atc_btn .wrapper-content{padding:10px;}
                .sticky_atc_btn .wrapper-content button{width:100%;max-width:200px;margin-bottom:5px;padding:10px;}
                .sticky_atc_btn .wrapper-content button i{margin-right:8px;}

                .sticky_atc_btn {
                    width:100%;height:auto;margin:0;
                    position:fixed;top:inherit;bottom:0;left:0;z-index:1000;
                    -webkit-box-shadow:0 0 2px rgba(0, 0, 0, 0.2);
                    -moz-box-shadow:0 0 2px rgba(0, 0, 0, 0.2);
                    box-shadow:0 0 2px rgba(0, 0, 0, 0.2);
                }

                .yith-wcwl-add-to-wishlist{display: none;}
                .product-single .entry-summary .single_add_to_cart_button span, .sticky_atc_btn .single_add_to_cart_button span{border:0;}
                .product-single .entry-summary .single_add_to_cart_button span i:before, .sticky_atc_btn .single_add_to_cart_button span i:before{font-family:"Quicksan";content:'\e116';font-size:14px;}
            </style>
            <?php
        };
        add_action( 'woocommerce_before_single_product', 'sticky_atc_action', 10 );


        function sticky_atc_btn() {
          if( wp_is_mobile() ){ ?>
                  <div class="sticky_atc_btn">
                      <div class="wrapper-content">
                          <div class="sticky_atc_btn-row">
                              <?php woocommerce_simple_add_to_cart(); ?>
                          </div>
                      </div>
                  </div>
                  <script type="text/javascript">
                      jQuery("div.quantity").attr("style","display:none;");
                  </script><?php
          }
        }

    }
