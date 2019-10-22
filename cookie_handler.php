<?php

if (isset($_COOKIE["usr"])) {
  include("db_conn.php");

  $sql = "SELECT UserName, Token FROM User WHERE Token = ?";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('s', $_COOKIE['usr']);

  $result = $stmt->execute();

  if ($result) {
    $bind = $stmt->bind_result($username, $ret_token);
    if ($bind) {
      if (!($stmt->fetch() == NULL)) {
        echo "<script type='text/javascript'>document.getElementById('login').innerHTML = '" . $username . "';</script>";
        echo "<script type='text/javascript'>document.getElementById('login').href = '#';</script>";
      }
    } else {
      echo "<script type='text/javascript'>alert('[cookie_handler] No data binded!');</script>";
    }
  } else {
    echo "<script type='text/javascript'>alert('[cookie_handler] Unable to execute query!');</script>";
  }

  $mysqli->close();
}

?>
