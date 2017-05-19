<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="nbd-sub-menu" class="nbd-sub-menu zoomOut hidden">
    <md-dialog layout-padding aria-label="Sub Menu" class="nbd-sub-menu-inner">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Shadow</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="toggleSubMenu()">
                    <md-icon md-svg-src="nbd:delete" aria-label="Close dialog"></md-icon>
                </md-button>  
            </div>
        </md-toolbar>          
        <md-dialog-content class="nbd-sub-menu-content">   
            <div class="" >
                <div>
                    <div flex  layout="row">
                        <md-switch flex="50" class="md-primary nbd-switch-shadow" md-invert aria-label="Shadow" ng-model="enableShadow">
                            Enable
                        </md-switch>  
                        <div flex="50" layout="row" layout-align="start center">
                            <span class="preview-shadow"
                                ng-click="_showColorDialog('shasow')"
                                ng-style="{'background' : 'yellow', 'box-shadow' : getStylePrviewShadow()}" > 
                                <md-tooltip md-direction="top" ng-class="primaryPalette">Change color</md-tooltip>
                            </span>   
                        </div> 
                    </div>    
                    <div class="config-shadow" ng-class="!enableShadow ? 'disabled' : ''">
                        <md-slider-container >
                            <span flex="20">X</span>
                            <md-slider flex="60" class="md-primary" aria-label="Dimension X" min="0" max="25" step="1" flex  ng-model="shadowX" id="shadow-x"></md-slider>
                            <md-input-container flex="20">
                                <input flex type="number" min="0" max="25" step="1" ng-model="shadowX" aria-label="X" aria-controls="shadow-x"> 
                            </md-input-container>        
                        </md-slider-container>
                        <md-slider-container >
                            <span flex="20">Y</span>
                            <md-slider flex="60" class="md-primary" aria-label="Dimension Y" min="0" max="25" step="1" flex  ng-model="shadowY" id="shadow-y"></md-slider>
                            <md-input-container flex="20">
                                <input flex type="number" min="0" max="25" step="1" ng-model="shadowY" aria-label="X" aria-controls="shadow-y"> 
                            </md-input-container>        
                        </md-slider-container>             
                        <md-slider-container >
                            <span flex="20">Blur</span>
                            <md-slider flex="60" class="md-primary" aria-label="Blur" min="0" max="25" step="1" flex  ng-model="shadowBlur" id="shadow-blur"></md-slider>
                            <md-input-container flex="20">
                                <input flex type="number" min="0" max="25" step="1" ng-model="shadowBlur" aria-label="Blur" aria-controls="shadow-blur"> 
                            </md-input-container>        
                        </md-slider-container>
                        <md-slider-container >
                            <span flex="20">Opacity</span>
                            <md-slider flex="60" class="md-primary" aria-label="Opacity" min="0" max="1" step="0.1" flex  ng-model="shadowOpacity" id="shadow-opacity"></md-slider>
                            <md-input-container flex="20">
                                <input flex type="number" min="0" max="1" step="0.1" ng-model="shadowOpacity" aria-label="Opacity" aria-controls="shadow-opacity"> 
                            </md-input-container>        
                        </md-slider-container>                               
                    </div>
                </div>
            </div>    
        </md-dialog-content>
    </md-dialog>
</div>    
