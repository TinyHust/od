<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div flex layout-align="start center" layout="row" style="width: 100%; height: 100%;" ng-show="currentActionType == 'text'" class="item-config-bar">
    <div flex layout-align="start center" layout="row" style="width: 100%; height: 100%;">
    <div class="nbd-fonts">
        <md-autocomplete 
            md-selected-item="currentFont"
            md-search-text-change="searchFontChange(searchFont)"
            md-search-text="searchFont"
            md-selected-item-change="selectedFontChange(font)"
            md-items="font in querySearchFont(searchFont)"
            md-item-text="font.name"    
            md-min-length="0"
            md-clear-button="true"
            md-require-match="true"
            placeholder="Select Font">
            <md-item-template>
                <span md-highlight-text="searchFont" md-highlight-flags="^i"ng-hide="true">{{font.name}}</span>
                <img ng-src="{{font.url}}" alt="{{font.name}}" />
            </md-item-template>
            <md-not-found>
                No fonts matching "{{searchFont}}" were found.
            </md-not-found>    
        </md-autocomplete>
    </div>    
    <div class="comboinput">
        <md-input-container md-no-float class="md-block">
            <input ng-model="currentfontSize" placeholder="Size" ng-pattern="fontPattern">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Font Size</md-tooltip>
        </md-input-container>
        <md-select ng-model="currentfontSize" aria-label="Font size">
            <md-option 
                ng-repeat="(index, size) in ['6','8','10','12','14','16','18','21','24','28','32','36','42','48','56','64','72','80','88','96','104','120','144']" 
                ng-value="{{size}}">{{size}}
            </md-option>
        </md-select>    
    </div>    
    <div>
        <div class="item-color" ng-style="{'background' : currentTextColor}" ng-click="_showColorDialog('color')">   
        </div>
        <md-tooltip md-direction="bottom" ng-class="primaryPalette">Color</md-tooltip>
    </div>    
    <md-menu md-offset="0 72">
        <md-button class="md-icon-button nbd-mag-0" aria-label="Text decoraton" ng-click="$mdMenu.open($event)">
            <md-icon md-svg-icon="nbd:text-decoration"></md-icon>
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Decoration</md-tooltip>
        </md-button>   
        <md-menu-content width="3" flex layout="row">
            <md-menu-item flex="20" class="nbd-dropdown-menu">
                <md-button aria-label="Bold">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:bold" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>    
            <md-menu-item flex="20" class="nbd-dropdown-menu">
                <md-button aria-label="Italic">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:italic" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>   
            <md-menu-item flex="20" class="nbd-dropdown-menu">
                <md-button aria-label="Underlined">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:underlined" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>    
            <md-menu-item flex="20" class="nbd-dropdown-menu">
                <md-button aria-label="Strikethrough">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:strikethrough" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>      
            <md-menu-item flex="20" class="nbd-dropdown-menu">
                <md-button aria-label="Overline" class="overline">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:overline" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>           
        </md-menu-content>
    </md-menu>
    <md-menu md-offset="0 72">
        <md-button class="md-icon-button" aria-label="Text Align" ng-click="$mdMenu.open($event)">
            <md-icon md-svg-icon="nbd:text-justify"></md-icon>
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Text Align</md-tooltip>
        </md-button>    
        <md-menu-content width="3" flex layout="row">
            <md-menu-item flex="33" class="nbd-dropdown-menu">
                <md-button aria-label="Left">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:text-left" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>          
            <md-menu-item flex="33" class="nbd-dropdown-menu">
                <md-button aria-label="Left">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:text-center" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>  
            <md-menu-item flex="33" class="nbd-dropdown-menu">
                <md-button aria-label="Left">
                    <div layout="row" flex>
                        <md-icon md-menu-align-target md-svg-icon="nbd:text-right" style="margin: 0 auto;"></md-icon>
                    </div>
                </md-button>
            </md-menu-item>         
        </md-menu-content>     
    </md-menu>
    <md-button class="md-icon-button nbd-mag-0" aria-label="Shadow" ng-click="toggleSubMenu('shadow')">
        <md-tooltip md-direction="bottom" ng-class="primaryPalette">Shadow</md-tooltip>
        <md-icon md-svg-icon="nbd:shadow"></md-icon>
    </md-button>     
    <md-menu md-offset="-20 60">
        <md-button class="md-icon-button nbd-mag-0" aria-label="Spacing" ng-click="$mdMenu.open($event)">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Spacing</md-tooltip>
            <md-icon md-svg-icon="nbd:line-spacing"></md-icon>
        </md-button>          
        <md-menu-content width="4" flex layout="column" style="overflow: hidden;">
            <md-menu-item class="nbd-dropdown-menu">
                <md-slider-container >
                    <span flex="20" class="nbd-slide-title">Spacing</span>
                    <md-slider flex="60" class="md-primary" aria-label="Spacing" min="-200" max="800" step="10" flex  ng-model="currentTextSpacing" id="layer-opacity"></md-slider>
                    <md-input-container flex="20">
                        <input flex type="number" min="-200" max="800" step="10" ng-model="currentTextSpacing" aria-label="X" aria-controls="layer-opacity"> 
                    </md-input-container>        
                </md-slider-container>
            </md-menu-item> 
            <md-menu-item class="nbd-dropdown-menu">
                <md-slider-container >
                    <span flex="20" class="nbd-slide-title">Line height</span>
                    <md-slider flex="60" class="md-primary" aria-label="Line height" min="0.5" max="2.5" step="0.01" flex  ng-model="currentTextLineHeight" id="layer-opacity"></md-slider>
                    <md-input-container flex="20">
                        <input flex type="number" min="0.5" max="2.5" step="0.01" ng-model="currentTextLineHeight" aria-label="X" aria-controls="layer-opacity"> 
                    </md-input-container>        
                </md-slider-container>
            </md-menu-item>             
        </md-menu-content>
    </md-menu>         
    </div>   
    <md-menu md-offset="0 65">
        <md-button class="md-icon-button" aria-label="More" ng-click="$mdMenu.open($event)">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">More</md-tooltip>
            <md-icon md-svg-icon="nbd:more-vert" ng-click="toggleSubMenu('', 'close')"></md-icon>
        </md-button>    
        <md-menu-content width="6" flex layout="column">
                <div style="height: 500px;">
                    <p>Outline</p>
                </div>       
        </md-menu-content>     
    </md-menu>
</div>    