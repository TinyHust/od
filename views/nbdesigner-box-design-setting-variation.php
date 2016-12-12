<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbdesigner-setting-variation">
    <h3><?php __('Setting Design', $this->textdomain); ?></h3>
    <div class="nbdesigner-left">
        <input type="hidden" value="0" name="_nbdesigner_enable<?php echo $vid; ?>"/>
        <label for="_nbdesigner_enable<?php echo $vid; ?>" class="nbdesigner-setting-box-label"><?php echo _e('Enable Design for this variation', $this->textdomain); ?></label>
        <input type="checkbox" value="1" name="_nbdesigner_enable<?php echo $vid; ?>" <?php checked($enable); ?> class="short nbdesigner_variation_enable" onchange="NBDESIGNADMIN.show_variation_config(this)"/>
    </div>    
    <div class="nbdesigner-right add_more" style="<?php if(!$enable) echo 'display: none;'; ?>">
        <a class="button button-primary" onclick="NBDESIGNADMIN.addOrientation(<?php echo $vid; ?>)"><?php echo __('Add More', $this->textdomain); ?></a>
    </div>    
    <div class="nbdesigner-clearfix"></div>
    <div id="nbdesigner-boxes<?php echo $vid; ?>" class="<?php if (!$enable) echo 'nbdesigner-disable'; ?> nbdesigner-variation-setting">
        <?php foreach ($designer_setting as $k => $v): ?>
            <div class="nbdesigner-box-container">
                <div class="nbdesigner-box">
                    <label class="nbdesigner-setting-box-label"><?php _e('Name:', $this->textdomain); ?></label>
                    <div class="nbdesigner-setting-box-value">
                        <input name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][orientation_name]" class="short orientation_name" value="<?php echo $v['orientation_name']; ?>" type="text" required/>
                    </div>
                    <div class="nbdesigner-right">
                        <a class="button nbdesigner-collapse" onclick="NBDESIGNADMIN.collapseBox(this)"><span class="dashicons dashicons-arrow-down"></span><?php _e('More setting', $this->textdomain); ?></a>
                        <a class="button nbdesigner-delete delete_orientation" data-index="<?php echo $k; ?>" data-variation="<?php echo $vid; ?>" onclick="NBDESIGNADMIN.deleteOrientation(this)">&times;</a>
                    </div>
                </div>
                <div class="nbdesigner-box nbdesigner-box-collapse" data-variation="<?php echo $vid; ?>" style="display: none;">
                    <div class="nbdesigner-image-box">
                        <div class="nbdesigner-image-inner">
                            <div class="nbdesigner-image-original">
                                <img src="<?php if ($v['img_src'] != '') {echo $v['img_src'];} else {echo NBDESIGNER_PLUGIN_URL . 'assets/images/default.png';} ?>" 
                                     class="designer_img_src"
                                    />
                            </div>
                            <div class="nbdesigner-area-design" style="width: <?php echo $v['area_design_width'] . 'px'; ?>; height: <?php echo $v['area_design_height'] . 'px'; ?>; left: <?php echo $v['area_design_left'] . 'px'; ?>; top: <?php echo $v['area_design_top'] . 'px'; ?>;"> </div>
                        </div>
                        <input type="hidden" class="hidden_img_src" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][img_src]" value="<?php echo $v['img_src']; ?>" >
                        <input type="hidden" class="hidden_img_src_top" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][img_src_top]">
                        <input type="hidden" class="hidden_img_src_left" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][img_src_left]">
                        <input type="hidden" class="hidden_img_src_width" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][img_src_width]">
                        <input type="hidden" class="hidden_img_src_height" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][img_src_height]">
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
                            <label class="nbdesigner-setting-box-label"><?php echo __('Real width', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][real_width]" value="<?php echo $v['real_width']; ?>" class="short real_width" onchange="NBDESIGNADMIN.updateDimensionRealOutputImage(this, 'width')">&nbsp;cm <span class="real_width_hidden"><?php echo $v['real_width']; ?></span><br /><small>&asymp; <?php echo round($v['real_width']/ 2.54, 2) ?> <?php _e('inches', $this->textdomain); ?> ~ <?php _e('Output image width', $this->textdomain); ?>: <span class="real_width_px"><?php echo round($v['real_width'] * $dpi / 2.54, 0); ?></span> px</small>
                            </div>
                        </div>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Real height', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any" min="1" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][real_height]" value="<?php echo $v['real_height']; ?>" class="short real_height"  onchange="NBDESIGNADMIN.updateDimensionRealOutputImage(this, 'height')">&nbsp;cm <span class="real_height_hidden"><?php echo $v['real_height']; ?></span><small><br />&asymp; <?php echo round($v['real_height']/ 2.54, 2) ?> <?php _e('inches', $this->textdomain); ?> ~ <?php _e('Output image height', $this->textdomain); ?>: <span class="real_height_px"><?php echo round($v['real_height'] * $dpi / 2.54, 0); ?></span> px</small>
                            </div>
                        </div>
                        <hr />
                        <p><?php echo __('Setting relative position for design area', $this->textdomain); ?>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Margin top', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any"  min="0" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][area_design_top]" value="<?php echo $v['area_design_top']; ?>" class="short area_design_dimension area_design_top" data-index="top" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px     
                            </div>
                        </div>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Margin left', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any"  min="0" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][area_design_left]" value="<?php echo $v['area_design_left']; ?>" class="short area_design_dimension area_design_left" data-index="left" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px
                            </div>
                        </div>	
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Width', $this->textdomain); ?></label>
                            <div>
                                <input type="number" step="any"  min="0" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][area_design_width]" value="<?php echo $v['area_design_width']; ?>" class="short area_design_dimension area_design_width" data-index="width" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px
                            </div>
                        </div>
                        <div class="nbdesigner-info-box-inner">
                            <label class="nbdesigner-setting-box-label"><?php echo __('Height', $this->textdomain); ?></label>
                            <div>
                                <input type="number"  step="any" min="0" name="_designer_setting<?php echo $vid; ?>[<?php echo $k; ?>][area_design_height]" value="<?php echo $v['area_design_height']; ?>" class="short area_design_dimension area_design_height" data-index="height" onchange="NBDESIGNADMIN.updatePositionDesignArea(this)">&nbsp;px
                            </div>
                        </div>					
                    </div>	
                </div>
            </div>        
        <?php endforeach; ?>
    </div>
</div>