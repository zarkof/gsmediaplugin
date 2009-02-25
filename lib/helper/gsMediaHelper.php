<?php
function link_to_admin_media( $name, $media )
{
	return link_to( $name, url_for_admin_media( $media ) );
}

function url_for_admin_media( $media = null )
{
	if ( $media instanceof gsMediaFolder )
	{
		return url_for( 'gsMediaFolderAdmin/view?id='.$media->getId() );
	}
	elseif ( $media instanceof gsMediaFile )
	{
		return url_for( 'gsMediaFileAdmin/view?id='.$media->getId() );
	}
	else
	{
		return url_for( 'gsMediaFolderAdmin/view');
	}
}

function url_for_admin_folder_action( gsMediaFolder $media, $action )
{
	switch ($action)
	{
		case 'edit':
			return url_for( 'gsMediaFolderAdmin/edit?id='.$media->getId() );
		case 'delete':
			return url_for( 'gsMediaFolderAdmin/delete?id='.$media->getId() );
		case 'create':
			return url_for( 'gsMediaFolderAdmin/create?id='.$media->getId() );
		case 'upload':
			return url_for( 'gsMediaFolderAdmin/upload?id='.$media->getId() );
		default:
			return url_for_admin_media( $media );
	}
}

function url_for_admin_file_action( gsMediaFile $media, $action, $options = array() )
{
	switch ($action)
	{
		case 'replace':
		case 'upload':
			return url_for( 'gsMediaFileAdmin/replace?id='.$media->getId() );
		case 'edit':
			return url_for( 'gsMediaFileAdmin/edit?id='.$media->getId() );
		case 'delete':
			return url_for( 'gsMediaFileAdmin/delete?id='.$media->getId() );
		case 'download':
			return url_for( 'gsMediaFileAdmin/download?id='.$media->getId() );
		case 'preview':
			if ( !isset( $options['format'] ) ) $options['format'] = 'preview';
			return url_for( 'gsMediaFileAdmin/view?id='.$media->getId().'&format='.$options['format'] );
		default:
			return url_for_admin_media( $media );
	}
}

function url_for_media( gsMediaFile $file, $format = 'original', $type = 'relative')
{	
	$folder_path = $file->getgsMediaFolder()->getRelativePath();
	if ( substr($folder_path, -1) != '/' ) $folder_path .= '/';
	
	$file_path = $file->getFormatPath( $format );
	if ( substr($file_path, -1) == '/' ) $file_path = substr($file_path, 0, -1);
	
	switch ( $type )
	{
		case 'absolute':
			$url = _compute_public_path($file->getFilename(), $folder_path.$file_path, '', true);
			break;
		case 'relative':
			$url = _compute_public_path($file->getFilename(), $folder_path.$file_path, '', false);
			break;
		case 'web_relative':
			$url = $folder_path.$file_path.$file->getFilename();
			break;
	}
	
	return $url;	
}

function media_admin_navigation( $media, $level = 0)
{
	$nav = '';
	if ( $media instanceof gsMediaFile )
	{
		$nav .=  media_admin_navigation( $media->getgsMediaFolder(), $level+1 );
	}
	
	if ( $media instanceof gsMediaFolder && $media->hasParent() )
	{
		$nav .= media_admin_navigation( $media->retrieveParent(), $level+1 );
	}
	
	$name = ($media instanceof gsMediaFolder) ? $media->getName() : $media->getName();
	
	if ( $nav != '' ) $nav .= ' / ';
	
	if ( $level > 0)
	{ 
		$nav .= link_to_admin_media( strtolower( $name ), $media);
	}
	else
	{
		$nav .= strtolower( $name );
	}

	return $nav;
}

function tag_for_media( gsMediaFile $media, $format = 'original')
{
	if ( !($format instanceof gsMediaFormat))
	{
		if ( !( $format = $media->getFormat( $format ) ) )
		{
			$format = $media->getFormat('original');
		}
	}
	
	$type = $format->getType();
	if ( $type == 'original') $type = $media->getContentType();
	
	// format known
	switch ( $type )
	{
		case 'image/jpeg':
		case 'image/jpg':
		case 'image/png':
		case 'image/bmp':
		case 'image/gif':
			return image_tag( url_for_media( $media, $format) );
		default:
			return '<div class="unknown_media"></div>';
	}

}

