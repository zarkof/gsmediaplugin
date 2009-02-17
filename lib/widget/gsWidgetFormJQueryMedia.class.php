<?php
class gsWidgetFormJQueryMedia extends sfWidgetFormInput
{
	protected function configure($options = array(), $attributes = array() )
	{
		parent::configure($options, $attributes);
	}
	
	public function render($name, $value = null, $attributes = array(), $errors = array())
	{
		$id = $this->generateId($name);
		$html = parent::render($name, $value, $attributes, $errors);
		
		if ( $value != '')
		{
			// create a preview image
			$html .= $this->renderTag('img', array_merge(array('id' => $id.'_preview', 'src' => $value), $attributes) );
		}
		
		$html .= '
<script type="text/javascript">
	jQuery(document).ready(function($){
		$("#'.$id.'").gsmedia( {url:"'.url_for('gsMediaFolderAdmin/view?gs_loader=gsmedia').'"} );
	});
</script>';
		
		return $html;
	}
	
	public function getJavaScripts()
	{
	    return array(
	    	'/gsMediaPlugin/js/jquery.gsmedia.widget.js', 
	    	'jquery/ui/ui.all.js',
	   	);
	}
	
	public function getStylesheets()
	{
		return array(
			'jquery.ui/theme/ui.all.css' => 'screen'
		);
	}
}

