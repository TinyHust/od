<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="wrap nbdesigner ">
    <h2><?php echo __('Settings', $this->textdomain); ?></h2>
    <div>
        <h3><?php echo __("License", $this->textdomain); ?></h3>
        <table class="form-table">
            <tr valign="top" class="" id="nbdesigner_license" <?php if(isset($license['key'])) echo 'style="display: none;"'; ?>>
                <th scope="row" class="titledesc"><?php echo __("Get free license key", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="email" class="regular-text" name="nbdesigner[name]" placeholder="Enter your name"/><br /><br />
                    <input type="email" class="regular-text" name="nbdesigner[email]" placeholder="Enter your email"/>
                    <button  class="button-primary" id="nbdesigner_get_key" ><?php _e('Get key', $this->textdomain); ?></button>
                    <img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" class="nbdesigner_loaded" id="nbdesigner_license_loading" style="margin-left: 15px;"/>
                    <div class="description">
                        <small id="nbdesigner_key_mes"><?php _e('Please fill correct email. License key will be sent to your email.', $this->textdomain); ?></small>
                    </div>
                    <input type="hidden" name="nbdesigner[domain]" value="<?php echo $site_url; ?>"/>
                    <input type="hidden" name="nbdesigner[title]" value="<?php echo $site_title; ?>"/>
                    <?php wp_nonce_field($this->plugin_id.'-get-key', $this->plugin_id . '_getkey_hidden'); ?>
                </td>
            </tr>   
            <tr <?php if(isset($license['key'])) echo 'style="display: none;"'; ?>><td colspan="2"><hr /></td></tr>
            <tr valign="top" class="" id="nbdesigner_active_license">
                <?php wp_nonce_field('nbdesigner-active-key', '_nbdesigner_license_nonce'); ?>
                <th scope="row" class="titledesc"><?php echo __("Active license key", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input class="regular-text" type="text" id="nbdesigner_input_key" name="nbdesigner[license]" placeholder="Enter your key" value="<?php if(isset($license['key'])) echo $license['key']; ?>" <?php if(isset($license['key'])) echo ' readonly'; ?>/>
                    <button  class="button-primary" id="nbdesigner_active_key" <?php if(isset($license['key'])) echo ' disabled'; ?>><?php _e('Active', $this->textdomain); ?></button>	
                    <button  class="button-primary" id="nbdesigner_remove_key" ><?php _e('Remove', $this->textdomain); ?></button>	
                    <img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" class="nbdesigner_loaded" id="nbdesigner_license_active_loading" style="margin-left: 15px;"/>
                    <div>
                        <small id="nbdesigner_license_mes">
                            <?php //if(!isset($license['type'])) _e('Your license is incorrect or expired! ', $this->textdomain);?>
                            <?php if(!isset($license['type']) || (isset($license['type']) && $license['type'] == 'free')) echo '<a href="'.$this->author_site.'wordpress-themes/wordpress-online-product-designer-plugin" target="_blank">Upgrade Pro version!</a>';?>
                        </small>
                    </div>
                </td>
            </tr>
        </table>     
    </div> 
    <hr />
    <h3><?php echo __("General Info", $this->textdomain); ?></h3>
    <form name="post" action="" method="post" autocomplete="off">
        <?php wp_nonce_field($this->plugin_id, $this->plugin_id . '_hidden'); ?>		
        <table class="form-table">
            <tr valign="top" style="display: none;">
                <th scope="row" class="titledesc"><?php echo __("Iframe security key", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input  id="nbdesigner-sec-key" type="password" class="regular-text" name="nbdesigner[iframe_securitykey]" value="<?php echo $opt_val['iframe_securitykey']; ?>" />
                    <button type="button" class="button button-secondary" id="nbdesigner-gen-sec-key"><?php echo __("Generate Key", $this->textdomain); ?></button>
                    <button type="button" class="button button-secondary nbdesigner-key-show-hide wp-hide-pw" id="nbdesigner-toggle-show-sec-key" style="display: none;">
                        <span class="dashicons dashicons-visibility"></span>
                        <span class="nbdesigner-show-text text"><?php echo __("Show", $this->textdomain); ?></span>
                        <span class="nbdesigner-hide-text text"><?php echo __("Hide", $this->textdomain); ?></span>
                    </button>
                    <input type="hidden" value="1" id="nbdesigner-check-toggle-show">
                    <div><small><?php echo __("With security key, your website safer.", $this->textdomain) ?></small></div>
                </td>
            </tr>            
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Label of button design", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="text" name="nbdesigner[btname]" value="<?php echo $opt_val['btname']; ?>" />						
                </td>
            </tr>
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Position of button design", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="radio" name="nbdesigner[btn_position]" id="btn_position_1" value="1" <?php checked($opt_val['btn_position'], 1) ?>/>	
                    <label for="btn_position_1"><?php echo __("Before add to cart button and after variantions option", $this->textdomain); ?></label><br />
                    <input type="radio" name="nbdesigner[btn_position]" id="btn_position_2" value="2"  <?php checked($opt_val['btn_position'], 2) ?>/>	
                    <label for="btn_position_2"><?php echo __("Before variantions option", $this->textdomain); ?></label><br />
                    <input type="radio" name="nbdesigner[btn_position]" id="btn_position_3" value="3"  <?php checked($opt_val['btn_position'], 3) ?>/>	
                    <label for="btn_position_3"><?php echo __("After add to cart button", $this->textdomain); ?></label><br />                  					
                </td>
            </tr>            
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Max size upload", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="number" class="small-text" name="nbdesigner[upload_max]" value="<?php echo $opt_val['upload_max']; ?>" min="1"/>&nbsp;MB						
                </td>
            </tr>
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Preview thumbnail size", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <label><?php echo __("Width:", $this->textdomain); ?></label>
                    <input type="number" class="small-text" name="nbdesigner[thumbnail_width]" value="<?php echo $opt_val['thumbnail_width']; ?>" />&nbsp;px&nbsp;&nbsp;	
                    <label><?php echo __("Height:", $this->textdomain); ?></label>
                    <input type="number" class="small-text" name="nbdesigner[thumbnail_height]" value="<?php echo $opt_val['thumbnail_height']; ?>" />&nbsp;px                    
                </td>             
            </tr> 
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Thumbnail quality", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="number" class="small-text" name="nbdesigner[thumbnail_quality]" value="<?php echo $opt_val['thumbnail_quality']; ?>" />&nbsp;%
                    <div><small><?php echo __("Quality of the generated thumbnails between 0 - 100", $this->textdomain) ?></small></div>
                </td>
            </tr> 
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Show customer design in cart", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="hidden" value="0" name="nbdesigner[show_design]"/>
                    <input type="checkbox" name="nbdesigner[show_design]" value="1" <?php checked($opt_val['show_design']); ?> />
                    <label><?php echo __("Enable", $this->textdomain); ?></label>
                </td>
            </tr>  
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Show customer design in order", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="hidden" value="0" name="nbdesigner[show_design_order]"/>
                    <input type="checkbox" name="nbdesigner[show_design_order]" value="1" <?php checked($opt_val['show_design_order']); ?> />
                    <label><?php echo __("Enable", $this->textdomain); ?></label>
                </td>
            </tr>            
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Admin notifications", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="hidden" value="0" name="nbdesigner[notifications_enable]"/>
                    <input type="checkbox" name="nbdesigner[notifications_enable]" value="1" <?php checked($opt_val['notifications_enable']); ?> />
                    <label><?php echo __("Enable", $this->textdomain); ?></label>
                    <div><small><?php echo __("Send a message to the admin when customer design saved / changed.", $this->textdomain); ?></small></div>
                </td>
            </tr> 
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Recurrence", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <select name="nbdesigner[owner_recurrence]">
                        <option value="hourly" <?php selected($opt_val['owner_recurrence'], 'hourly'); ?> ><?php echo __("Hourly", $this->textdomain); ?></option>
                        <option value="twicedaily" <?php selected($opt_val['owner_recurrence'], 'twicedaily'); ?> ><?php echo __("Twice a day", $this->textdomain); ?></option>
                        <option value="daily" <?php selected($opt_val['owner_recurrence'], 'daily'); ?> ><?php echo __("Daily", $this->textdomain); ?></option>                        
                    </select>
                    <div><small><?php echo __("Choose how many times you want to receive an e-mail.", $this->textdomain); ?></small></div>
                </td>
            </tr>             
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Recipients", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="text" class="regular-text" name="nbdesigner[owner_email]" value="<?php echo $opt_val['owner_email']; ?>" placeholder="Enter your email"/>
                    <div><small><?php echo sprintf(__( 'Enter recipients (comma separated) for this email. Defaults to %s', $this->textdomain ),'<code>'.get_option('admin_email').'</code>');?></small></div>
                </td>
            </tr>               
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Facebook API Key", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="text" name="nbdesigner[facebook_api_key]" value="<?php echo $opt_val['facebook_api_key']; ?>" />
                </td>
            </tr>	
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Facebook App Secret", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="text" name="nbdesigner[facebook_secret_key]" value="<?php echo $opt_val['facebook_secret_key']; ?>" />
                </td>
            </tr>
<!--            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Instagram API Key", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="text" name="nbdesigner[instagram_api_key]" value="<?php echo $opt_val['instagram_api_key']; ?>" />
                </td>
            </tr>	
            <tr valign="top">
                <th scope="row" class="titledesc"><?php echo __("Instagram App Secret", $this->textdomain); ?> </th>
                <td class="forminp-text">
                    <input type="text" name="nbdesigner[instagram_secret_key]" value="<?php echo $opt_val['instagram_secret_key']; ?>" />
                </td>
            </tr>	            -->
        </table>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>		
    </form>

</div>