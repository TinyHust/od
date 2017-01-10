<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2><?php echo __('Manager Admin Template', $this->textdomain); ?></h2>
<div class="wrap">
    <?php  if(isset($_GET['id'])):?>
    <h3>
        <a href="<?php echo admin_url('admin.php?page=nbdesigner_admin_template') ?>" class="button-primary nbdesigner-right"><?php _e('Back', $this->textdomain); ?></a>
        <?php _e('Product', $this->textdomain); ?>: <a href="<?php echo get_edit_post_link($_GET['id']); ?>"><?php echo $pro->get_title(); ?></a>(<?php echo count($list_design); ?> <?php _e('Templates', $this->textdomain); ?>)
    </h3>
    <div class="nbdesign-template-actions tablenav">
        <div class="alignleft actions">
            <select id="nbdesigner-admin-template-action">
                <option value="-1"><?php _e('Bulk Actions', $this->textdomain); ?></option>
                <option value="primary"><?php _e('Make Primary Design', $this->textdomain); ?></option>
                <option value="publish"><?php _e('Publish Design', $this->textdomain); ?></option>
                <option value="unpublish"><?php _e('Unpublish Design', $this->textdomain); ?></option>
                <option value="private"><?php _e('Private Design', $this->textdomain); ?></option>
                <option value="delete"><?php _e('Delete Design', $this->textdomain); ?></option>
            </select>
            <button class="button-primary" onclick="NBDESIGNADMIN.make_primary_design(<?php echo $_GET['id']; ?>)"><?php _e('Apply', $this->textdomain); ?></button>
        </div>
        <div class="alignleft actions">
            <form method="post" action="">
                <select id="nbdesigner-admin-template-filter" name="nbdesigner_filter">
                    <option value="-1"><?php _e('Show all design', $this->textdomain); ?></option>
                    <option value="publish"><?php _e('Publish design', $this->textdomain); ?></option>
                    <option value="unpublish"><?php _e('Unpublish design', $this->textdomain); ?></option>
                    <option value="private"><?php _e('Private design', $this->textdomain); ?></option>
                </select>
                <?php wp_nonce_field($this->plugin_id, $this->plugin_id . '_hidden'); ?>	
                <button class="button-primary" type="submit"><?php _e('Filter', $this->textdomain); ?></button>
            </form>
        </div>
        <img src="<?php echo NBDESIGNER_PLUGIN_URL . 'assets/images/loading.gif'; ?>" class="nbdesigner_primary_design nbdesigner_loaded" style="margin-left: 15px;"/>
    </div>    
    <?php foreach ($list_design as $key => $des): ?>
    <?php if($key == 'primary'){ ?>
    <div class="nbdesigner-template-item" id="nbdesigner-template-item-<?php echo $key; ?>">
        <input type="radio" name="nbdesigner_primary" value="<?php echo $key; ?>" checked class="nbdesigner-admin-template-primary"/>
        <?php foreach ($des as $d): ?>
        <img src="<?php echo $d; ?>" class="nbdesigner-admin-template-detail"/>
        <?php endforeach; ?>
    </div>
    <?php } ?>
    <?php endforeach; ?>
    <?php foreach ($list_design as $key => $des): ?>
    <?php if($key != 'primary'){ ?>
    <div class="nbdesigner-template-item" id="nbdesigner-template-item-<?php echo $key; ?>">
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