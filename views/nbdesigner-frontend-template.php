<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<!DOCTYPE html>
<?php
    $hide_on_mobile = nbdesigner_get_option('nbdesigner_disable_on_smartphones');
    if(wp_is_mobile() && $hide_on_mobile == 'yes'):                           
?>
<html lang="<?php echo get_bloginfo('language'); ?>" ng-app="app">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Online Designer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1, minimum-scale=0.5, maximum-scale=1.0"/>
        <meta content="Online Designer - HTML5 Designer - Online Print Solution" name="description" />
        <meta content="Online Designer" name="keywords" />
        <meta content="Netbaseteam" name="author"> 
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300italic,300' rel='stylesheet' type='text/css'>
        <style type="text/css">
            html {
                width: 100%;
                height: 100%;
            }
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                background-color: #f4f4f4;
            }
            p {
                margin: 0;
                text-align: center;
                font-family: 'Roboto', sans-serif;
            }
            p.announce {
                padding-left: 15px;
                padding-right: 15px;                
                font-size: 17px;
                margin-top: 15px;
                color: #999;
            }
            p img {
                max-width: 100%;
            }
            a {
                display: inline-block;
                color: #fff;
                background: #f98332;
                margin-top: 15px;
                padding: 10px;
                text-transform: uppercase;
                font-size: 14px;
                border-radius: 5px;
                box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);      
                text-decoration: none;
            }
        </style>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                window.parent.NBDESIGNERPRODUCT.nbdesigner_ready();
            });           
        </script>
    </head>
    <body>
        <p><img src="<?php echo NBDESIGNER_PLUGIN_URL . 'assets/images/mobile.png'; ?>" /></p>
        <p class="announce"><?php _e('Sorry, our design tool is not currently supported on mobile devices.', 'nbdesigner'); ?></p>
        <p class="recommend"><a href="javascript:void(0)" onclick="window.parent.hideDesignFrame();"><?php _e('Back to product', 'nbdesigner'); ?></a></p>
    </body>
</html>
<?php else: ?>
<html lang="<?php echo get_bloginfo('language'); ?>" ng-app="app">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Online Designer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1, minimum-scale=0.5, maximum-scale=1.0"/>
        <meta content="Online Designer - HTML5 Designer - Online Print Solution" name="description" />
        <meta content="Online Designer" name="keywords" />
        <meta content="Netbaseteam" name="author">
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/jquery-ui.min.css'; ?>" rel="stylesheet" media="all" />
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/font-awesome.min.css'; ?>" rel="stylesheet" media="all" />
        <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300italic,300' rel='stylesheet' type='text/css'>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/bootstrap.min.css'; ?>" rel="stylesheet" media="all"/>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/bundle.css'; ?>" rel="stylesheet" media="all"/>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/owl.carousel.css'; ?>" rel="stylesheet" media="all"/>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/tooltipster.bundle.min.css'; ?>" rel="stylesheet" media="all"/>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/style.min.css'; ?>" rel="stylesheet" media="all">
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/custom.css'; ?>" rel="stylesheet" media="all">
        <?php if(is_rtl()): ?>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/nbdesigner-rtl.css'; ?>" rel="stylesheet" media="all">
        <?php endif; ?>
        <?php 
            $enableColor = nbdesigner_get_option('nbdesigner_show_all_color'); 
            if($enableColor == 'no'):
        ?>
        <link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/spectrum.css'; ?>" rel="stylesheet" media="all">
        <?php endif; ?>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->	
        <script type="text/javascript">
            var product_id = '<?php echo $_GET['product_id']; ?>';
            var od_mainURL = '<?php echo NBDESIGNER_PLUGIN_URL . 'assets/'; ?>';
            var orderid = OD_task = OD_priority = adid = OD_temp = OD_ref = OD_folder = OD_oiid = '';
            var OD_save_status = 0;
            var NBDESIGNCONFIG = {};
            var NBDSETTINGS = {};
            NBDESIGNCONFIG['lang_code'] = "<?php echo get_bloginfo('language'); ?>";
            NBDESIGNCONFIG['lang_rtl'] = "<?php if(is_rtl()){ echo 'rtl'; } else {  echo 'ltr';  } ?>";
            NBDESIGNCONFIG['is_mobile'] = "<?php echo wp_is_mobile(); ?>";
            NBDESIGNCONFIG['stage_dimension'] = 500;
            NBDESIGNCONFIG['max_size_upload'] = <?php echo nbdesigner_get_option('nbdesigner_maxsize_upload'); ?>;
            NBDESIGNCONFIG['min_size_upload'] = <?php echo nbdesigner_get_option('nbdesigner_minsize_upload'); ?>;
            NBDESIGNCONFIG['default_text'] = "<?php echo nbdesigner_get_option('nbdesigner_default_text'); ?>";
            NBDESIGNCONFIG['pattern_text'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_textpattern'); ?>";
            NBDESIGNCONFIG['curved_text'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_curvedtext'); ?>";
            NBDESIGNCONFIG['nbdesigner_enable_upload_image'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_upload_image'); ?>";
            NBDESIGNCONFIG['nbdesigner_enable_image_webcam'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_image_webcam'); ?>";
            NBDESIGNCONFIG['nbdesigner_enable_facebook_photo'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_facebook_photo'); ?>";
            NBDESIGNCONFIG['nbdesigner_enable_image_url'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_image_url'); ?>";
            NBDESIGNCONFIG['default_text_qrcode'] = "<?php echo nbdesigner_get_option('nbdesigner_default_qrcode'); ?>";
            NBDESIGNCONFIG['enable_text'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_text'); ?>";
            NBDESIGNCONFIG['enable_clipart'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_clipart'); ?>";
            NBDESIGNCONFIG['enable_image'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_image'); ?>";
            NBDESIGNCONFIG['enable_qrcode'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_qrcode'); ?>";
            NBDESIGNCONFIG['enable_draw'] = "<?php echo nbdesigner_get_option('nbdesigner_enable_draw'); ?>";
            NBDESIGNCONFIG['enable_all_color'] = "<?php echo nbdesigner_get_option('nbdesigner_show_all_color'); ?>";
            NBDESIGNCONFIG['_palette'] = "<?php echo nbdesigner_get_option('nbdesigner_hex_names'); ?>";
            NBDESIGNCONFIG['nbdesigner_default_color'] = "<?php echo nbdesigner_get_option('nbdesigner_default_color'); ?>";
            NBDESIGNCONFIG['font_url'] = "<?php echo NBDESIGNER_FONT_URL .'/'; ?>";
            NBDESIGNCONFIG['url_style'] = "<?php echo NBDESIGNER_PLUGIN_URL . 'assets/'; ?>";
            NBDESIGNCONFIG['is_designer'] = 0;
            NBDESIGNCONFIG['origin_foler_template'] = '';
            <?php if(current_user_can('edit_nbd_template')): ?>
            NBDESIGNCONFIG['is_designer'] = 1;   
            <?php endif; ?>                   
            ;var _colors = NBDESIGNCONFIG['_palette'].split(','),
            colorPalette = [], row = [];
            for(var i=0; i < _colors.length; ++i) {
                var color = _colors[i].split(':')[0];
                row.push(color);
                if(i % 10 == 9){
                    colorPalette.push(row);
                    row = [];
                }               
            }
            row.push(NBDESIGNCONFIG['nbdesigner_default_color']);
            colorPalette.push(row);
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
                adid = "<?php echo time(); ?>";
             <?php endif; ?>
            <?php if (isset($_GET['redesign'])): ?>
                adid = "<?php echo $_GET['temp']; ?>";
                NBDESIGNCONFIG['origin_foler_template'] = "<?php echo $_GET['temp']; ?>";
                OD_save_status = 1;
            <?php endif; ?>                   
            <?php if(isset($_GET['temp'])): ?>
                OD_temp = "<?php echo $_GET['temp']; ?>";
            <?php endif; ?>          
            <?php if(isset($_GET['ref'])): ?>
                OD_ref = "<?php echo $_GET['ref']; ?>";
            <?php endif; ?>    
            <?php if(isset($_GET['folder'])): ?>
                OD_folder = "<?php echo $_GET['folder']; ?>";
            <?php endif; ?>    
            <?php if(isset($_GET['oiid'])): ?>
                OD_oiid = "<?php echo $_GET['oiid']; ?>";
            <?php endif; ?>    
            <?php 
                $settings = nbdesigner_get_all_frontend_setting();
                foreach ($settings as $key => $val):
            ?>
            NBDSETTINGS['<?php echo $key; ?>'] = <?php echo $val; ?>;
            <?php endforeach; ?>
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
            <p ng-show="partialSave"><span id="saved_sides">0</span> / <span id="total_sides">1</span></p>
        </div>
<!--        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
        <script type='text/javascript' src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/libs/jquery.min.js'; ?>"></script>
<!--        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>-->
        <script type='text/javascript' src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/libs/jquery-ui.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/touch.js'; ?>"></script>
<!--        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
        <script type='text/javascript' src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/libs/bootstrap.min.js'; ?>"></script>
<!--        <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.2/angular.min.js"></script>-->
        <script type='text/javascript' src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/libs/angular.min.js'; ?>"></script>
<!--        <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.js"></script>-->
        <script type='text/javascript' src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/libs/lodash.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/bundle.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/fabric.curvedText.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/fabric.removeColor.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/_layout.js'; ?>"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/spectrum/1.3.0/js/spectrum.min.js"></script>    
        <script type="text/javascript" src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/js/designer.min.js'; ?>"></script>		
    </body>
</html>
<?php endif; ?>