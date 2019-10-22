<?php
setcookie("usr", "", time() - 3600);
header("Location: home.php");
exit;
?>
