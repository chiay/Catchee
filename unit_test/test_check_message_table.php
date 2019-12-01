<?php

include("db_conn.php");

$sql = "SELECT * FROM Message";

$stmt = $mysqli->prepare($sql);
$result_exe = $stmt->execute();

if ($result_exe) {
  $result_bind = $stmt->bind_result($mid, $cid, $uid, $content, $time);
  if ($result_bind) {
    while ($stmt->fetch()) {
      echo " MID: " . $mid .
           " ChatID: " . $cid .
           " UserID: " . $uid .
           " Content: " . $content .
           " Time: " . $time .
           " <br>";
    }
  } else {
    echo "0 result";
  }
}

$mysqli->close();

?>
