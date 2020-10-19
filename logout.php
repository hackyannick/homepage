<?php
setcookie("logged_in","",time() - 3600);

include('inc/menu_info.php');
include('inc/dyn_login-signout.php');
include('inc/footer.php');
?>
