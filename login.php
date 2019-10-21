<?php

include("db_conn.php");
include("credential_generator.php");

/* Check if user is registered
 * $flag = 0 for username
 * $flag = 1 for email
 */
function check_user($credential, $password, $flag, $mysqli) {

  $hash_pass = password_hash($password);

  if ($flag == 0) {
    $sql = "SELECT Email FROM User WHERE UserName = ? AND Password = ?";
  } else if ($flag == 1) {
    $sql = "SELECT UserName FROM User WHERE Email = ? AND Password = ?";
  }

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $credential, $hash_pass);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($usercred);
    if ($result_bind) {
      if ($stmt->fetch() == NULL) {
        echo "<script type='text/javascript'>alert('Username/Email not registered.');</script>";
        exit;
      } else {
        echo "<script type='text/javascript'>alert('Welcome back!');</script>";
        return $usercred;
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

  session_start();

  $cred = $_POST["credential"];
  $pass = $_POST["password"];

  if (isEmail($cred)) {
    $r = check_user($cred, $pass, 1, $mysqli);

    $_SESSION["login"] = "true";
    $_SESSION["user"] = $r;
    $_SESSION["email"] = $cred;

    echo "<script>location.href='home.html';</script>";
  } else {
    $r = check_user($cred, $pass, 0, $mysqli);

    $_SESSION["login"] = "true";
    $_SESSION["user"] = $cred;
    $_SESSION["email"] = $r;

    echo "<script>location.href='home.html';</script>";
  }

  $mysqli->close();

  exit;
}

//$mysqli->close();

?>
