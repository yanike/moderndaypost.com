<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Ultra Seven
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function ultra_seven_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ultra_seven_woocommerce_setup' );



/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function ultra_seven_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'ultra_seven_woocommerce_active_body_class' );


/* WooCommerce Action and filter ADD and REMOVE Section */

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
function ultra_seven_woocommerce_template_loop_product_thumbnail(){ ?>
    <div class="item-img">          
        
        <?php global $post, $product; if ( $product->is_on_sale() ) : 
            echo apply_filters( 'woocommerce_sale_flash', '<div class="new-label new-top-right">' . esc_html__( 'Sale!', 'ultra-seven' ) . '</div>', $post, $product ); // WPCS: XSS OK.?>
        <?php endif; ?>
        <?php
            global $product_label_custom;
            if ($product_label_custom != ''){
                echo '<div class="new-label new-top-left">'.$product_label_custom.'</div>';// WPCS: XSS OK.
            }

        ?>

        <a class="product-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <?php echo woocommerce_get_product_thumbnail();// WPCS: XSS OK. ?>
        </a>  
        <div class="box-hover-home">
          <ul class="add-to-links">
            <li><?php woocommerce_template_loop_add_to_cart(); ?></li>
            <li><?php if(function_exists( 'ultra_seven_quickview' )) { ultra_seven_quickview(); } ?></li>
            <li><?php if(function_exists( 'ultra_seven_wishlist_products' )) { ultra_seven_wishlist_products(); } ?></li>
          </ul>
        </div> 

    </div>
<?php 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'ultra_seven_woocommerce_template_loop_product_thumbnail', 9 );


/* Product Block Title Area */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
function ultra_seven_woocommerce_template_loop_product_title(){ 
 ?>
    <div class="block-item-title">
      <h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </div>
<?php }
add_action( 'woocommerce_shop_loop_item_title', 'ultra_seven_woocommerce_template_loop_product_title', 10 );

/* Product Add to Cart and View Details */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Woo Commerce Number of row filter Function
**/
add_filter('loop_shop_columns', 'ultra_seven_loop_columns');
if (!function_exists('ultra_seven_loop_columns')) {
    function ultra_seven_loop_columns() {
        $xr = get_theme_mod('ultra_woo_column',3);
        return $xr;
    }
}

add_action( 'body_class', 'ultra_seven_woo_body_class');
if (!function_exists('ultra_seven_woo_body_class')) {
    function ultra_seven_woo_body_class( $class ) {
           $class[] = 'columns-'.ultra_seven_loop_columns();
           return $class;
    }
}

/**
 * Woo Commerce Number of Columns filter Function
**/
function ultra_seven_product_perpage(){
  $perpage = get_theme_mod('ultra_seven_product_perpage','9');
  return $perpage;
}
 
add_filter( 'loop_shop_per_page', 'ultra_seven_product_perpage', 20 );

/**
 * Woo Commerce Related Products filter Function
**/
add_filter( 'woocommerce_output_related_products_args', 'ultra_seven_related_products_args' );
  function ultra_seven_related_products_args( $args ) {
  $sidebar = get_theme_mod('ultra_shop_sidebar_layout','rightsidebar');
  if($sidebar != 'nosidebar'){
    $per_page = 3;
  }else{
    $per_page = 4;
  }
  $args['posts_per_page'] = $per_page; // 4 related products
  //$args['columns'] = 3; // arranged in 2 columns
  return $args;
}

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'ultra_seven_woocommerce_wrapper_before' ) ) {
  /**
   * Before Content.
   *
   * Wraps all WooCommerce content in wrappers which match the theme markup.
   *
   * @return void
   */
  function ultra_seven_woocommerce_wrapper_before() {
    ?>
    <?php 
    $sidebar = get_theme_mod('ultra_shop_sidebar_layout','rightsidebar');
    if($sidebar!="nosidebar"){
      $sidebar .= ' with-sidebar';
    }
    ?>
    <div class="ultra-container <?php echo esc_attr($sidebar);?> clearfix">
      <?php ultra_seven_breadcrumbs(); ?>
    <div class="primary content-area">
      <main id="main" class="site-main" role="main">
    <?php
  }
}
add_action( 'woocommerce_before_main_content', 'ultra_seven_woocommerce_wrapper_before' );


if ( ! function_exists( 'ultra_seven_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function ultra_seven_woocommerce_wrapper_after() {
		?>
  			</main><!-- #main -->
  		</div><!-- .primary -->
      <?php get_sidebar(); ?>
    </div><!-- #container -->    
<?php
	}
}
add_action( 'woocommerce_after_main_content', 'ultra_seven_woocommerce_wrapper_after' );


remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


/**
 * Header Shopping Cart function 
**/
if ( class_exists('woocommerce') ) {

    if ( ! function_exists( 'ultra_seven_header_cart' ) ) {
       function ultra_seven_header_cart(){ ?>
            <a class="cart-contentsone" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'ultra-seven' ); ?>">
               <div class="count">
                   <i class="fa fa-shopping-cart"></i>
                   <span class="cart-count"><?php echo wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) ); ?></span>
               </div>                                      
           </a>
       <?php
       }
    }

    if ( ! function_exists( 'ultra_seven_cart_fragments' ) ) {

        function ultra_seven_cart_fragments( $fragments ) {
            global $woocommerce;
            ob_start();
            ultra_seven_header_cart();
            $fragments['a.cart-contentsone'] = ob_get_clean();
            return $fragments;
        }
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'ultra_seven_cart_fragments' );
}

/**
 *  Add the Link to Quick View Function
**/

if( defined( 'YITH_WCQV' ) ){
    function ultra_seven_quickview(){
        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
        $label = esc_html( get_option( 'yith-wcqv-button-label' ) );
        echo '<a href="#" class="link-quickview yith-wcqv-button" data-product_id="' . get_the_ID() . '">' . esc_attr($label) . '</a>';
    }
}

/**
 ** Product Wishlist Button Function
**/
if (defined( 'YITH_WCWL' )) { 

    function ultra_seven_wishlist_products() {      
          global $product;
          $url = add_query_arg( 'add_to_wishlist', get_the_ID() );
          $id = get_the_ID();
          $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?> 

            <div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">
                
                <div class="yith-wcwl-add-button show" style="display:block">
                    <a href="<?php echo esc_url( $url ); ?>" data-toggle="tooltip" data-placement="top" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" title="<?php esc_attr_e( 'Add to Wishlist', 'ultra-seven' ); ?>" class="add_to_wishlist link-wishlist">
                        <?php esc_html_e( 'Add Wishlist', 'ultra-seven' ); ?>
                    </a> 
                </div>            

                <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                    <a class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'View Wishlist', 'ultra-seven' ); ?></a>
                </div>

                <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                    <a  class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'Browse Wishlist', 'ultra-seven' ); ?></a>
                </div>

                <div class="clear"></div>
                <div class="yith-wcwl-wishlistaddresponse"></div>

            </div>

         <?php
    }
}
 