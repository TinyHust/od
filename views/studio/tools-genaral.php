<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<md-menu-bar class="nbd-menu-bar">
    <md-menu>
        <button  class="md-icon-button" aria-label="Position"  ng-click="$mdMenu.open()">
            <md-icon md-svg-icon="nbd:position"></md-icon>
        </button >   
        <md-menu-content>
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:move-left"></md-icon>
                <md-button aria-label="Move Left" >
                    Move Left
                    <span class="md-alt-text">&#8592;</span>
                </md-button>             
            </md-menu-item>    
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:move-right"></md-icon>
                <md-button aria-label="Move Right" >
                    Move Right
                    <span class="md-alt-text">&#8594;</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:move-up"></md-icon>
                <md-button aria-label="Move Up" >
                    Move Up
                    <span class="md-alt-text">&#8593;</span>
                </md-button>             
            </md-menu-item>    
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:move-down"></md-icon>
                <md-button aria-label="Move Down" >
                    Move Down
                    <span class="md-alt-text">&#8595;</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:zoom-out-layer"></md-icon>
                <md-button aria-label="Move Up" >
                    Zoom out Layer
                    <span class="md-alt-text">{{ 'S-' | keyboardShortcut }} -</span>
                </md-button>             
            </md-menu-item>    
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:zoom-in-layer"></md-icon>
                <md-button aria-label="Move Down" >
                    Zoom in Layer
                    <span class="md-alt-text">{{ 'S-' | keyboardShortcut }} +</span>
                </md-button>             
            </md-menu-item>                
        </md-menu-content>
    </md-menu>    
    <md-menu>
        <button  class="md-icon-button" aria-label="Rotate"  ng-click="$mdMenu.open()">
            <md-icon md-svg-icon="nbd:rotate"></md-icon>
        </button >   
        <md-menu-content>
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:reflect-horizontal"></md-icon>
                <md-button aria-label="Reflect Horizontal" >
                    Reflect Horizontal
                    <span class="md-alt-text">{{ 'S-H' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:reflect-vertical"></md-icon>
                <md-button aria-label="Reflect Vertical" >
                    Reflect Vertical
                    <span class="md-alt-text">{{ 'S-V' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>   
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:one-hundred-eighty"></md-icon>
                <md-button aria-label="Rotate 180&#176;" >
                    Rotate 180&#176;
                    <span class="md-alt-text">{{ 'S-F' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:ninety-cw"></md-icon>
                <md-button aria-label="Rotate 90&#176; CW" >
                    Rotate 90&#176; CW
                    <span class="md-alt-text">{{ 'S-C' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:ninety-ccw"></md-icon>
                <md-button aria-label="Rotate 90&#176; CCW" >
                    Rotate 90&#176; CCW
                    <span class="md-alt-text">{{ 'S-W' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>              
        </md-menu-content>
    </md-menu>
    <md-menu>
        <button  class="md-icon-button" aria-label="Arrange"  ng-click="$mdMenu.open()">
            <md-icon md-svg-icon="nbd:arrange"></md-icon>
        </button >  
        <md-menu-content>
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:bring-front"></md-icon>
                <md-button aria-label="Bring to Front" >
                    Bring to Front
                    <span class="md-alt-text">{{ 'S-M-]' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>      
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:bring-forward"></md-icon>
                <md-button aria-label="Bring Forward" >
                    Bring Forward
                    <span class="md-alt-text">{{ 'M-]' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>     
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:send-backward"></md-icon>
                <md-button aria-label="Send Backward" >
                    Send to Backward
                    <span class="md-alt-text">{{ 'M-[' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>      
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:send-back"></md-icon>
                <md-button aria-label="Send to Back" >
                    Send to Back
                    <span class="md-alt-text">{{ 'S-M-[' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>              
        </md-menu-content>
    </md-menu>
    <md-menu>
        <button  class="md-icon-button" aria-label="Align"  ng-click="$mdMenu.open()">
            <md-icon md-svg-icon="nbd:align"></md-icon>
        </button >  
        <md-menu-content>
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:align-vertical"></md-icon>
                <md-button aria-label="Align Center" >
                    Align Vertical Center
                    <span class="md-alt-text">{{ 'S-C' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:align-horizontal"></md-icon>
                <md-button aria-label="Align Middle" >
                    Align Horizontal Center
                    <span class="md-alt-text">{{ 'S-M' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>    
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:align-left"></md-icon>
                <md-button aria-label="Align Left" >
                    Align Left
                    <span class="md-alt-text">{{ 'S-L' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:align-right"></md-icon>
                <md-button aria-label="Align Right" >
                    Align Right
                    <span class="md-alt-text">{{ 'S-R' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>  
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:align-top"></md-icon>
                <md-button aria-label="Align Top" >
                    Align Top
                    <span class="md-alt-text">{{ 'S-T' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>
            <md-menu-item class="md-indent">
                <md-icon md-svg-icon="nbd:align-bottom"></md-icon>
                <md-button aria-label="Align Bottom" >
                    Align Bottom
                    <span class="md-alt-text">{{ 'S-B' | keyboardShortcut }}</span>
                </md-button>             
            </md-menu-item>              
        </md-menu-content>
    </md-menu>
</md-menu-bar>    
<md-button class="md-icon-button" aria-label="Copy" >
    <md-icon md-svg-icon="nbd:copy"></md-icon>
</md-button> 
<md-button class="md-icon-button" aria-label="Delete" onclick="nbdPlg.deleteLayer()">
    <md-icon md-svg-icon="nbd:trash"></md-icon>
</md-button>  
<md-button class="md-icon-button" aria-label="Delete" onclick="nbdPlg.deleteLayer()">
    <md-icon md-svg-icon="nbd:lock"></md-icon>
</md-button>  