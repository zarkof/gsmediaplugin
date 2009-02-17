<?php

class gsMediaFile extends BasegsMediaFile
{
	public $formats = array();
	
	public function __construct()
	{
		// load all configured formats
		$this->formats = gsMediaFormatPeer::loadFromConfig();
		
		// add 'original' format
		$this->formats[] = new gsMediaFormatOriginal( array( 'name' => 'original', 'type' => 'original' ) );
	}
	
	public function __toString()
	{
		return $this->getName();
	}
	
	public function setFilename( $v )
	{
		if ( !isset( $this->old_filename ) ) $this->old_filename = $this->getFilename();
		parent::setFilename($v);
	}
	
	public function getAbsolutePath()
	{
		$folder = $this->getgsMediaFolder();
		return $folder->getAbsolutePath();
	}
	
	public function getAbsoluteFilename( $format = 'original' )
	{
		return $this->getAbsolutePath().$this->getFormatPath( $format ).$this->getFilename();
	}
	
	public function getContent( $format = 'original' )
	{
		if ( !$this->fileExist( $format ) ) throw new gsMediaException('gsMediaFile: format file not found' );
		return file_get_contents( $this->getAbsoluteFilename($format) );
	}
	
	public function getFilesize( $format = 'original' )
	{
		if ( !$this->fileExist($format) ) return 'file not found';
		return filesize( $this->getAbsoluteFilename($format) );
	}
	
	public function fileExist( $format = 'original' )
	{
		return file_exists( $this->getAbsoluteFilename( $format ) );
	}
	
	public function deleteRelatedFiles()
	{
		foreach( $this->formats as $format )
		{
			if ( $this->fileExist( $format->getName() ) ) unlink( $this->getAbsoluteFilename( $format->getName() ) );
		}
	}
	
	public function getFormats()
	{
		return $this->formats;
	}
	
	public function getFormat( $name )
	{
		foreach( $this->formats as $format )
		{
			if ( $format->getName() == $name ) return $format;
		}
		return false;
	}
	
	public function getFormatPath( $format = 'original' )
	{
		if ( $format instanceof gsMediaFormat ) 
		{
			return $format->getPath();
		}
		elseif ( $obj_format = $this->getFormat( $format ) )
		{
			return $obj_format->getPath();	
		}
		else
		{
			return false;
		}
	}
	
	public function generateFormats()
	{
		foreach( $this->formats as $format )
		{
			$format->generate( $this );
		}
	}

	public function delete( PropelPDO $con = null )
	{
		$this->deleteRelatedFiles();
		
		parent::delete( $con );
	}
	
	public function save ( PropelPDO $con = null)
	{
		if ( isset( $this->old_filename ) ) 
		{
			$this->renameAllFiles($this->old_filename, $this->getFilename() );
			unset( $this->old_filename );
		}
		
		// empty name automatically inherits from filename
		if ( $this->getName() == '' ) $this->setName( $this->getFilename() );

		parent::save($con);
	}
	
	public function renameAllFiles( $old, $new )
	{
		foreach( $this->getFormats() as $format )
		{
			rename( $this->getAbsolutePath().$this->getFormatPath( $format ).$old,
				 	$this->getAbsolutePath().$this->getFormatPath( $format ).$new );
		}
	}
}
