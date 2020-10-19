<?php
define("DB_HOST", "blank");
define("DB_NAME", "blank");
define("DB_USER", "blank");
define("DB_PASSWORD", "blank");
define("PROJECT_URL", "blank");
define("TIME_BEFORE_EXPIRE", 1);      // 8 hours
define("FILES_DIRECTORY", "./files");

try {
    $db_connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    exit($e->getMessage());
}

function getFiles()
{
    global $db_connection;

    $query = $db_connection->prepare("SELECT * FROM files");

    $query->execute();

    $results = $query->setFetchMode(PDO::FETCH_OBJ); 

    $files = [];

    foreach ($query->fetchAll() as $row) {
        $files[] = $row;
    }

    return $files;
}

function getFile($id) 
{
    global $db_connection;

    $query = $db_connection->prepare("SELECT * FROM files where id='{$id}'");

    $query->execute();

    $results = $query->setFetchMode(PDO::FETCH_OBJ); 

    $file = false;

    foreach ($query->fetchAll() as $row) {
        $file = $row;
    }

    return $file;
}

function checkId()
{
    if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
        exit('<div class="alert alert-danger">missing file id</div>');
    }

    $file = getFile($_GET['id']);

    if(!$file) {
        exit('<div class="alert alert-danger">file not found, may be it\'s deleted!</div>');
    }

    return $file;
}

function getFileUrl($file_id)
{
    global $db_connection;

    $query = $db_connection->prepare("SELECT * FROM file_urls where file_id='{$file_id}' and ip_address='".$_SERVER['REMOTE_ADDR']."' and time_before_expire >= '".time()."'");

    $query->execute();

    $results = $query->setFetchMode(PDO::FETCH_OBJ); 

    $file_url = false;

    foreach ($query->fetchAll() as $row) {
        $file_url = $row;
    }

    return $file_url;
}

function getFileUrlByToken($token_identifier)
{
    global $db_connection;

    $query = $db_connection->prepare("SELECT * FROM file_urls where token_identifier='{$token_identifier}'");

    $query->execute();

    $results = $query->setFetchMode(PDO::FETCH_OBJ); 

    $file_url = false;

    foreach ($query->fetchAll() as $row) {
        $file_url = $row;
    }

    return $file_url;
}

function randStr($length = 60) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function insertFileUrl($file_id)
{
    global $db_connection;

    $data = [
        'file_id' => $file_id,
        'token_identifier' => randStr(),
        'time_before_expire' => (time() + TIME_BEFORE_EXPIRE*60*60),     // 8 hours later
        'ip_address' => $_SERVER['REMOTE_ADDR']
    ];

    $sql = "INSERT INTO file_urls (file_id, token_identifier, time_before_expire, ip_address) VALUES (:file_id, :token_identifier, :time_before_expire, :ip_address)";

    $query = $db_connection->prepare($sql);
    
    $query->execute($data);

    return $data;
}