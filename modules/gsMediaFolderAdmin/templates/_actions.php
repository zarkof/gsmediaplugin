<div class="media_actions">
	<ul id="tab_actions">
		<li><a class="ui-state-default ui-corner-all preview" href="<?php echo url_for_admin_folder_action( $folder, 'view' ); ?>"> View </a></li>
		<li><a class="ui-state-default ui-corner-all edit" href="<?php echo url_for_admin_folder_action( $folder, 'edit' ); ?>"> Edit </a></li>
		<li><a class="ui-state-default ui-corner-all delete" href="<?php echo url_for_admin_folder_action( $folder, 'delete' ); ?>"> Delete </a></li>
		<li><a class="ui-state-default ui-corner-all create" href="<?php echo url_for_admin_folder_action( $folder, 'create' ); ?>"> Create </a></li>
		<li><a class="ui-state-default ui-corner-all upload" href="<?php echo url_for_admin_folder_action( $folder, 'upload' ); ?>"> Upload </a></li>
		<?php if ($folder->hasParent() ): ?>
			<li><a class="ui-state-default ui-corner-all back" href="<?php echo url_for_admin_media( $folder->getgsMediaFolderRelatedByTreeParent(), 'view' ); ?>"> Back </a></li>
		<?php endif; ?>
	</ul>
	<div style="clear:both"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".media_actions a.delete").click( function() {
			return confirm("Are you sure you wish to delete this file?");
		}); 
	});
</script>
			

