<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbdesign-migrate">
    <h2><?php echo __('Migrate website domain', $this->textdomain); ?></h2>
    <p><?php echo __('Update url, path: cliparts, fonts...', $this->textdomain); ?></p>
    <div>
        <table class="form-table" id="nbdesigner-migrate-info">
            <?php wp_nonce_field('nbdesigner-migrate-key', '_nbdesigner_migrate_nonce'); ?>
            <tr valign="top" class="" >
                <th scope="row" class="titledesc"><?php echo __("Old domain", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="email" class="regular-text" name="old_domain" placeholder="http://old-domain.com"/>
                    <div class="description">
                        <small id="nbdesigner_key_mes"><?php _e('Fill your old domain, example: "http://old-domain.com".', $this->textdomain); ?></small>
                    </div>                    
                </td>
            </tr>     
            <tr valign="top" class="" > 
                <th scope="row" class="titledesc"><?php echo __("New domain", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="email" class="regular-text" name="new_domain" placeholder="http://new-domain.com"/>
                    <div class="description">
                        <small id="nbdesigner_key_mes"><?php _e('Fill your new domain, example: "http://new-domain.com".', $this->textdomain); ?></small>
                    </div>                    
                </td>                
            </tr>
        </table>
        <p class="submit">
            <button class="button-primary" id="nbdesigner_update_data_migrate"><?php echo __("Update", $this->textdomain); ?></button>
            <button class="button-primary" id="nbdesigner_resote_data_migrate"><?php echo __("Restore", $this->textdomain); ?></button>
            <img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" class="nbdesigner_loaded" id="nbdesigner_migrate_loading" style="margin-left: 15px;"/>
        </p>	        
    </div>
</div>
<hr />
<div class="nbdesign-migrate">
    <h2><?php echo __('Theme check', $this->textdomain); ?></h2>
    <div id="nbdesign-theme-check">
        <?php wp_nonce_field('nbdesigner-check-theme-key', '_nbdesigner_check_theme_nonce'); ?>
        <button class="button-primary" id="nbdesigner_check_theme"><?php echo __("Start check", $this->textdomain); ?></button>
        <img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" class="nbdesigner_loaded" id="nbdesigner_check_theme_loading" style="margin-left: 15px;"/>
        <div class="theme_check_note"></div>
    </div>
    <div id="nbdesigner-result-check-theme" style="margin-bottom: 15px;"></div>
</div>
<hr />
<div class="nbdesigner-editor">
    <h2>
        <?php echo __('Edit custom CSS for NBDesigner frontend', $this->textdomain); ?>
        <img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" class="nbdesigner_loaded" id="nbdesigner_custom_css_loading" style="margin-left: 15px;"/>
    </h2>
    <div id="nbdesigner_custom_css_con">
        <?php wp_nonce_field('nbdesigner-custom-css', '_nbdesigner_custom_css'); ?>
        <textarea cols="70" rows="30" name="nbdsigner_custom_css" id="nbdsigner_custom_css" ><?php echo esc_html( $custom_css ); ?></textarea>
    </div>
    <div style="margin-top: 15px;">
        <button class="button-primary" id="nbdesigner_custom_css"><?php _e('Update Custom CSS', $this->textdomain) ?></button>
        <small><?php _e('Using bad CSS code could break the appearance of your plugin', $this->textdomain) ?></small>
    </div>
    <script language="javascript">
            jQuery( document ).ready( function($) {
                var editorCodeMirror = CodeMirror.fromTextArea( document.getElementById( "nbdsigner_custom_css" ), {lineNumbers: true, lineWrapping: true} );
                $('#nbdesigner_custom_css').on('click', function(e){
                    var formdata = jQuery('#nbdesigner_custom_css_con').find('input').serialize();
                    var content = editorCodeMirror.getValue();
                    formdata = formdata + '&action=nbdesigner_custom_css&content=' + content;
                    jQuery('#nbdesigner_custom_css_loading').removeClass('nbdesigner_loaded');
                    jQuery.post(admin_nbds.url, formdata, function(data){
                        jQuery('#nbdesigner_custom_css_loading').addClass('nbdesigner_loaded');
                        data = JSON.parse(data);
                        if(data.flag){
                            alert('Update success!');
                        }else{
                            alert('Oops! Try again!');
                        }                  
                    });                
                });   
            });
            
    </script>    
</div>