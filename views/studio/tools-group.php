<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div flex layout-align="start center" layout="row" style="width: 100%; height: 100%;" ng-show="currentActionType == 'group'" class="item-config-bar">
    <div flex layout-align="start center" layout="row" style="width: 100%; height: 100%;">
        <md-button class="md-icon-button nbd-mag-0" aria-label="Ungroup" ng-click="Ungroup()">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Ungroup</md-tooltip>
            <md-icon md-svg-icon="nbd:ungroup"></md-icon>
        </md-button>          
    </div>
</div>

