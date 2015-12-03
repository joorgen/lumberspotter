<?php
	function mb_ucfirst($string, $encoding)
	{
		$strlen = mb_strlen($string, $encoding);
		$firstChar = mb_substr($string, 0, 1, $encoding);
		$then = mb_substr($string, 1, $strlen - 1, $encoding);
		return mb_strtoupper($firstChar, $encoding) . $then;
	}

    if( !isset( $_GET['filters'] ))
    {
        exit();
    }

    $filters_json = $_GET['filters'];

    $filters = json_decode($filters_json,true);

    if( !isset( $filters))
    {
        header('HTTP/1.0 404 Not Found');
        exit();
    }

	$db = new SQLite3('permits_2015.db');
	$query = 'SELECT * FROM permits WHERE ';
	$i = 0;
	foreach ($filters as $key => $value)
	{
		if( $i > 0 )
			$query .= ' AND ';

		$query	.= '"'.$key .'"'. '=' . '"'.$value .'"'.' ';
		$i++;
	}

	$results = $db->query( $query );

	$resultarray = array();
	while( $row = $results->fetchArray(SQLITE3_ASSOC) )
	{
		array_push( $resultarray, $row );
	}

    header('Content-Type: application/json; charset=utf-8');
	print_r( json_encode($resultarray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) );
?>