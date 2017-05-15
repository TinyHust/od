<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbd-stages" ng-style="{'width' : adjustStage('width'), 'height' : adjustStage('height')}">
    <div class="tool-bar" ng-style="{'left' : adjustStage('left'), 'width' : adjustStage('width')}">
        <div flex layout="row">
            <div flex layout-align="start center" layout="row" style="padding-left: 15px; border-right: 1px solid #ddd;">     
                <?php include_once('config-text.php'); ?> 
                <?php include_once('config-clipart.php'); ?>
                <?php include_once('config-image.php'); ?>
                <?php include_once('config-draw.php'); ?>
                <?php include_once('config-qrcode.php'); ?>
            </div>
            <div flex="none" layout-align="center center" layout="row" class="config-general">
                <?php include_once('config-genaral.php'); ?>
            </div>
        </div>    
    </div>     
    <div class="stages-inner" id="stages-inner">
        <div class="nbd-on-process" ng-show="onProcess">
            <div flex layout-align="center center" layout="row" class="nbd-on-process-inner">
                <md-progress-circular class="md-primary md-default" md-diameter="70"></md-progress-circular>
            </div>
        </div>         
        <div class="stage" ng-repeat="stage in stages" ng-repeat="stage in stages" on-finish-render-canvas="stageRepeatFinished" 
             ng-class="{'hidden':$index > 0}" id="stage-container-{{stage.id}}">
            <div class="stage-inner">
                <div class="stage-content md-whiteframe-5dp"
                     ng-style="{'width' : calcStageDimension(stage, 'width') + 'px', 'height' : calcStageDimension(stage, 'height') + 'px'}"> 
                    <div class="stage-background" ng-style="{'background' : stage.background}"></div>
                    <div class="design-zone">
                        <canvas id="stage-{{stage.id}}" width="500px" height="500px"></canvas>
                    </div>
                    <div class="stage-overlay"></div>
                    <div class="stage-grid">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" ng-show="showGrid">
                            <defs>
                                <pattern id="grid10" width="10" height="10" patternUnits="userSpaceOnUse">
                                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="gray" stroke-width="0.5"/>
                                </pattern>
                                <pattern id="grid100" width="100" height="100" patternUnits="userSpaceOnUse">
                                    <rect width="100" height="100" fill="url(#grid10)"/>
                                    <path d="M 100 0 L 0 0 0 100" fill="none" stroke="gray" stroke-width="1"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#grid100)" />
                        </svg>                        
                    </div>
                </div> 
            </div>
            <div class="page-toolbar" ng-show="_.size(stages) > 1">
                <div class="page-toolbar-inner" flex layout="row" layout-align="center center">
                    <div flex="grow" class="page-toolbar-action">
                        <md-button class="md-icon-button nbd-mag-0" aria-label="Up" ng-disabled="$first" ng-click="switchStage(stage, 'prev')">
                            <md-icon md-svg-icon="nbd:up"></md-icon>
                        </md-button>   
                        <p>{{stage.id}}</p>                       
                        <md-button class="md-icon-button nbd-mag-0"  ng-disabled="$last" aria-label="Down" ng-click="switchStage(stage, 'next')">
                            <md-icon md-svg-icon="nbd:down"></md-icon>
                        </md-button>      
                        <md-button class="md-icon-button nbd-mag-0" aria-label="Refresh Stage" ng-click="refreshStage()">
                            <md-icon md-svg-icon="nbd:refresh" class="bold"></md-icon>
                            <md-tooltip md-direction="right" ng-class="primaryPalette">{{(i18nLangs['RESET_DESIGN']) ? i18nLangs['RESET_DESIGN'] : 'Reset Design'}}</md-tooltip>
                        </md-button>                         
                    </div>
                </div>               
            </div>
        </div>
        <?php include_once('google-fonts.php'); ?>
    </div> 
    <md-button class="md-fab md-mini md-fab-bottom-right" aria-label="Add Stage" ng-disabled="canAddStage" style="bottom: 70px;">
        <md-icon md-svg-icon="nbd:add-stage"></md-icon> 
    </md-button>       
</div>