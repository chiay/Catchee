<?php

include("db_conn.php");
include("credential_generator.php");

// Check if username existed
function check_user($username, $email, $mysqli) {
  $sql = "SELECT UserID FROM User WHERE UserName = ? OR Email = ?";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $username, $email);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($userid);
    if ($result_bind) {
      if (!($stmt->fetch() == NULL)) {
        echo "Username/Email not available. Please choose another username/email.";
        return FALSE;
      } else {
        //echo "<script type='text/javascript'>alert('Username/Email acceptable');</script>";
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

function insert_data($username, $password, $email, $mysqli) {

  $sql = "INSERT INTO User (UserName, Password, Email, Token) VALUES (?, ?, ?, ?)";

  $token = token_generator($username, $email);

  $hash_pass = password_hash($password);

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('ssss', $username, $hash_pass, $email, $token);

  $result = $stmt->execute();

  if ($result) {
    echo "<script type='text/javascript'>alert('Welcome to Catchee!');</script>" ;
    return TRUE;
  } else {
    echo "<script type='text/javascript'>alert('Unable to register at this time.');</script>" ;
    return FALSE;
  }
}


/* Uncomment for testing only */
//$usr = "test1";
//$pass = "test1";
//$email = "test1@catchee.com";

//insert_data($usr, $pass, $email, $mysqli);

if (isset($_POST["submit_registration"]) && isset($_POST["username"]) && isset($_POST["password_init"]) && isset($_POST["email"])) {

  include("db_conn.php");

  session_start();

  $usr = $_POST["username"];
  $pass = $_POST["password_init"];
  $email = $_POST["email"];

  if (check_user($usr, $email, $mysqli)) {
    if(insert_data($usr, $pass, $email, $mysqli)) {
      $_SESSION["login"] = "true";
      $_SESSION["user"] = $usr;
      $_SESSION["email"] = $email;

      /* Redirect to page */
      //header("Location: home.html"); <-- this may not work after javascript code
      echo "<script>location.href='home.html';</script>";
    }
  }

  $mysqli->close();

  exit;
}



//$mysqli->close();

?>
