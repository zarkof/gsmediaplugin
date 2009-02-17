<?php

class gsMediaFormatImage extends gsMediaFormat
{
	protected 	$width = null, 
				$height = null,
				$adapterClass = null;
	
	public function __construct( $options = array() )
	{
		parent::__construct( $options );
		
		if ( isset( $options['width']) ) $this->setWidth( $options['width'] );
		if ( isset( $options['height']) ) $this->setHeight( $options['height'] );
		if ( isset( $options['adapterClass'])) $this->setAdapterClass( $options['adapterClass'] );
	}

	public function setAdapterClass($v)
	{
		$this->adapterClass = $v;
	}
	
	public function getAdapterClass()
	{
		return $this->adapterClass;
	}
	
	public function getWidth()
	{
		return $this->width;
	}
	
	public function setWidth($v)
	{
		$this->width = $v;
	}
	
	public function getHeight()
	{
		return $this->height;
	}
	
	public function setHeight($v)
	{
		$this->height = $v;
	}
	
	public function getDescription()
	{
		return $this->getWidth().'x'.$this->getHeight();
	}
	
	public function generate( gsMediaFile $file )
	{
		$format_dir = $file->getAbsolutePath().$this->getPath();
		if ( !is_dir( $format_dir ) ) mkdir( $format_dir );
		
		$image = new sfThumbnail( $this->getWidth(), $this->getHeight(), true, true, 75, $this->getAdapterClass() );
		$image->loadFile( $file->getAbsoluteFilename() );

		// todo: file extension should match the format type, and not the uploaded file (ie: .PDF uploaded, .PNG as preview) 
		$image->save( $file->getAbsoluteFilename( $this->getName() ), $this->getType() );
	}
	
	public function isDisplayable()
	{
		return true;
	}
}