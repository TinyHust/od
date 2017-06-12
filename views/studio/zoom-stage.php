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
    <div flex="25" layout-align="center center" layout="column" style="position: relative;">
        <md-button class="md-icon-button" aria-label="Language" ng-click="showScaleRange = !showScaleRange" style="font-size: 12px;">
            {{_round(stages[currentStage].scaleRange[stages[currentStage].currentScale] * 100)}}%
        </md-button>       
        <ul ng-show="showScaleRange" class="zoom-range md-whiteframe-3dp animate400" ng-class="showScaleRange ? 'zoomIn' : 'zoomOut'">
            <li md-ink-ripple ng-repeat="zoom in stages[currentStage].scaleRange" ng-class="$index == stages[currentStage].currentScale ? 'active' : ''" ng-click="toggleZoomRange(); zoomStage($index)"><span>{{_round(zoom * 100)}}%</span></li>
        </ul>
    </div>
    <md-button class="md-icon-button" aria-label="Zoom Out" ng-click="zoomStage('+')">
        <md-icon md-svg-icon="nbd:plus"></md-icon>
    </md-button>     
</div>
