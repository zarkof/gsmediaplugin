<?php include_stylesheets_for_form( $form ) ?>
<?php include_javascripts_for_form( $form ) ?>

<div class="gsmedia">
	<h1>File: <?php echo $file->getName() ?></h1>
	<?php include_partial('gsMediaFolderAdmin/navigation', array('media' => $file) ) ?>
	<?php include_partial('actions', array('file' => $file)) ?>
	
	<div class="media_view">
		<div class="media_form">
			
			<?php if ( $sf_user->getFlash('form_success') ): ?>
				<div class="message">
					<div class="notice"><?php echo $sf_user->getFlash('form_success') ?></div>
				</div>
			<?php endif; ?>
			
			<form id="media_edit" action="<?php echo url_for_admin_file_action( $file, 'edit' ) ?>" method="post">
			<table>
			    <?php echo $form ?>
				<tr>
					<td>&nbsp;</td>
					<td>
			        	<input type="submit" value="Update"/>
			    	</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>