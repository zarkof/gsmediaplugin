<?php
class gsMediaTools
{
	static public function sanitize( $data, $options = array('use_underscore' => true) )
	{
		// trim spaces
		$data = trim( $data );
	
		// translate utf-8 characters
		$data = @iconv('UTF-8', 'ASCII//IGNORE//TRANSLIT', $data);
		$data = preg_replace('/[\"\'\`\^\°\~]/', '', $data);
		
		// only keep characters within 32-128 ascii codes. 
		$new_data = '';
		for ($ni=0; $ni<= strlen($data); $ni++)
		{
			if ( ord( substr($data, $ni,1) ) >= 32 and ord( substr($data, $ni, 1) ) <= 128 )
			{
				$new_data .= substr($data, $ni, 1); 
			}
		}
		$data = $new_data;
		
		// convert to lowercase
		$data = strtolower( $data );
		
		// convert any non alphanumeric character to a separator
		$separator = '';
		foreach( $options as $key => $val )
		{
			switch ( true )
			{
				case ( $key == 'use_dash' && $val == true):
					$separator = '-';
					break;
				case ( $key == 'use_underscore' && $val == true):
					$separator = '_';
					break;
			}
		}
		$data = preg_replace('/[^a-zA-Z0-9._\-]/i', $separator, $data );
		
		// reduces concurrent dashes or underscores (if avaialable)
		$data = preg_replace('/[-]+/i', '-', $data );
		$data = preg_replace('/[_]+/i', '_', $data );
		
		// trims dashes and underscores
		$data = trim($data, '-_ ' );
				
		return $data;
	}
}