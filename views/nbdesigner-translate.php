<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="wrap nbdesigner ">
    <h2><?php echo __('Frontend Translate', $this->textdomain); ?></h2>
    <div>
        <b><?php echo __('Choose language', $this->textdomain); ?></b>
        <?php if(is_array($list) && count($list) > 0): ?>
        <select id="nbdesigner-translate-code" onchange="NBDESIGNADMIN.changeLang()">
            <?php foreach ($list as $l): ?>
            <option value="<?php echo $l->code; ?>"><?php echo $l->name; ?></option>
            <?php endforeach; ?>
        </select>
        <?php endif; ?>
        <a class="button btn-primary" onclick="NBDESIGNADMIN.saveLang(this)" data-code="en" id="nbdesigner-trans-code"><?php echo __('Save Language', $this->textdomain); ?></a>
        <?php add_thickbox(); ?>
        <div id="nbdesigner-new-lang" style="display:none;">
            <div id="nbdesigner-new-lang-con" class="nbdesigner-align-center">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row" class="titledesc"><?php echo __("Language name", $this->textdomain); ?></th>
                        <td class="forminp-text">
                            <input type="text" name="nbdesigner_namelang" placeholder="English">
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row" class="titledesc"><?php echo __("Language code", $this->textdomain); ?></th>
                        <td class="forminp-text">
                            <input type="text" name="nbdesigner_codelang" placeholder="en" maxlength="3">
                        </td>
                    </tr> 
                    <?php wp_nonce_field($this->plugin_id.'-new-lang', $this->plugin_id . '_newlang_hidden'); ?>
                </table>
                <p>
                    <a class="button button-primary" onclick="NBDESIGNADMIN.createLang()"><?php esc_attr_e('Save') ?></a>
                    <img class="nbdesigner_loaded" id="nbdesigner_new_translate_loading" src="<?php echo NBDESIGNER_PLUGIN_URL . 'assets/images/loading.gif' ?>" />
                </p>                
            </div>
        </div>        
        <a name="<?php _e('Create new language', $this->textdomain); ?>" href="#TB_inline?width=300&height=230&inlineId=nbdesigner-new-lang" class="thickbox button btn-primary" onclick=""><?php echo __('Add New Language', $this->textdomain); ?></a>   
        <img class="nbdesigner_loaded" id="nbdesigner_translate_loading" src="<?php echo NBDESIGNER_PLUGIN_URL . 'assets/images/loading.gif' ?>" />
    </div>
    <div>
        <?php if(isset($langs) && is_array($langs) && count($langs) > 0): ?>
        <ul class="nbdesigner-translate">
            <?php foreach ($langs as $key => $val): ?>
            <li><p class="click_edit" data-label="<?php echo $key;?>"><?php echo stripslashes($val);?></p></li>
            <?php endforeach; ?>            
        </ul>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    jQuery('.click_edit').editable(function(value, settings) {
        return(value);
    },{ 
        submit : 'OK',
        tooltip : 'Click to edit...'
    });
    function langOk(ok){
        jQuery(ok).parent('form').parent('p').css('color', '#cc324b');
        return true;
    }    
</script>