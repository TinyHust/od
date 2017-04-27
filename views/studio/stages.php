<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbd-stages" ng-style="{'width' : adjustStage('width'), 'height' : adjustStage('height')}">
    <div class="tool-bar" ng-style="{'left' : adjustStage('left'), 'width' : adjustStage('width')}">
        <div flex layout="row">
            <div flex layout-align="start center" layout="row" style="padding: 0 15px; border-right: 1px solid #ddd;">
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
        <div class="stage" ng-repeat="stage in stages"  ng-repeat="stage in stages">
            <canvas id="c{{stage.id}}" width="500px" height="500px"></canvas>
            <div class="page-toolbar" ng-show="isMutilpleStages">
                <div class="page-toolbar-inner" flex layout="row" layout-align="center center">
                    <div flex="grow" class="page-toolbar-action">
                        <md-button class="md-icon-button nbd-mag-0" aria-label="Up" ng-disabled="isFirstStage">
                            <md-icon md-svg-icon="nbd:up"></md-icon>
                        </md-button>   
                        <p>{{stage.id}}</p>                       
                        <md-button class="md-icon-button nbd-mag-0" aria-label="Down">
                            <md-icon md-svg-icon="nbd:down"></md-icon>
                        </md-button>      
                        <md-button class="md-icon-button nbd-mag-0" aria-label="Down">
                            <md-icon md-svg-icon="nbd:refresh" class="bold"></md-icon>
                            <md-tooltip md-direction="right" ng-class="primaryPalette">Clear Design</md-tooltip>
                        </md-button>                         
                    </div>
                </div>               
            </div>
        </div>
        <div style="height: 60px;">
            <hr class="nbd-divider add-stage"/>
            <div class="add-stage-sign">
                <div class="add-stage-sign-inner">
                    <md-button class="md-fab md-mini" aria-label="Add Stage" ng-disabled="canAddStage">
                        <md-icon md-svg-icon="nbd:add-stage"></md-icon> 
                    </md-button>     
                </div>    
            </div>
        </div>        
    </div> 
</div>