<?php

/**
 * gsMediaFile form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class gsMediaFileEditForm extends BasegsMediaFileForm
{
	public function configure()
	{
	  	unset( $this['file'] );
	  	unset( $this['folder_id'] );
	  	unset( $this['created_at'] );
	  	unset( $this['updated_at'] );
	  	unset( $this['content_type'] );
	  	
		$this->validatorSchema['filename'] = new sfValidatorRegex( array('pattern' => '/^[A-Za-z0-9._\-]+$/'), array(
			'required' => 'required field',
			'invalid'  => 'The file name may only contain alphanumeric characters. (no spaces, no special characters, no accents)'
		));
	}
}
