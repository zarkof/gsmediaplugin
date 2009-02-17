<?php

class gsMediaAccessComponents extends sfComponents
{
	public function executeShow($request)
	{
		$this->media = gsMediaFilePeer::retrieveByPK( $this->id );
		
		if ( !isset($this->format) ) $this->format = 'original';
	}
}