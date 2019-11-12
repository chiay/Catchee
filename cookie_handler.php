<?php

if (isset($_POST["token"])) {
  include("db_conn.php");

  $sql = "SELECT UserID, UserName, Token FROM User WHERE Token = ?";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('s', $_POST['token']);

  $result = $stmt->execute();

  if ($result) {
    $bind = $stmt->bind_result($userid, $username, $ret_token);
    if ($bind) {
      if ($stmt->fetch()) {
        $ret_arr[] = array(
          "userid" => $userid,
          "username" => $username
        );
        echo json_encode($ret_arr);
        /*echo "<script type='text/javascript'>";

        echo "document.getElementById('nav_login').innerHTML = '" . $username . "';";
        echo "document.getElementById('nav_signup').innerHTML = 'Sign Out';";
        echo "document.getElementById('nav_login').href = 'test_login.html';";
        echo "document.getElementById('nav_signup').href = 'logout.php';";

        echo "</script>";*/
      }
    } /*else {
      echo "<script type='text/javascript'>alert('[cookie_handler] No data binded!');</script>";
    }*/
  } /*else {
    echo "<script type='text/javascript'>alert('[cookie_handler] Unable to execute query!');</script>";
  }*/

  $mysqli->close();
}

?>
