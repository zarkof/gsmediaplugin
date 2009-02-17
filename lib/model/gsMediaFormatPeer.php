<?php

class gsMediaFormatPeer
{
	static public function loadFromConfig()
	{
		$formats = array();
		
		$cfg_formats = sfConfig::get('app_gsmedia_formats');
		foreach( (array) $cfg_formats as $cfg_format_name => $cfg_format_data )
		{
			$cfg_format_data['name'] = $cfg_format_name;
			
			if ( isset($cfg_format_data['class']) )	
			{
				$classname = $cfg_format_data['class'];
			}
			else
			{
				$classname = 'gsMediaFormat';
			}
			
			$formats[] = new $classname( $cfg_format_data );
		}
		
		return $formats;
	}
}