<?php
include_once './includes.php'; 
if(!isset($_GET['t']) || empty($_GET['t'])) {
    exit('Fehlende Download ID');
}
$fileUrl = getFileUrlByToken($_GET['t']);
// if download not exist
if(!$fileUrl) {
    exit('Es sind keine Downloads unter dieser ID Verfügbar.');
}
// if download expired
if($fileUrl->time_before_expire < time()) {
    exit('Dieser Download ist erloschen');
}
// download
$file = getFile($fileUrl->file_id);
if(!empty($file->filename) && file_exists('./files/' . $file->filename)) {
    
    $file = urldecode($file->filename);
    $filepath = "./files/" . $file;
    header('Content-Description: File Transfer');
    // header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    flush(); // Flush system output buffer
    readfile($filepath);
    exit;
}