<?php

include("db_conn.php");

/* Check if user is registered
 * $flag = 0 for username
 * $flag = 1 for email
 */
function check_user($credential, $password, $flag, $mysqli) {

  if ($flag == 0) {
    $sql = "SELECT UserID FROM User WHERE UserName = ? AND Password = SHA1(?)";
  } else if ($flag == 1) {
    $sql = "SELECT UserID FROM User WHERE Email = ? AND Password = SHA1(?)";
  }

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $credential, $password);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($userid);
    if ($result_bind) {
      if ($stmt->fetch() == NULL) {
        echo "<script type='text/javascript'>alert('Username/Email not registered.');</script>";
        return FALSE;
      } else {
        echo "<script type='text/javascript'>alert('Welcome back! " . $userid . "');</script>";
        return TRUE;
      }
    } else {
      echo "No data binded.";
      return FALSE;
    }
  } else {
    echo "Unable to execute sql query.";
    return FALSE;
  }
}

function isEmail($credential) {

  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

  if (preg_match($regex, $credential)) {
    return TRUE;
  }

  return FALSE;
}


/* Uncomment for testing only */
//$usr = "test1";
//$pass = "test1";
//$email = "test1@catchee.com";

if (isset($_POST["submit_login"]) && isset($_POST["credential"]) && isset($_POST["password"])) {

  include("db_conn.php");

  $cred = $_POST["credential"];
  $pass = $_POST["password"];

  if (isEmail($cred)) {
    check_user($cred, $pass, 1, $mysqli);
  } else {
    check_user($cred, $pass, 0, $mysqli);
  }

  $mysqli->close();
}

//$mysqli->close();

?>
