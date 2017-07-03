<?php
wp( 'p=' . $product_id . '&post_type=product' );

while ( have_posts() ) : the_post(); ?>
    <?php do_action( 'woocommerce_single_product_summary' ); ?>
<?php endwhile;

