<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div style="padding: 10px;">
    <div class="sidebar-scroll-top" flex layout="row" ng-show="false">
        <span flex></span>
        <span class="element-name" style="padding: 10px 15px;">{{currentElement}}</span>
        <md-icon class="element-name" md-svg-icon="nbd:delete" style="color: #fff; margin-left: 3px;"></md-icon>
    </div>
    <div class="nbd-element md-whiteframe-2dp">
       <div md-ink-ripple class="nbd-element-inner" flex layout-align="center center" layout="column">
            <md-icon md-svg-icon="nbd:upload-from-pc" style="color: #607d8b;" class="element-icon"></md-icon>
            <p>Upload</p>
       </div>
    </div>
    <div class="nbd-element md-whiteframe-2dp">
       <div md-ink-ripple class="nbd-element-inner" flex layout-align="center center" layout="column">
            <md-icon md-svg-icon="nbd:link" style="color: #ff9800" class="element-icon"></md-icon>
            <p>Url</p>
       </div>
    </div>
    <div class="nbd-element md-whiteframe-2dp no-margin-right">
       <div md-ink-ripple class="nbd-element-inner" flex layout-align="center center" layout="column">
            <md-icon md-svg-icon="nbd:facebook" style="color: #3b5998;" class="element-icon"></md-icon>
            <p>Facebook</p>
       </div>
    </div>
    <div class="nbd-element md-whiteframe-2dp">
       <div md-ink-ripple class="nbd-element-inner" flex layout-align="center center" layout="column">
            <md-icon md-svg-icon="nbd:instagram" style="color: #4c68d7;" class="element-icon"></md-icon>
            <p>Instagram</p>
       </div>
    </div>
    <div class="nbd-element md-whiteframe-2dp">
       <div md-ink-ripple class="nbd-element-inner" flex layout-align="center center" layout="column">
            <md-icon md-svg-icon="nbd:dropbox" style="color: #1081de" class="element-icon"></md-icon>
            <p>Dropbox</p>
       </div>
    </div>
    <div class="nbd-element md-whiteframe-2dp no-margin-right">
       <div md-ink-ripple class="nbd-element-inner" flex layout-align="center center" layout="column">
            <md-icon md-svg-icon="nbd:camera" style="color: #9c27b0;" class="element-icon"></md-icon>
            <p>Camera</p>
       </div>
    </div>  
    <hr class="nbd-divider">
   
</div>
