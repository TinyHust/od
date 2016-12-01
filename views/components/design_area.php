<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="viewport" ng-style="{'width': designerWidth, 'height': designerHeight, 'left': offset,
                                           'min-width' : '320px',
                                           'min-height' : '320px'}">
    <div class="view_container">
        <div class="design-image" >
            <div class="container-image">
                <img ng-src="{{img.img_src}}"  spinner-on-load ng-repeat="img in currentVariant.activeImages"
                     ng-style="{'top': calcLeft(img.img_src_top), 'left': calcLeft(img.img_src_left), 'width': calcDimension(img.img_src_width), 'height':calcDimension(img.img_src_height)}"
                     />
            </div>                               
        </div>
        <div class="grid-area">
            <canvas id="grid"></canvas>
        </div>	

        <div class="design-aria" 
             ng-style="{'width': currentVariant.designArea['area_design_width'] * zoom * designScale,
					   'height' : currentVariant.designArea['area_design_height'] * zoom * designScale,
					   'top' : calcLeft(currentVariant.designArea['area_design_top']),
					   'left' : calcLeft(currentVariant.designArea['area_design_left'])
				}"
             >
            <canvas id="designer-canvas" width="500" height="500"></canvas> 
        </div>	
    </div>
</div>
<div id="frame" ng-style="{'top': designerWidth + 2, 'width': calcWidthThumb(_.size(currentVariant.info)) * 50, 'margin-left': -(calcWidthThumb(_.size(currentVariant.info)) * 50)/2}">
    <div class="container_frame">
        <span class="fa fa-angle-left left shadow" aria-hidden="true" ng-show="currentVariant.numberFrame > 4"></span>
        <span class="fa fa-angle-right right shadow" aria-hidden="true" ng-show="currentVariant.numberFrame > 4"></span>
        <div class="container-inner-frame">
            <div class="container_item">
                <a class="box-thumb" ng-class="{active: currentVariant.orientationActive == orientation.name}" ng-repeat="orientation in currentVariant.info" ng-click="changeOrientation(orientation)">
                    <img width="40" height="40" ng-src="{{orientation.source['img_src']}}"  spinner-on-load/>
                </a>
            </div>
        </div>
    </div>
</div>