<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="tool-bar animated" ng-style="{'left' : adjustStage('left'), 'width' : adjustStage('width')}" ng-class="isActiveLayer ? 'fadeInDown' : 'fadeOutUp'">
    <div flex layout="row">
        <div flex layout-align="start center" layout="row" style="padding-left: 15px; border-right: 1px solid #ddd;">     
            <?php include_once('tools-text.php'); ?> 
            <?php include_once('tools-clipart.php'); ?>
            <?php include_once('tools-image.php'); ?>
            <?php include_once('tools-draw.php'); ?>
            <?php include_once('tools-qrcode.php'); ?>
            <?php include_once('tools-group.php'); ?>
        </div>
        <div flex="none" layout-align="center center" layout="row" class="config-general">
            <?php include_once('tools-genaral.php'); ?>
        </div>
    </div>    
</div>    
