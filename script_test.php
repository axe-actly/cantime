<?php

$post = [
    'tag' => 'testpost5',
    'inout' => 'in',
];

$ch = curl_init('http://php-cyrilhurbin373378.codeanyapp.com/index.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);
