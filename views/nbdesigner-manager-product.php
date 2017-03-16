<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2 class="nbd-title-page"><?php echo __('Manager NBDesigner Product', 'nbdesigner'); ?></h2>
<div class="wrap postbox nbdesigner-manager-product">
    <div>
	<?php 
            foreach($pro as $key => $val): 
            $link_manager_template = add_query_arg(array('pid' => $val["id"]), admin_url('admin.php?page=nbdesigner_admin_template'));    
        ?>
		<div class="nbdesigner-product">
                    <a class="nbdesigner-product-title"><span><?php echo $val['name']; ?></span></a>
                    <div class="nbdesigner-product-inner">
                        <a href="<?php echo $val['url']; ?>" class="nbdesigner-product-link"><?php echo $val['img']; ?></a> 
                    </div>
                    <p class="nbdesigner-product-link">
                        <a href="<?php echo $val['url']; ?>" title="<?php _e('Edit product', 'nbdesigner'); ?>"><span class="dashicons dashicons-edit"></span></a>
                        <a href="<?php echo $val['url']; ?>" title="<?php _e('Create template', 'nbdesigner'); ?>"><span class="dashicons dashicons-admin-customizer"></span></a>
                        <a href="<?php echo $val['url']; ?>" title="<?php _e('Manager template', 'nbdesigner'); ?>"><span class="dashicons dashicons-images-alt"></span></a>
                    </p>                     
		</div>		
	<?php endforeach;?>
    </div>
    <div class="tablenav top">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo $number_pro.' '. __('products', 'nbdesigner'); ?></span>
            <?php echo $paging->html();  ?>
        </div>
    </div>    
</div>