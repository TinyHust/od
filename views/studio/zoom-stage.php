<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="zoom md-whiteframe-1dp" flex layout="row">
    <div flex="25" class="presentation">
        <md-button class="md-icon-button" aria-label="Zoom out" onclick="nbdPlg.zoomStageFullScreen()">
            <md-icon md-svg-icon="nbd:full-page"></md-icon>
        </md-button> 
    </div>    
    <md-button class="md-icon-button" aria-label="Zoom Int" ng-click="zoomStage('-')">
        <md-icon md-svg-icon="nbd:minus"></md-icon>
    </md-button>    
    <div flex="25" layout-align="center center" layout="column">{{_round(stages[currentStage].scaleRange[stages[currentStage].currentScale] * 100)}}%</div>
    <md-button class="md-icon-button" aria-label="Zoom Out" ng-click="zoomStage('+')">
        <md-icon md-svg-icon="nbd:plus"></md-icon>
    </md-button>     
</div>
