<?php

/**
 * gsMediaFolder form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class gsMediaFolderCreateForm extends BasegsMediaFolderForm
{
	public function configure()
	{
		unset( $this['id'] );
		unset( $this['tree_left'] );
		unset( $this['tree_right'] );
		unset( $this['created_at'] );
		unset( $this['updated_at'] );
		unset( $this['relative_path'] );
		
		$this->widgetSchema['tree_parent'] = new sfWidgetFormInputHidden();
		
		$this->widgetSchema['pathname'] = new sfWidgetFormInput();
		$this->validatorSchema['pathname'] = new sfValidatorRegex( array('pattern' => '/^[A-Za-z0-9._\-]+$/'), array(
			'required' => 'required field',
			'invalid'  => 'the path name may only contain alphanumeric characters: #value'
		));
	}
	
	public function doSave( $con = null )
	{
		$media = $this->getObject();
		$media->setRelativePathFromParent( $this->getValue('pathname') );
		
		return parent::doSave($con);
	}
}
