<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<md-sidenav class="md-sidenav-left" md-component-id="sidebar" md-disable-backdrop md-whiteframe="4" >
    <md-toolbar class="">
        <h2 class="md-toolbar-tools">
            <span flex>Choose Style</span>
            <md-button ng-click="toggleSidebar()" class="md-icon-button" aria-label="Close">
                <md-icon md-svg-icon="nbd:delete" ></md-icon>
            </md-button>            
        </h2>
    </md-toolbar>
    <md-content layout-margin>
        <div id="wheel">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                <filter id="drop-shadow">
                    <feGaussianBlur in="SourceAlpha" stdDeviation="3.2" />
                    <feOffset dx="0" dy="0" result="offsetblur" />
                    <feFlood flood-color="rgba(0,0,0,1)" />
                    <feComposite in2="offsetblur" operator="in" />
                    <feMerge>
                        <feMergeNode />
                        <feMergeNode in="SourceGraphic" />
                    </feMerge>
                </filter>
                </defs>
                <g class="wheel--maing"></g>
            </svg>        
        </div>
        <div>
            <p><md-icon md-svg-icon="nbd:one" ></md-icon>  Primary color</p>            
            <p><md-icon md-svg-icon="nbd:two" ></md-icon>  Accent color</p>            
        </div>
    </md-content>
</md-sidenav> 
