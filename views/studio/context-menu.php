<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="md-whiteframe-3dp nbd-contextmenu" ng-show="openContextMenu" id="nbd-contextmenu" ng-click="ctrl.deleteLayer()">
    <md-menu-content width="3">
        <!-- For Item -->
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="rotateLayer('reflect-hoz')" ng-show="isItem">
            <md-button aria-label="Reflect Horizontal">
                <md-icon md-svg-icon="nbd:reflect-horizontal"></md-icon> Reflect Horizontal
            </md-button>             
        </md-menu-item>
        <md-menu-item class="md-indent md-in-menu-bar"  ng-click="rotateLayer('reflect-ver')" ng-show="isItem">
            <md-button aria-label="Reflect Vertical">
                <md-icon md-svg-icon="nbd:reflect-vertical"></md-icon> Reflect Vertical
            </md-button>  
        </md-menu-item>         
        <md-menu-item class="md-indent md-in-menu-bar" ng-show="isItem">
            <md-button ng-disabled="true" aria-label="Replace Image" >
                <md-icon md-svg-icon="nbd:replace-image"></md-icon> Replace Image
            </md-button>  
        </md-menu-item>        
        <!-- For Group -->
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="alignLayer('vertical')" ng-show="isGroup">
            <md-button aria-label="Align Vertical Center">
                <md-icon md-svg-icon="nbd:align-vertical"></md-icon> Align Vertical Center
            </md-button>             
        </md-menu-item>  
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="alignLayer('horizontal')" ng-show="isGroup">
            <md-button aria-label="Align Horizontal Center">
                <md-icon md-svg-icon="nbd:align-horizontal"></md-icon> Align Horizontal Center
            </md-button>             
        </md-menu-item>   
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="alignLayer('left')" ng-show="isGroup">
            <md-button aria-label="Align Left">
                <md-icon md-svg-icon="nbd:align-left"></md-icon> Align Left
            </md-button>             
        </md-menu-item>   
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="alignLayer('right')" ng-show="isGroup">
            <md-button aria-label="Align Left">
                <md-icon md-svg-icon="nbd:align-right"></md-icon> Align Right
            </md-button>             
        </md-menu-item>      
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="alignLayer('top')" ng-show="isGroup">
            <md-button aria-label="Align Top">
                <md-icon md-svg-icon="nbd:align-top"></md-icon> Align Top
            </md-button>             
        </md-menu-item>   
        <md-menu-item class="md-indent md-in-menu-bar has-sub" ng-click="alignLayer('bottom')" ng-show="isGroup">
            <md-button aria-label="Align Bottom">
                <md-icon md-svg-icon="nbd:align-bottom"></md-icon> Align Bottom
            </md-button>             
        </md-menu-item>           
        <md-menu-divider></md-menu-divider>
        <md-menu-item class="md-indent md-in-menu-bar" ng-click="duplicateLayer()" ng-show="isItem">
            <md-button aria-label="Duplicate" >
                <md-icon md-svg-icon="nbd:copy"></md-icon> Duplicate
            </md-button>  
        </md-menu-item>
        <md-menu-item class="md-indent md-in-menu-bar" ng-click="Ungroup()" ng-show="isGroup">
            <md-button aria-label="Ungroup" >
                <md-icon md-svg-icon="nbd:ungroup"></md-icon> Ungroup
            </md-button>  
        </md-menu-item>        
        <md-menu-item class="md-indent md-in-menu-bar" ng-click="deleteLayer()">
            <md-button aria-label="Delete">
                <md-icon md-svg-icon="nbd:trash"></md-icon> Delete
            </md-button>  
        </md-menu-item>          
    </md-menu-content>
</div>

