<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<!DOCTYPE html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title><?php echo 'Online Designer'; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1, minimum-scale=0.5, maximum-scale=1.0"/>
        <meta content="<?php echo 'Online Designer - HTML5 Designer - Online Print Solution'; ?>" name="description" />
        <meta content="<?php echo 'Online Designer'; ?>" name="keywords" />
        <meta content="Netbaseteam" name="author">
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/jquery-ui.min.css'; ?>" rel="stylesheet" media="all" />
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/font-awesome.min.css'; ?>" rel="stylesheet" media="all" />
        <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300italic,300' rel='stylesheet' type='text/css'>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/bootstrap.min.css'; ?>" rel="stylesheet" media="all"/>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/bundle.css'; ?>" rel="stylesheet" media="all"/>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/owl.carousel.css'; ?>" rel="stylesheet" media="all"/>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/style.min.css'; ?>" rel="stylesheet" media="all">
        <?php if(is_rtl()): ?>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/nbdesigner-rtl.css'; ?>" rel="stylesheet" media="all">
        <?php endif; ?>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->	
        <script type="text/javascript">
            var product_id = '<?php echo $_GET['product_id']; ?>';
            var od_mainURL = '<?php echo NBDESIGNER_PLUGIN_URL . 'assets/'; ?>';
            var orderid = OD_task = OD_priority = adid = '';
            var NBDESIGNCONFIG = {};
            NBDESIGNCONFIG['lang_code'] = "<?php echo get_bloginfo('language'); ?>";
            NBDESIGNCONFIG['lang_rtl'] = "<?php if(is_rtl()){ echo 'rtl'; } else {  echo 'ltr';  } ?>";
            NBDESIGNCONFIG['is_mobile'] = "<?php echo wp_is_mobile(); ?>";
            <?php if (isset($_GET['orderid']) && ($_GET['orderid'] != '')): ?>
                orderid = "<?php echo $_GET['orderid']; ?>";
            <?php endif; ?>
            <?php if(isset($_GET['task'])): ?>
                OD_task = "<?php echo $_GET['task']; ?>";
             <?php endif; ?>   
            <?php if(isset($_GET['priority'])): ?>
                OD_priority = "<?php echo $_GET['priority']; ?>";
             <?php endif; ?>  
            <?php if(isset($_GET['adid'])): ?>
                adid = "<?php echo $_GET['adid']; ?>";
             <?php endif; ?>  
        </script>
    </head>
    <body ng-controller="DesignerController" ng-style="{'background-image' : 'url(<?php echo NBDESIGNER_PLUGIN_URL ?>assets/images/background/'+backgroundId+'.png)'}">
        <div class="od_loading"></div>
        <div class="container-fluid" id="designer-controller">
            <?php
            include_once('components/menu.php');
            include_once('components/design_area.php');
            include_once('components/info.php');
            ?>
        </div>
        <div id="od_modal">
            <?php
            include_once('components/modal_clipart.php');
            include_once('components/modal_upload.php');
            include_once('components/modal_qrcode.php');
            include_once('components/modal_preview.php');
            include_once('components/modal_pattern.php');
            include_once('components/modal_fonts.php');
            include_once('components/modal_crop_image.php');
            include_once('components/modal_config_art.php');
            include_once('components/modal_share.php');		
            include_once('components/modal_expand_feature.php');		
            ?>
        </div>
        <div id="od_config" ng-class="modeMobile ? 'mobile' : 'modepc'">	
            <?php
            include_once('components/config_text.php');
            include_once('components/config_clipart.php');
            include_once('components/config_image.php');
            include_once('components/config_draw.php');
            ?>
            <span class="hide-config fa fa-chevron-down e-shadow e-hover-shadow item-config" ng-show="modeMobile"></span>
            <span class="hide-tool-config fa fa-chevron-down e-shadow e-hover-shadow item-config" ng-hide="modeMobile" ng-style="{'display' : (pop.text == 'block' || pop.art == 'block' || pop.qrcode == 'block' || pop.clipArt == 'block' || pop.draw == 'block') ? 'block' : 'none'}"></span>
        </div>
        <?php
        include_once('components/config_style.php');
        include_once('components/popover_layer.php');
        include_once('components/tool_top.php');
        include_once('components/helpdesk.php');
        ?>
        <div class="od_processing">
            <div id="nbdesigner_preloader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>	
            <p id="first_message">{{(langs['NBDESIGNER_PROCESSING']) ? langs['NBDESIGNER_PROCESSING'] : "NBDESIGNER PROCESSING"}}...</p>
        </div>
        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/touch.js'; ?>"></script>
        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.2/angular.min.js"></script>
        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.js"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/bundle.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/fabric.curvedText.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/fabric.removeColor.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/jscolor.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/_layout.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/designer.min.js'; ?>"></script>		
    </body>
</html>