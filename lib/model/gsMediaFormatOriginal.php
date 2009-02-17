<?php

class gsMediaFormatOriginal extends gsMediaFormat
{
	public function __construct( $options = array() )
	{
		parent::__construct( $options );
	}
	
	public function generate( gsMediaFile $file )
	{
		// possible work on original document
	}
	
	public function isDisplayable()
	{
		return true;
	}
}