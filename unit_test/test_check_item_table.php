<?php

include("db_conn.php");

$sql = "SELECT ItemID, Name, Tag, Price, Description, GPS, PostTime, Address FROM Item";

$stmt = $mysqli->prepare($sql);
$result_exe = $stmt->execute();

if ($result_exe) {
  $result_bind = $stmt->bind_result($id, $name, $tag, $price, $description, $gps, $posttime, $address);
  if ($result_bind) {
    while ($stmt->fetch()) {
      echo " ID: " . $id .
           " Name: " . $name .
           " Description: " . $description .
           " Price: " . $price .
           " Tag: " . $tag .
           " PostTime: " . $posttime .
           " Address: " . $address .
           " GPS: " . $gps .
           " <br>";
    }
  } else {
    echo "0 result";
  }
}

$mysqli->close();

?>
