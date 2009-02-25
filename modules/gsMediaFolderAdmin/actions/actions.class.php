<?php

class gsMediaFolderAdminActions extends sfActions
{
	public function preExecute()
	{
		$this->getContext()->getRouting()->setDefaultParameter('gs_loader', $this->getRequestParameter('gs_loader', 'gsmedia') );
		
		$sf_response = $this->getContext()->getResponse();

		switch ( $this->getRequest()->getParameter('gs_loader') )
		{
			case 'tinymce':
				$sf_response->addJavascript( '/'.sfConfig::get('sf_rich_text_js_dir', 'sf/tinymce/js').'/tiny_mce_popup.js' );
				$sf_response->addJavascript( '/gsMediaPlugin/js/tinymce.loader.js', 'last' );
				$this->setLayout( sfConfig::get('sf_plugins_dir').'/gsMediaPlugin/templates/layout' );
				break;
			case 'gsmedia':
				$sf_response->addJavascript( '/gsMediaPlugin/js/jquery.gsmedia.loader.js', 'last');
				$this->setLayout( sfConfig::get('sf_plugins_dir').'/gsMediaPlugin/templates/layout' );
				break; 
			case 'admin':
				
				break;
		}
	}
	
	public function executeIndex($request)
	{
		$this->redirect('gsMediaFolderAdmin/view');
	}
	
	public function executeView($request)
	{
		if ( $request->getParameter('id') ) 
		{
			$this->folder = gsMediaFolderPeer::retrieveByPK( $request->getParameter('id') );
		}
		else
		{
			$this->folder = gsMediaFolderPeer::retrieveRoot();
		}
		$this->forward404Unless( $this->folder );
		
	}
	
	public function executeEdit($request)
	{
		$this->folder = gsMediaFolderPeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $this->folder );
		
		$this->form = new gsMediaFolderEditForm( $this->folder );
		if ( $request->isMethod('post') ) $this->processEdit($request, $this->form);
	}
	
	public function executeCreate($request)
	{
		$this->parent = gsMediaFolderPeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $this->parent );
		
		$this->folder = new gsMediaFolder();
		$this->folder->setgsMediaFolderRelatedByTreeParent( $this->parent );
		
		$this->form = new gsMediaFolderCreateForm( $this->folder );
		if ( $request->isMethod('post') ) $this->processCreate($request, $this->form);
	}
	
	public function executeUpload($request)
	{
		$this->folder = gsMediaFolderPeer::retrieveByPK( $request->getParameter('id'));
		$this->forward404Unless( $this->folder );
		
		$file = new gsMediaFile();
		$file->setgsMediaFolder( $this->folder );
		$this->form = new gsMediaFileUploadForm( $file );
		if ( $request->isMethod('post') ) $this->processUpload($request, $this->form);
	}	
	
	public function executeDelete($request)
	{
		$media = gsMediaFolderPeer::retrieveByPK( $request->getParameter('id') );
		$this->forward404Unless( $media );
		
		$parent = $media->getgsMediaFolderRelatedByTreeParent();
		$media->delete();
		$this->redirect('gsMediaFolderAdmin/view?id='.$parent->getId() );
	}
	
	protected function processEdit( sfWebRequest $request, sfForm $form )
	{
		$form->bind(
			$request->getParameter( $form->getName() ),
			$request->getFiles( $form->getName() )
		);
		
		if ( $this->form->isValid() )
		{
			$media = $form->save();
			
			$this->getUser()->setFlash('form_success', 'Folder succesfully edited.');
			
			$this->redirect('gsMediaFolderAdmin/view?id='.$media->getId() );
		}
	}
	
	protected function processCreate( sfWebRequest $request, sfForm $form )
	{
		$form->bind(
			$request->getParameter( $form->getName() ),
			$request->getFiles( $form->getName() )
		);
		
		if ( $this->form->isValid() )
		{
			$media = $form->save();
			
			$this->getUser()->setFlash('form_success', 'Folder succesfully created.');
			
			$this->redirect('gsMediaFolderAdmin/view?id='.$media->getId() );
		}
	}
	
	protected function processUpload( sfWebRequest $request, sfForm $form )
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