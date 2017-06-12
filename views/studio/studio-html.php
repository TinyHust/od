<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<!DOCTYPE html>
<html lang="<?php echo str_replace('-', '_', get_bloginfo('language')); ?>">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Online Designer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1, minimum-scale=0.5, maximum-scale=1.0"/>
        <meta content="Online Designer - HTML5 Designer - Online Print Solution" name="description" />
        <meta content="Online Designer" name="keywords" />
        <meta content="Netbaseteam" name="author"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
        <link type="text/css" href="<?php echo NBDESIGNER_ASSETS_URL .'libs/css/angular-material.css'; ?>" rel="stylesheet" media="all">
        <link type="text/css" href="<?php echo NBDESIGNER_CSS_URL .'nbdstuido-bundle.css'; ?>" rel="stylesheet" media="all">
        <link type="text/css" href="<?php echo NBDESIGNER_CSS_URL .'nbd-studio.css'; ?>" rel="stylesheet" media="all">
        <link type="text/css" href="<?php echo NBDESIGNER_CSS_URL .'ng-scrollable.min.css'; ?>" rel="stylesheet" media="all">
        <script type="text/javascript" >
            var NBDCONFIG = {
                svgUrl  :   "<?php echo NBDESIGNER_ASSETS_URL. 'svgs/' ; ?>",
                fontUrl :   "<?php echo NBDESIGNER_PLUGIN_URL. 'data/google-font-images/' ; ?>",
                typoUrl :   "<?php echo NBDESIGNER_PLUGIN_URL. 'data/typography/' ; ?>",
                nonce_get   :   "<?php echo wp_create_nonce('nbd-get-data'); ?>",
                ajax_url :   "<?php echo admin_url('admin-ajax.php'); ?>",
                task    :   'typography', /* tasks: design, template, typography */ 
            };
        </script>  
        <style>
            .showbox{position:absolute;top:0;bottom:0;left:0;right:0;z-index: 999;background: #fdfdfd;}.loader{position:relative;margin:-50px auto 0 -50px;width:100px;top:50%;left:50%}.loader:before{content:'';display:block;padding-top:100%}.circular{-webkit-animation:rotate 2s linear infinite;-moz-animation:rotate 2s linear infinite;-ms-animation:rotate 2s linear infinite;animation:rotate 2s linear infinite;height:100%;-webkit-transform-origin:center center;transform-origin:center center;width:100%;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto}.path{stroke-dasharray:1,200;stroke-dashoffset:0;-webkit-animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;-moz-animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;-ms-animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;stroke-linecap:round}@-webkit-keyframes rotate{100%{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotate{100%{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}50%{stroke-dasharray:89,200;stroke-dashoffset:-35px}100%{stroke-dasharray:89,200;stroke-dashoffset:-124px}}@keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}50%{stroke-dasharray:89,200;stroke-dashoffset:-35px}100%{stroke-dasharray:89,200;stroke-dashoffset:-124px}}@-webkit-keyframes color{0%,100%{stroke:#d62d20}40%{stroke:#0057e7}66%{stroke:#008744}80%,90%{stroke:#ffa700}}@keyframes color{0%,100%{stroke:#d62d20}40%{stroke:#0057e7}66%{stroke:#008744}80%,90%{stroke:#ffa700}}     
        </style>
    </head>    
    <body>
        <?php $svgUrl = NBDESIGNER_ASSETS_URL. 'svgs/' ; ?>
        <div class="showbox">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                </svg>
            </div>
        </div>
        <div class="nbd-workbench nbd-div-shadow" ng-app="nbDesignerApp" ng-cloak>
            <div ng-controller="StudioController as ctrl" md-theme="{{theme}}" ng-class="primaryPalette" id="nbd-workbench" ng-click="hideContextMenu($event)">
                <div>
                    <?php include_once('main-bar.php'); ?>
                    <?php include_once('sidebar.php'); ?>
                   
                    <?php include_once('stages.php'); ?>
                </div>    
                <?php include_once('zoom-stage.php'); ?>
                <?php include_once('color-modal.php'); ?>
                <?php include_once('clear-stage-dialog.php'); ?>
                <?php include_once('sub-menu.php'); ?>      
                <?php include_once('context-menu.php'); ?>      
            </div>    
        </div>   
        
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-cookies-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-animate-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-aria-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-route-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-material-1.1.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_JS_URL.'nbd-studio-bundle.js'; ?>"></script>
        <!-- <script type='text/javascript' src="<?php echo NBDESIGNER_JS_URL.'mdColorPicker.js'; ?>"></script> -->
        <script type='text/javascript' src="<?php echo NBDESIGNER_JS_URL.'ng-scrollable.min.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_JS_URL.'nbd-studio.js'; ?>"></script>
    </body>    
</html>
