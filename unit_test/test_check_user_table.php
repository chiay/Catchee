<?php

include("db_conn.php");

$sql = "SELECT UserName, Email FROM User";
//$result = $mysqli->query($sql);

$stmt = $mysqli->prepare($sql);
$result_exe = $stmt->execute();

//$result = $stmt->get_result();
if ($result_exe) {
  $result_bind = $stmt->bind_result($username, $email);
  if ($result_bind) {
    while ($stmt->fetch()) {
      echo "Username: " . $username . " " . "E-mail: " . $email . "<br>";
    }
  } else {
    echo "0 result";
  }
}

$mysqli->close();

?>
