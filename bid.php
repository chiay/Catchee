<?php
function set_double($p) {
  $price = $p % 10;

  if ($price == 0) {
    return $p + 0.00;
  } else {
    return $p;
  }
}

function load_data($iid, $mysqli) {
  $sql = "SELECT * FROM Bid WHERE ItemID = ?";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('i', $iid);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($bid, $iid, $uid, $price, $t);
    if ($result_bind) {
      while ($stmt->fetch()) {
        $r[] = array(
          "BidID" => $bid,
          "ItemID" => $iid,
          "UserID" => $uid,
          "Price" => $price,
          "Time" => $t
        );
      }
    }
  }
  echo json_encode($r);
}

function insert_bid($iid, $uid, $price, $mysqli) {
  $price = set_double($price);

  $sql = "INSERT INTO Bid (ItemID, UserID, Price) VALUES (?, ?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("iid", $iid, $uid, $price);
  $result = $stmt->execute();
  $r[] = array(
    "itemid" => $iid,
    "userid" => $uid,
    "price" => $price
  );
  echo json_encode($r);
}

include("db_conn.php");
if (isset($_POST['flag']) && ($_POST['flag'] == 0)){
  load_data($_POST["itemID"], $mysqli);
}

if (isset($_POST['flag']) && ($_POST['flag'] == 1)){
  insert_bid($_POST["itemID"], $_POST['userID'], $_POST['price'], $mysqli);
}
$mysqli->close();

?>
