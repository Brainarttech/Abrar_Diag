<?php


$resp = array();

$cat['id'] = 1;
$cat['name'] = "MRI";
$resp[] = $cat;
unset($cat);

$item['id'] = 1;
$item['cat_id'] = 1; //Category ID
$item['name'] = 'MRI BRAIN WITHOUT CONTRAST';
$item['rate'] = 9000;
$resp[] = $item;
unset($item);

$item['id'] = 2;
$item['cat_id'] = 1; //Category ID
$item['name'] = 'MRI BRAIN WITH CONTRAST';
$item['rate'] = 12000;
$resp[] = $item;
unset($item);

$item['id'] = 3;
$item['cat_id'] = 1; //Category ID
$item['name'] = 'MRI PNS WITHOUT CONTRAST';
$item['rate'] = 9000;
$resp[] = $item;
unset($item);

$item['id'] = 4;
$item['cat_id'] = 1; //Category ID
$item['name'] = 'MRI PNS WITH CONTRAST';
$item['rate'] = 12000;
$resp[] = $item;
unset($item);

$item['id'] = 5;
$item['cat_id'] = 1; //Category ID
$item['name'] = 'MRV BRAIN';
$item['rate'] = 9000;
$resp[] = $item;
unset($item);

$item['id'] = 6;
$item['cat_id'] = 1; //Category ID
$item['name'] = 'MRI ORBITS WITHOUT CONTRAST';
$item['rate'] = 9000;
$resp[] = $item;
unset($item);

$item['id'] = 7;
$item['cat_id'] = 1; //Category ID
$item['name'] = 'MRI ORBITS WITH CONTRAST';
$item['rate'] = 12000;
$resp[] = $item;
unset($item);

//CT SCAN ITEM NAMES........
$cat['id'] = 2;
$cat['name'] = "CT SCAN";
$resp[] = $cat;
unset($cat);

$item['id'] = 1;
$item['cat_id'] = 2; //Category ID
$item['name'] = 'CT NECK+CHEST';
$item['rate'] = 18000;
$resp[] = $item;
unset($item);

$item['id'] = 2;
$item['cat_id'] = 2; //Category ID
$item['name'] = 'CT IAM+NECK';
$item['rate'] = 12500;
$resp[] = $item;
unset($item);

$item['id'] = 3;
$item['cat_id'] = 2; //Category ID
$item['name'] = 'CT HEAD+NECK';
$item['rate'] = 13000;
$resp[] = $item;
unset($item);

$item['id'] = 4;
$item['cat_id'] = 2; //Category ID
$item['name'] = 'CT CHEST+ABDOMEN';
$item['rate'] = 18500;
$resp[] = $item;
unset($item);

$item['id'] = 5;
$item['cat_id'] = 2; //Category ID
$item['name'] = 'CT BRAIN+IAM';
$item['rate'] = 12500;
$resp[] = $item;
unset($item);

$item['id'] = 6;
$item['cat_id'] = 2; //Category ID
$item['name'] = 'CT SCANOGRAM';
$item['rate'] = 4000;
$resp[] = $item;
unset($item);

$item['id'] = 7;
$item['cat_id'] = 2; //Category ID
$item['name'] = 'CT PELVIMETRY';
$item['rate'] = 4000;
$resp[] = $item;
unset($item);
// XRAY ITEMS NAME.........

$cat['id'] = 3;
$cat['name'] = "XRAY";
$resp[] = $cat;
unset($cat);

$item['id'] = 1;
$item['cat_id'] = 3; //Category ID
$item['name'] = 'LEFT ARM XRAY';
$item['rate'] = 1000;
$resp[] = $item;
unset($item);

$item['id'] = 2;
$item['cat_id'] = 3; //Category ID
$item['name'] = 'RIGHT ARM XRAY';
$item['rate'] = 1000;
$resp[] = $item;
unset($item);

$item['id'] = 3;
$item['cat_id'] = 3; //Category ID
$item['name'] = 'CHEST XRAY';
$item['rate'] = 1200;
$resp[] = $item;
unset($item);

$item['id'] = 4;
$item['cat_id'] = 3; //Category ID
$item['name'] = 'LEFT KNEE XRAY';
$item['rate'] = 1100;
$resp[] = $item;
unset($item);

$item['id'] = 5;
$item['cat_id'] = 3; //Category ID
$item['name'] = 'RIGHT KNEE XRAY';
$item['rate'] = 1100;
$resp[] = $item;
unset($item);

//COPY PASTE And SO ON ......




$response['item'] = $resp;

echo json_encode($response);













?>