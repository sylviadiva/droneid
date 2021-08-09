<?php
/**
 * Handler for [etl_guten_block] shortcode
 *
 * @param $atts
 *
 * @return string
 */
function psfwl_block_handler($atts)
{
	$atts = shortcode_atts([
		'heading' => __('Product Slider-For-Woocommerce-Lite Title'),
		'heading_tag' => 'h2',
		'psfwl_id' => '',
	], $atts, 'psfwl_guten_block');

	return psfwl_block_renderer($atts[ 'heading' ],$atts[ 'heading_tag' ],$atts[ 'psfwl_id' ]);
}

add_shortcode('psfwl_guten_block', 'psfwl_block_handler');

/**
 * Handler for post title block
 * @param $atts
 *
 * @return string
 */
function psfwl_block_render_handler($atts)
{
	return psfwl_block_renderer($atts[ 'heading' ],$atts[ 'heading_tag' ],$atts[ 'psfwl_id' ]);
}

/**
 * Output the post title wrapped in a heading
 *
 * @param int $etl_id The post ID
 * @param string $heading Allows : h2,h3,h4 only
 *
 * @return string
 */
function psfwl_block_renderer($heading,$heading_tag,$psfwl_id)
{	
	$ret = '';
	if(!empty($heading)){
		$ret .= "<$heading_tag>$heading</$heading_tag>";
	}
	
	if($psfwl_id!=null){
		$sht = "[psfw slug='$psfwl_id']";
		$title = do_shortcode($sht);
		$ret .= "$title";
	}
	return $ret;
}

/**
 * Register block
 */
add_action('init', function () {
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	wp_enqueue_style( 'dashicons' );
    wp_enqueue_style( 'psfw-fontawesome', PSFWL_CSS_DIR . '/font-awesome.min.css', false, PSFWL_VERSION );
    wp_enqueue_style( 'psfw-font', '//fonts.googleapis.com/css?family=Bitter|Hind|Playfair+Display:400,400i,700,700i,900,900i|Open+Sans:400,500,600,700,900|Lato:300,400,700,900|Montserrat|Droid+Sans|Roboto|Lora:400,400i,700,700i|Roboto+Slab|Rubik|Merriweather:300,400,700,900|Poppins|Ropa+Sans|Playfair+Display|Rubik|Source+Sans+Pro|Roboto+Condensed|Roboto+Slab:300,400,700|Amatic+SC:400,700|Quicksand|Oswald|Quicksand:400,500,700', false );
    wp_enqueue_style( 'psfw-animation-style', PSFWL_CSS_DIR . '/animate.css', false, PSFWL_VERSION );
    wp_enqueue_style( 'psfw-linearicons', PSFWL_CSS_DIR . '/linear-icon-font.min.css', false, PSFWL_VERSION);

    if ( class_exists( 'WooCommerce' ) ) {
        global $woocommerce;
        wp_enqueue_script( 'wc-add-to-cart-variation', $woocommerce -> plugin_url() . '/assets/js/frontend/add-to-cart-variation.js', array( 'jquery' ), '1.6', true );
    }
    
    wp_enqueue_script( 'psfw-isotope-script', PSFWL_JS_DIR . '/isotope.js', array( 'jquery' ), PSFWL_VERSION );
    wp_enqueue_script( 'psfw-imageloaded-script', PSFWL_JS_DIR . '/imagesloaded.min.js', array( 'jquery' ), PSFWL_VERSION );
    wp_enqueue_script( 'psfw-linearicons', PSFWL_JS_DIR . '/linear-icon.min.js', array( 'jquery' ), PSFWL_VERSION  );
    wp_enqueue_script( 'psfw-bxslider-script', PSFWL_JS_DIR . '/jquery.bxslider.min.js', array( 'jquery' ), PSFWL_VERSION );

    wp_enqueue_style( 'psfw-bxslider-style', PSFWL_CSS_DIR . '/jquery.bxslider.css', false, PSFWL_VERSION );
    
    wp_enqueue_style( 'psfw-frontend-style', PSFWL_CSS_DIR . '/psfw-frontend.css', PSFWL_VERSION );
    wp_enqueue_style( 'psfw-responsive-style', PSFWL_CSS_DIR . '/psfw-responsive.css', false, PSFWL_VERSION );
    
            // "wp-util" used to solve the issue that stopped the price of variable products from displaying.
    if ( class_exists( 'WooCommerce' ) ) {
        $js_list = array( 'jquery', 'psfw-imageloaded-script', 'psfw-isotope-script', 'psfw-bxslider-script', 'wc-add-to-cart-variation', 'wp-util' );
    } else {
        $js_list = array( 'jquery', 'psfw-imageloaded-script', 'psfw-isotope-script', 'psfw-bxslider-script', 'wp-util' );
    }

    wp_enqueue_script( 'psfw-frontend-script', PSFWL_JS_DIR . '/psfw-frontend.js', $js_list, PSFWL_VERSION );

    $frontend_ajax_nonce = wp_create_nonce( 'psfw-frontend-ajax-nonce' );
    $frontend_ajax_object = array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => $frontend_ajax_nonce );
    wp_localize_script( 'psfw-frontend-script', 'psfw_frontend_js_params', $frontend_ajax_object );
    if ( class_exists( 'WooCommerce' ) ) {
        global $woocommerce;
                //wp_register_script( 'psfw-woo-script', '/psfwscript_url' );
        wp_enqueue_script( 'psfw-woo-script' );

        $translation_array = array( 'templateUrl' => $woocommerce -> plugin_url() );
        wp_localize_script( 'psfw-woo-script', 'psfw_object_name', $translation_array );
    }

	$index_js = 'psfwl-block.js';
	wp_register_script(
		'psfwl-block-script',
		plugins_url($index_js, __FILE__),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-components',
			'wp-editor'
		),
		filemtime("$dir/$index_js")
	);

	$psfwl_logos_array = get_psfwl_logos();
	wp_localize_script( 'psfwl-block-script', 'PSFWL_logos_array', $psfwl_logos_array);

	register_block_type('psfwl-display-block/psfwl-widget', array(
		'editor_script' => 'psfwl-block-script',
		'render_callback' => 'psfwl_block_render_handler',
		'attributes' => [			
			'heading' => [
				'type' => 'string',
				'default' => __('Product Slider-For-Woocommerce-Lite Title')
			],
			'heading_tag' => [
				'type' => 'string',
				'default' => 'h2'
			],
			'psfwl_id' => [
				'type' => 'string',
				'default' => ''
			],
		]
	));
});

function get_psfwl_logos(){
	$args = array('post_type'=>'productsliderwoo',
		'post_status'=>'publish',
		'posts_per_page'=>'25'
	);
    // The Query
	$the_query = new WP_Query( $args );

	$product_slider = array(array('value'=>'0','label'=>__('Select Tab')));

    // The Loop
	if ( $the_query->have_posts() ) {
		while($the_query->have_posts()){
			$the_query->the_post();
			global $post;
			$product_slider[] = array('value'=>$post->post_name, 'label'=> get_the_title());
		}
	}

	return $product_slider;
}