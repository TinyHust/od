<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<md-autocomplete
    md-selected-item="selectFont"
    
    >
    <md-item-template>
        <span md-highlight-text="searchFont" md-highlight-flags="^i">{{item.display}}
    </md-item-template>
</md-autocomplete>
<div class="comboinput">
    <md-input-container md-no-float class="md-block">
        <input ng-model="currentfontSize" placeholder="Size" type="number" step="any" min="1">
    </md-input-container>
    <md-select ng-model="currentfontSize" aria-label="Font size">
        <md-option 
            ng-repeat="(index, size) in ['6','8','10','12','14','16','18','21','24','28','32','36','42','48','56','64','72','80','88','96','104','120','144']" 
            ng-value="{{size}}">{{size}}
        </md-option>
    </md-select> 
</div>    
<div md-color-picker ng-model="currentTextColor"></div>


