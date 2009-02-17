<?php use_helper('gsMedia', 'gsTools') ?>
<div class="gsmedia">
	<h1>File: <?php echo $file->getName() ?></h1>
	<?php include_partial('gsMediaFolderAdmin/navigation', array('media' => $file) ) ?>
	<?php include_partial('actions', array('file' => $file, 'format' => $format)) ?>

	<div class="media_view">
		<div class="preview">
			<div class="meta_data">
				<div class="file">
					<span class="filename"><?php echo $file->getFilename() ?></span> (<span class="filesize"><?php echo byte_convert( $file->getFilesize() ) ?>)</span>
				</div>
				<?php if ( $file->getAuthor() != ''): ?>	
					<div class="author">
						<span class="copyright">copyright &copy; <?php echo $file->getAuthor() ?></span>
					</div>
				<?php endif; ?>
				<span class="description"><?php echo $file->getDescription() ?></span>
			</div>
			
			<div class="formats">
				<?php include_partial('formats', array('file' => $file, 'selected_format' => $format)) ?>
			</div>			
			<div class="image">
				<?php echo tag_for_media( $file, $format ) ?>
			</div>
		</div>
	</div>
</div>