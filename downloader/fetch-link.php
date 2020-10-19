<?php include_once './includes.php';

if(!isset($_GET['file_id']) || !is_numeric($_GET['file_id']))
    exit('missing file id');

// insert new url
$insertedData = insertFileUrl($_GET['file_id']);

// return response
$token_identifier = $insertedData['token_identifier'];
$time_before_expire = TIME_BEFORE_EXPIRE; 

include_once './download-box.php'; 
exit;