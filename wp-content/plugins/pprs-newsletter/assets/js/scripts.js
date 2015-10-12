var $j = jQuery.noConflict();

$j(document).ready(function(){
    //iframeLoaded();
});

$j.fn.center = function(){
	var top = ($j(window).height() / 2) - (this.height() / 2);
	var left = ($j(window).width() / 2) - (this.width() / 2);
	this.css('position','fixed');
	this.css('top',top + 'px');
	this.css('left',left + 'px');
}
//-- Ajdust iFrame Height
function iframeLoaded() {
  var iFrameID = document.getElementById('builder-frame');
  if(iFrameID) {
        // here you can make the height, I delete it first, then I make it again      
  	    var content_height = iFrameID.contentWindow.document.body.scrollHeight + 'px';
  	    var builder_height = jQuery('#builder-frame').contents().find('#newsletter-builder-area').height();
  	    if(parseInt(builder_height) > 500){
            iFrameID.height = builder_height+'px';
        }else{
        	iFrameID.height = '500px';
        }
  }   
};

//-- Update textarea
function export_template(){
	var rows = $j('#builder-frame').contents().find('#newsletter-builder-area-center-frame-content .esf-row.sort-row');
	var output = '';
	var html = '';
	rows.each(function(){
        var row = $j(this).clone();
         row.find('.esf-row-delete').remove();
         row.find('.esf-row-editrow').remove();
		output += '<div class="esf-row sort-row">' + row.html() + '</div>';
		// var row = $j(this).clone();
		// row.find('.esf-row-delete').remove();
		// row.find('.esf-row-editrow').remove();
		// row.find('.esf-row-edit').removeAttr('data-type');
		// row.find('.esf-row-edit').removeAttr('class');
		// //row.find('.esf-row-edit').removeClass('esf-row-edit');
		// output += row.html();
	});
	$j('#template-output').val(output);
	$j('#template-edited').val('true');
};

function show_media_manager(){
    var selected_img;
    // check for media manager instance
    if(wp.media.frames.gk_frame) {
        wp.media.frames.gk_frame.open();
        return;
    }
    // configuration of the media manager new instance
    wp.media.frames.gk_frame = wp.media({
        title: 'Select image',
        multiple: false,
        library: {
            type: 'image'
        },
        button: {
            text: 'Use selected image'
        }
    });

    // Function used for the image selection and media manager closing
    var gk_media_set_image = function() {
        var selection = wp.media.frames.gk_frame.state().get('selection');

        // no selection
        if (!selection) {
            return;
        }
        // iterate through selected elements
        selection.each(function(attachment) {
            var url = attachment.attributes.url;
            //console.log(img);
            var img = jQuery('#builder-frame').contents().find('.update-image');
            img.attr('src',url);
            iframeLoaded();
            export_template();
        });
    };

    // closing event for media manger
    wp.media.frames.gk_frame.on('close', function(){
        var img = jQuery('#builder-frame').contents().find('.update-image');
        setTimeout(function(){
            img.removeClass('update-image');
        },1000);
        //img.removeClass('update-image');
    });
    // image selection event
    wp.media.frames.gk_frame.on('select', gk_media_set_image);
    // showing media manager
    wp.media.frames.gk_frame.open();
}

function edit_module(type,el){
    if(type == 'title'){
        $j('.esf-edit-box-content-field-input.title').val(el.text());
    }
    if(type == 'text'){
        el.find('.esf-row-edit-hover').remove();
        el.find('p').filter(function () { return this.innerHTML == "" }).remove();
        var html = $j.trim(el.html());
        $j('iframe#content_ifr').contents().find('body').html(html);
        $j('.mail-edit-text').val(el.html());
    }
    if(type == 'link'){
        $j('.esf-edit-box-content-field-input.link').val(el.text());
        $j('.esf-edit-box-content-field-input.url').val(el.attr('href'));
    }
    if(type == 'icon'){
        $j('.esf-edit-box-content-field-input.icon-url').val(el.find('a').attr('href'));
    }
    if(type == 'button'){
        $j('.esf-edit-box-content-field-input.button-url').val(el.find('a').attr('href'));
    }
	show_edit_box($j("#esf-edit-"+type));
}

function add_new_icon(type){
    show_edit_box($j("#esf-add-"+type));
}

function show_edit_box(el){
	$j('#edit-overlay').show();
	el.show();
	el.find('.esf-edit-box').show();
	el.center();
}

function scroll_to_bottom(){
    var win = $j(window).height();
    var scroll = document.body.scrollHeight - win - 70;
    $j("html, body").animate({ scrollTop: scroll }, 400);
}

$j(document).on('click','.esf-edit-box-buttons-cancel',function(){
	el = $j("#"+$j(this).data('close'));
	hide_editor(el);
    undo_editing();
});

$j(document).on('click','.esf-edit-box-buttons-save',function(){
    
    el = $j("#"+$j(this).data('close'));

    if( $j(this).data('close') == 'esf-edit-title' ){
        var new_val = el.find('.esf-edit-box-content-field-input.title').val();
        $j('#builder-frame').contents().find('.editing').html(new_val);
    }
    
    if( $j(this).data('close') == 'esf-edit-text' ){
        tinyMCE.triggerSave();
        var new_val = el.find('.mail-edit-text').val();
        $j('#builder-frame').contents().find('.editing').html(new_val);
    }

    if( $j(this).data('close') == 'esf-edit-link' ){
        var title = el.find('.esf-edit-box-content-field-input.link').val();
        var url = el.find('.esf-edit-box-content-field-input.url').val();
        $j('#builder-frame').contents().find('.editing').text(title);
        $j('#builder-frame').contents().find('.editing').attr('href',url);
    }

    if( $j(this).data('close') == 'esf-add-icon' ){
        // var area = $j('.add-new-button-area.editing');
        // console.log(area);
        var tr = $j('#builder-frame').contents().find('.editing.add-new-button-area').find('table').find('tr:first');

        var href = $j('.esf-edit-box-content-field-input.new-icon-url').val();
        if(href == "")
            href = "#";

        var src = $j('#new-icon-url').val();
        td = '<td style="padding-left: 5px;"><div class="esf-row-edit" data-remove="true" data-type="icon"><a href="'+href+'"><img width="30px" src="'+src+'"></a></div></td>';
        tr.append(td);

    }

    iframeLoaded(); //--fix the iframe height
    undo_editing(); //--remove editing falg from the element
    hide_editor(el); //--close editor window
    export_template(); //--save iframe content to textarea

});

//--Save ICONS
$j(document).on('click','.icons-list > li',function(){
    el = $j('#esf-edit-icon');
    var src = $j(this).find('img').attr('src');
    var href = $j('.esf-edit-box-content-field-input.icon-url').val();

    var image = $j('#builder-frame').contents().find('.editing').find('img');
    var link =  $j('#builder-frame').contents().find('.editing').find('a');

    image.attr('src',src);
    link.attr('href',href);

    iframeLoaded(); //--fix the iframe height
    undo_editing(); //--remove editing falg from the element
    hide_editor(el); //--close editor window
    export_template(); //--save iframe content to textarea
});

//--Save BUTTONS
$j(document).on('click','.buttons-list > li',function(){
    el = $j('#esf-edit-button');
    var src = $j(this).find('img').attr('src');
    var href = $j('.esf-edit-box-content-field-input.button-url').val();

    var image = $j('#builder-frame').contents().find('.editing').find('img');
    var link =  $j('#builder-frame').contents().find('.editing').find('a');

    image.attr('src',src);
    link.attr('href',href);

    iframeLoaded(); //--fix the iframe height
    undo_editing(); //--remove editing falg from the element
    hide_editor(el); //--close editor window
    export_template(); //--save iframe content to textarea
});

$j(document).on('click','.new-icons-list > li',function(){
    var src = $j(this).find('img').attr('src');
    //var href = $j('.esf-edit-box-content-field-input.button-url').val();
    //alert(src);
    $j('.new-icons-list > li').each(function(){
        $j(this).removeClass('selected');
    });
    $j(this).addClass('selected');
    $j('#new-icon-url').val(src);
})

function undo_editing(){
    $j('#builder-frame').contents().find('.editing').removeClass('editing');
}

function hide_editor(el){
    $j('#edit-overlay').hide();
    el.find('.esf-edit-box').hide();
    el.hide();
}