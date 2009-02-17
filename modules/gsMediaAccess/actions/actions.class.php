<?php

class gsMediaAccessActions extends sfActions
{
	public function executeFile( $request )
	{
		$file = gsMediaFilePeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404If( !$file );
		$response = $this->getResponse();
		$response->clearHttpheaders();
		$response->setContentType( $file->getContentType() );
		$response->setHttpHeader('Content-length', $file->getFilesize() );
		$response->setContent( $file->getContent( $request->getParameter('format', 'normal') ) );
		
		return sfView::NONE;
		
	}
}