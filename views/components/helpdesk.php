<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div id="helpdesk" class="shadow">
    <h3>{{(langs['HELPDESK']) ? langs['HELPDESK'] : "Helpdesk"}}</h3>
    <div class="od_tabs inner-help">
        <ul>
            <li><a href="#general-help">{{(langs['GENERAL']) ? langs['GENERAL'] : "General"}}</a></li>
            <li><a href="#design-help">{{(langs['DESIGN']) ? langs['DESIGN'] : "Design"}}</a></li>
            <li><a href="#tool-help">{{(langs['TOOL_LAYER']) ? langs['TOOL_LAYER'] : "Tool-Layer"}}</a></li>
        </ul>
        <div id="general-help">
            <img src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/images/helpdesk01.jpg'; ?>" />
            <img src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/images/helpdesk02.jpg'; ?>" />
        </div>
        <div id="design-help">
            <img src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/images/helpdesk04.jpg'; ?>" />
            <img src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/images/helpdesk05.jpg'; ?>" />
        </div>	
        <div id="tool-help">           
            <img src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/images/helpdesk06.jpg'; ?>" />
            <img src="<?php echo NBDESIGNER_PLUGIN_URL .'assets/images/helpdesk03.jpg'; ?>" />
        </div>	
    </div>
    <span class="close-helpdesk fa fa-angle-double-right"></span>
</div>