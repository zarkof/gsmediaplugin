<?php

/**
 * gsMediaFile form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BasegsMediaFileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'folder_id'    => new sfWidgetFormPropelChoice(array('model' => 'gsMediaFolder', 'add_empty' => false)),
      'filename'     => new sfWidgetFormInput(),
      'name'         => new sfWidgetFormInput(),
      'description'  => new sfWidgetFormTextarea(),
      'author'       => new sfWidgetFormInput(),
      'content_type' => new sfWidgetFormInput(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'gsMediaFile', 'column' => 'id', 'required' => false)),
      'folder_id'    => new sfValidatorPropelChoice(array('model' => 'gsMediaFolder', 'column' => 'id')),
      'filename'     => new sfValidatorString(array('max_length' => 255)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'description'  => new sfValidatorString(array('required' => false)),
      'author'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content_type' => new sfValidatorString(array('max_length' => 255)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'gsMediaFile', 'column' => array('folder_id', 'filename')))
    );

    $this->widgetSchema->setNameFormat('gs_media_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'gsMediaFile';
  }


}
