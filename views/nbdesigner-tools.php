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
    <div id="nbdesigner-result-check-theme"></div>
</div>