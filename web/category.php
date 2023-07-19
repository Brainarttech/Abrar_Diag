<?php


$resp = array();

$cat['id'] = 1;
$cat['name'] = "MRI";
$resp[] = $cat;
unset($cat);

$cat['id'] = 2;
$cat['name'] = "CT SCAN";
$resp[] = $cat;
unset($cat);

$cat['id'] = 3;
$cat['name'] = "XRAY";
$resp[] = $cat;
unset($cat);

$cat['id'] = 4;
$cat['name'] = "ULTRA SOUND";
$resp[] = $cat;
unset($cat);

$cat['id'] = 5;
$cat['name'] = "OPG";
$resp[] = $cat;
unset($cat);

$cat['id'] = 6;
$cat['name'] = "ECHO";
$resp[] = $cat;
unset($cat);
//And SO ON ......




$response['category'] = $resp;

echo json_encode($response);













?>