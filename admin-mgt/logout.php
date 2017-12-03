<?php
require 'ac/core/config.db.php';
if (isset($_SESSION['uid'])) {
	$updateUser=mysql_query("UPDATE `users` SET `last_login`=NOW() WHERE `uid`= '".$_SESSION['uid']."'");
}

session_destroy();
echo '<script>
localStorage.clear();
location.href="login.html";
</script>';
?>
