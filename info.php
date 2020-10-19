<?php
setcookie("logged_in","true",time()+(3600));
include('inc/menu_info.php');
//include('inc/setup_cookie.php');
include('inc/dyn_login-info.php');
include('inc/footer.php');
?>
