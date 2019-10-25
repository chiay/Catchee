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

function tag_to_int($tag) {
  switch ($tag) {
    case "Books":
      return 1;
    case "Clothes/Shoes":
      return 2;
    case "Electronic":
      return 3;
    case "Furniture":
      return 4;
    case "Toy":
      return 5;
    case "Transporation":
      return 6;
    default:
      return 0;
  }
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

function insert_data($name, $tag, $price, $description, $gps, $image_data, $image_name, $postTime, $address, $mysqli) {

  $id = get_userid($mysqli);

  $price = set_double($price);

  $sql = "INSERT INTO Item (UserID, Name, Tag, Price, Description, GPS, ImageData, ImageName, PostTime, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('issdssbsss', $id, $name, $tag, $price, $description, $gps, $image_data, $image_name, $postTime, $address);
  $stmt->send_long_data(6, $image_data);
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
/*$name = "Microsoft Surface Pro 6";
$tag= "Electronic";
$price = "123.45";
$description = "New in box";
$gps = "44.565071;-123.277920";
$postTime = get_time();
$address = "xxx St.";*/




if (isset($_POST["submit_sell"]) && isset($_POST["ItemName"]) && isset($_POST["ItemDescription"]) && isset($_POST["ItemPrice"]) && isset($_POST["ItemTag"])) {

  $name = $_POST["ItemName"];
  $tag = $_POST["ItemTag"];
  $price = $_POST["ItemPrice"];
  $description = $_POST["ItemDescription"];
  $gps = $_POST["msg"];
  $postTime = get_time();
  $address = "xxx St.";

  $image_name = $mysqli->real_escape_string($_FILES["ItemImage"]["name"]);
  $image_data = file_get_contents($_FILES["ItemImage"]["tmp_name"]);
  $image_type = $mysqli->real_escape_string($_FILES["ItemImage"]["type"]);

  $tag = tag_to_int($tag);

  if(substr($image_type, 0, 5) == "image") {

    if (insert_data($name, $tag, $price, $description, $gps, $image_data, $image_name, $postTime, $address, $mysqli)) {

    }
  }

  $mysqli->close();

  exit;
}


?>
