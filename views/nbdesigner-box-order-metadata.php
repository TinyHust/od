<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<?php if(isset($has_design) && ($has_design == 'has_design')) : 
    $count_img_design = 0;
?>
<div id="nbdesigner_order_info">
	<?php foreach($products AS $order_item_id => $product): ?>
		<?php 
			$has_design = wc_get_order_item_meta($order_item_id, '_nbdesigner_has_design');
			if($has_design == 'has_design'): 
			$pid = 'nbds_'.$product["product_id"];			
		?>
			<div>
				<h4 class="nbdesigner_order_product_name"><?php echo $product['name']; ?></h4>
				<div class="nbdesigner_container_item_order <?php if(isset($data_designs[$pid])) { $status = ($data_designs[$pid] == 'accept') ? 'approved' : 'declined'; echo $status;}; ?>">
				<?php 
					$path = $this->plugin_path_data . 'designs/' . $user_id . '/' . $order_id .'/' .$product["product_id"] .'/thumbs';
					$list_images = $this->nbdesigner_list_thumb($path, 1);											
					if(count($list_images) > 0):
					
				?>
					<input type="checkbox" name="_nbdesigner_design_file[]" class="nbdesigner_design_file" value="<?php echo $product["product_id"]; ?>" />
					<?php foreach($list_images as $key => $image): 
                                            $count_img_design++;
                                            $src = $this->nbdesigner_create_secret_image_url($image);						
					?>						
						<img class="nbdesigner_order_image_design" src="<?php echo $src; ?>" />
					<?php endforeach; ?>
                                               
					<a class="nbdesigner-right button button-small button-secondary"  href="<?php echo add_query_arg(array('product_id' => $product["product_id"], 'order_id' => $order->id), admin_url('admin.php?page=nbdesigner_detail_order')); ?>"><?php _e('View detail', $this->textdomain); ?></a>
				<?php  endif; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach;?>
    <br /> 
    <div class="nbdesigner-left" style="padding: 5px;">
        <input type="checkbox" class="" id="nbdesigner_order_design_check_all" />
        <label for="nbdesigner_order_design_check_all"><small><?php _e('Check all', $this->textdomain); ?></small></label>
    </div>
	<div class="nbdesigner-right" style="padding: 5px;">
		<?php  if(class_exists('ZipArchive') && $count_img_design > 0): ?>
			<a href="<?php echo add_query_arg(array('download-all' => 'true', 'order_id' => $order->id), admin_url('admin.php?page=nbdesigner_detail_order')); ?>" class="button button-small button-secondary"><?php _e('Download all', $this->textdomain); ?></a>
		<?php else: ?>
			<span class="button button-small button-disabled" style="color: #dedede;"><?php _e('Download all', $this->textdomain); ?></span>
		<?php endif; ?>
	</div>
	<div class="nbdesigner-clearfix"></div>
	<div>
		<?php _e('With selected:', $this->textdomain); ?>
		<img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" class="nbdesigner_loaded" id="nbdesigner_order_submit_loading" style="margin-left: 15px;"/>
		<div class="nbdesigner-right">
            <select name="nbdesigner_order_file_approve" class="">
                <option value="accept"><?php _e('Accept', $this->textdomain); ?></option>
                <option value="decline"><?php _e('Decline', $this->textdomain); ?></option>
            </select>
            <a href="#" class="button button-primary" id="nbdesigner_order_file_submit"><?php _e('GO', $this->textdomain); ?></a>			
		</div>
	</div>
	<input type="hidden" name="nbdesigner_design_order_id" value="<?php echo $order->id; ?>" />
	<?php wp_nonce_field('approve-designs', '_nbdesigner_approve_nonce'); ?>
	<div class="nbdesigner-clearfix"></div>
</div>
<div class="nbdesigner_container_order_email" id="nbdesigner_order_email_info">
	<h4><?php _e('Send mail',$this->textdomain); ?></h4>
	<?php wp_nonce_field('approve-design-email', '_nbdesigner_design_email_nonce'); ?>
	<input type="hidden" name="nbdesigner_design_email_order_id" value="<?php echo $order->id; ?>" />
    <div id="nbdesigner_order_email_error" class="nbdesigner_order_email_message hidden"></div>
    <div id="nbdesigner_order_email_success" class="nbdesigner_order_email_message hidden"></div>	
    <div>
        <label for="nbdesigner_design_email_order_content"><?php _e('Reason accepted / declined:', $this->textdomain); ?></label>
        <textarea name="nbdesigner_design_email_order_content" id="nbdesigner_design_email_order_content" rows="3" style="width: 100%;"></textarea>
    </div>	
    <div class="nbdesigner-right">
		<img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" class="nbdesigner_loaded" id="nbdesigner_order_mail_loading" style="margin-left: 15px;"/>
        <select name="nbdesigner_design_email_reason" class="">
            <option value="approved"><?php _e('Files accepted', $this->textdomain); ?></option>
            <option value="declined"><?php _e('Files rejected', $this->textdomain); ?></option>
        </select>
        <a href="#" class="button button-primary" id="nbdesigner_uploads_email_submit"><?php _e('Send mail',$this->textdomain); ?></a>
    </div>	
	<div class="nbdesigner-clearfix"></div>
</div>
<?php else: ?>
<p><?php _e('No design in this order', $this->textdomain); ?></p>
<?php endif; ?>