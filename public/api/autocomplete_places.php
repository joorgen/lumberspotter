<?php
	function mb_ucfirst($string, $encoding)
	{
		$strlen = mb_strlen($string, $encoding);
		$firstChar = mb_substr($string, 0, 1, $encoding);
		$then = mb_substr($string, 1, $strlen - 1, $encoding);
		return mb_strtoupper($firstChar, $encoding) . $then;
	}

    if( !isset( $_GET['term'] ))
    {
        exit();
    }

	$db = new SQLite3('places.db');
	$statement = $db->prepare('SELECT * FROM places WHERE LOWER(ime) LIKE :id;');
	$statement->bindValue(':id', mb_ucfirst($_GET['term'],'utf-8').'%');

	$result = $statement->execute();

	$return = array();
	while ($row = $result->fetchArray()) {
		array_push($return,array( 'label'=>$row['ime'] . ', ' . $row['obshtina'] ));
	}

	header('Content-Type: application/json; charset=utf-8');
	print_r(json_encode($return, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ));
?>
