<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div style="visibility: hidden">
    <div class="md-dialog-container" id="colorDialog">
        <md-dialog class="modal-color" layout-padding aria-label="Color Palette">
            <md-toolbar>
                <div class="md-toolbar-tools">
                    <h2>Choose color</h2>
                    <span flex></span>
                    <md-button class="md-icon-button" ng-click="cancelDialog()">
                        <md-icon md-svg-src="nbd:delete" aria-label="Close dialog"></md-icon>
                    </md-button>  
                </div>
            </md-toolbar>          
            <md-dialog-content class="nbd-palette" id="nbd-palette">  
                <div class="nbd-palette-inner">
                    <div md-color-picker ng-model="currentTextColor" md-callback="showColorDialog()" skip-hide="true"></div>
                    <h3 style="font-size: 14px; text-transform: uppercase;">Custom</h3>
                    <div ng-repeat="color in customPalette" class="nbd-color">
                        <div ng-style="{'background': color, 'width' : '100%', 'height' : '100%'}"></div>
                        <md-tooltip md-direction="top" ng-class="primaryPalette">{{color}}</md-tooltip>
                    </div>                 
                    <h3 style="font-size: 14px; text-transform: uppercase;">Trendy</h3>
                    <div ng-repeat="colors in palette" class="palette-con">                    
                        <div ng-repeat="color in colors" class="nbd-color" ng-style="{'background': color}" ng-click="debug(color)">
                            <md-tooltip md-direction="top" ng-class="primaryPalette">{{color}}</md-tooltip>
                            <span class="color-shadow"></span>
                        </div>    
                    </div> 
                </div>
            </md-dialog-content>
        </md-dialog>
    </div>
</div>

