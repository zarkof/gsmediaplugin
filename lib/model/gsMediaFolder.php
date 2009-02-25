<?php

class gsMediaFolder extends BasegsMediaFolderNestedSet
{
	public function getFilesByOrder( $order = null )
	{
		$criteria = new Criteria();
		
		switch( $order )
		{
			case 'name':
				$criteria->addAscendingOrderByColumn( gsMediaFilePeer::NAME );
				break;
			case 'filename':
				$criteria->addAscendingOrderByColumn( gsMediaFilePeer::FILENAME );
				break;
			case 'id':
				$criteria->addAscendingOrderByColumn( gsMediaFilePeer::ID );
				break;
			case 'date':
				$criteria->addAscendingOrderByColumn( gsMediaFilePeer::CREATED_AT );
				break;
			default:
				$criteria->addAscendingOrderByColumn( gsMediaFilePeer::CREATED_AT );
				break;
		}
		
		return $this->getgsMediaFiles( $criteria );
	}
	
	public function __toString()
	{
		return $this->getName();
	}
	
	public function getAbsolutePath()
	{
		return sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$this->getRelativePath().DIRECTORY_SEPARATOR;
	}
	
	public function setRelativePathFromParent( $pathname )
	{
		$parent = $this->getgsMediaFolderRelatedByTreeParent();
		$relative_path = $parent->getRelativePath().DIRECTORY_SEPARATOR.$pathname;
		return $this->setRelativePath( $relative_path );
	}
	
	public function save( PropelPDO $con = null)
	{
		// auto-generate tree
		if ( ! ($this->getTreeLeft() && $this->getTreeRight() ) )
		{
			if ( $this->getTreeParent() )
			{
				$parent_node = $this->getgsMediaFolderRelatedByTreeParent();
				$this->insertAsLastChildOf( $parent_node );
			}
			else
			{
				$this->makeRoot();
			}
		}

		$this->createIfNotExistRelativePath();
		
		parent::save( $con );
	}
	
	public function delete( PropelPDO $con = null) 
	{
		// delete all files within folder
		foreach( $this->getgsMediaFiles() as $file )
		{
			$file->delete( $con );			
		}
		
		// delete all sub folders
		foreach( $this->getgsMediaFoldersRelatedByTreeParent() as $folder )
		{
			$folder->delete( $con );
		}
		
		// delete physical folder
		@rmdir( $this->getAbsolutePath() );
		
		parent::delete( $con );
	}
	
	public function createIfNotExistRelativePath()
	{
		// if path doesn't not exist, create it
		if ( !is_dir( $this->getAbsolutePath() ) ) mkdir( $this->getAbsolutePath(), 0700, true );
	}
}