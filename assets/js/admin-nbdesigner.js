jQuery(document).ready(function ($) {
    NBDESIGNADMIN.loopConfigAreaDesign();
    NBDESIGNADMIN.ajustImage();
    if($('#_nbdesigner_enable').prop("checked")){
        $('.nbdesigner-right.add_more').show();
    }
    $('#_nbdesigner_enable').change(function () {
        $('#nbdesigner-boxes').toggleClass('nbdesigner-disable');     
        $('#nbdesigner_dpi_con').toggleClass('nbdesigner-disable');     
        $('#nbdesigner-option').toggleClass('nbdesigner-disable');     
        $('.nbdesigner-right.add_more').toggle();
        NBDESIGNADMIN.ajustImage();
    });
    $('#nbdesigner_add_font_cat').on('click', function () {
        var html = '<input class="form-required nbdesigner_font_name" type="text" id="nbdesigner_name_font_newcat"><br /><br />';
        html += '<input type="button" id="nbdesigner_save_font_cat" onclick="NBDESIGNADMIN.add_font_cat(this)" value="Add new" class="button-primary">';
        html += '<img src="' + admin_nbds.url_gif + '" class="nbdesigner_loaded" id="nbdesigner_img_loading" style="margin-left: 15px;"/>';
        $('#nbdesigner_font_newcat').append(html);
        $(this).hide();
    });
    $('#nbdesigner_add_art_cat').on('click', function () {
        var html = '<input class="form-required nbdesigner_art_name" type="text" id="nbdesigner_name_art_newcat"><br /><br />';
        html += '<input type="button" id="nbdesigner_save_art_cat" onclick="NBDESIGNADMIN.add_art_cat(this)" value="Add new" class="button-primary">';
        html += '<img src="' + admin_nbds.url_gif + '" class="nbdesigner_loaded" id="nbdesigner_img_loading" style="margin-left: 15px;"/>';
        $('#nbdesigner_art_newcat').append(html);
        $('#nbdesigner_add_art_cat').hide();
    });
    $('#nbdesigner_order_design_check_all').click(function(){
        if ($(this).is(':checked')) {
            $('.nbdesigner_design_file').prop('checked', true);
        } else {
            $('.nbdesigner_design_file').prop('checked', false);
        }        
    });
    $('#nbdesigner_order_file_submit').on('click', function(e){
        e.preventDefault();
        var formdata = $('#nbdesigner_order_info').find('input, select').serialize();
        var approve_action = $('#nbdesigner_order_info select[name="nbdesigner_order_file_approve"]').val();
        $('#nbdesigner_order_submit_loading').removeClass('nbdesigner_loaded');
        formdata = formdata + '&action=nbdesigner_design_approve';
        $.post(admin_nbds.url, formdata, function(data) {
            $('#nbdesigner_order_submit_loading').addClass('nbdesigner_loaded');
            if(data.mes == 'success'){
                $('#nbdesigner_order_info input[class^="nbdesigner_design_file"]:checked').each(function(){
                    if (approve_action == 'accept') {
                        var newclass = 'approved';
                    } else {
                        var newclass = 'declined';
                    }
                    $(this).attr('checked', false);
                    $(this).parent('.nbdesigner_container_item_order').attr('class', 'nbdesigner_container_item_order '+newclass);                    
                });
            }else {
                alert(data.mes);
            }
        }, 'json');
    });
    $('#nbdesigner_uploads_email_submit').on('click', function(e){
        e.preventDefault();
        var formdata = $('#nbdesigner_order_email_info').find('textarea, select, input').serialize();
        formdata = formdata + '&action=nbdesigner_design_order_email';
        $('#nbdesigner_order_mail_loading').removeClass('nbdesigner_loaded');
        $.post(admin_nbds.url, formdata, function(data) {
            $('#nbdesigner_order_mail_loading').addClass('nbdesigner_loaded');
            if(data.success == 1) {
                $('#nbdesigner_order_email_error').fadeOut('fast');
                $('#nbdesigner_order_email_success').html(admin_nbds.mes_success).fadeIn('fast');
                $('textarea#nbdesigner_design_email_order_content').val('');
            } else {

                $('#nbdesigner_order_email_success').fadeOut('fast');
                $('#nbdesigner_order_email_error').html(data.error).fadeIn('fast');
            }            
        }, 'json');
    });
    $('#nbdesigner_get_key').on('click', function(e){
        e.preventDefault();
        var email = $('#nbdesigner_license input[name*="email"]').val(),
        name = $('#nbdesigner_license input[name*="name"]').val();
        if(email == '' || name == ''){
            alert('Please enter your name and your email!');
            return;
        };
        $('#nbdesigner_license_loading').removeClass('nbdesigner_loaded');
        var formdata = $('#nbdesigner_license').find('textarea, select, input').serialize();
        formdata = formdata + '&action=nbdesigner_get_license_key';
        $.post(admin_nbds.url, formdata, function(data){
            $('#nbdesigner_license_loading').addClass('nbdesigner_loaded');
            data = JSON.parse(data);
            if(data.mes){
                $('#nbdesigner_key_mes').html(data.mes).css('color', '#0085ba');
            }             
        });
    });
    $('#nbdesigner_active_key').on('click', function(e){
        e.preventDefault();
        $('#nbdesigner_license_active_loading').removeClass('nbdesigner_loaded');
        var formdata = $('#nbdesigner_active_license').find('textarea, select, input').serialize();
        formdata = formdata + '&action=nbdesigner_get_info_license';
        $.post(admin_nbds.url, formdata, function(data){
            $('#nbdesigner_license_active_loading').addClass('nbdesigner_loaded');
            data = JSON.parse(data);
            if(data.mes){
                $('#nbdesigner_license_mes').html(data.mes).css('color', '#0085ba');
            }
            if(data.flag == 1){
                $('#nbdesigner_active_key').prop('disabled', true);
                $('#nbdesigner_license').hide();
            }            
        });
    });
    $('#nbdesigner_remove_key').on('click', function(e){
        e.preventDefault();
        var con = confirm('Are you sure remove this license');
        if(con){
            var formdata = $('#nbdesigner_active_license').find('textarea, select, input').serialize();
            formdata = formdata + '&action=nbdesigner_remove_license';
            $('#nbdesigner_license_active_loading').removeClass('nbdesigner_loaded');
            $.post(admin_nbds.url, formdata, function(data){
                $('#nbdesigner_license_active_loading').addClass('nbdesigner_loaded');
                data = JSON.parse(data);
                if(data.mes){
                    $('#nbdesigner_license_mes').html(data.mes).css('color', '#0085ba');
                }
                if(data.flag == 1){
                    $('#nbdesigner_remove_key').prop('disabled', true);
                    $('#nbdesigner_active_key').prop('disabled', false);
                    $('#nbdesigner_input_key').val('').removeAttr('readonly');
                    $('#nbdesigner_license').show();
                }                  
            });
        }
    });
    $('#nbdesigner-gen-sec-key').on('click', function(){
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: {'action': 'nbdesigner_get_security_key', 'nonce': admin_nbds.nonce}          
        }).done(function (data) {
            var res = JSON.parse(data);
            if(res['mes'] == 'success'){
                $("#nbdesigner-sec-key").val(res['key']);
                $('#nbdesigner-toggle-show-sec-key').show();
                var check = parseInt($('#nbdesigner-check-toggle-show').val());
                if(check == 0){
                    $('#nbdesigner-toggle-show-sec-key .nbdesigner-hide-text').show();
                }else{
                    $('#nbdesigner-toggle-show-sec-key .nbdesigner-show-text').show();
                }
            }
        });        
    });
    $('#nbdesigner-toggle-show-sec-key').on('click', function(){
        var check = parseInt($('#nbdesigner-check-toggle-show').val());
        if(check == 0){
            $('#nbdesigner-check-toggle-show').val(1);
            $("#nbdesigner-sec-key").attr('type', 'password');
            $('#nbdesigner-toggle-show-sec-key .nbdesigner-hide-text').hide();
            $('#nbdesigner-toggle-show-sec-key .nbdesigner-show-text').show();
            $('#nbdesigner-toggle-show-sec-key .dashicons').addClass('dashicons-visibility').removeClass('dashicons-hidden'); 
        }else{
            $('#nbdesigner-check-toggle-show').val(0);
            $("#nbdesigner-sec-key").attr('type', 'text');
            $('#nbdesigner-toggle-show-sec-key .nbdesigner-hide-text').show();
            $('#nbdesigner-toggle-show-sec-key .nbdesigner-show-text').hide();
            $('#nbdesigner-toggle-show-sec-key .dashicons').removeClass('dashicons-visibility').addClass('dashicons-hidden');                    
        }
    });
});
var NBDESIGNADMIN = {
    add_font_cat: function (e) {
        var cat_name = jQuery(e).parent().find('.nbdesigner_font_name').val(),
                cat_id = jQuery('#nbdesigner_current_font_cat_id').val();
        if(cat_name == "") {
            alert('Please fill category name!');
            return;
        };        
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: {'action': 'nbdesigner_add_font_cat', 'name': cat_name, 'id': cat_id, 'nonce': admin_nbds.nonce},
            beforeSend: function () {
                jQuery('#nbdesigner_img_loading').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('#nbdesigner_img_loading').addClass('nbdesigner_loaded');
            }
        }).done(function (data) {
            if (data == 'success') {
                var html = '<li id="nbdesigner_cat_font_' + cat_id + '" class="nbdesigner_action_delete_cf"><label>';
                html += '<input value="' + cat_id + '" type="checkbox" name="nbdesigner_font_cat[]" />';
                html += '</label><span class="nbdesigner-right nbdesigner-delete-item" onclick="NBDESIGNADMIN.delete_cat_font(this)">&times;</span>'+cat_name+'</li>';
                jQuery('#nbdesigner_list_cats').append(html);
                jQuery('#nbdesigner_current_font_cat_id').val(parseInt(cat_id) + 1);
                jQuery('#nbdesigner_font_newcat').html('');
            } else if(data){
                alert(data);
                jQuery('#nbdesigner_font_newcat').html('');
            }
            jQuery('#nbdesigner_add_font_cat').show();
        });
    },
    add_art_cat: function (e) {     
        var cat_name = jQuery(e).parent().find('.nbdesigner_art_name').val(),
                cat_id = jQuery('#nbdesigner_current_art_cat_id').val();
        if(cat_name == "") {
            alert('Please fill category name!');
            return;
        };
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: {'action': 'nbdesigner_add_art_cat', 'name': cat_name, 'id': cat_id, 'nonce': admin_nbds.nonce},
            beforeSend: function () {
                jQuery('#nbdesigner_img_loading').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('#nbdesigner_img_loading').addClass('nbdesigner_loaded');
            }
        }).done(function (data) {
            if (data == 'success') {
                var html = '<li id="nbdesigner_cat_art_' + cat_id + '" class="nbdesigner_action_delete_art_cat"><label>';
                html += '<input value="' + cat_id + '" type="checkbox" name="nbdesigner_art_cat[]" />';
                html += '</label><span class="nbdesigner-right nbdesigner-delete-item dashicons dashicons-no-alt" onclick="NBDESIGNADMIN.delete_cat_art(this)"></span>'+cat_name+'</li>';
                jQuery('#nbdesigner_list_art_cats').append(html);
                jQuery('#nbdesigner_current_art_cat_id').val(parseInt(cat_id) + 1);
                jQuery('#nbdesigner_art_newcat').html('');
            } else if(data){
                alert(data);
                jQuery('#nbdesigner_art_newcat').html('');
            }
            jQuery('#nbdesigner_add_art_cat').show();
        });
    },
    delete_cat_font: function (e) {
        var index = jQuery(e).parent().find('input').val();
        var con = confirm("Do your want delete this category?"),
                cat_id = jQuery('#nbdesigner_current_font_cat_id').val();
        if (con) {
            var data = {'action': 'nbdesigner_delete_font_cat', 'id': index, 'nonce': admin_nbds.nonce};
            jQuery.ajax({
                url: admin_nbds.url,
                method: "POST",
                data: data,
                beforeSend: function () {
                    jQuery('#nbdesigner_img_loading').removeClass('nbdesigner_loaded');
                },
                complete: function () {
                    jQuery('#nbdesigner_img_loading').addClass('nbdesigner_loaded');
                }
            }).done(function (data) {
                if (data == 'success') {
                    jQuery('#nbdesigner_list_cats').find('#nbdesigner_cat_font_' + index).remove();
                    jQuery.each(jQuery('#nbdesigner_list_cats li label input'), function (key, val) {
                        jQuery(this).val(key);
                    });
                    jQuery('#nbdesigner_current_font_cat_id').val(parseInt(cat_id) - 1);
                    jQuery.each(jQuery('.nbdesigner_action_delete_cf'), function (key, val) {
                        jQuery(this).attr('id', 'nbdesigner_cat_font_' + key);
                    });
                }
                ;
            });
            ;
        }
    },
    delete_cat_art: function (e) {
        var index = jQuery(e).parent().find('input').val();
        var con = confirm("Do your want delete this category?"),
                cat_id = jQuery('#nbdesigner_current_art_cat_id').val();
        if (con) {
            var data = {'action': 'nbdesigner_delete_art_cat', 'id': index, 'nonce': admin_nbds.nonce};
            jQuery.ajax({
                url: admin_nbds.url,
                method: "POST",
                data: data,
                beforeSend: function () {
                    jQuery('#nbdesigner_img_loading').removeClass('nbdesigner_loaded');
                },
                complete: function () {
                    jQuery('#nbdesigner_img_loading').addClass('nbdesigner_loaded');
                }
            }).done(function (data) {
                if (data == 'success') {
                    jQuery('#nbdesigner_list_art_cats').find('#nbdesigner_cat_art_' + index).remove();
                    jQuery.each(jQuery('#nbdesigner_list_art_cats li label input'), function (key, val) {
                        jQuery(this).val(key);
                    });
                    jQuery('#nbdesigner_current_art_cat_id').val(parseInt(cat_id) - 1);
                    jQuery.each(jQuery('.nbdesigner_action_delete_art_cat'), function (key, val) {
                        jQuery(this).attr('id', 'nbdesigner_cat_art_' + key);
                    });
                }
                ;
            });
            ;
        }
    },
    delete_font: function (type, e) {
        var index = jQuery(e).data('index'),
                con = confirm("do you want delete this font?");
        var total = jQuery('#nbdesigner_current_index_google_font').val();
        if (con) {
            var data = {'action': 'nbdesigner_delete_font', 'id': index, 'nonce': admin_nbds.nonce, 'type': type};
            jQuery.ajax({
                url: admin_nbds.url,
                method: "POST",
                data: data
            }).done(function (data) {
                if (data == 'success') {
                    jQuery(e).parent().remove();
                    if (type == 'google') {
                        jQuery('#nbdesigner_current_index_google_font').val(parseInt(total) - 1);
                        jQuery.each(jQuery('.nbdesigner_action_delete_gf'), function (key, val) {
                            jQuery(this).attr('data-index', key);
                        });
                    } else if (type == 'custom') {
                        jQuery.each(jQuery('.nbdesigner_action_delete_cfont'), function (key, val) {
                            jQuery(this).attr('data-index', key);
                        });
                    }
                }
                ;
            });
        }
    },
    delete_art: function (e) {
        var index = jQuery(e).data('index'),
                con = confirm("Do you want delete this art?");
        if (con) {
            var data = {'action': 'nbdesigner_delete_art', 'id': index, 'nonce': admin_nbds.nonce};
            jQuery.ajax({
                url: admin_nbds.url,
                method: "POST",
                data: data
            }).done(function (data) {
                if (data == 'success') {
                    jQuery(e).parent().remove();
                    jQuery.each(jQuery('.nbdesigner_action_delete_art'), function (key, val) {
                        jQuery(this).attr('data-index', key);
                    });
                }
                ;
            });
        }
    },
    add_google_font: function (e) {
        var name = jQuery(e).prev('input').val(),
                index = jQuery('#nbdesigner_current_index_google_font').val();
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: {'action': 'nbdesigner_add_google_font', 'name': name, "id": index, 'nonce': admin_nbds.nonce},
            beforeSend: function () {
                jQuery('#nbdesigner_google_font_loading').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('#nbdesigner_google_font_loading').addClass('nbdesigner_loaded');
            }
        }).done(function (data) {
            var html = '<span class="nbdesigner_google_link "><a href="https://fonts.google.com/specimen/' + name + '" target="_blank"><span>' + name + '</span></a><span data-index="' + index + '" onclick="NBDESIGNADMIN.delete_font(\'google\',this)">&times;</span></span>';
            jQuery('#nbdesigner_no_google_font').hide();
            jQuery('#nbdesigner_container_list_google_font').append(html);
            jQuery('#nbdesigner_current_index_google_font').val(parseInt(index) + 1);
        });
    },
    loadImage: function (e) {
        var upload;
        if (upload) {
            upload.open();
            return;
        }
        var self = this;
        var index = jQuery(e).data('index'),
                _img = jQuery(e).parent().parent().find('.designer_img_src'),
                _input = jQuery(e).parent().parent().find('.hidden_img_src');
        upload = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        upload.on('select', function () {
            attachment = upload.state().get('selection').first().toJSON();
            _img.attr('src', attachment.url);
            _img.show();
            self.calcMargin(attachment.width, attachment.height, _img);
            self.calcPositionImg(_img);
            _input.val(attachment.url);
        });
        upload.open();
    },
    deleteOrientation: function (e) {
        if((jQuery('.nbdesigner-box-container').length) > 1){
            jQuery(e).parents('.nbdesigner-box-container').remove();
            this.resetBoxes();            
        }else{
            jQuery(e).parents('.nbdesigner-box-container').hide();
        };
    },
    resetBoxes: function () {
        jQuery.each(jQuery('#nbdesigner-boxes .nbdesigner-box-container'), function (key, val) {
            jQuery(this).find('.orientation_name').attr('name', '_designer_setting[' + key + '][orientation_name]');
            jQuery(this).find('.delete_orientation').attr('data-index', key);
            jQuery(this).find('.nbdesigner-area-design').attr('id', 'nbdesigner-area-design-' + key);
            jQuery(this).find('.hidden_img_src').attr('name', '_designer_setting[' + key + '][img_src]');
            jQuery(this).find('.hidden_img_src_top').attr('name', '_designer_setting[' + key + '][img_src_top]');
            jQuery(this).find('.hidden_img_src_left').attr('name', '_designer_setting[' + key + '][img_src_left]');
            jQuery(this).find('.hidden_img_src_width').attr('name', '_designer_setting[' + key + '][img_src_width]');
            jQuery(this).find('.hidden_img_src_height').attr('name', '_designer_setting[' + key + '][img_src_height]');
            jQuery(this).find('.nbdesigner_move').attr('data-index', key);
            jQuery(this).find('.nbdesigner-add-image').attr('data-index', key);
            jQuery(this).find('.real_width').attr('name', '_designer_setting[' + key + '][real_width]');
            jQuery(this).find('.real_height').attr('name', '_designer_setting[' + key + '][real_height]');
            jQuery(this).find('.area_design_top').attr('name', '_designer_setting[' + key + '][area_design_top]');
            jQuery(this).find('.area_design_left').attr('name', '_designer_setting[' + key + '][area_design_left]');
            jQuery(this).find('.area_design_width').attr('name', '_designer_setting[' + key + '][area_design_width]');
            jQuery(this).find('.area_design_height').attr('name', '_designer_setting[' + key + '][area_design_height]');
        });
        this.loopConfigAreaDesign();
    },
    calcPositionImg: function (e) {
        var p = e.parent(),
        top = e.offset().top - jQuery(p).offset().top,
        left = e.offset().left - jQuery(p).offset().left,
        width = e.width(),
        height = e.height();
        e.parents('.nbdesigner-image-box').find('.hidden_img_src_top').val(top);
        e.parents('.nbdesigner-image-box').find('.hidden_img_src_left').val(left);
        e.parents('.nbdesigner-image-box').find('.hidden_img_src_width').val(width);
        e.parents('.nbdesigner-image-box').find('.hidden_img_src_height').val(height);
    },
    loopConfigAreaDesign: function () {
        var parent = this;
        jQuery('.nbdesigner-area-design').each(function (key, val) {
            var self = this;
            jQuery(this).on('click', function () {
                jQuery('.nbdesigner-area-design').removeClass('selected');
                jQuery(this).addClass('selected');
            });
            jQuery(this).resizable({
                handles: "ne, se, sw, nw",
                aspectRatio: false,
                maxWidth: 300,
                maxHeight: 300,
                resize: function (event, ui) {
                    parent.updateDimension(self, ui.size.width, ui.size.height, ui.position.left, ui.position.top);
                },
                start: function (event, ui) {
                    /*TODO*/
                }
            }).draggable({containment: "parent",
                drag: function (event, ui) {
                    parent.updateDimension(self, null, null, ui.position.left, ui.position.top);
                }
            });
        });
    },
    calcMargin: function (w, h, _img) {
        var h_d = _img.parent().height();
        if ((w < h) && (h >= h_d)) {
            _img.css('margin-top', '0');
        };
        if ((w <= h_d) && (h <= h_d)) {
            var offset = (h_d - h) / 2;
            _img.css('margin-top', offset + 'px');
        };
        if ((w >= h) && (w > h_d)) {
            h = h * h_d / w;
            var offset = (h_d - h) / 2;
            _img.css('margin-top', offset + 'px');
        };
    },
    nbdesigner_move: function (e, command) {
        var index = jQuery(e).data('index');
        var id_area = 'nbdesigner-area-design-' + index,
        area = jQuery('#' + id_area),
        left = area.css('left'),
        top = area.css('top');
        w = area.width(),
        h = area.height(),
        ip_left = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_left'),
        ip_top = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_top'),
        ip_width = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_width'),
        ip_height = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_height');
        switch (command) {
            case 'left':
                area.css('left', parseFloat(left) - 1);
                ip_left.val(parseFloat(left) - 1);
                break;
            case 'right':
                area.css('left', parseFloat(left) + 1);
                ip_left.val(parseFloat(left) + 1);
                break;
            case 'down':
                area.css('top', parseFloat(top) + 1);
                ip_top.val(parseFloat(top) + 1);
                break;
            case 'up':
                area.css('top', parseFloat(top) - 1);
                ip_top.val(parseFloat(top) - 1);
                break;
            case 'center':
                left = (300 - w) / 2;
                top = (300 - h) / 2;
                area.css({'top': top + 'px', 'left': left + 'px'});
                ip_left.val(left);
                ip_top.val(top);
                break;
            case 'fit':             
                var width = jQuery(e).parents('.nbdesigner-box-collapse').find('.designer_img_src').width();
                var height = jQuery(e).parents('.nbdesigner-box-collapse').find('.designer_img_src').height();
                left = (300 - width) / 2;
                top = (300 - height) / 2;
                area.css({'top': top + 'px', 'left': left + 'px', 'width': width + 'px',  'height': height + 'px'});
                ip_left.val(left);
                ip_top.val(top);                
                ip_width.val(width);                
                ip_height.val(height);   
                break;
        }
    },
    ajustImage: function () {
        var self = this;
        jQuery.each(jQuery('.designer_img_src'), function () {
            var _img = jQuery(this),
            w = jQuery(this).width(),
            h = jQuery(this).height();
            self.calcMargin(w, h, _img);
            self.calcPositionImg(_img);
        });
    },
    updateDimension: function (e, width, height, left, top) {
        var ip_left = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_left'),
                ip_top = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_top'),
                ip_width = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_width'),
                ip_height = jQuery(e).parents('.nbdesigner-box-collapse').find('.area_design_height');
        if (left)
            ip_left.val(left);
        if (top)
            ip_top.val(top);
        if (width)
            ip_width.val(width);
        if (height)
            ip_height.val(height);
    },
    updatePositionDesignArea: function (e) {
        var att = jQuery(e).data('index'),
        value = jQuery(e).val(),
        parent = jQuery(e).parents('.nbdesigner-box-collapse').find('.nbdesigner-info-box'),              
        area = jQuery(e).parents('.nbdesigner-box-collapse').find('.nbdesigner-area-design'),
        dpi = jQuery('#nbdesigner_dpi').val(),
        sefl = jQuery(e);
        if(att == 'width'){
            var height = parent.find('.area_design_height').val(),
            left = parent.find('.area_design_left').val();
            if(value < 0) value = 0;
            if(value > (300 - left)) value = 300 - left;
            var ratio = value / height,
            real_width = parent.find('.real_width').val(),
            real_height = parent.find('.real_height').val(),
            new_width = parseInt(ratio * real_height);
            parent.find('.real_width').val(new_width); 
            parent.find('.real_width_hidden').html(new_width);
            parent.find('.real_width_px').html(parseInt(new_width * dpi / 2.54));
        } else if(att == 'height'){
            var width = parent.find('.area_design_width').val(),
            top = parent.find('.area_design_top').val();
            if(value < 0) value = 0;
            if(value > (300 - top)) value = 300 - top;
            var ratio = value / width,
            real_width = parent.find('.real_width').val(),
            real_height = parent.find('.real_height').val(),
            new_height = parseInt(ratio * real_width);
            parent.find('.real_height').val(new_height); 
            parent.find('.real_height_hidden').html(new_height);
            parent.find('.real_height_px').html(parseInt(new_height * dpi / 2.54));            
        } else if(att == 'left'){
            var width = parent.find('.area_design_width').val();
            if(value < 0) value = 0;
            if(value > (300 - width)) value = 300 - width;            
        } else if(att == 'top'){
            var height = parent.find('.area_design_height').val();
            if(value < 0) value = 0;
            if(value > (300 - height)) value = 300 - height;                
        }
        area.css(att, value + 'px');
        sefl.val(value);
    },
    updateSolutionImage: function(){
        var dpi = jQuery('#nbdesigner_dpi').val();
        if(dpi < 1) dpi = 1;
        jQuery.each(jQuery('#nbdesigner-boxes .nbdesigner-box-container'), function (key, val) {
            var width = jQuery(this).find('.real_width_hidden').html(),
            height = jQuery(this).find('.real_height_hidden').html();
            jQuery(this).find('.real_width_px').html(parseInt(width * dpi / 2.54));
            jQuery(this).find('.real_height_px').html(parseInt(height * dpi / 2.54));
        });
        jQuery('#nbdesigner_dpi').val(dpi);
    },
    updateDimensionRealOutputImage: function(e, command){
        var parent = jQuery(e).parents('.nbdesigner-box-collapse').find('.nbdesigner-info-box'),
        width = parent.find('.area_design_width'),
        height = parent.find('.area_design_height'),
        dpi = jQuery('#nbdesigner_dpi').val(),
        sefl = jQuery(e);
        switch (command) {
            case 'width':
                var w = sefl.val(),
                original_val = parseInt(parent.find('.real_width_hidden').html()),        
                h = parent.find('.real_height').val(),
                _h = parseInt(h * w / original_val);
                parent.find('.real_height').val(_h);
                parent.find('.real_width_hidden').html(w);
                parent.find('.real_height_hidden').html(_h);
                parent.find('.real_width_px').html(parseInt(w * dpi / 2.54));
                parent.find('.real_height_px').html(parseInt(_h * dpi / 2.54));
                break;
            case 'height':
                var h = sefl.val(),
                original_val = parseInt(parent.find('.real_height_hidden').html()),        
                w = parent.find('.real_width').val(),
                _w = parseInt(w * h / original_val);
                parent.find('.real_width').val(_w);  
                parent.find('.real_width_hidden').html(_w);
                parent.find('.real_height_hidden').html(h);   
                parent.find('.real_width_px').html(parseInt(_w * dpi / 2.54));
                parent.find('.real_height_px').html(parseInt(h * dpi / 2.54));
                break;
        }
    },
    addOrientation: function () {
        var old_box = jQuery('#nbdesigner-boxes .nbdesigner-box-container').last();
        if(old_box.css('display') == 'none'){
            old_box.show();
        }else{
            var new_box = old_box.clone();
            new_box.appendTo('#nbdesigner-boxes');
            new_box.find('.ui-resizable-handle').remove();
            this.resetBoxes();            
        };
    },
    collapseBox: function (e) {
        var clicked_element = jQuery(e);
        var toggle_element = jQuery(e).parents('.nbdesigner-box-container').find('.nbdesigner-box-collapse');
        toggle_element.slideToggle(function () {
            if (toggle_element.is(':visible')) {
                clicked_element.html('<span class="dashicons dashicons-arrow-up"></span> Less setting');
            } else {
                clicked_element.html('<span class="dashicons dashicons-arrow-down"></span> More setting');
            }
        });
    },
    changeLang: function(){
        var code = jQuery("#nbdesigner-translate-code").val();
        jQuery("#nbdesigner-trans-code").attr('data-code', code);
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: {'action': 'nbdesigner_get_language', 'code': code, 'nonce': admin_nbds.nonce},
            beforeSend: function () {
                jQuery('#nbdesigner_translate_loading').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('#nbdesigner_translate_loading').addClass('nbdesigner_loaded');
            }
        }).done(function (result) { 
            var data = JSON.parse(result);
            if(data.mes == "success"){
                var html = "";
                jQuery.each(data.langs, function(key, value ){
                    html += '<li><p class="click_edit" data-label="'+key+'">'+value+'</p></li>';
                });
                jQuery(".nbdesigner-translate").html(html);
                jQuery('.click_edit').editable(function(value, settings) {
                    return(value);
                },{ 
                    submit : 'OK',
                    tooltip : 'Click to edit...'
                });
            }
        });  
    },
    saveLang: function(e){        
        var langs = {},
        code = jQuery(e).data('code');
        jQuery('.click_edit').each(function(){
            var label = jQuery(this).data('label');
            var text = jQuery(this).html();
            langs[label] = text.replace(/"/g,"");
        });
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: {'action': 'nbdesigner_save_language', 'code': code, 'nonce': admin_nbds.nonce, 'langs': langs},
            beforeSend: function () {
                jQuery('#nbdesigner_translate_loading').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('#nbdesigner_translate_loading').addClass('nbdesigner_loaded');
            }
        }).done(function (data) {
            alert(data);
        });        
    },
    createLang: function(){
        var formdata = jQuery('#nbdesigner-new-lang-con').find('textarea, select, input').serialize();
        formdata = formdata + '&action=nbdesigner_create_language';
        jQuery('#nbdesigner_new_translate_loading').removeClass('nbdesigner_loaded');
        jQuery.post(admin_nbds.url, formdata, function(result){
            jQuery('#nbdesigner_new_translate_loading').addClass('nbdesigner_loaded');     
            var data = JSON.parse(result);
            if(data.mes == "success"){
                var html = "";
                jQuery.each(data.langs, function(key, value ){
                    html += '<li><p class="click_edit" data-label="'+key+'">'+value+'</p></li>';
                });
                jQuery(".nbdesigner-translate").html(html);
                jQuery('.click_edit').editable(function(value, settings) {
                    return(value);
                },{ 
                    submit : 'OK',
                    tooltip : 'Click to edit...'
                });  
                jQuery('#nbdesigner-translate-code').append('<option value="'+data.code+' selected">'+data.name+'</option>');
                jQuery("#nbdesigner-trans-code").attr('data-code', data.code);
                tb_remove();
            };
        });        
    },
    edit_cat_art: function(e){   
        jQuery(e).parents('#nbdesigner_list_art_cats').find('.nbdesigner-editcat-name').hide();
        jQuery(e).parents('#nbdesigner_list_art_cats').find('.nbdesigner-cat-link').show();
        jQuery(e).parent().find('.nbdesigner-cat-link').hide();
        jQuery(e).parent().find('.nbdesigner-editcat-name').show(); 
    },
    remove_action_cat_art: function(e){
        jQuery(e).parents('#nbdesigner_list_art_cats').find('.nbdesigner-cat-link').show();
        jQuery(e).parents('#nbdesigner_list_art_cats').find('.nbdesigner-editcat-name').hide();
        return;
    },
    save_cat_art: function(e){
        var index = jQuery(e).parent().find('input').val(),
        name = jQuery(e).parent().find('input.nbdesigner-editcat-name').val(),
        sefl = jQuery(e);
        var data = {'action': 'nbdesigner_add_art_cat', 'id': index, 'name': name, 'nonce': admin_nbds.nonce};
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: data,
            beforeSend: function () {
                jQuery('.nbdesigner_editcat_loading').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('.nbdesigner_editcat_loading').addClass('nbdesigner_loaded');
            }
        }).done(function (data) {
            if (data == 'success') {
                sefl.parent().find('.nbdesigner-cat-link').html(name).show();
                sefl.parent().find('input.nbdesigner-editcat-name').val(name); 
                sefl.parent().find('.nbdesigner-editcat-name').val(name).hide(); 
            };
        });        
    },
    edit_cat_font: function(e){
        jQuery(e).parents('#nbdesigner_list_cats').find('.nbdesigner-editcat-name').hide();
        jQuery(e).parents('#nbdesigner_list_cats').find('.nbdesigner-cat-link').show();
        jQuery(e).parent().find('.nbdesigner-cat-link').hide();
        jQuery(e).parent().find('.nbdesigner-editcat-name').show();         
    },
    remove_action_cat_font: function(e){
        jQuery(e).parents('#nbdesigner_list_cats').find('.nbdesigner-cat-link').show();
        jQuery(e).parents('#nbdesigner_list_cats').find('.nbdesigner-editcat-name').hide();
        return;
    },  
    save_cat_font: function(e){
        var index = jQuery(e).parent().find('input').val(),
        name = jQuery(e).parent().find('input.nbdesigner-editcat-name').val(),
        sefl = jQuery(e);
        var data = {'action': 'nbdesigner_add_font_cat', 'id': index, 'name': name, 'nonce': admin_nbds.nonce};
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: data,
            beforeSend: function () {
                jQuery('.nbdesigner_editcat_loading').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('.nbdesigner_editcat_loading').addClass('nbdesigner_loaded');
            }
        }).done(function (data) {
            if (data == 'success') {
                sefl.parent().find('.nbdesigner-cat-link').html(name).show();
                sefl.parent().find('input.nbdesigner-editcat-name').val(name); 
                sefl.parent().find('.nbdesigner-editcat-name').val(name).hide(); 
            };
        });        
    },
    make_primary_design: function(id){
        var val = jQuery('input[name=nbdesigner_primary]:checked').val(),
        data = {'action': 'nbdesigner_make_primary_design', 'id': id, 'folder': val, 'nonce': admin_nbds.nonce};
        if(val == 'primary') return;
        jQuery.ajax({
            url: admin_nbds.url,
            method: "POST",
            data: data,
            beforeSend: function () {
                jQuery('.nbdesigner_primary_design').removeClass('nbdesigner_loaded');
            },
            complete: function () {
                jQuery('.nbdesigner_primary_design').addClass('nbdesigner_loaded');
            }
        }).done(function (data) {
            data = JSON.parse(data);
            if (data['mes'] == 'success') {
                alert('Change success!');
            }else{
                alert('Oops! Try again');
            };
        }); 
    }
};
function base64Encode(str) {
  var CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  var out = "", i = 0, len = str.length, c1, c2, c3;
  while (i < len) {
    c1 = str.charCodeAt(i++) & 0xff;
    if (i == len) {
      out += CHARS.charAt(c1 >> 2);
      out += CHARS.charAt((c1 & 0x3) << 4);
      out += "==";
      break;
    }
    c2 = str.charCodeAt(i++);
    if (i == len) {
      out += CHARS.charAt(c1 >> 2);
      out += CHARS.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
      out += CHARS.charAt((c2 & 0xF) << 2);
      out += "=";
      break;
    }
    c3 = str.charCodeAt(i++);
    out += CHARS.charAt(c1 >> 2);
    out += CHARS.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
    out += CHARS.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
    out += CHARS.charAt(c3 & 0x3F);
  }
  return out;
}