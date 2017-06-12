<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbd-stages" ng-style="{'width' : adjustStage('width'), 'height' : adjustStage('height')}">
    <?php include_once('tools-bar.php'); ?>  
    <div class="stages-inner" id="stages-inner">
        <div class="nbd-on-process" ng-show="onProcess">
            <div flex layout-align="center center" layout="row" class="nbd-on-process-inner">
                <md-progress-circular class="md-primary md-default" md-diameter="70"></md-progress-circular>
            </div>
        </div> 
        <div class="guideline-notation md-whiteframe-2dp" ng-show="showGuideline">
            <p><span class="notation-guiline" style="border-top-color: red;"></span> Bleed<br /></p>
            <p><span class="notation-guiline" style="border-top-color: blue; border-top-style: dashed;"></span> Trim Line<br /></p>
            <p><span class="notation-guiline" style="border-top-color: green;"></span> Safe Zone</p>
        </div>        
        <div class="stage" ng-repeat="stage in stages" ng-repeat="stage in stages" on-finish-render-canvas="stageRepeatFinished" 
             ng-class="{'hidden':$index > 0}" id="stage-container-{{stage.id}}">
            <div class="stage-inner">
                <div class="stage-content md-whiteframe-5dp" ng-contextmenu action="showContextMenu"
                     ng-style="{'width' : stage.widthRange[stage.currentScale] + 'px', 'height' : stage.heightRange[stage.currentScale] + 'px'}"> 
                    <div class="stage-background" ng-style="{'background' : stage.background}">
                    </div>
                    <div class="design-zone">
                        <canvas id="stage-{{stage.id}}" width="500px" height="500px"></canvas>
                    </div>
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
                    <div ng-show="snapMode" class="stage-snaplines">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <div id="horizontal-line-{{stage.id}}" class="snapline horizontal"></div>
                            <div id="bhorizontal-line-{{stage.id}}" class="snapline horizontal"></div>
                            <div id="mhorizontal-line-{{stage.id}}" class="snapline horizontal"></div>
                            <div id="vertical-line-{{stage.id}}" class="snapline vertical"></div>                            
                            <div id="rvertical-line-{{stage.id}}" class="snapline vertical"></div>                            
                            <div id="mvertical-line-{{stage.id}}" class="snapline vertical"></div>                            
                            <div id="horizontal-center-line-{{stage.id}}" class="snapline horizontal"></div>                            
                            <div id="vertical-center-line-{{stage.id}}" class="snapline vertical"></div>                            
                        </div>
                    </div>                    
                    <div class="stage-overlay" ng-style="{'background' : stage.overlay}">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <span ng-show="isActiveLayer" id="bounding-position-{{stage.id}}" style="font-size: 9px; position: absolute; left: -9999px; top: -9999px; text-shadow: rgb(255, 255, 255) 0px 0px 2px;">0, 0</span><br />                       
                        </div>
                    </div>                         
                    <div class="stage-guideline" ng-show="showGuideline">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <div class="guideline" style="width: 100%; height: 100%; border-color: red;"></div>
                            <div class="guideline" style="border-color: blue; border-style: dashed;" ng-style="{'width': stage.contentWidth[stage.currentScale] + 'px', 
                                'height': stage.contentHeight[stage.currentScale] + 'px',
                                'left': stage.bleedLeft[stage.currentScale] + 'px',    
                                'top': stage.bleedTop[stage.currentScale] + 'px'}">
                            </div>
                            <div class="guideline" style="border-color: green;" ng-style="{'width': stage.safeContentWidth[stage.currentScale] + 'px', 
                                'height': stage.safeContentHeight[stage.currentScale] + 'px',
                                'left': stage.marginLeft[stage.currentScale] + 'px',    
                                'top': stage.marginTop[stage.currentScale] + 'px'}">
                            </div>                            
                        </div>
                    </div>
                </div> 
            </div>
            <div class="page-toolbar" ng-show="_.size(stages) > 1" ng-style="{'height' : stage.heightRange[stage.currentScale] + 'px', 'left' : calcPageToolBarLeft(stage) + 'px'}">
                <div class="page-toolbar-inner" flex layout="row" layout-align="center center">
                    <div flex="grow" class="page-toolbar-action">
                        <md-button class="md-icon-button nbd-mag-0" aria-label="Up" ng-disabled="$first" ng-click="switchStage(stage, 'prev')">
                            <md-icon md-svg-icon="nbd:up"></md-icon>
                        </md-button>   
                        <p>{{stage.id + 1}}</p>                       
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
    <div class="movement">
        <md-fab-speed-dial md-direction="right" md-open="openMovement"   ng-init="openMovement = false"
                ng-mouseenter="openMovement = true" ng-mouseleave="openMovement = false" class="md-scale">
            <md-fab-trigger>
                <md-button aria-label="movement" class="md-fab md-mini">
                    <md-icon md-svg-src="nbd:movent"></md-icon>
                </md-button>
            </md-fab-trigger>    
            <md-fab-actions>
                <md-button aria-label="Left" class="md-fab md-mini nbd-movement">
                    <md-icon md-svg-src="nbd:move-left" aria-label="Left"></md-icon>
                </md-button>         
                <md-button aria-label="Top" class="md-fab md-mini nbd-movement">
                    <md-icon md-svg-src="nbd:move-up" aria-label="Top"></md-icon>
                </md-button>        
                <md-button aria-label="Right" class="md-fab md-mini nbd-movement">
                    <md-icon md-svg-src="nbd:move-right" aria-label="Right"></md-icon>
                </md-button>         
                <md-button aria-label="Bottom" class="md-fab md-mini nbd-movement">
                    <md-icon md-svg-src="nbd:move-down" aria-label="Bottom"></md-icon>
                </md-button>                  
            </md-fab-actions>
        </md-fab-speed-dial>
    </div>
    <md-button class="md-fab md-mini md-fab-bottom-right" aria-label="Add Stage" 
        ng-disabled="canAddStage" style="bottom: 70px;" ng-click="addStage()">
        <md-icon md-svg-icon="nbd:add-stage"></md-icon> 
    </md-button>       
</div>