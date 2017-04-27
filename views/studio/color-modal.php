<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div style="visibility: hidden">
    <div class="md-dialog-container" id="myDialog">
        <md-dialog layout-padding style="position: absolute; left: 60px; top: 64px; width: 320px; border-radius: 0; ">
            <h2>Pre-Rendered Dialog</h2>
            <div md-color-picker ng-model="currentTextColor"></div>
            <div class="nbd-palette">
                <div ng-repeat="color in palette" class="nbd-color" ng-style="{'background': color}">
                    
                </div>
            </div>
        </md-dialog>
    </div>
</div>

