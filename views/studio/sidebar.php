<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbd-side-bar" ng-style="{'height': (workBenchHeight - 64) + 'px'}">
    <div class="side-bar-inner">
        <div class="primary-menu-container">
            <div class="primary-menu-con">
                <div class="primary-menu" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">{{(i18nLangs['PRODUCTS']) ? i18nLangs['PRODUCTS'] : "Products"}}</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Browser product" data-panel="product" data-index="1" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:product"></md-icon>
                    </md-button>    
                </div>  
                <div class="primary-menu" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Text</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Text" data-panel="text" data-index="2" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:text"></md-icon>
                    </md-button>    
                </div>      
                <div class="primary-menu" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Clip Arts</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Clip Arts" data-panel="clipart" data-index="3" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:clipart" class="bold"></md-icon>
                    </md-button>    
                </div>      
                <div class="primary-menu" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Upload</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Upload" data-panel="upload" data-index="4" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:upload" class="bold"></md-icon>
                    </md-button>    
                </div>      
                <div class="primary-menu" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Free Draw</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Free Draw" data-panel="draw" data-index="5" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:draw" class="bold"></md-icon>
                    </md-button>    
                </div>  
                <div class="primary-menu" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Qr Code</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Qr Code" data-panel="qrcode" data-index="6" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:qrcode"></md-icon>
                    </md-button>    
                </div> 
                <div class="primary-menu" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">{{(i18nLangs['LAYERS']) ? i18nLangs['LAYERS'] : "Layers"}}</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Layers" data-panel="layer" data-index="7" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:layer" class="bold"></md-icon>
                    </md-button>    
                </div>  
                <div class="primary-menu bold helpdesk" flex layout-align="center center" layout="column">
                    <md-button class="md-icon-button" aria-label="Helpdesk" data-panel="helpdesk" data-index="8" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:info" class="bold"></md-icon>
                    </md-button>    
                </div>  
            </div>    
        </div>    
        <div class="primary-sub-menu">
            <div class="primary-sub-menu-inner">
                <div class="menu-panel active" style="background: #607d8b;" data-panel="product" data-panel-index="1">
                    
                </div>
                <div class="menu-panel after" style="background: #363f45;"  data-panel="text" data-panel-index="2">
                    
                </div>        
                <div class="menu-panel after" style="background: #607d8b;" data-panel="clipart" data-panel-index="3">
                    
                </div>
                <div class="menu-panel after" style="background: #363f45;"  data-panel="upload" data-panel-index="4">
                    
                </div>       
                <div class="menu-panel after" style="background: #607d8b;" data-panel="draw" data-panel-index="5">
                    
                </div>
                <div class="menu-panel after" style="background: #363f45;"  data-panel="qrcode" data-panel-index="6">
                    
                </div>        
                <div class="menu-panel after" style="background: #607d8b;" data-panel="layer" data-panel-index="7">
                    
                </div>
                <div class="menu-panel after" style="background: #363f45;"  data-panel="helpdesk" data-panel-index="8">
                    
                </div>                   
            </div>
        </div>
    </div>    
</div>
<md-sidenav class="md-sidenav-left" md-component-id="sidebar" md-disable-backdrop md-whiteframe="4">
    <md-toolbar class="md-theme-indigo">
        <h1 class="md-toolbar-tools">Disabled Backdrop</h1>
    </md-toolbar>
    <md-content layout-margin>
        <p>
            This sidenav is not showing any backdrop, where users can click on it, to close the sidenav.
        </p>
        <md-button ng-click="toggleSidebar()" class="md-accent">
            Close this Sidenav
        </md-button>
    </md-content>
</md-sidenav>  


