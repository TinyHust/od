<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h2>
    <?php _e('Detail product design', $this->textdomain); ?>
    <a class="button-primary nbdesigner-right" href="<?php echo admin_url('post.php?post=' . absint($order_id) . '&action=edit'); ?>"><?php _e('Back to order', $this->textdomain); ?></a>
</h2>
<?php if(!isset($_GET['product_id'])): ?>
	<p><?php echo __('Go to order detail and choose product design you want to view detail!', $this->textdomain); ?></p>
<?php else: 
    
    ?>
    <div class="nbdesigner_detail_order_container">
        <div class="nbdesigner_preview">
           <img src="" id="nbdesigner_large_image"/>
           <img src="" id="nbdesigner_large_design"/>
        </div>
        <div class="owl-carousel">
        <?php if(is_array($datas)){
            foreach($datas as $key => $data): ?>
            <div class="item nbdesigner_item">
                <img class="large" data-style="<?php echo 'top: '.(2*$data['img_src_top']).'px; left: '.(2*$data['img_src_left']).'px; width: '.(2*$data['img_src_width']).'px; height: '.(2*$data['img_src_height']).'px;'; ?>" class="nbdesigner_detail_order" src="<?php echo $data['img_src'] ?>" 
                    data-design="<?php echo 'top: '.(2*$data['area_design_top']).'px; left: '.(2*$data['area_design_left']).'px; width: '.(2*$data['area_design_width']).'px; height: '.(2*$data['area_design_height']).'px;'; ?>" 
                    data-design-src="<?php if(isset($list_design[$key])) echo $list_design[$key]; else echo ''; ?>" data-index="<?php echo $key; ?>"
                    style="position: absolute; <?php echo 'top: '.(1/2*$data['img_src_top']).'px; left: '.(1/2*$data['img_src_left']).'px; width: '.(1/2*$data['img_src_width']).'px; height: '.(1/2*$data['img_src_height']).'px;'; ?>"
                    />
                <?php if(isset($list_design[$key])): ?>
                <img src="<?php echo $list_design[$key]; ?>" 
                    style="position: absolute; <?php echo 'top: '.(1/2*$data['area_design_top']).'px; left: '.(1/2*$data['area_design_left']).'px; width: '.(1/2*$data['area_design_width']).'px; height: '.(1/2*$data['area_design_height']).'px;'; ?>" 
                />
                <?php endif; ?>
            </div>         
        <?php endforeach;} ?>    
        </div>        
    </div>
    <script>
        jQuery(document).ready(function() {
            var img_dg = '<img src="" id="nbdesigner_large_design"/>';
            jQuery('.owl-carousel').owlCarousel({
                loop:true,
                items:4  
            });
            var first = jQuery('.owl-item.active').first().find('img.large'),
            src = first.attr('src'),
            design = first.data('design'),
            style = first.data('style'),
            design_src = first.data('design-src');
            jQuery('#nbdesigner_large_image').attr('src', src);
            jQuery('#nbdesigner_large_image').attr('style', style);
            if(design_src != ''){
                jQuery('#nbdesigner_large_design').attr('src', design_src);  
            }else{
                jQuery('#nbdesigner_large_design').remove();
            }
            jQuery('#nbdesigner_large_design').attr('style', design);
            jQuery('.nbdesigner_order_design_info:not(:first-child)').hide();
            jQuery('.owl-item').on('click', function() {
                var img = jQuery(this).find('img.large'),
                src = img.attr('src'),
                style = img.data('style'),
                design = img.data('design'),
                index = img.data('index'),
                design_src = img.data('design-src');                
                jQuery('#nbdesigner_large_image').attr('src', src);
                jQuery('#nbdesigner_large_image').attr('style', style);
                if(design_src != ''){
                    if(!jQuery('#nbdesigner_large_design').length) jQuery('.nbdesigner_preview').append(img_dg);
                    jQuery('#nbdesigner_large_design').attr('src', design_src);
                }else{
                    jQuery('#nbdesigner_large_design').remove();
                } 
                jQuery('#nbdesigner_large_design').attr('style', design);
                jQuery('.nbdesigner_order_design_info').hide();
                jQuery('.nbdesigner_order_design_info'+'.nb_'+index).show();
            });           
        });
       
    </script>           
<?php endif; ?>