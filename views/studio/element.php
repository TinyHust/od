<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div>
    <div class="panel-inner">
        <div class="sidebar-scroll-top" flex layout="row" ng-show="false">
            <span flex></span>
            <span class="element-name" style="padding: 10px 15px;">{{currentElement}}</span>
            <md-icon class="element-name" md-svg-icon="nbd:delete" style="color: #fff; margin-left: 3px;"></md-icon>
        </div>
        <div class="nbd-element">
           <div class="nbd-element-inner" flex layout-align="center center" layout="column">
                <md-icon md-svg-icon="nbd:brush" class="element-icon"></md-icon>
                <p>Draw</p>
           </div>
        </div>
        <div class="nbd-element">
           <div class="nbd-element-inner" flex layout-align="center center" layout="column">
                <md-icon md-svg-icon="nbd:shape" class="element-icon"></md-icon>
                <p>Shapes</p>
           </div>
        </div>
        <div class="nbd-element no-margin-right">
           <div class="nbd-element-inner" flex layout-align="center center" layout="column">
                <md-icon md-svg-icon="nbd:icon" class="element-icon"></md-icon>
                <p>Icons</p>
           </div>
        </div>
        <div class="nbd-element">
           <div class="nbd-element-inner" flex layout-align="center center" layout="column">
                <md-icon md-svg-icon="nbd:line" class="element-icon"></md-icon>
                <p>Lines</p>
           </div>
        </div>
        <div class="nbd-element">
           <div class="nbd-element-inner" flex layout-align="center center" layout="column">
                <md-icon md-svg-icon="nbd:grid-element" class="element-icon"></md-icon>
                <p>Grids</p>
           </div>
        </div>
        <div class="nbd-element no-margin-right">
           <div class="nbd-element-inner" flex layout-align="center center" layout="column">
                <md-icon md-svg-icon="nbd:frame" class="element-icon"></md-icon>
                <p>Frames</p>
           </div>
        </div>   
        <hr class="nbd-divider">
        <div class="element-shapes">
            <span ng-click="addRect()">square</span>
        </div>
    </div>      
</div>    


