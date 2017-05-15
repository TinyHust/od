<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div style="padding: 20px; text-align: center;">
    <span class="" style="color: #fff; margin-bottom: 20px; display: block;">Click to add text</span>
    <div class="common-typography">
        <p class="text-heading" style="font-size: 40px; font-weight: 700;" ng-click="addTypography()">Add heading</p>
        <p class="text-heading" style="font-size: 24px; font-weight: 500" ng-click="addImage()">Add subheading</p>
        <p class="text-heading" style="margin:10px 0 20px; font-size: 14px;" ng-click="addGroup()">Add a little bit of body text</p>
    </div> 
    <hr class="nbd-divider"/>
    <div>
        <img ng-repeat="typo in listTypography | limitTo: listTypographyPage * typoPerPage"
            ng-src="{{sourceTypography(typo)}}" style="width: 120px; padding: 10px;"
            md-whiteframe="{{height}}" ng-init="height = -1" ng-mouseenter="height = 3" ng-mouseleave="height = -1"
            class="typo-item"/>
    </div>
    <div layout="row" layout-sm="column" layout-align="space-around" id="load-typo">
        <md-progress-circular md-mode="indeterminate" class="md-accent"></md-progress-circular>
    </div>      
    <div id="load-typo-more">
        <md-button class="md-raised md-primary" ng-click="loadMoreTypography()">More</md-button>
    </div>
</div>