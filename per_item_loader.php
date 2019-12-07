<?php

include("db_conn.php");

$itemid = $_POST["itemID"];

//$sql = "SELECT * FROM Item WHERE ItemID = ?";

$sql = "SELECT i.ItemID, u.UserName, i.Name, i.Tag, i.Price, i.Description, i.gps, i.Latitude, i.Longitude, i.ImageData, i.ImageName, i.PostTime, i.Address
FROM Item i
INNER JOIN User u on i.UserID = u.UserID
WHERE i.ItemID = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $itemid);

$result_exe = $stmt->execute();
$stmt->store_result();

if ($result_exe) {
  $result_bind = $stmt->bind_result($iid, $uname, $name, $tag, $price, $description, $gps, $lat, $long, $image_data, $image_name, $postTime, $address);
  if ($result_bind) {
    while ($stmt->fetch()) {
      $return_arr[] = array(
        "itemid" => $iid,
        "username" => $uname,
        "itemname" => $name,
        "tag" => $tag,
        "price" => $price,
        "description" => $description,
        "gps" => $gps,
        "lat" => $lat,
        "long" => $long,
        "image_data" => base64_encode($image_data),
        "image_name" => $image_name,
        "posttime" => $postTime,
        "address" => $address
      );
    }
    echo json_encode($return_arr);
  }
}

$mysqli->close();

?>
