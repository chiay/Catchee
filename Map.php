<?php

function load_items($mysqli) {
  $sql = "SELECT ItemID, Name, Tag, Price, Description, GPS, Latitude, Longitude, PostTime, Address FROM Item";

  $stmt = $mysqli->prepare($sql);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($ItemID, $Name, $Tag, $Price, $Description, $GPS, $Latitude, $Longitude, $PostTime, $Address);
    if ($result_bind) {
      while ($stmt->fetch()) {
        $return_arr[] = array(
          "ID" => $ItemID,
          "Name" => $Name,
          "Tag" => $Tag,
          "Price" => $Price,
          "Description" => $Description,
          "GPS" => $GPS,
          "Latitude" => $Latitude,
          "Longitude" => $Longitude,
          "PostTime" => $PostTime,
          "Address" => $Address

        );
      }
      echo json_encode($return_arr);
    }
  }
}

if (isset($_POST["flag"]) && $_POST["flag"] == 3) {
  include("db_conn.php");
  load_items($mysqli);
  $mysqli->close();
  exit;
}

?>
