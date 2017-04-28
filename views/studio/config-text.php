<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div flex layout-align="start center" layout="row" style="width: 100%; height: 100%;">
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
                <span md-highlight-text="searchFont" md-highlight-flags="^i">{{font.name}}
            </md-item-template>
                <md-not-found>
                    No fonts matching "{{searchFont}}" were found.
                </md-not-found>    
        </md-autocomplete>
        <md-tooltip md-direction="bottom" ng-class="primaryPalette">Font</md-tooltip>
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
            <md-icon md-svg-icon="nbd:text-decoration" class="bold"></md-icon>
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
    <md-menu md-offset="0 75">
        <md-button class="md-icon-button nbd-mag-0" aria-label="Shadow" ng-click="$mdMenu.open($event)">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Shadow</md-tooltip>
            <md-icon md-svg-icon="nbd:shadow" class="bold"></md-icon>
        </md-button> 
        <md-menu-content width="4" flex layout="column">
                <div class="nbd-content-dropdown-menu" id="nbd-content-dropdown-menu">
                    <div>
                        <md-switch class="md-primary" md-invert aria-label="Shadow" ng-model="enableShadow">
                            Shadow
                        </md-switch>  
                        <span ng-style="" ng-click="_showColorDialog('shasow')">Content</span>
                        <div class="config-shadow" ng-class="!enableShadow ? 'disabled' : ''">
                            <md-slider-container >
                                <span>X</span>
                                <md-slider class="md-primary" aria-label="Dimension X" min="0" max="100" step="10" flex  ng-model="shadowX" id="shadow-x"></md-slider>
                                <md-input-container>
                                    <input flex type="number" ng-model="shadowX" aria-label="X" aria-controls="shadow-x"> 
                                </md-input-container>        
                            </md-slider-container>
                            <md-slider-container >
                                <span>Y</span>
                                <md-slider class="md-primary" aria-label="Dimension Y" min="0" max="100" step="10" flex  ng-model="shadowY" id="shadow-y"></md-slider>
                                <md-input-container>
                                    <input flex type="number" ng-model="shadowY" aria-label="X" aria-controls="shadow-y"> 
                                </md-input-container>        
                            </md-slider-container>             
                            <md-slider-container >
                                <span>Blur</span>
                                <md-slider class="md-primary" aria-label="Blur" min="0" max="25" step="1" flex  ng-model="shadowBlur" id="shadow-blur"></md-slider>
                                <md-input-container>
                                    <input flex type="number" ng-model="shadowBlur" aria-label="Blur" aria-controls="shadow-blur"> 
                                </md-input-container>        
                            </md-slider-container>
                            <md-slider-container >
                                <span>Opacity</span>
                                <md-slider class="md-primary" aria-label="Opacity" min="0" max="1" step="0.1" flex  ng-model="shadowOpacity" id="shadow-opacity"></md-slider>
                                <md-input-container>
                                    <input flex type="number" ng-model="shadowOpacity" aria-label="Opacity" aria-controls="shadow-opacity"> 
                                </md-input-container>        
                            </md-slider-container>                               
                        </div>
                    </div>
                </div>       
        </md-menu-content>          
    </md-menu>    
    <md-button class="md-icon-button nbd-mag-0" aria-label="Background" ng-click="_showColorDialog('background')">
        <md-tooltip md-direction="bottom" ng-class="primaryPalette">Background</md-tooltip>
        <md-icon md-svg-icon="nbd:paint-bucket" class="bold"></md-icon>
    </md-button> 
    </div>   
    <md-menu md-offset="0 75">
        <md-button class="md-icon-button" aria-label="More" ng-click="$mdMenu.open($event)">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">More</md-tooltip>
            <md-icon md-svg-icon="nbd:more-vert"></md-icon>
        </md-button>    
        <md-menu-content width="6" flex layout="column">
                <div style="height: 500px;">
                    <p>fsf</p>
                    <p>fsf</p>
                    <p>fsf</p>
                </div>       
        </md-menu-content>     
    </md-menu>
</div>    