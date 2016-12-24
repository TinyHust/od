<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<?php
$templates = $args['templates'];
$row = absint($args['row']);
$per_row = absint($args['per_row']);
$des = $args['des'];
$k = 0;
echo "<p>".$des."</p>";
if(is_array($templates)):
    echo '<ul class="nbdesigner-gallery">';
    foreach ($templates as $temp): ?>
    <?php if($k % $per_row == 0) echo '<li class="nbdesigner-container">';?>
    <div class="nbdesigner-item">
        <div class="nbdesigner-con">
            <div class="nbdesigner-top">
                <img src="<?php echo $temp['design'][0]; ?>" class="nbdesigner-img"/>
            </div>
            <div class="nbdesigner-hover">
                <div class="nbdesigner-inner">
                    <a href="<?php echo add_query_arg(array('nbds-adid' => $temp['adid']), get_permalink( $temp['id'] )); ?>" class="nbdesigner-link" target="_blank">View design<span>→</span></a>
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