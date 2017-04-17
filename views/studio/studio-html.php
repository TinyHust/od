<?php // ?>
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
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300italic,300' rel='stylesheet' type='text/css'>
        <link type="text/css" href="<?php echo NBDESIGNER_ASSETS_URL .'libs/css/angular-material.css'; ?>" rel="stylesheet" media="all">
        <link type="text/css" href="<?php echo NBDESIGNER_CSS_URL .'nbdstuido-bundle.css'; ?>" rel="stylesheet" media="all">
        <link type="text/css" href="<?php echo NBDESIGNER_CSS_URL .'nbd-studio.css'; ?>" rel="stylesheet" media="all">
    <head>    
    <body >
<div class="nbd-workbench nbd-div-shadow" ng-app="nbDesignerApp">
    <div ng-controller="StudioController">
        <nbd-stage
            action= "activeStage()"
            stages = "stackStages"
            add="addAction"
        >
        </nbd-stage>

    </div>    
</div>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-cookies-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-animate-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-aria-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-route-1.6.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_ASSETS_URL.'libs/angular-material-1.1.3.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_JS_URL.'nbd-studio-bundle.js'; ?>"></script>
        <script type='text/javascript' src="<?php echo NBDESIGNER_JS_URL.'nbd-studio.js'; ?>"></script>
    </body>    
</html>
