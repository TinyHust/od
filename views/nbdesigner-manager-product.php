<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2 class="nbd-title-page"><?php echo __('Manager NBDesigner Product', $this->textdomain); ?></h2>
<div class="wrap postbox nbdesigner-manager-product">
    <div>
	<?php foreach($pro as $key => $val): ?>
		<div class="nbdesigner-product">
			<a href="<?php echo $val['url']; ?>" class="nbdesigner-product-link"><?php echo $val['img']; ?></a>
			<a><span><?php echo $val['name']; ?></span></a>
		</div>		
	<?php endforeach;?>
    </div>
    <div class="tablenav top">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo $number_pro.' '. __('products', $this->textdomain); ?></span>
            <?php echo $paging->html();  ?>
        </div>
    </div>    
</div>