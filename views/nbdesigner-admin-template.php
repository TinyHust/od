<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2><?php echo __('Manager Admin Template', 'nbdesigner'); ?></h2>
<div class="wrap">
    <?php  if(isset($_GET['pid'])):
        global $wpdb;
        $check = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='nbdesigner-admindesign-product-x1095'"); 
        $link_admindesign = get_page_link($check).'?product_id='.$_GET['pid'].'&p=extra&adid='.time();
    ?>  
        <div class="wrap">
            <h2>
                <?php _e('Templates for', 'nbdesigner'); ?>: <a href="<?php echo get_edit_post_link($_GET['pid']); ?>"><?php echo $pro->get_title(); ?></a>
                <a class="button" href="<?php echo $link_admindesign; ?>" target="_blank"><?php _e('Add Template'); ?></a>
                <a href="<?php echo admin_url('admin.php?page=nbdesigner_admin_template') ?>" class="button-primary nbdesigner-right"><?php _e('Back', 'nbdesigner'); ?></a>
            </h2>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <form method="post">
                            <?php
                                $templates_obj->prepare_items();
                                $templates_obj->display();
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
        <a href="?page=nbdesigner_admin_template&pid=<?php echo $pro['id']; ?>" class="nbdesigner-product-link"><?php echo $pro['img']; ?><br /><?php echo $pro['title']; ?></a>
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
    .column-folder img{
        width: 60px;
        margin-right: 5px;
        border: 1px solid #ddd;
        border-radius: 2px;
    }   
    .column-priority span {
        font-size: 20px;
    }
    .column-priority span.primary {
        color: #0085ba;
    }
</style>