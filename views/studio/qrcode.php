<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div style="text-align: center; padding: 20px;">
<md-input-container class="md-block">
    <input ng-model="qrcodeString" placeholder="{{qrcodeDefaultString}}">
</md-input-container>
<md-button class="md-raised md-primary" ng-click="createQrCode()">Create QrCode</md-button>
<div id="qr-container">
    
</div>
</div>
