<?php
/**
  Here I show how to connect to openml api using a session hash
  I show how to obtain this hash from openml api in connect.php
*/
$URL = 'http://openml.liacs.nl/api/?f=openml.run.upload';

$description_file = '/home/noor/Desktop/run_task_5518.xml';
$predictions_file = '/home/noor/Desktop/Predictions.arff';
//$splits_file = '/home/noor/Desktop/Splits.arff';
$session_hash = 'ZN0R1252U5ZEHE2P779MF20DFO4XVX9KAZ12SXVD';

if( file_exists( $description_file ) === false ||
    file_exists( $predictions_file ) === false ) {
  die('File not found. ');
}


$post = array(
  'description' => "@$description_file",
  'predictions' => "@$predictions_file",
  'session_hash' => $session_hash
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, trim( $URL ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$res = curl_exec($ch);
echo curl_error($ch);
curl_close($ch);
echo $res;
?>
