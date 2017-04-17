(function(angular, fabric, undefined) {
    'use strict';
    var nbDesigner = angular.module('nbDesigner', []);
    (function(undefined) {
        'use strict';
        nbDesigner.directive('nbdStage', function() {
            return {
                restrict: 'EA',
                scope: {
                    options: '=?',
                    id: '@?',
                    ngStageClass: '=?',
                    action: '&',
                    stages: '=',
                    add: '&'
                },
                
                link: function ($scope, $element, attrs) {
                    
                    var $canvas = $element.find('canvas');
                    var can = angular.element(document.getElementById("c1"));
                    $element.on('click', function(){
                        can.css('background-color', 'yellow');
                        console.log(can);
                        $element.append('<p>Text 2</p>');
                    });
                    var options = angular.extend({}, $scope.options);                
                },
                controller: function($scope){
                    $scope.invokeAction = function(){
                        $scope.add()('abc');
                        if (!$scope.stages) $scope.stages = [];
                        $scope.stages.push({
                            id: 'c2'
                        });    
                    };                 
                },
                templateUrl: 'canvas.html'
            }
        });
    })();
    angular.module('nbDesigner').run(['$templateCache', function ($templateCache) {
        'use strict';
        $templateCache.put('canvas.html',
            '<div ng-repeat="stage in stages" class="nbd-stage-container">' +
                '<canvas id="{{stage.id}}" width="500" height="500" ng-click="invokeAction()"></canvas>' +
            '</div>' +
            '<p class="">'+
                '<md-button class="md-fab md-hue-2" aria-label="Profile">' +
                    '+' +
                '</md-button>'  +            
            '</p>' +
            '<p class="test">Text</p>'
        );
    }]);    
})(window.angular, window.fabric);
var nbStudio = angular.module("nbDesignerApp", ['nbDesigner', 'ngMaterial', 'ngCookies', 'ngRoute', 'mdColorPicker']).controller("StudioController", function($scope, $mdDialog, $document){
    $scope.Stages = [];
    $scope.stackStages = [{id : 'c1'}];
    $scope.stageName = 'Name';
    $scope.activeStage = function(){
        var canvas = $document[0].getElementById('c1'),
        paragraph = $document[0].getElementsByClassName('test');
        var text_p = angular.element(paragraph).html();
        console.log(123);
    };
    $scope.addAction = function(text){
        console.log(text);  
        $scope.activeStage();
    };
    $scope.changeStageName = function(){
        console.log($scope.stageName);
    };
    var originatorEv;

    this.openMenu = function($mdMenu, ev) {
      originatorEv = ev;
      $mdMenu.open(ev);
    };

    this.notificationsEnabled = true;
    this.toggleNotifications = function() {
      this.notificationsEnabled = !this.notificationsEnabled;
    };

    this.redial = function() {
      $mdDialog.show(
        $mdDialog.alert()
          .targetEvent(originatorEv)
          .clickOutsideToClose(true)
          .parent('body')
          .title('Suddenly, a redial')
          .textContent('You just called a friend; who told you the most amazing story. Have a cookie!')
          .ok('That was easy')
      );

      originatorEv = null;
    };

    this.checkVoicemail = function() {
      // This never happens.
    };    
})