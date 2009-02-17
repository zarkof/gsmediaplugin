var gsMediaReturn = {
	init: function () {
		//
	},
	submit: function ( url, title, description ) {
		// we are in a tinyMCEPopup !
		win = tinyMCEPopup.getWindowArg("window");
		win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = url;
		
		if ( win.document.forms[0].title) win.document.forms[0].title.value = title;
		if ( win.document.forms[0].alt) win.document.forms[0].alt.value = description;
			
		if ( typeof(win.ImageDialog) != "undefined") {
			if ( typeof(win.ImageDialog.getImageData) != "undefined" ) win.ImageDialog.getImageData();
			if ( typeof(win.ImageDialog.showPreviewImage) != "undefined" ) win.ImageDialog.showPreviewImage(url);
		}
		
		tinyMCEPopup.close();
	}
}

tinyMCEPopup.onInit.add(gsMediaReturn.init, gsMediaReturn);