<?php


function gdversion( )
{
	static $gd_version_number = null;
	if ( $gd_version_number === null )
	{
		ob_start( );
		phpinfo( 8 );
		$module_info = ob_get_contents( );
		ob_end_clean( );
		if ( preg_match( "/\\bgd\\s+version\\b[^\\d\n\r]+?([\\d\\.]+)/i", $module_info, $matches ) )
		{
			$gdversion_h = $matches[1];
			return $gdversion_h;
		}
		$gdversion_h = 0;
	}
	return $gdversion_h;
}

function getbackalert( $msg, $isstop = 0 )
{
	$msg = str_replace( "\"", "`", $msg );
	if ( $isstop == 1 )
	{
		$msg = "<script>\r\n<!--\r\n alert(\"".$msg."\");\r\n-->\r\n</script>\r\n";
	}
	else
	{
		$msg = "<script>\r\n<!--\r\n alert(\"".$msg."\");history.go(-1);\r\n-->\r\n</script>\r\n";
	}
	$msg = "<meta http-equiv=content-type content='text/html; charset=utf-8'>\r\n".$msg;
	return $msg;
}

function testwrite( $d )
{
	$tfile = "_honghesoft.txt";
	$fp = @fopen( $d."/".$tfile, "w" );
	if ( !$fp )
	{
		return false;
	}
	fclose( $fp );
	$rs = @unlink( $d."/".$tfile );
	if ( $rs )
	{
		return true;
	}
	return false;
}

?>
