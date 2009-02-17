(function($) {
	// plugin definition
	$.fn.gsmedia = function(options) {
		var settings = $.extend({}, $.fn.gsmedia.defaults, options);
		
		return this.each(function() {
			var id = $(this).attr('id');
			var button_id = id+'_button';
			var container_id = id+'_container';
			var iframe_id = id+'_iframe';
			var preview_id = id+'_preview';
			
			// create button
			$(this).after('<input type="button" id="'+button_id+'" value="..."/>');
			
			$('#'+button_id).click( function() {
				$(this).after('<div id="'+container_id+'" style="padding: 15px"><iframe id="'+iframe_id+'" src="'+settings.url+'" width="100%" height="100%" border="0"/></div>');
				
				$('#'+container_id).dialog({

					closeOnEscape: true, 
					width: settings.width, 
					height: settings.height,
					resizable: true, 
					modal: true,
					position: ['center','center'],
					show: 'slide',
					title: 'select a media'
				});
				
				$('#'+iframe_id).load( function() {
					this.contentWindow.gsmedia_callback = function( value ) {
						$('#'+id).val( value );
						$('#'+container_id).dialog('close');
						$('#'+container_id).remove();
						$('#'+preview_id).attr('src', $('#'+id).val() );
					};
				});
				
			});
		});
	}
	
	$.fn.gsmedia.defaults = {
		width: 640,
		height: 600
	};
})(jQuery);