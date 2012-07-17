/*************CONSTANTS**************/
var base_url = document.getElementById('ls_base_url').value;
var template_url = document.getElementById('ls_template_url').value;
var plugin_url = document.getElementById('ls_plugin_url').value;
var ls_controller_url = plugin_url + '/library/controller.php';

/***********AJAX REQUESTS************/
/*Send ajax to conroller on microinv buttin click*/
jQuery('#microinv_microdata_btn').click(function(){
	
	var query_data  = 'action=ls_get_microinv_page';
		query_data += '&operation=load';
		
		jQuery.ajax({
				type:"POST",
				cache:false,
				url:ls_controller_url,
				data:query_data,
				
				beforeSend:function(data)
				{
					
				},
				success:function(ajaxResult)
				{
					data = jQuery.trim(ajaxResult);
					jQuery( "#TB_ajaxContent" ).html(ajaxResult);
					ls_load_schema_inputs('local_business');
				},
				error:function(ajaxResult)
				{
				}
		});	
});

/*Send ajax to conroller on select change*/
function ls_load_schema_inputs(type)
{
	var query_data = 'action=ls_get_microinv_page_data';
		query_data += '&operation='+type;
		
		jQuery.ajax({
				type:"POST",
				cache:false,
				url:ls_controller_url,
				data:query_data,
				
				beforeSend:function(data)
				{
					jQuery('#loading-image').css('display', 'inline');
					jQuery('#microinv-result').val('');
				},
				success:function(ajaxResult)
				{
					ajaxResult = jQuery.trim(ajaxResult);
					jQuery('#ls-input-data').html(ajaxResult); 
					jQuery('#loading-image').hide();
					jQuery('#microdata-save-butns').css('display', 'block');
					jQuery('#save-micro-button').css('display','none');
				},
				error:function(ajaxResult)
				{
				}
		});
}

/*Clear all fields in form and hide save button*/
function ls_clear_microdata()
{
	jQuery("#mi-microdata-form input[type=text]").val("");
    jQuery("#mi-microdata-form textarea").val("");
	jQuery('#save-micro-button').hide();
}

function ls_create_microdata()
{
	var form_data = jQuery('#mi-microdata-form').serialize();
	var query_data = 'action=ls_create_microdata&';
		query_data += form_data;
		
		jQuery.ajax({
			type:"POST",
			cache:false,
			url:ls_controller_url,
			data:query_data,
			
			beforeSend:function(data)
			{
				jQuery('#microinv-result').val('');
				jQuery('#microinv-result').val('Loading...');
			},
			success:function(ajaxResult)
			{
				data = jQuery.trim(ajaxResult);
				data = data.split('~:~');
				
				jQuery('#microinv-result').val(data[1]);
				jQuery('#save-micro-button').css('display','inline');
			},
			error:function(ajaxResult)
			{
			}
		});
}

function ls_save_microdata()
{
	var form_data = jQuery('#microinv-result').val();
	var query_data = 'action=ls_save_microdata&save_data=';
		query_data += form_data;
		
		jQuery.ajax({
				type:"POST",
				cache:false,
				url:ls_controller_url,
				data:query_data,
				
				beforeSend:function(data)
				{
				},
				success:function(ajaxResult)
				{
					microinv_submit_form(ajaxResult);
					window.parent.tb_remove();
				},
				error:function(ajaxResult)
				{
				}
		});
}

function microinv_insert_into_post_editor(microdata) {

			var microinv;

			if ( typeof tinyMCE != 'undefined' && ( microinv = tinyMCE.activeEditor ) && !microinv.isHidden() ) {

				microinv.focus();

				if ( tinymce.isIE )

        			microinv.selection.moveToBookmark(tinymce.EditorManager.activeEditor.windowManager.bookmark);

        		microinv.execCommand('mceInsertContent', false, '['+microdata+']');

        	} else if ( typeof edInsertContent == 'function' ) {

					edInsertContent(edCanvas, '['+microdata+']');

			} else {

				jQuery( edCanvas ).val( jQuery( edCanvas ).val() +  '['+microdata+']' );

			}

	}
	
function microinv_submit_form(microdata) {

				window.parent.microinv_insert_into_post_editor(microdata);  

}