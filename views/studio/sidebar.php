<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="nbd-side-bar" ng-style="{'height': (workBenchHeight - 64) + 'px'}">
    <div class="side-bar-inner">
        <div class="primary-menu-container" style="z-index: 2">
            <div class="primary-menu-con">
                <div class="primary-menu slideInLeft animate500" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">{{(i18nLangs['PRODUCTS']) ? i18nLangs['PRODUCTS'] : "Products"}}</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Browser product" data-panel="product" data-index="1" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:layout"></md-icon>
                    </md-button>    
                </div>  
                <div class="primary-menu  slideInLeft animate600" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Typography</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Text" data-panel="text" data-index="2" 
                        ng-click="loadTypography()"       
                        onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:typography"></md-icon>
                    </md-button>    
                </div>      
                <div class="primary-menu  slideInLeft animate700" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Clip Arts</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Clip Arts" data-panel="clipart" data-index="3" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:clipart" class="bold"></md-icon>
                    </md-button>    
                </div>      
                <div class="primary-menu  slideInLeft animate800" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Images</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Upload" data-panel="upload" data-index="4" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:image"></md-icon>
                    </md-button>    
                </div>      
                <div class="primary-menu  slideInLeft animate900" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Element</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Free Draw" data-panel="draw" data-index="5" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:element"></md-icon>
                    </md-button>    
                </div>  
                <div class="primary-menu slideInLeft animate1000" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">Qr Code</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Qr Code" data-panel="qrcode" data-index="6" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:qrcode"></md-icon>
                    </md-button>    
                </div> 
                <div class="primary-menu slideInLeft animate1100 active" flex layout-align="center center" layout="column">
                    <md-tooltip md-direction="right" ng-class="primaryPalette">{{(i18nLangs['LAYERS']) ? i18nLangs['LAYERS'] : "Layers"}}</md-tooltip>
                    <md-button class="md-icon-button" aria-label="Layers" data-panel="layer" data-index="7" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:layer"></md-icon>
                    </md-button>    
                </div>  
                <div class="primary-menu bold helpdesk" flex layout-align="center center" layout="column">
                    <md-button class="md-icon-button" aria-label="Helpdesk" data-panel="helpdesk" data-index="8" onclick="nbdLayout.activePanel(this)">
                        <md-icon md-svg-icon="nbd:info" class="bold"></md-icon>
                    </md-button>    
                </div>  
            </div>    
        </div>    
        <div class="primary-sub-menu slideInLeft animate1100" style="z-index: 1">
            <div class="primary-sub-menu-inner">
                <div class="menu-panel before" data-panel="product" data-panel-index="1">
                    
                </div>
                <div class="menu-panel before" data-panel="text" data-panel-index="2" style="background: #607d8b;" id="nbd-typography">
                    <?php include_once('typography.php'); ?>
                </div>        
                <div class="menu-panel before" data-panel="clipart" data-panel-index="3">
                    <?php include_once('element.php'); ?>
                </div>
                <div class="menu-panel before" data-panel="upload" data-panel-index="4">
                    
                </div>       
                <div class="menu-panel before" data-panel="draw" data-panel-index="5">
                    
                </div>
                <div class="menu-panel before"  data-panel="qrcode" data-panel-index="6">
                    <?php include_once('qrcode.php'); ?>
                </div>        
                <div class="menu-panel active nbd-layers" data-panel="layer" data-panel-index="7" id="nbd-layers">
                    <?php include_once('layers.php'); ?>
                </div>
                <div class="menu-panel after" data-panel="helpdesk" data-panel-index="8">
                    
                </div>                   
            </div>
        </div>
    </div>    
</div>
<?php include_once('style-sidenav.php'); ?>


