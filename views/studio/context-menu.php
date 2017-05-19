<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="md-whiteframe-3dp nbd-contextmenu" ng-show="openContextMenu" id="nbd-contextmenu" ng-click="ctrl.deleteLayer()">
    <md-menu-content width="3">
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="rotateLayer('reflect-hoz')">
            <md-button aria-label="Reflect Horizontal">
                <md-icon md-svg-icon="nbd:reflect-horizontal"></md-icon> Reflect Horizontal
            </md-button>             
        </md-menu-item>
        <md-menu-item class="md-indent md-in-menu-bar"  ng-click="rotateLayer('reflect-ver')">
            <md-button aria-label="Reflect Vertical">
                <md-icon md-svg-icon="nbd:reflect-vertical"></md-icon> Reflect Vertical
            </md-button>  
        </md-menu-item>         
        <md-menu-item class="md-indent md-in-menu-bar">
            <md-button ng-disabled="true" aria-label="Replace Image" >
                <md-icon md-svg-icon="nbd:replace-image"></md-icon> Replace Image
            </md-button>  
        </md-menu-item>          
        <md-menu-divider></md-menu-divider>
        <md-menu-item class="md-indent md-in-menu-bar" ng-click="duplicateLayer()">
            <md-button aria-label="Duplicate" >
                <md-icon md-svg-icon="nbd:copy"></md-icon> Duplicate
            </md-button>  
        </md-menu-item>
        <md-menu-item class="md-indent md-in-menu-bar" ng-click="deleteLayer()">
            <md-button aria-label="Delete">
                <md-icon md-svg-icon="nbd:trash"></md-icon> Delete
            </md-button>  
        </md-menu-item>          
    </md-menu-content>
</div>

