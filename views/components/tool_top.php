<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="tool-top">
    <span class="fa fa-book shadow help first_visitor"></span>
    <span class="fa fa-globe shadow translate" style="font-size: 20px;"></span>
<!--    <span id="show_grid" ng-hide="modeMobile" class="fa fa-th shadow hover-shadow" ng-click="showGrid()"></span>-->    
<!--    <span id="mobile" ng-show="modeMobile" class="fa fa-eye shadow hover-shadow"></span>-->
    <span id="debug" ng-show="state == 'dev'" class="fa fa-magic shadow hover-shadow" ng-click="debug()"></span>
    <span id="show_grid" ng-hide="modeMobile" class="fa fa-search shadow hover-shadow"  data-toggle="modal" data-target="#dg-preview" ng-click="preview()"></span>    
    <span class="fa fa-plus shadow hover-shadow" aria-hidden="true"  ng-click="zoomIn()"></span>
    <span class="fa fa-minus shadow hover-shadow" aria-hidden="true"  ng-click="zoomOut()"></span>	
    <span id="expand_feature" class="fa fa-ellipsis-h shadow hover-shadow"  data-toggle="modal" data-target="#dg-expand-feature" ></span>
    <span class="fa fa-paint-brush shadow hover-shadow" aria-hidden="true" ng-click="disableDrawMode()" ng-show="canvas.isDrawingMode" ng-class="canvas.isDrawingMode ? 'disabledraw' : ''"></span>   
</div>
<div class="first_message hover-shadow">
    {{(langs['HI_THERE']) ? langs['HI_THERE'] : "Hi there"}}, <br />
    {{(langs['IM_HELPER']) ? langs['IM_HELPER'] : "I'm Helper! If you need any help"}}...
</div>
<div class="translate-switch hover-shadow shadow" ng-show="langCategories.length > 1">
    <ul>
        <li ng-repeat="cat in langCategories" ng-click="loadLanguage(cat.code)" ng-class="{open : currentCatLang === cat.code}">{{cat.name}}</li>
    </ul>
</div>