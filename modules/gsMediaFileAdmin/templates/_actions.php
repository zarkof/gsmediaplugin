<div class="media_actions">
	<ul id="">
		<li><a class="ui-state-default ui-corner-all preview" href="<?php echo url_for_admin_file_action( $file, 'view' ); ?>"> Preview </a></li>
		<li><a class="ui-state-default ui-corner-all edit" href="<?php echo url_for_admin_file_action( $file, 'edit' ); ?>"> Edit </a></li>
		<li><a class="ui-state-default ui-corner-all replace" href="<?php echo url_for_admin_file_action( $file, 'replace' ); ?>"> Replace </a></li>
		<li><a class="ui-state-default ui-corner-all download" href="<?php echo url_for_admin_file_action( $file, 'download' ); ?>"> download </a></li>
		<li><a class="ui-state-default ui-corner-all delete" href="<?php echo url_for_admin_file_action( $file, 'delete' ); ?>"> Delete </a></li>
		<?php if ( isset($format) ): ?>
			<li><a class="ui-state-default ui-corner-all select" href="#" onclick="gsMediaReturn.submit('<?php echo url_for_media($file, $format)?>', '<?php echo $file->getFilename() ?>', '<?php echo $file->getDescription() ?>')  "> Select </a></li>
		<?php endif; ?>
		<li><a class="ui-state-default ui-corner-all back" href="<?php echo url_for_admin_media( $file->getgsMediaFolder() ) ?>"> Back </a></li>
	</ul>
	<div style="clear:both"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".media_actions a.delete").click( function() {
			return confirm("Are you sure you wish to delete this file?");
		}); 
	});
	
	$(document).ready(function(){
		$(".ui-state-default").hover( 
			function() { $(this).addClass('ui-state-hover');},
			function() { $(this).removeClass('ui-state-hover');}
		);
	});
</script>
			

