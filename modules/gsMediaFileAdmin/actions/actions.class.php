<?php
class gsMediaFileAdminActions extends sfActions
{
	public function preExecute()
	{
		$this->getContext()->getRouting()->setDefaultParameter('gs_loader', $this->getRequestParameter('gs_loader') );
		
		$sf_response = $this->getContext()->getResponse();

		switch ( $this->getRequest()->getParameter('gs_loader') )
		{
			case 'tinymce' :
				$sf_response->addJavascript( '/'.sfConfig::get('sf_rich_text_js_dir', 'sf/tinymce/js').'/tiny_mce_popup.js' );
				$sf_response->addJavascript( '/gsMediaPlugin/js/tinymce.loader.js' );
				break;
			case 'gsmedia' :
				$sf_response->addJavascript( '/gsMediaPlugin/js/jquery.gsmedia.loader.js');
				break; 
		}
	}
	
	public function executeView($request)
	{
		$this->file = gsMediaFilePeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $this->file );
		
		$this->format = $request->getParameter('format', 'preview');
	}

	public function executeDownload($request)
	{
		$file = gsMediaFilePeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $file );
			
		$response = $this->getResponse();
		$response->clearHttpheaders();
		$response->setContentType( $file->getContentType() );
		//$response->setContentType( 'application/octet-stream' );
		$response->setHttpHeader('Content-length', $file->getFilesize() );
		$response->setHttpHeader('Content-Disposition', 'attachment; filename=' . $file->getFilename() );
		
		$response->setContent( $file->getContent( $request->getParameter('format', 'original') ) );
		
		return sfView::NONE;
	}
	
	public function executeEdit($request)
	{
		$this->file = gsMediaFilePeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $this->file );
		
		$this->form = new gsMediaFileEditForm( $this->file );
		if ( $request->isMethod('post') ) $this->processEdit($request, $this->form);
	}
	
	public function executeReplace($request)
	{
		$this->file = gsMediaFilePeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $this->file );
		
		$this->form = new gsMediaFileReplaceForm( $this->file );
		if ( $request->isMethod('post') ) $this->processReplace($request, $this->form);
	}
	
	public function executeDelete($request)
	{
		$media = gsMediaFilePeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $media );
		
		$folder = $media->getgsMediaFolder();
		$media->delete();
		$this->redirect('gsMediaFolderAdmin/view?id='.$folder->getId() );
	}

	protected function processEdit( sfWebRequest $request, sfForm $form )
	{
		$form->bind(
			$request->getParameter( $form->getName() ),
			$request->getFiles( $form->getName() )
		);
		
		if ( $form->isValid() )
		{
			$media = $form->save();
			
			$this->getUser()->setFlash('form_success', 'The item was updated successfully.');
			
			$this->redirect('gsMediaFileAdmin/edit?id='.$media->getId() );
		}
	}
	
	protected function processReplace( sfWebRequest $request, sfForm $form )
	{
		$form->bind(
			$request->getParameter( $form->getName() ),
			$request->getFiles( $form->getName() )
		);
		
		if ( $form->isValid() )
		{
			$media = $form->save();
			
			$this->getUser()->setFlash('form_success', 'File succesfully uploaded.');
			
			$this->redirect('gsMediaFileAdmin/view?id='.$media->getId() );
		}
	}
	

}
