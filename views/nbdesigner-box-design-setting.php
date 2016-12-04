<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="nbdesigner-setting-container">
    <?php wp_nonce_field('nbdesigner_setting_box', 'nbdesigner_setting_box_nonce'); ?>		
    <div class="nbdesigner-left">
        <input type="hidden" value="0" name="_nbdesigner_enable"/>
        <label for="_nbdesigner_enable" class="nbdesigner-setting-box-label"><?php echo _e('Enable Design', $this->textdomain); ?></label>
        <input type="checkbox" value="1" name="_nbdesigner_enable" id="_nbdesigner_enable" <?php checked($enable); ?> class="short" />
    </div>
    <div class="nbdesigner-right add_more" style="display: none;">
        <a class="button button-primary" onclick="NBDESIGNADMIN.addOrientation()"><?php echo __('Add More', $this->textdomain); ?></a>
    </div>
    <div class="nbdesigner-clearfix"></div>
    <div id="nbdesigner_dpi_con" class="<?php if (!get_post_meta($post_id, '_nbdesigner_enable', true)) echo 'nbdesigner-disable'; ?>">
        <label for="nbdesigner_dpi" class="nbdesigner-setting-box-label"><?php echo _e('DPI', $this->textdomain); ?></label>
        <input name="_nbdesigner_dpi" id="nbdesigner_dpi" value="<?php echo $dpi;?>" type="number"  min="0" max="300" style="width: 60px;" onchange="NBDESIGNADMIN.updateSolutionImage()">&nbsp;<small>(<?php _e('Dots Per Inch', $this->textdomain); ?>)</small>   
    </div>
    <div id="nbdesigner-boxes" class="<?php if (!$enable) echo 'nbdesigner-disable'; ?>">
        <?php $count = 0;
        foreach ($designer_setting as $k => $v): ?>
            <div class="nbdesigner-box-container">
                <div class="nbdesigner-box">
                    <label class="nbdesigner-setting-box-label"><?php _e('Name:', $this->textdomain); ?></label>
                    <div class="nbdesigner-setting-box-value">
                        <input name="_designer_setting[<?php echo $k; ?>][orientation_name]" class="short orientation_name" value="<?php echo $v['orientation_name']; ?>" type="text" required/>
                    </div>
                    <div class="nbdesigner-right">
                        <a class="button nbdesigner-collapse" onclick="NBDESIGNADMIN.collapseBox(this)"><span class="dashicons dashicons-arrow-up"></span><?php _e('Less setting', $this->textdomain); ?></a>
                        <a class="button nbdesigner-delete delete_orientation" data-index="<?php echo $k; ?>" onclick="NBDESIGNADMIN.deleteOrientation(this)">&times;</a>
                    </div>
                </div>
                <div class="nbdesigner-box nbdesigner-box-collapse">
                    <div class="nbdesigner-image-box">
                        <div class="nbdesigner-image-inner">
                            <div class="nbdesigner-image-original">
                                <img src="<?php if ($v['img_src'] != '') {echo $v['img_src'];} else {echo NBDESIGNER_PLUGIN_URL . 'assets/images/default.png';} ?>" 
                                     class="designer_img_src"
                                    />
                            </div>
                            <div class="nbdesigner-area-design" id="nbdesigner-area-design-<?php echo $k; ?>" style="width: <?php echo $v['area_design_width'] . 'px'; ?>; height: <?php echo $v['area_design_height'] . 'px'; ?>; left: <?php echo $v['area_design_left'] . 'px'; ?>; top: <?php echo $v['area_design_top'] . 'px'; ?>;"> </div>
                        </div>
                        <input type="hidden" class="hidden_img_src" name="_designer_setting[<?php echo $k; ?>][img_src]" value="<?php echo $v['img_src']; ?>" >
                        <input type="hidden" class="hidden_img_src_top" name="_designer_setting[<?php echo $k; ?>][img_src_top]">
                        <input type="hidden" class="hidden_img_src_left" name="_designer_setting[<?php echo $k; ?>][img_src_left]">
                        <input type="hidden" class="hidden_img_src_width" name="_designer_setting[<?php echo $k; ?>][img_src_width]">
                        <input type="hidden" class="hidden_img_src_height" name="_designer_setting[<?php echo $k; ?>][img_src_height]">
                        <div>	
                            <a class="button nbdesigner_move nbdesigner_move_left" data-index="<?php echo $k; ?>" onclick="NBDESIGNADMIN.nbdesigner_move(this, 'left')">&larr;</a>
                            <a class="button nbdesigner_move nbdesigner_move_right" data-index="<?php echo $k; ?>" onclick="NBDESIGNADMIN.nbdesigner_move(this, 'right')">&rarr;</a>
                            <a class="button nbdesigner_move nbdesigner_move_up" data-index="<?php echo $k; ?>" onclick="NBDESIGNADMIN.nbdesigner_move(this, 'up')">&uarr;</a>
                            <a class="button nbdesigner_move nbdesigner_move_down" data-index="<?php echo $k; ?>" onclick="NBDESIGNADMIN.nbdesigner_move(this, 'down')">&darr;</a>
                            <a class="button nbdesigner_move nbdesigner_move_center" data-index="<?php echo $k; ?>" onclick="NBDESIGNADMIN.nbdesigner_move(this, 'center')">&frac12;</a>
                            <a class="button nbdesigner_move nbdesigner_move_center" style="padding-left: 7px; padding-right: 7px;" data-index="<?php echo $k; ?>" onclick="NBDESIGNADMIN.nbdesigner_move(this, 'fit')"><i class="mce-ico mce-i-dfw" style="margin: 4px 0px 0px 0px !important; padding: 0 !important;"></i></a>
                            <a class="button nbdesigner-button nbdesigner-add-image" style="margin-top: 10px;" onclick="NBDESIGNADMIN.loadImage(this)" data-index="<?php echo $k; ?>"><?php echo __('Change image', $this->textdomain); ?></a>
                        </div>
                    </div>
                    <div class="nbdesigner-info-box">
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Real width design zone', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any" name="_designer_setting[<?php echo $k; ?>][real_width]" value="<?php echo $v['real_width']; ?>" class="short real_width" onchange="NBDESIGNADMIN.updateDimensionRealOutputImage(this, 'width')">&nbsp;cm <span class="real_width_hidden"><?php echo $v['real_width']; ?></span><br /><small>&asymp; <?php echo round($v['real_width']/ 2.54, 2) ?> <?php _e('inches', $this->textdomain); ?> ~ <?php _e('Output image width', $this->textdomain); ?>: <span class="real_width_px"><?php echo round($v['real_width'] * $dpi / 2.54, 0); ?></span> px</small>
                            </div>
                        </div>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Real height design zone', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any" min="1" name="_designer_setting[<?php echo $k; ?>][real_height]" value="<?php echo $v['real_height']; ?>" class="short real_height"  onchange="NBDESIGNADMIN.updateDimensionRealOutputImage(this, 'height')">&nbsp;cm <span class="real_height_hidden"><?php echo $v['real_height']; ?></span><small><br />&asymp; <?php echo round($v['real_height']/ 2.54, 2) ?> <?php _e('inches', $this->textdomain); ?> ~ <?php _e('Output image height', $this->textdomain); ?>: <span class="real_height_px"><?php echo round($v['real_height'] * $dpi / 2.54, 0); ?></span> px</small>
                            </div>
                        </div>
                        <hr />
                        <p><?php echo __('Setting relative position for design area', $this->textdomain); ?>&nbsp;<span class="nbdesign-config-tooltip dashicons dashicons-editor-help"></span></p>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Design area margin top', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any"  min="0" name="_designer_setting[<?php echo $k; ?>][area_design_top]" value="<?php echo $v['area_design_top']; ?>" class="short area_design_dimension area_design_top" data-index="top" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px
                                
                            </div>
                        </div>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Design area margin left', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any"  min="0" name="_designer_setting[<?php echo $k; ?>][area_design_left]" value="<?php echo $v['area_design_left']; ?>" class="short area_design_dimension area_design_left" data-index="left" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px
                            </div>
                        </div>	
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Design area width', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any"  min="0" name="_designer_setting[<?php echo $k; ?>][area_design_width]" value="<?php echo $v['area_design_width']; ?>" class="short area_design_dimension area_design_width" data-index="width" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px
                            </div>
                        </div>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Design area height', $this->textdomain); ?></label>
                            <div>
                                <input type="number"  step="any" min="0" name="_designer_setting[<?php echo $k; ?>][area_design_height]" value="<?php echo $v['area_design_height']; ?>" class="short area_design_dimension area_design_height" data-index="height" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px
                            </div>
                        </div>					
                    </div>	
                </div>
            </div>
    <?php $count++;
endforeach; ?>
        <input type="hidden" value="<?php echo $count; ?>" id="nbdesigner-count-box"/>
    </div>
    <div id="nbdesigner-option" class="nbdesigner-option <?php if (!$enable) echo 'nbdesigner-disable'; ?>">
        <div class="nbdesigner-opt-inner">
            <label for="_nbdesigner_admindesign" class="nbdesigner-setting-box-label"><?php echo _e('Admin design template', $this->textdomain); ?></label>
            <input type="checkbox" value="1" name="_nbdesigner_option[admindesign]" id="_nbdesigner_admindesign" <?php checked(isset($option['admindesign']) ? $option['admindesign'] : false); ?> class="short"/>
            <?php if($enable && isset($option['admindesign'])): ?>
            <a href="<?php echo $link_admindesign.'&p=primary'; ?>" target="_blank">
                <?php if($priority):?>
                <span class="dashicons dashicons-admin-network" style="text-decoration: none;"></span><?php echo _e('Primary Design', $this->textdomain); ?></a>&nbsp;
                    <span class="dashicons dashicons-plus"></span><a href="<?php echo $link_admindesign.'&p=extra&adid='.time(); ?>" target="_blank"><?php echo _e('Add Design', $this->textdomain); ?></a>
                <?php else:?>
                    <span class="dashicons dashicons-art" style="text-decoration: none;"></span><?php echo _e('Start Design', $this->textdomain); ?></a>
                <?php endif;?>
            <?php else: ?>
            <small><?php echo _e('After save product, you\'ll see link start design', $this->textdomain); ?></small>
            <?php endif; ?>
        </div>  
        <div class="nbdesigner-opt-inner" style="display: none;">
            <label for="_nbdesigner_customprice" class="nbdesigner-setting-box-label"><?php echo _e('Custom price', $this->textdomain); ?></label>
            <input type="number" step="any" class="short nbdesigner-short-input" id="_nbdesigner_customprice" name="_nbdesigner_option[customprice]" value="<?php if(isset($option['customprice'])) echo $option['customprice']; ?>"/>
        </div>
    </div>    
</div>
<?php
function  add_js_code(){
?><script>
    jQuery(document).ready( function($) {
        var options = {
            "content":"<h3>Notice<\/h3>" +
                       "<p>Bellow values must in range from 0 to 300px<\/p>" + 
                       "<p>The ratio of 'Design area width' to 'Design area height' is the ratio of 'Real width design zone' to 'Real height design zone'<\/p>"+
                       "<p>Change 'Design area width' or 'Design area height' will change 'Real width design zone' or 'Real height design zone'. Let's change them before change 'Real dimensions'<\/p>",
            "position": {"edge":"left", "align":"center"}
        };
        if ( ! options ) return;
        options = $.extend( options, {
            close: function() {
                //to do
            }
        });
        $('.nbdesign-config-tooltip').pointer( options );
        $('.nbdesign-config-tooltip').on('hover', function(){
            $(this).pointer("open")
        });
    });
</script>
<?php
}
add_action("admin_footer", "add_js_code");
?>