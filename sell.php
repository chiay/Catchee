<?php

include("db_conn.php");

function set_double($p) {
  $price = $p % 10;

  if ($price == 0) {
    return $p + 0.00;
  } else {
    return $p;
  }
}

function get_time() {
  $ts = time();
  return strval(date("Y-m-d h:i:s", $ts));
}

function get_userid($mysqli) {

  $sql = "SELECT UserID FROM User WHERE Token = ?";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("s", $_COOKIE['usr']);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($userid);
    if ($result_bind) {
      if ($stmt->fetch() == NULL) {
        echo "<script type='text/javascript'>alert('User not exists!');</script>";
        exit;
      } else {
        //echo "<script type='text/javascript'>alert('Welcome back!');</script>";
        return $userid;
      }
    } else {
      echo "No data binded.";
      exit;
    }
  } else {
    echo "Unable to execute sql query.";
    exit;
  }
}

function insert_data($name, $tag, $price, $description, $gps, $picture, $postTime, $address, $mysqli) {

  $id = "2";

  $price = set_double($price);

  $sql = "INSERT INTO Item (UserID, Name, Tag, Price, Description, GPS, PostTime, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('issdssss', $id, $name, $tag, $price, $description, $gps, $postTime, $address);

  $result = $stmt->execute();

  if ($result) {
    echo "<script type='text/javascript'>alert('Item Posted!');</script>" ;
    return TRUE;
  } else {
    echo "<script type='text/javascript'>alert('Unable to post item for sell.');</script>" ;
    return FALSE;
  }
}

/* Uncomment for testing only */
$name = "Microsoft Surface Pro 6";
$tag= "Electronic";
$price = "123.45";
$description = "New in box";
$gps = "44.565071;-123.277920";
$picture = "";
$postTime = get_time();
$address = "xxx St.";

insert_data($name, $tag, $price, $description, $gps, $picture, $postTime, $address, $mysqli);



/*
if (isset($_POST["submit_sell"]) && isset($_POST["ItemName"]) && isset($_POST["ItemDescription"]) && isset($_POST["ItemPrice"])) {

}
*/


$mysqli->close();
?>
