<?php
if (!defined('ABSPATH')) exit;
$url = esc_url( get_permalink($product->get_id()) );
if($type = 'simple'){ 
    $url =  add_query_arg(array(
            'task'  => 'design',
            'product_id'    =>  $product->get_id()
            ),  getUrlPageNBD('create'));
}
echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
        $url,
        esc_attr( isset( $quantity ) ? $quantity : 1 ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        esc_attr( isset( $class ) ? $class : 'button' ),
        esc_html( $label )
);
