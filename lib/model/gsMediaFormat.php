<?php

class gsMediaFormat
{
	protected $name, $type, $path;
	
	public function __construct( $options = array() )
	{
		if ( !isset($options['name']) ) throw new gsMediaException('gsMediaFormat: missing format name');
		if ( !isset($options['type']) ) throw new gsMediaException('gsMediaFormat: missing format type');
		
		$this->setName( $options['name'] );
		$this->setType( $options['type'] );
	}
	
	public function setPath( $v )
	{
		$this->path = $v;
	}
	
	public function getPath()
	{
		if ( !isset( $this->path ) ) return '_'.$this->getName().DIRECTORY_SEPARATOR;
		return $this->path;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($v)
	{
		$this->name = $v;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($v)
	{
		$this->type = $v;
	}
	
	public function generate( gsMediaFile $file )
	{
		return false;
	}
	
	public function getDescription()
	{
		return null;
	}
	
	public function isDisplayable()
	{
		return false;
	}
}