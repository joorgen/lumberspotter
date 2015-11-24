<?php
    function filterPermits($key, $value)
    {
        $json = file_get_contents('2015.json');
        $permits = json_decode($json, true);

        $permitsFiltered = array();
        foreach ($permits as &$item) {
            if( mb_strtolower($item[$key]) === mb_strtolower($value) )
            {
                array_push($permitsFiltered, $item);
            }
        }
        unset($item); // break the reference with the last element

        return $permitsFiltered;
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

	$json_output = filterPermits( key($filters), $filters[key($filters)]);
    header('Content-Type: application/json');
	print_r( json_encode($json_output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) );
?>