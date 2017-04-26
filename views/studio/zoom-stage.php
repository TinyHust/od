<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="zoom" flex layout="row">
    <div flex="25" class="presentation">
        <md-button class="md-icon-button" aria-label="Zoom out" onclick="nbdPlg.zoomStageFullScreen()">
            <md-icon md-svg-icon="nbd:presentation"></md-icon>
        </md-button> 
    </div>    
    <md-button class="md-icon-button" aria-label="Zoom Int" ng-click="zoomIntStage()">
        <md-icon md-svg-icon="nbd:minus"></md-icon>
    </md-button>    
    <div flex="25" layout-align="center center" layout="column">{{currentStageRatio}}%</div>
    <md-button class="md-icon-button" aria-label="Zoom Out" ng-click="zoomOutStage()">
        <md-icon md-svg-icon="nbd:plus"></md-icon>
    </md-button>     
</div>
