<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<style type="text/css">
    canvas.foo {
        background: rgba(0, 220, 255, 0.27);
    }
</style>
<div class="nbd-workbench nbd-div-shadow" ng-app="nbDesignerApp">
    <div ng-controller="StudioController as ctrl">
        <nbd-stage
            action= "activeStage()"
            stages = "stackStages"
            add="addAction"
        >
        </nbd-stage>
        <div md-color-picker ng-model="valueObj"></div>
    
    

  <div class="menu-demo-container" layout-align="center center" layout="column">
    <md-menu>
      <md-button aria-label="Open phone interactions menu" class="md-icon-button" ng-click="ctrl.openMenu($mdMenu, $event)">
        <md-icon md-menu-origin md-svg-icon="call:phone"></md-icon>
      </md-button>
      <md-menu-content width="4">
        <md-menu-item>
          <md-button ng-click="ctrl.redial($event)">
            <md-icon md-svg-icon="call:dialpad" md-menu-align-target></md-icon>
            Redial
          </md-button>
        </md-menu-item>
        <md-menu-item>
          <md-button disabled="disabled" ng-click="ctrl.checkVoicemail()">
            <md-icon md-svg-icon="call:voicemail"></md-icon>
            Check voicemail
          </md-button>
        </md-menu-item>
        <md-menu-divider></md-menu-divider>
        <md-menu-item>
          <md-button ng-click="ctrl.toggleNotifications()">
            <md-icon md-svg-icon="social:notifications-{{ctrl.notificationsEnabled ? 'off' : 'on'}}"></md-icon>
            {{ctrl.notificationsEnabled ? 'Disable' : 'Enable' }} notifications
          </md-button>
        </md-menu-item>
      </md-menu-content>
    </md-menu>
  </div>   
        
         </div>    
</div>