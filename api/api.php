<?php
	
	$url = '2015.json';
	$json = file_get_contents($url);
	$permits = json_decode($json, true);
	// echo '<pre>';
	// var_dump($permits);
	// echo '</pre>';

	function filterItem($item)
	{
	    // returns whether the input integer is odd
	    return( $item["Община"] === "Правец" );
	}

	$permitsFiltered = array_filter($permits, "filterItem");
	$json_output = json_encode($permitsFiltered,JSON_UNESCAPED_UNICODE);
	//echo '<pre>';
	print_r( $json_output );
	//echo '</pre>';

?>