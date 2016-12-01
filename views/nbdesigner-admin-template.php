<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2><?php echo __('Manager Admin Template', $this->textdomain); ?></h2>
<div>
    <?php  if(isset($_GET['id'])):?>
    <h3>
        <?php echo $pro->get_title(); ?>&nbsp;
        <button class="button-primary" onclick="NBDESIGNADMIN.make_primary_design(<?php echo $_GET['id']; ?>)"><?php _e('Make Primary Design', $this->textdomain); ?></button>
        <img src="<?php echo NBDESIGNER_PLUGIN_URL . 'assets/images/loading.gif'; ?>" class="nbdesigner_primary_design nbdesigner_loaded" style="margin-left: 15px;"/>
    </h3>
    <?php foreach ($list_design as $key => $des): ?>
    <?php if($key == 'primary'){ ?>
    <div>
        <input type="radio" name="nbdesigner_primary" value="<?php echo $key; ?>" checked class="nbdesigner-admin-template-primary"/>
        <?php foreach ($des as $d): ?>
        <img src="<?php echo $d; ?>" class="nbdesigner-admin-template-detail"/>
        <?php endforeach; ?>
    </div>
    <?php } ?>
    <?php endforeach; ?>
    <?php foreach ($list_design as $key => $des): ?>
    <?php if($key != 'primary'){ ?>
    <div>
        <input type="radio" name="nbdesigner_primary" value="<?php echo $key; ?>" class="nbdesigner-admin-template-primary"/>
        <?php foreach ($des as $d): ?>
        <img src="<?php echo $d; ?>" class="nbdesigner-admin-template-detail"/>
        <?php endforeach; ?>
    </div>
    <?php } ?>
    <?php endforeach; ?>    
    <?php else: ?>
    <div class="wrap postbox nbdesigner-admin-template">
        <?php foreach ($list_product as $pro): ?>
            <a href="?page=nbdesigner_admin_template&id=<?php echo $pro['id']; ?>" class="nbdesigner-product-link"><?php echo $pro['img']; ?></a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>