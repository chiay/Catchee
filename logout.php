<?php
setcookie("usr", "", time() - 3600);
header("Location: home.html");
exit;
?>
