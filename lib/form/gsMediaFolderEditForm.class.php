<?php

/**
 * gsMediaFolder form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class gsMediaFolderEditForm extends BasegsMediaFolderForm
{
	public function configure()
	{
		unset( $this['tree_parent'] );
		unset( $this['tree_left'] );
		unset( $this['tree_right'] );
		unset( $this['created_at'] );
		unset( $this['updated_at'] );
		unset( $this['relative_path'] );
	}
}
