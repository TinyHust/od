<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<md-toolbar layout="row">
  <div class="md-toolbar-tools">
    <h3 style="color: #fff;">Layers manage</h3>
  </div>
</md-toolbar>
<md-list ng-cloak class="list-layers">
    <md-subheader class="md-no-ink">
        <div flex layout="row">
        <div flex="80" layout-align="center start" layout="column">
            <h4 flex="none" style="width: 100%;" md-truncate>
                <span>{{stages[currentStage]['name']}} - 
                <span>{{ _.size(layers ) }} {{ ( _.size( layers ) > 1 ) ? 'layers' : 'layer' }}</span>
            </h4>    
        </div>    
        <div flex="20" layout-align="center end" layout="column">
            <div layout-align="center start" layout="row">
                <md-menu  md-position-mode="target-left target">
                    <md-button class="md-icon-button button-no-margin" aria-label="Actions" ng-click="$mdMenu.open($event)">
                        <md-tooltip md-direction="top" ng-class="primaryPalette">Actions</md-tooltip>
                        <md-icon md-svg-icon="nbd:more-vert"></md-icon>
                    </md-button> 
                    <md-menu-content width="3">
                        <md-menu-item>
                            <md-button aria-label="Clear All Layers">
                                <md-icon md-menu-align-target md-svg-icon="nbd:clear-all" class="md-accent"></md-icon>
                                Clear All Layers
                            </md-button>                            
                        </md-menu-item>                        
                        <md-menu-item>
                            <md-button aria-label="Import">
                                <md-icon md-menu-align-target md-svg-icon="nbd:import"></md-icon>
                                Import
                            </md-button>
                        </md-menu-item>    
                        <md-menu-item >
                            <md-button aria-label="Export">
                                <md-icon md-menu-align-target md-svg-icon="nbd:export"></md-icon>
                                Export
                            </md-button>
                        </md-menu-item>   
                    </md-menu-content>            
                </md-menu>
            </div>    
        </div>    
        </div>
    </md-subheader>
    <md-list-item ng-repeat="layer in layers" class="md-2-line nbd-layer" ng-class="currentLayerActive == $index ? 'active' : ''">
        <img alt="{{ layer.name }}" ng-src="{{ layer.img }}" class="md-avatar  nbd-layer-thumb" ng-click="activeLayer(layer)"/>
        <div class="md-list-item-text nbd-layer-name" ng-click="activeLayer(layer)">
            <p>{{ layer.name }}</p>
        </div>
        <md-menu class="md-secondary">
            <md-button class="md-icon-button button-no-margin" aria-label="Actions" ng-click="$mdMenu.open($event)">
                <md-icon md-svg-icon="nbd:more-vert"></md-icon>
            </md-button>         
            <md-menu-content width="3">            
                <md-menu-item>
                    <md-button aria-label="Visible" ng-click="hideLayer()">
                        <md-icon md-svg-icon="nbd:{{currentLayerIsVisible ? 'visible' : 'invisible'}}" ng-class="{'md-warn' : !currentLayerIsVisible}"></md-icon>
                        {{currentLayerIsVisible ? 'Hide' : 'Show'}}
                    </md-button>                            
                </md-menu-item>    
                <md-menu-item>
                    <md-button aria-label="Visible" ng-click="lockLayer()">
                        <md-icon md-svg-icon="nbd:{{currentLayerIsLocked ? 'unlock' : 'lock'}}" ng-class="{'md-warn' : !currentLayerIsLocked}"></md-icon>
                        {{currentLayerIsLocked ? 'Lock' : 'Unlock'}}
                    </md-button>                            
                </md-menu-item>
                <md-menu-item>
                    <md-button aria-label="Visible" ng-click="lockLayer()">
                        <md-icon md-svg-icon="nbd:click-to-upload"></md-icon>
                        {{currentLayerIsVisible ? 'Click to Upload' : 'Remove Upload'}}
                    </md-button>                            
                </md-menu-item>            
            </md-menu-content>   
        </md-menu>
    </md-list-item>
</md-list>