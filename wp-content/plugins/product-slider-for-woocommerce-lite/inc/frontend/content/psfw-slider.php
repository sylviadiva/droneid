<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="psfw-slider-inner-wrap" data-post_id="<?php echo esc_attr($product_item_id); ?>" data-shortcode_id="<?php echo esc_attr($post_id); ?>">
    <div class="psfw-container-wrapper">
        <?php
        $psfw_fetch_category = $this -> psfw_fetch_category($post_id, $product_item_id, $psfw_option['select_post_taxonomy']);
        $psfw_fetch_content = $this -> psfw_fetch_content($product_item_id, $psfw_option['psfw_post_excerpt']);
        if (isset( $psfw_option[ 'psfw_slider_container_width' ] ) && $psfw_option[ 'psfw_slider_container_width' ] !='' ) {
            $psfw_slider_container_width = $psfw_option['psfw_slider_container_width'].'px';
            $inline_css ="style='max-width:".$psfw_slider_container_width.";'" ;
        } else {
            $inline_css ='';
        } 
        if ( isset( $psfw_option[ 'psfw_slider_template' ] ) && $psfw_option[ 'psfw_slider_template' ] != '' ) {
            include (PSFWL_PATH . '/inc/frontend/template/slider/'. $psfw_option['psfw_slider_template'].'.php'); 
        } else {
            include (PSFWL_PATH . '/inc/frontend/template/slider/template-1.php');
        }
        ?>
    </div>
</div>
