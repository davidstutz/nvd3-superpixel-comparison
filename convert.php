<?php

$in_file = $_GET['file'];
$contents = file_get_contents($in_file);

$contents = preg_replace('#[\t ]+#', ' ', $contents);
$lines = explode("\n", $contents);

foreach ($lines as $line) {
    $array[] = str_getcsv($line, ' ');
}

$json = array();
$k = 0;
foreach ($array[0] as $key => $value) {
    if ($value == 'K') {
        $k = $key;
    }
}

foreach ($array[0] as $key => $value) {
    if ($value == 'K' || $value == 'Kd') {
        continue;
    }
    
    $data = array(
        'key' => $value,
        'values' => array(),
    );
    
    foreach ($array as $row_index => $row) {
        if ($row_index == 0) {
            continue;
        }
        
        if (isset($row[$key]) && $row[$key] != 'nan') {
            $data['values'][] = array((int) $row[$k], (float) $row[$key]);
        }
    }
    
    if (sizeof($data['values']) > 0) {
        $json[] = $data;
    }
}

$json_encoded = json_encode($json);
file_put_contents($in_file . '.json', $json_encoded);
echo $json_encoded;
