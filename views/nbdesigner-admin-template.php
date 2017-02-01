<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2><?php echo __('Manager Admin Template', $this->textdomain); ?></h2>
<div class="wrap">
    <?php  if(isset($_GET['pid'])):?>  
        <div class="wrap">
            <h2>
                <?php _e('Templates', $this->textdomain); ?> : <a href="<?php echo get_edit_post_link($_GET['pid']); ?>"><?php echo $pro->get_title(); ?></a>
                <a href="<?php echo admin_url('admin.php?page=nbdesigner_admin_template') ?>" class="button-primary nbdesigner-right"><?php _e('Back', $this->textdomain); ?></a>
            </h2>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <form method="post">
                            <?php
                            $customers_obj->prepare_items();
                            $customers_obj->display();
                            ?>
                            </form>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>        
    <?php else: ?>
    <div class="wrap postbox nbdesigner-admin-template">
        <?php foreach ($list_product as $pro): ?>
            <a href="?page=nbdesigner_admin_template&pid=<?php echo $pro['id']; ?>" class="nbdesigner-product-link"><?php echo $pro['img']; ?></a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<style>
    .column-folder {
        width: 50%;
    }
    .column-user_id {
        width: 10%;
    }
</style>