<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  
$row = absint($row);
$per_row = absint($per_row);
$k = 0;
$total = 0;
$limit = $per_row * $row;
echo "<p>".$des."</p>";
if(is_array($templates)):
    echo '<ul class="nbdesigner-gallery">';
    $total = count($templates);
    $temps = $templates;
    if(($total > $limit) && $pagination){
        $temps = array_slice($templates, ($page-1)*$limit, $limit);    
    }
    foreach ($temps as $temp): ?>
    <?php if($k % $per_row == 0) echo '<li class="nbdesigner-container">';?>
    <div class="nbdesigner-item">
        <div class="nbdesigner-con">
            <div class="nbdesigner-top">
                <img src="<?php echo $temp['design'][0]; ?>" class="nbdesigner-img"/>
            </div>
            <div class="nbdesigner-hover">
                <div class="nbdesigner-inner">
                    <a href="<?php echo add_query_arg(array('nbds-adid' => $temp['adid']), get_permalink( $temp['id'] )); ?>" class="nbdesigner-link" >View design<span>→</span></a>
                </div>
            </div>            
        </div>
    </div>
    <?php if($k % $per_row == ($per_row -1)) echo '</li>';?>
    <?php 
    $k ++;
    endforeach;
    echo '</ul>';
endif; ?>
<?php if(($total > $limit) && $pagination): ?>
<?php  
    require_once NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.pagination.php';
    $paging = new Nbdesigner_Pagination();
    $url = '';
    $config = array(
        'current_page'  => isset($page) ? $page : 1, 
        'total_record'  => $total,
        'limit'         => $limit,
        'link_full'     => $url.'?paged={p}',
        'link_first'    => $url              
    );	        
    $paging->init($config); 
?>
    <div class="tablenav top nbdesigner-pagination-con">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo $total.' '. __('Templates', 'nbdesigner'); ?></span>
            <?php echo $paging->html();  ?>
        </div>
    </div>  
<?php endif; ?>
