<?php
/**
  Here I show how to connect to openml api using a session hash
  I show how to obtain this hash from openml api in connect.php
*/
$URL = 'http://openml.liacs.nl/api/?f=openml.data.upload';

$description_file = 'dataset.xml';
$dataset_file = 'cpu.arff';
$session_hash = 'MFD6VIF6H351ABO5RHNRZKQ4DXMKE5SQBWMX5SUC';

if( file_exists( $description_file ) === false ||
    file_exists( $dataset_file ) === false ) {
  die('File not found. ');
}


$post = array(
  'description' => "@$description_file",
  'dataset' => "@$dataset_file",
  'session_hash' => $session_hash
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, trim( $URL ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_exec($ch);
echo curl_error($ch);
curl_close($ch);

?>
