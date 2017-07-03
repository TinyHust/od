<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2><?php _e('Designs store', 'web-to-print-online-designer'); ?></h2>
<p id="nbd-artist-form"><span><?php _e('Artist ', 'web-to-print-online-designer'); ?></span> 
    <b><span id="nbd-artist-name"><?php 
        $artist_name = esc_attr( get_the_author_meta( 'nbd_artist_name', $user->ID ) );
        if($artist_name == '') $artist_name = $user->user_nicename;
        echo $artist_name;
    ?>
    </span></b> 
    <a id="nbd-edit-name" href="javascript:void(0)" onclick="editArtistName()"><?php _e('Edit ', 'web-to-print-online-designer'); ?></a>
    <input id="nbd-artist-name-value" value="<?php echo $artist_name; ?>" style="display: none;" name="nbd_artist_name">
    <?php wp_nonce_field( 'nbd_artist_update', 'nbd_nonce' ); ?>
    <a id="nbd-submit-name" href="javascript:void(0)" onclick="submitArtistName()" style="display: none;"><?php _e('OK ', 'web-to-print-online-designer'); ?></a>
</p>
<div class="container-design">
    <table>
        <thead>
            <tr>
                <th><?php _e('No', 'web-to-print-online-designer'); ?></th>
                <th><?php _e('Preview', 'web-to-print-online-designer'); ?></th>
                <th><?php _e('Price', 'web-to-print-online-designer'); ?></th>
                <th><?php _e('Date', 'web-to-print-online-designer'); ?></th>
                <th><?php _e('Actions ', 'web-to-print-online-designer'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php // ?>
        </tbody>
    </table>
    <form method="post" enctype="multipart/form-data" action="">
        <input name="add-to-cart" value="547"/>
        <input name="variation_id" value="547"/>
        <input name="product_id" value="531"/>
        <select id="pa_color" class="" name="attribute_pa_color" data-attribute_name="attribute_pa_color" data-show_option_none="yes">
            <option value="">Choose an option</option>
            <option value="black" selected>Black</option>
            <option value="blue" class="attached enabled">Blue</option>
        </select>
        <input type="submit"/>
    </form>
</div>
<script>
var nbd_ajax = "<?php echo admin_url('admin-ajax.php'); ?>";   
function editArtistName(){
    jQuery('#nbd-artist-name, #nbd-edit-name').hide();
    jQuery('#nbd-artist-name-value, #nbd-submit-name').show();
}
function submitArtistName(){
    var formdata = jQuery('#nbd-artist-form').find('textarea, select, input').serialize();
    formdata = formdata + '&action=nbd_update_artist_name';
    jQuery.post(nbd_ajax, formdata, function(data){
        data = JSON.parse(data);
        if(data.flag && data.flag == 1){
            jQuery('#nbd-artist-name, #nbd-edit-name').show();
            jQuery('#nbd-artist-name-value, #nbd-submit-name').hide();      
            jQuery('#nbd-artist-name').html(data.name); 
            jQuery('#nbd-artist-name-value').val(data.name);    
        } 
    });
}
</script>    