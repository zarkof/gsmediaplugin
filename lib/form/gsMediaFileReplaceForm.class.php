<?php

/**
 * gsMediaFile form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class gsMediaFileReplaceForm extends BasegsMediaFileForm
{
	public function configure()
	{
	 	unset( $this['filename'] );
	 	unset( $this['name'] );
	 	unset( $this['author'] );
	 	unset( $this['description'] );
	  	unset( $this['folder_id'] );
	  	unset( $this['created_at'] );
	  	unset( $this['updated_at'] );
	  	unset( $this['content_type'] );
	
	  	$this->widgetSchema['file'] = new sfWidgetFormInputFile( array(
			'label' 	=> 'Media file',
		));
		
		$this->validatorSchema['file'] = new sfValidatorFile(array(
	  		'required'   => true,
	        'max_size' => sfConfig::get('app_gsmedia_upload_max_size', 2048000),
	  		'mime_types' => sfConfig::get('app_gsmedia_mime_types'),
		));
	}
  
	public function doSave( $con = null )
	{
		$media = $this->getObject();
		$media->deleteRelatedFiles();
		
		if ( $file = $this->getValue('file') )
		{
			// file is replaced, so the name should stay the same as the previous one 
			$filename = $this->getObject()->getFilename();
			if ( !$filename ) $filename = gsMediaTools::sanitize( $file->getOriginalName() );
			
			$media->setFilename( $filename );
			$media->setContentType( $file->getType() );			

			$file->save( $media->getAbsoluteFilename() );
			$media->generateFormats();
		}
		
		return parent::doSave($con);
  	}
}
