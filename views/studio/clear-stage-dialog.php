<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div style="visibility: hidden">
    <div class="md-dialog-container" id="clearStageDialog">
        <md-dialog layout-padding aria-label="Clear Stage" style="padding: 0; border-radius: 0;">
            <md-toolbar style="padding: 0;">
                <div class="md-toolbar-tools">
                    <h2>Delete All Layers</h2>
                    <span flex></span>
                    <md-button class="md-icon-button" ng-click="cancelDialog()">
                        <md-icon md-svg-src="nbd:delete" aria-label="Close dialog"></md-icon>
                    </md-button>  
                </div>
            </md-toolbar>          
            <md-dialog-content style="padding: 15px; font-size: 14px;">  
                Are you sure you want to delete all layers?
            </md-dialog-content>
            <md-dialog-actions layout="row">
                <md-button ng-click="cancelDialog()"aria-label="No">
                    <md-icon md-svg-icon="nbd:delete"></md-icon> No
                </md-button>
                <span flex></span>
                <md-button ng-click="submitClearStageDialog()" aria-label="Yes" class="md-raised md-primary">
                    <md-icon md-svg-icon="nbd:submit"></md-icon> Yes
                </md-button>                
            </md-dialog-actions>
        </md-dialog>
    </div>
</div>