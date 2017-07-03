<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbd-user-settings">
    <h2 id="wordpress-seo"><?php
        printf( __( '%1$s settings', 'web-to-print-online-designer' ), 'NBDesigner' );
        ?></h2>    
    <label for="nbd_artist_name"><?php _e( 'Artist Name', 'web-to-print-online-designer' ); ?></label>
    <input class="regular-text" type="text" id="nbd_artist_name" name="nbd_artist_name"
        value="<?php echo esc_attr( get_the_author_meta( 'nbd_artist_name', $user->ID ) ); ?>"/><br> <br>     
    <label for="nbd_artist_name"><?php _e( 'Sell designs', 'web-to-print-online-designer' ); ?></label>
    <input class="regular-text" type="checkbox" id="nbd_artist_name" name="nbd_sell_design"
        value="on" <?php echo ( get_the_author_meta( 'nbd_sell_design', $user->ID ) === 'on' ) ? 'checked' : ''; ?> />  
    <p style="display: inline-block; "><?php _e('Allow user sell his/her designs', 'web-to-print-online-designer'); ?></p>
</div>
