<?
function byte_convert( $bytes )
{
	if ( $bytes <= 0 ) return $bytes;
	$s = array('B', 'Kb', 'MB', 'GB', 'TB', 'PB');
	$e = floor(log($bytes)/log(1024));
	return sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e))));
}

function hyphenize($text, $size, $hyphen = '&shy;' )
{
	$words = explode(' ', $text);
	foreach( $words as &$word)
	{
		$word = wordwrap( $word, $size, $hyphen, true);
	}
	return implode(' ', $words);
}