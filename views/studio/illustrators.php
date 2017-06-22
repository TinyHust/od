<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="panel-container" id="__illustrator-container" ng-scrollable spy-y="PosX">
    <div class="panel-inner">
        <div class="search">
            <md-input-container class="md-block">
                <label>Search</label>
                <input ng-model="illustratorName">
            </md-input-container>      
            {{PosX}}
        </div>
        <div ng-show="!hideIllustratorCat" class="panel-list-cat">
            <div ng-repeat="cat in listIllustratorCategories" class="panel-item" md-whiteframe="{{height}}" ng-init="height = -1" ng-mouseenter="height = 3" ng-mouseleave="height = -1"
                 ng-class="$index % 3 == 2 ? 'no-margin-right' : ''" ng-click="changeIllustratorCat(cat)">
                <md-icon md-svg-icon="nbd:cat-placeholder"></md-icon>
                <span class="item-name">{{cat.name}}<span>
            </div>            
        </div>
        <div layout="row" layout-sm="column" layout-align="space-around" id="load-illustrator">
            <md-progress-circular md-mode="indeterminate" class="md-accent"></md-progress-circular>
        </div> 
        <div ng-show="hideIllustratorCat" class="panel-list-item">
            <div class="panel-items" ng-repeat="_cat in listIllustratorCategories" ng-show="currentIllustratorCat == _cat.id">
                <p  style="color: #fff;">
                    <md-button class="md-icon-button nbd-mag-0" aria-label="Back" ng-click="showIllustratorCat()">
                        <md-icon md-svg-icon="nbd:back" style="color: #fff;"></md-icon>
                    </md-button>                  
                    {{_cat.name}}
                </p>
                <div ng-repeat="art in _cat.arts | filter : illustratorName | limitTo: illustratorLimit" class="panel-item" md-whiteframe="{{height}}" ng-init="height = -1" ng-mouseenter="height = 3" ng-mouseleave="height = -1"
                    ng-class="$index % 3 == 2 ? 'no-margin-right' : ''">
                    <img class="item-name" ng-src="{{art.url}}"/>
                </div>      
            </div> 
        </div>    
    </div>    
</div>
