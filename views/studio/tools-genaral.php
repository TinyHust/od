<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<md-menu md-offset="-20 60">
    <md-button class="md-icon-button nbd-mag-0" aria-label="Background" ng-click="$mdMenu.open($event)">
        <md-tooltip md-direction="bottom" ng-class="primaryPalette">Background</md-tooltip>
        <md-icon md-svg-icon="nbd:paint-bucket"></md-icon>
    </md-button>   
    <md-menu-content width="3" flex layout="row">
        <md-menu-item flex="33" class="nbd-dropdown-menu">
            <md-button aria-label="Color" ng-click="_showColorDialog('background')">
                <div layout="row" flex>
                    <div style="width: 24px; height: 24px; margin: 0 auto; display: inline-block;" ng-style="{'background' : currentTextColor}"></div>
                    <md-tooltip md-direction="bottom" ng-class="primaryPalette">Color</md-tooltip>
                </div>
            </md-button>
        </md-menu-item>          
        <md-menu-item flex="33" class="nbd-dropdown-menu">
            <md-button aria-label="Pattern">
                <div layout="row" flex>
                    <md-icon md-menu-align-target md-svg-icon="nbd:pattern" style="margin: 0 auto;"></md-icon>
                    <md-tooltip md-direction="bottom" ng-class="primaryPalette">Pattern</md-tooltip>
                </div>
            </md-button>
        </md-menu-item>  
        <md-menu-item flex="33" class="nbd-dropdown-menu">
            <md-button aria-label="None">
                <div layout="row" flex>
                    <md-icon md-menu-align-target md-svg-icon="nbd:forbidden" class="bold" style="margin: 0 auto;"></md-icon>
                    <md-tooltip md-direction="bottom" ng-class="primaryPalette">None</md-tooltip>
                </div>
            </md-button>
        </md-menu-item>         
    </md-menu-content>           
</md-menu>    
<md-menu md-offset="-20 60">
    <md-button class="md-icon-button nbd-mag-0" aria-label="Opacity" ng-click="$mdMenu.open($event)">
        <md-tooltip md-direction="bottom" ng-class="primaryPalette">Opacity</md-tooltip>
        <md-icon md-svg-icon="nbd:opacity"></md-icon>
    </md-button>          
    <md-menu-content width="3" flex layout="row" style="overflow: hidden;">
        <md-menu-item flex="100" class="nbd-dropdown-menu">
            <md-slider-container >
                <span flex="20">Opacity</span>
                <md-slider flex="60" class="md-primary" aria-label="Opacity" min="0" max="1" step="0.01" flex  ng-model="currentLayerOpacity" id="layer-opacity"></md-slider>
                <md-input-container flex="20">
                    <input flex type="number" min="0" max="1" step="0.01" ng-model="currentLayerOpacity" aria-label="X" aria-controls="layer-opacity"> 
                </md-input-container>        
            </md-slider-container>
        </md-menu-item> 
    </md-menu-content>
</md-menu> 
<md-menu-bar class="nbd-menu-bar">
    <md-menu>
        <button  class="md-icon-button" aria-label="Rotate"  ng-click="$mdMenu.open()">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Rotate</md-tooltip>
            <md-icon md-svg-icon="nbd:rotate"></md-icon>
        </button >   
        <md-menu-content>
            <md-menu-item class="md-indent" ng-click="rotateLayer('reflect-hoz')">
                <md-icon md-svg-icon="nbd:reflect-horizontal"></md-icon>
                <md-button aria-label="Reflect Horizontal" >
                    Reflect Horizontal
                    <span class="md-alt-text">{{ 'S-H' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent" ng-click="rotateLayer('reflect-ver')">
                <md-icon md-svg-icon="nbd:reflect-vertical"></md-icon>
                <md-button aria-label="Reflect Vertical" >
                    Reflect Vertical
                    <span class="md-alt-text">{{ 'S-V' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>   
            <md-menu-item class="md-indent" ng-click="rotateLayer('180')">
                <md-icon md-svg-icon="nbd:one-hundred-eighty"></md-icon>
                <md-button aria-label="Rotate 180&#176;" >
                    Rotate 180&#176;
                    <span class="md-alt-text">{{ 'S-F' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent" ng-click="rotateLayer('90cw')">
                <md-icon md-svg-icon="nbd:cw"></md-icon>
                <md-button aria-label="Rotate 90&#176; CW" >
                    Rotate 90&#176; CW
                    <span class="md-alt-text">{{ 'S-C' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent" ng-click="rotateLayer('90ccw')">
                <md-icon md-svg-icon="nbd:ccw"></md-icon>
                <md-button aria-label="Rotate 90&#176; CCW" >
                    Rotate 90&#176; CCW
                    <span class="md-alt-text">{{ 'S-W' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>              
        </md-menu-content>
    </md-menu>
    <md-menu>
        <button  class="md-icon-button" aria-label="Arrange"  ng-click="$mdMenu.open()">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Arrange</md-tooltip>
            <md-icon md-svg-icon="nbd:arrange"></md-icon>
        </button >  
        <md-menu-content>
            <md-menu-item class="md-indent" ng-click="setStackPosition('bring-front')">
                <md-icon md-svg-icon="nbd:bring-front"></md-icon>
                <md-button aria-label="Bring to Front" >
                    Bring to Front
                    <span class="md-alt-text">{{ 'M-S-]' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>      
            <md-menu-item class="md-indent" ng-click="setStackPosition('bring-forward')">
                <md-icon md-svg-icon="nbd:bring-forward"></md-icon>
                <md-button aria-label="Bring Forward" >
                    Bring Forward
                    <span class="md-alt-text">{{ 'M-]' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent" ng-click="setStackPosition('send-backward')">
                <md-icon md-svg-icon="nbd:send-backward"></md-icon>
                <md-button aria-label="Send Backward" >
                    Send to Backward
                    <span class="md-alt-text">{{ 'M-[' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>      
            <md-menu-item class="md-indent" ng-click="setStackPosition('send-back')">
                <md-icon md-svg-icon="nbd:send-back"></md-icon>
                <md-button aria-label="Send to Back" >
                    Send to Back
                    <span class="md-alt-text">{{ 'M-S-[' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>              
        </md-menu-content>
    </md-menu>
    <md-menu>
        <button  class="md-icon-button" aria-label="Align"  ng-click="$mdMenu.open()">
            <md-tooltip md-direction="bottom" ng-class="primaryPalette">Align</md-tooltip>
            <md-icon md-svg-icon="nbd:align-position"></md-icon>
        </button >  
        <md-menu-content>
            <md-menu-item class="md-indent" ng-click="alignLayer('vertical')">
                <md-icon md-svg-icon="nbd:align-vertical"></md-icon>
                <md-button aria-label="Align Center" >
                    Align Vertical Center
                    <span class="md-alt-text">{{ 'S-C' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>
            <md-menu-item class="md-indent" ng-click="alignLayer('horizontal')">
                <md-icon md-svg-icon="nbd:align-horizontal"></md-icon>
                <md-button aria-label="Align Middle" >
                    Align Horizontal Center
                    <span class="md-alt-text">{{ 'S-M' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>    
            <md-menu-item class="md-indent" ng-click="alignLayer('left')">
                <md-icon md-svg-icon="nbd:align-left"></md-icon>
                <md-button aria-label="Align Left" >
                    Align Left
                    <span class="md-alt-text">{{ 'S-L' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>
            <md-menu-item class="md-indent" ng-click="alignLayer('right')">
                <md-icon md-svg-icon="nbd:align-right"></md-icon>
                <md-button aria-label="Align Right" >
                    Align Right
                    <span class="md-alt-text">{{ 'S-R' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>  
            <md-menu-item class="md-indent" ng-click="alignLayer('top')">
                <md-icon md-svg-icon="nbd:align-top"></md-icon>
                <md-button aria-label="Align Top" >
                    Align Top
                    <span class="md-alt-text">{{ 'S-T' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>
            <md-menu-item class="md-indent" ng-click="alignLayer('bottom')">
                <md-icon md-svg-icon="nbd:align-bottom"></md-icon>
                <md-button aria-label="Align Bottom" >
                    Align Bottom
                    <span class="md-alt-text">{{ 'S-B' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>              
        </md-menu-content>
    </md-menu>
</md-menu-bar>    
<md-button class="md-icon-button" aria-label="Copy"  ng-click="duplicateLayer()">
    <md-icon md-svg-icon="nbd:copy"></md-icon>
</md-button> 
<md-button class="md-icon-button" aria-label="Delete" ng-click="deleteLayer()">
    <md-icon md-svg-icon="nbd:trash"></md-icon>
</md-button>  
<md-button class="md-icon-button" aria-label="Lock" ng-click="lockLayer()">
    <md-icon md-svg-icon="nbd:lock"></md-icon>
</md-button>  