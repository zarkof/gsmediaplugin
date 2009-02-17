<div class="format_actions">
	<div class="title">Formats:</div>
	<ul id="tab_actions" style="clear: both">
		<?php foreach( $file->getFormats() as $format): ?>
			<?php if ( $format->isDisplayable() ): ?>
				<li>
					<a class="ui-state-default ui-corner-all preview <?php echo ($format->getName() == $selected_format) ? 'selected' : '' ?>" href="<?php echo url_for_admin_file_action( $file, 'preview', array('format' => $format->getName() ) ); ?>"> 
						<?php echo $format->getName() ?>
						<?php if ($format->getDescription() != ''): ?>
							(<?php echo $format->getDescription() ?>)
						<?php endif; ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<div style="clear:both"></div>
</div>
			

