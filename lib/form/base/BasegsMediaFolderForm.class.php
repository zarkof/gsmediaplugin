<?php

/**
 * gsMediaFolder form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BasegsMediaFolderForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInput(),
      'description'   => new sfWidgetFormTextarea(),
      'relative_path' => new sfWidgetFormInput(),
      'tree_parent'   => new sfWidgetFormPropelChoice(array('model' => 'gsMediaFolder', 'add_empty' => true)),
      'tree_left'     => new sfWidgetFormInput(),
      'tree_right'    => new sfWidgetFormInput(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'gsMediaFolder', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'description'   => new sfValidatorString(array('required' => false)),
      'relative_path' => new sfValidatorString(array('max_length' => 255)),
      'tree_parent'   => new sfValidatorPropelChoice(array('model' => 'gsMediaFolder', 'column' => 'id', 'required' => false)),
      'tree_left'     => new sfValidatorInteger(array('required' => false)),
      'tree_right'    => new sfValidatorInteger(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'gsMediaFolder', 'column' => array('relative_path')))
    );

    $this->widgetSchema->setNameFormat('gs_media_folder[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'gsMediaFolder';
  }


}
