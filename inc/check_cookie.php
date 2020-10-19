<?php
// Prüfen ob Cookie mit dem Inhalt 12345 existiert

if ($_COOKIE['logged_in'] == 'true') {
  include('downloader/index.php');
  } else {
  include('inc/forbidden.php');
}
?>