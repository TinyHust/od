<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div layout="row" layout-wrap class="header-fixed md-whiteframe-1dp">
    <div class="logo" flex="none" layout-align="center center" layout="row">
        <md-button class="md-icon-button menu" aria-label="Menu" ng-click="toggleSidebar()">
            <md-icon md-svg-icon="nbd:menu" class="menu"></md-icon>
        </md-button>
        <md-menu-bar style="display: inline-block;">
            <md-menu >
                <button class="md-icon-button" aria-label="View"  ng-click="$mdMenu.open()">
                    <span>View</span>
                </button >   
                <md-menu-content width="3">
                    <md-menu-item>
                        <md-menu>
                            <md-button ng-disabled="!snapMode" ng-click="$mdMenu.open()">Snap To</md-button>
                            <md-menu-content width="3">
                                <md-menu-item ng-disabled="!showGrid" type="radio" ng-model="snapType" value="grid" ng-change="changeSnapMode('grid')">
                                    <md-button >Grid</md-button>
                                </md-menu-item>
                                <md-menu-item type="radio" ng-model="snapType" value="layer" ng-change="changeSnapMode('layer')">
                                    <md-button >Layers</md-button>
                                </md-menu-item> 
                                <md-menu-item type="radio" ng-model="ctrl.snapType" value="bound" ng-change="changeSnapMode('bound')">
                                    <md-button >Stage Bounds</md-button>
                                </md-menu-item>                                 
                            </md-menu-content>
                        </md-menu>            
                    </md-menu-item>                     
                </md-menu-content>
            </md-menu>
        </md-menu-bar>
    </div>
    <div flex="" class="nbd-tools" layout-align="center center" layout="row">   
        <md-button class="md-icon-button" aria-label="Undo" ng-click="undo()">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Undo</md-tooltip>
            <md-icon md-svg-icon="nbd:undo"></md-icon>
        </md-button>  
        <md-button class="md-icon-button" aria-label="Redo" ng-click="redo()">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Redo</md-tooltip>
            <md-icon md-svg-icon="nbd:redo"></md-icon>
        </md-button>          
        <md-button class="md-icon-button" aria-label="Grid" ng-click="showGrid = !showGrid">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">{{ !showGrid ? 'Grid' : 'Grid Off' }}</md-tooltip>
            <md-icon md-svg-icon="nbd:{{ !showGrid ? 'grid' : 'grid-off' }}"></md-icon>
        </md-button>   
        <md-button class="md-icon-button" aria-label="Snap" ng-click="snapMode = !snapMode">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">{{ !snapMode ? 'Snap' : 'Snap Off' }}</md-tooltip>
            <md-icon md-svg-icon="nbd:{{ !snapMode ? 'magnet-on' : 'magnet' }}"></md-icon>
        </md-button>   
        <md-button class="md-icon-button" aria-label="Guideline" ng-click="showGuideline = !showGuideline">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Guideline</md-tooltip>
            <md-icon md-svg-icon="nbd:guideline"></md-icon>
        </md-button>          
        <md-button class="md-icon-button" aria-label="Debug" ng-click="debug()">
            <md-icon md-svg-icon="nbd:magic"></md-icon>
        </md-button>    
        <md-button class="md-icon-button" aria-label="Debug2" ng-click="debug2()">
            <md-icon md-svg-icon="nbd:magic"></md-icon>
        </md-button>         
    </div>   
    <div flex="none" layout-align="center center" layout="row">
        <p class="current-stage-name">{{stages[currentStage]['name']}}</p>
        <md-button class="md-icon-button slideInDown animate600" aria-label="Cart" ng-click="saveCart()">
            <md-icon md-svg-icon="nbd:download"></md-icon>
        </md-button>        
        <md-button class="md-icon-button slideInDown animate700" aria-label="Cart" ng-click="saveCart()">
            <md-icon md-svg-icon="nbd:cart"></md-icon>
        </md-button>   
        <md-button class="md-icon-button slideInDown animate800" aria-label="Save">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Save for later</md-tooltip>
            <md-icon md-svg-icon="nbd:save"></md-icon>
        </md-button>    
        <md-menu  md-position-mode="target-left target">
            <md-button class="md-icon-button slideInDown animate900" aria-label="Share" ng-click="$mdMenu.open($event)">
                <md-tooltip md-direction="bottom" ng-class="primaryPalette">Share</md-tooltip>
                <md-icon md-svg-icon="nbd:share"></md-icon>
            </md-button> 
            <md-menu-content width="3" flex layout="column">
                <md-menu-item flex="25">
                    <md-button aria-label="facebook">
                        <div layout="row" flex>
                            <md-icon md-menu-align-target md-svg-icon="nbd:language" style="margin: auto 3px auto 0;"></md-icon>
                        </div>
                    </md-button>
                </md-menu-item>    
                <md-menu-item flex="25">
                    <md-button aria-label="facebook">
                        <div layout="row" flex>
                            <md-icon md-menu-align-target md-svg-icon="nbd:language" style="margin: auto 3px auto 0;"></md-icon>
                        </div>
                    </md-button>
                </md-menu-item>                   
            </md-menu-content>            
        </md-menu>
        <md-menu>
            <md-button class="md-icon-button slideInDown animate1000" aria-label="Language" ng-click="$mdMenu.open($event)">
                <md-icon md-svg-icon="nbd:language"></md-icon>
            </md-button>   
            <md-menu-content width="3">
                <md-menu-item ng-repeat="lang in langs">
                    <md-button ng-click="ctrl.announceClick(lang.code)"  aria-label="facebook">
                        <div layout="row" flex>
                            <p flex>{{lang.name}}</p>
                            <md-icon md-menu-align-target md-svg-icon="nbd:language" style="margin: auto 3px auto 0;"></md-icon>
                        </div>
                    </md-button>
                </md-menu-item>                                  
            </md-menu-content>
        </md-menu>                           
    </div>
 </div>