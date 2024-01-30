<?php 

$barangay = array();
$barangayList = file_get_contents('information/barangay_list.txt');
$barangay = explode("\n", $barangayList);

foreach ($barangay as &$brgy) {
    $brgy = trim($brgy);
}
unset($brgy); // unset the reference variable


?>