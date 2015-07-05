<?php

$out_file = 'bsd-test.csv.json';
// $files = array(
//     'data/cis-bsd-test.csv' => 'CIS',
//     'data/crs-bsd-test.csv' => 'CRS',
//     'data/ers-bsd-test.csv' => 'ERS',
//     'data/fh-bsd-test.csv' => 'FH',
//     'data/grid-bsd-test.csv' => 'GRID',
//     'data/oriseedsmp-bsd-test.csv' => 'oriSEEDS',
//     'data/orislic-bsd-test.csv' => 'oriSLIC',
//     'data/pb-bsd-test.csv' => 'PB',
//     'data/qs-bsd-test.csv' => 'QS',
//     'data/reseedsmp-bsd-test.csv' => 'reSEEDS',
//     'data/reseedssm-bsd-test.csv' => 'reSEEDS*',
//     'data/tp-bsd-test.csv' => 'TP',
//     'data/tps-bsd-test.csv' => 'TPS',
//     'data/nc-bsd.csv' => 'NC',
//);
// $files = array(
//     'data/cis-nyu-test.csv' => 'CIS',
//     'data/crs-nyu-test.csv' => 'CRS',
//     'data/ers-nyu-test.csv' => 'ERS',
//     'data/fh-nyu-test.csv' => 'FH',
//     'data/grid-nyu-test.csv' => 'GRID',
//     'data/oriseedsmp-nyu-test.csv' => 'oriSEEDS',
//     'data/orislic-nyu-test.csv' => 'oriSLIC',
//     'data/pb-nyu-test.csv' => 'PB',
//     'data/qs-nyu-test.csv' => 'QS',
//     'data/reseedsmp-nyu-test.csv' => 'reSEEDS',
//     'data/reseedssm-nyu-test.csv' => 'reSEEDS*',
//     'data/tp-nyu-test.csv' => 'TP',
//     'data/tps-nyu-test.csv' => 'TPS',
//     'data/vccs-depth-test.csv' => 'VCCS',
//     'data/slic3d-nyu-test.csv' => 'SLIC3D',
//     'data/seeds3d-nyu-test.csv' => 'SEEDS3D',
//     'data/seeds3dn-nyu-test.csv' => 'SEEDS3Dn',
//     'data/dasp-nyu-test.csv' => 'DASP',
//     'data/nc-nyu.csv' => 'NC',
// );
// $files = array(
//     'data/fh-bsd-test.csv' => 'FH',
//     'data/grid-bsd-test.csv' => 'GRID',
//     'data/oriseedsmp1it-bsd-test.csv' => 'oriSEEDS1it',
//     'data/orislic1it-bsd-test.csv' => 'oriSLIC1it',
//     'data/reseedsmp1it-bsd-test.csv' => 'reSEEDS1it',
//     'data/reseedssm1it-bsd-test.csv' => 'reSEEDS1it*',
// );
$files = array(
    'data/fh-nyu-test.csv' => 'FH',
    'data/grid-nyu-test.csv' => 'GRID',
    'data/oriseedsmp1it-nyu-test.csv' => 'oriSEEDS1it',
    'data/orislic1it-nyu-test.csv' => 'oriSLIC1it',
    'data/reseedsmp1it-nyu-test.csv' => 'reSEEDS1it',
    'data/reseedssm1it-nyu-test.csv' => 'reSEEDS1it*',
    'data/vccs-depth-test.csv' => 'VCCS',
    'data/slic3d-nyu-test.csv' => 'SLIC3D',
    'data/seeds3d-nyu-test.csv' => 'SEEDS3D',
    'data/dasp-nyu-test.csv' => 'DASP',
);

$data = array();
foreach ($files as $file => $name) {
    $contents = file_get_contents($file . '.json');
    $json = json_decode($contents);
    
    foreach ($json as $dataset) {
        $key = $dataset->key;
        
        if (!isset($data[$key])) {
            $data[$key] = array();
        }
        
        $values = array();
        foreach ($dataset->values as $array) {
            $values[] = array((int) $array[0], (float) $array[1]);
        }
        
        $data[$key][] = array(
            'key' => $name,
            'values' => $values
        );
    }
}

$json = json_encode($data);
echo $json;
