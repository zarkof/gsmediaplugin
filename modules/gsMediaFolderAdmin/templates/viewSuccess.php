<?php use_helper('gsMedia', 'gsTools', 'Text') ?>
<!--[if lte ie 7]>
<style type="text/css">

.miniature .center-cell {
  display: inline-block;
  position: relative;
  }

</style>
<![endif]-->

<div class="gsmedia">
	<h1>Folder: <?php echo $folder->getName(); ?></h1>
	
	<?php include_partial('navigation', array('media' => $folder) ) ?>
	
	<?php include_partial('actions', array('folder' => $folder) ) ?>
	
	<div class="media_view">
		<?php if ( $folder->getDescription() != '' ): ?>
			<div class="preview">
				<div class="meta_data">
					<div class="description"><?php echo $folder->getDescription() ?></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	
	<ul class="media_miniatures">
	
		<?php if ( $folder->hasParent() ): ?>
			<li class="media_folder media_folder_return">
				<a href="<?php echo url_for_admin_media( $folder->retrieveParent() ) ?>">
					<span class="miniature">&nbsp;</span>
					<span class="foldername">..</span>
				</a>
			</li>
		<?php endif; ?>
		
		<?php foreach( $folder->getChildren() as $subfolder): ?>
			<li class="media_folder">
				<a href="<?php echo url_for_admin_media( $subfolder ) ?>">
					<span class="miniature">&nbsp;</span>
					<span class="foldername"><?php echo $subfolder ?></span>
				</a>
			</li>
		<?php endforeach ?>
		
		<?php foreach( $folder->getgsMediaFiles() as $file ): ?>
			<li class="media_file">
				<a href="<?php echo url_for_admin_media( $file ) ?>" title="<?php echo $file->getName() ?>" class="thickbox">
					<span class="miniature">
						<span class="center-table">
							<span class="center-cell" >
							<?php if ( $file->fileExist('miniature') ): ?>
								<img src="<?php echo url_for_media( $file, 'miniature' ) ?>"/>
								<!--[if lte ie 7]> <b style="display: inline-block; width: 0; height: 100%; vertical-align: middle;"></b><![endif]-->
							<?php endif; ?>
							</span>
						</span>
					</span>
					<span class="filename"><?php echo hyphenize( truncate_text( $file->getName(), 24, '...' ), 12, '&#8203;') ?></span>
				</a>
			</li>
		<?php endforeach ?>
		
	</ul>
</div>