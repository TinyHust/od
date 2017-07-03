<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="main_menu">	
    <ul class="tool_draw">
        <li ng-show="settings['enable_text'] == 'yes'">
            <a class="add_text shadow nbd-tooltip-i18n" ng-click="addText()" data-lang="ADD_TEXT" data-placement="right">
                <i class="fa fa-font" aria-hidden="true"></i>
            </a>
        </li>
        <li ng-show="settings['enable_clipart'] == 'yes'">
            <a class="add_art shadow nbd-tooltip-i18n" data-toggle="modal" data-target="#dg-cliparts" ng-click="loadArt()" data-lang="ADD_CLIPART" data-placement="right">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
            </a>
        </li>
        <li ng-show="settings['enable_image'] == 'yes'">
            <a class="add_image shadow nbd-tooltip-i18n" data-toggle="modal" data-target="#dg-myclipart" ng-click="loadLocalStorageImage()" data-lang="FREE_DRAW" data-placement="right">
                <i class="fa fa-camera-retro" aria-hidden="true"></i>
            </a>
        </li>
        <li ng-show="settings['enable_draw'] == 'yes'">
            <a class="draw_free shadow nbd-tooltip-i18n" ng-click="showDrawConfig()" data-lang="ADD_CLIPART" data-placement="right">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>
            </a>
        </li>
        <li ng-show="settings['enable_qrcode'] == 'yes'">
            <a class="add_code shadow nbd-tooltip-i18n" data-toggle="modal" data-target="#dg-qrcode" data-lang="ADD_QRCODE" data-placement="right">
                <i class="fa fa-qrcode" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
    <div class="container_menu shadow hover-shadow">	
        <div id="menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="layer" class="shadow hover-shadow">
        <div class="nav_layer">
            <span></span>
            <span></span>
            <span></span>		
        </div>
        <span class="layer_after">{{(langs['LAYERS']) ? langs['LAYERS'] : "Layers"}}</span>
    </div>
    <div id="gesture" class="hover-shadow">
        <div class="menu_gesture shadow">
            <span class="fa fa-hand-o-up m-center" aria-hidden="true"></span>
            <span class="fa fa-chevron-left shadow left" ng-click="ShiftLeft()"></span>
            <span class="fa fa-chevron-right shadow right" ng-click="ShiftRight()"></span>
            <span class="fa fa-chevron-up shadow up" ng-click="ShiftUp()"></span>
            <span class="fa fa-chevron-down shadow down" ng-click="ShiftDown()"></span>
            <span class="fa fa-exchange flip-ver"  ng-click="flipVertical()"></span>
            <span class="fa fa-exchange rotate90 flip-hoz"  ng-click="flipHorizontal()"></span>
            <span class="glyphicon glyphicon-object-align-vertical set-ver shadow" ng-click="setHorizontalCenter()"></span>
            <span class="glyphicon glyphicon-object-align-horizontal set-hoz shadow" ng-click="setVerticalCenter()"></span>
            <span class="fa fa-trash-o delete shadow"  onclick="deleteObject()"></span>
            <span class="fa fa-files-o refresh shadow"  ng-click="duplicateItem()"></span>
            <span class="fa fa fa-plus zoom-out shadow" ng-click="scaleItem('+')"></span>
            <span class="fa fa fa-minus zoom-in shadow" ng-click="scaleItem('-')"></span>
        </div>
        <span class="gesture_after">{{(langs['TOOL']) ? langs['TOOL'] : "Tool"}}</span>
    </div>	
    <div id="info" class="shadow hover-shadow <?php echo 'ui-mode-'.$ui_mode; ?>">
        <div class="container_info">
            <?php if($ui_mode == 1): ?>
            <span class="fa fa-floppy-o menu_cart" ng-click="storeDesign()"></span>
            <?php elseif($ui_mode == 2): ?>
            <p ng-click="storeDesign()"><span class="fa fa-shopping-cart add-to-cart"></span>{{(langs['ADD_TO_CART']) ? langs['ADD_TO_CART'] : "Add to cart"}}</p>
            <?php endif; ?>
        </div>
        <?php if($ui_mode == 1): ?>
        <span class="info_after">{{(langs['SAVE']) ? langs['SAVE'] : "Save"}}</span>
        <?php endif; ?>
    </div>
</div>