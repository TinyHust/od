var langjs = {
    "DELETE_ITEM_MESSAGE" : "Are you sure you want to delete this item?",
    "DELETE_ALL_ITEM_MESSAGE" : "Are you sure you want to delete all layers?",
    "LAYER_IMAGE" : "Image",
    "LAYER_GROUP" : "Group",
    "LAYER_PATH" : "Path",
    "LAYER_RECTANGLE" : "Rectangle",
    "LAYER_CIRCLE" : "Circle",
    "LAYER_TRIANGLE" : "Triangle",
    "LAYER_LINE" : "Line",
    "LAYER_POLYGON" : "Polygon",
    "LAYERS" : "Layers",
    "LANGUAGE" : "Language",
    "PREVIEW" : "Preview",
    "ZOOM_IN" : "Zoom In",
    "ZOOM_OUT" : "Zoom Out",
    "TEMPLATE" : "Template",
    "ALIGN" : "Align",
    "ALIGN_LEFT" : "Align Left",
    "ALIGN_RIGHT" : "Align Right",
    "ALIGN_TOP" : "Align Top",
    "ALIGN_BOTTOM" : "Align Bottom",
    "ALIGN_MIDDLE_VERTICAL" : "Align Middle Vertival",
    "ALIGN_MIDDLE_HORIZONTAL" : "Align Middle Horizontal",
    "UNDO" : "Undo",
    "REDO" : "Redo",
    "DOWNLOAD" : "Download",
    "SNAP_GRID" : "Snap grid",
    "PNG" : "PNG",
    "JPG" : "JPG",
    "PDF" : "PDF",
    "LOCK" : "Lock",
    "ELEMENT_UPLOAD" : "Element Upload",
    "LOCK_ALL_ADJUSMENT" : "Lock all adjustment",
    "LOCK_HORIZONTAL_MOVEMENT" : "Lock horizontal movement",
    "LOCK_VERTITAL_MOVEMENT" : "Lock vertical movement",
    "LOCK_HORIZONTAL_SCALING" : "Lock horizontal scaling",
    "LOCK_VERTITAL_SCALING" : "Lock vertical scaling",
    "DISABLE_DRAW_MODE" : "Disable draw mode",
    "LOCK_ROTATION" : "Lock rotation",
    "DESELECT_GROUP" : "Deselect group",
    "REPLACE_IMAGE" : "Replace image",
    "MES_ALLOW_UPLOAD_IMG" : "Only images are allowed",
    "MES_ERROR_MAXSIZE_UPLOAD" : "Oops, file upload larger than",
    "MES_ERROR_MINSIZE_UPLOAD" : "Oops, file upload smaller than",
    "FONT_CAT" : "Font Categories",
    "CAT" : "Categories",
    "TERM_ALERT" : "Please read and accept the terms",
    "PRODUCTS"  :   "Products"
};
/**
 * Util functions
 */
(function(c) {
    var b, d, e, f, g, h = c.body,
        a = c.createElement("div");
    a.innerHTML = '<span style="' + ["position:absolute", "width:auto", "font-size:128px", "left:-99999px"].join(" !important;") + '">' + Array(100).join("wi") + "</span>";
    a = a.firstChild;
    b = function(b) {
        a.style.fontFamily = b;
        h.appendChild(a);
        g = a.clientWidth;
        h.removeChild(a);
        return g;
    };
    d = b("monospace");
    e = b("serif");
    f = b("sans-serif");
    window.isFontAvailable = function(a) {
        return d !== b(a + ",monospace") || f !== b(a + ",sans-serif") || e !== b(a + ",serif");
    };
    window.isFireFox = function(){
        if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1){
            return true;
        }
        return false;
    };
    window.getType = function(obj){
        return {}.toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase();
    };
    /**
     * If return value greater than 0, browser is IE or Edge
     * @returns {Number|Window.getIEVersion.rv}
     */
    window.getIEVersion = function(){
        /*http://stackoverflow.com/questions/31757852/how-can-i-detect-internet-explorer-ie-and-microsoft-edge-using-javascript/32107845#32107845*/
        var rv = -1; 
        if (navigator.appName == 'Microsoft Internet Explorer'){
           var ua = navigator.userAgent,
               re  = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})");
           if (re.exec(ua) !== null){
             rv = parseFloat( RegExp.$1 );
           }
        }
        else if(navigator.appName == "Netscape"){                     
           if(navigator.appVersion.indexOf('Trident') === -1) rv = 12;
           else rv = 11;
        }       
        return rv;           
    };
    window.degToRad = function(degrees) {
        return degrees * (Math.PI / 180)
    };   
    window.isMobileDevice = function(){
        var isMobile = false; 
        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;    
        return isMobile;
    };    
    window.fitRectangle = function(x1, y1, x2, y2, type){
        
    };
})(document);
angular.module("nbDesignerApp", ['ngMaterial', 'ngCookies', 'ngRoute', 'mdColorPicker'])
        .controller("StudioController", function($scope, $mdDialog, $document, $timeout, $mdSidenav, $window, $rootScope){
    $scope.canAddStage = true;           
    $scope.isFirstStage = true;           
    $scope.isLastStage = false;           
    $scope.canAddStage = true;           
    $scope.isMutilpleStages = true;           
    $scope.onProcess = true;           
    $scope.theme = 'default';
    $scope.primaryPalette = 'blue-grey';
    $scope.currentStageRatio = 50;
    $scope.i18nLangs = {};
    $scope.currentfontSize = 14;
    $scope.currentTextColor = '#607d8b';
    $scope.stages = [{id : '1'},{id : '2'}];
    //$scope.default = 'cyan';
    $scope.langs = [
        {id : 1, code : 'en', name : 'English'},
        {id : 2, code : 'vi', name : 'Tiếng Việt'}
    ];
    $scope.changeTheme = function(){
        $scope.theme = $scope.theme === 'default' ? 'cyan' : 'default';
    };
    $scope.toggleSidebar = function(){
        $mdSidenav('sidebar').toggle();
    };
    $scope.announceClick = function(code){
        console.log(code);
    };
    /* Adjus work bench when window resize*/
    var _window = angular.element($window);
    $scope.workBenchHeight = $window.innerHeight;      
    $scope.workBenchWidth = $window.innerWidth;
    _window.bind('resize', $scope.resizeWindow);
    $scope.adjustStage = function(command){
        if(command === 'width'){
            return ($scope.workBenchWidth - 380) + 'px';
        }else if(command === 'height'){
            return ($scope.workBenchHeight - 64) + 'px';
        }else if(command === 'left') {
            return 380 + 'px';
        }  
    };
    $scope.resizeWindow = function(){
        $scope.workBenchHeight = $window.innerHeight;           
        $scope.workBenchWidth = $window.innerWidth;
    };     
    /** Adjus work bench when window resize **/

    /* Adjust stage */
    $scope.zoomIntStage = function(){
        nbdPlg.zoomIntStage();
    };   
    $scope.zoomOuttStage = function(){
        nbdPlg.zoomOuttStage();
    };     
    /** Adjust stage **/
    $scope.saveCart = function(){
        //todo
    };
    $scope.init = function(){
        angular.copy(langjs, $scope.i18nLangs);
    };
    $scope.init();
    $scope.debug = function(){
        console.log($scope.onProcess);
        $scope.onProcess = !$scope.onProcess;
        console.log($scope.onProcess);
    };
}).config(function($mdThemingProvider, $mdIconProvider){
    $mdIconProvider.iconSet('nbd', NBDCONFIG['svgUrl'] + 'nbd-icons.svg');
    $mdThemingProvider.theme('default')
        .primaryPalette('blue-grey', {
        })
        .accentPalette('red')
        .warnPalette('pink', {
            'default': '400',
            'hue-1': '100', 
            'hue-2': '600', 
            'hue-3': 'A100'    
        })
        .backgroundPalette('grey');
    $mdThemingProvider.theme('cyan')
        .primaryPalette('red', {
        })
        .accentPalette('red')
        .warnPalette('pink', {
            'default': '400',
            'hue-1': '100', 
            'hue-2': '600', 
            'hue-3': 'A100'    
        })
        .backgroundPalette('grey');
}).filter('keyboardShortcut', function($window) {
    return function(str) {
        if (!str)
            return;
        var keys = str.split('-');
        var isOSX = /Mac OS X/.test($window.navigator.userAgent);
        var seperator = (!isOSX || keys.length > 2) ? '+' : '';
        var abbreviations = {
            M: isOSX ? '⌘' : 'Ctrl',
            A: isOSX ? 'Option' : 'Alt',
            S: 'Shift'
        };
        return keys.map(function (key, index) {
            var last = index == keys.length - 1;
            return last ? key : abbreviations[key];
        }).join(seperator);
    };    
});
var nbdPlg = {
    stages : [],
    currentStage : 0,
    int : function(){
        for (stage in this.stages){
            stage.canvas = new fabric.Canvas(stage.id);
        }
    },
    /**
     * Design tools
     */
    /* Font */
    
    /* End. Font */
    /* Text */
    addText : function(text){
        //TODO
    },
    /* End. Text */
    /* Image */
    addImage : function(url){
        
    },
    /* End Image */
    /* Manipulate layer */
    deleteLayer : function(){},
    copyLayer : function(){},
    flipHorizontal : function(){},
    flipVertical : function(){},
    zoomInLayer : function(){},
    zoomOutLayer : function(){},
    alignLayer : function(command){
        switch(command) {
            case 'horizontal':
                //todo
                break;
            case 'center':
                //todo
                break;    
            case 'top':
                //todo
                break;
            case 'bottom':
                //todo
                break;  
            case 'left':
                //todo
                break;
            case 'right':
                //todo
                break;  
            default :
                //todo align layer center center
        }         
    },
    moveLayer : function(command){
        switch(command) {
            case 'top':
                //todo
                break;
            case 'bottom':
                //todo
                break;    
            case 'left':
                //todo
                break;
            case 'right':
                //todo
                break;               
        }        
    },
    arrangeLayer : function(command){
        switch(command) {
            case 'backward':
                //todo
                break;
            case 'back':
                //todo
                break;    
            case 'forward':
                //todo
                break;
            case 'front':
                //todo
                break;               
        }           
    }, 
    rotateLayer : function(deg){},
    undo : function(){}, 
    redo : function(){}, 
    /* End. Manipulate layer */
    /**
     * Adjust stage
     */
    zoomInStage : function(){
        
    },
    zoomOutStage : function(){
        
    },    
    resizeStage : function(){
        
    },
    rederStage : function(){
        
    },
    exportStage : function(){
        
    },
    deactiveAllLayer : function(){}
};
document.addEventListener('DOMContentLoaded', function(){
    nbdPlg.stages[0] = {
        id : '1',
        option : '',
        canvas : null
    };
    Ps.initialize(document.getElementById('stages-inner'));
    nbdPlg.int();
});
var nbdLayout = {
    activePanel : function(e){
        var target = angular.element(e),
        targetData = target.attr('data-panel'),
        targetIndex =  parseInt(target.attr('data-index')),       
        panels = angular.element(document.getElementsByClassName('menu-panel'));
        angular.element(document.getElementsByClassName('primary-menu')).removeClass('active');
        target.parent().addClass("active");
        for (var i = 0; i < panels.length; ++i){
            var panel = angular.element(panels[i]),
            index = parseInt(panel.attr('data-panel-index'));
            panel.removeClass('active');
            if (panel.attr('data-panel') == targetData){                
                panel.removeClass('after').removeClass('before').addClass('active');
            }else{
                panel.removeClass('after').removeClass('before');
                if(index < targetIndex){
                    panel.addClass('before');
                }else{
                    panel.addClass('after');
                }
            };
        }
    }
};