<?php

function load_data($user1, $user2, $mysqli) {
  $sql = "SELECT UserID_1, UserID_2, Content, PostTime FROM Message WHERE (UserID_1 = ? AND UserID_2 = ?) OR (UserID_1 = ? AND UserID_2 = ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("iiii", $user1, $user2, $user2, $user1);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($userid1, $userid2, $msg, $postTime);
    if ($result_bind) {
      while ($stmt->fetch()) {
        if ($userid1 == $user1 && $userid2 == $user2) {
          echo '<div class="row my-3">';
          echo '<div class="col-6"></div>';
          echo '<div class="col-6">';
          echo '<div class="float-right rounded-pill bg-primary px-5 py-2 text-white">' . $msg . '</div>';
          echo '</div></div>';
        } else {
          echo '<div class="row my-3">';
          echo '<div class="col-6">';
          echo '<div class="float-left rounded-pill border border-dark bg-light px-5 py-2 text-dark">' . $msg . '</div>';
          echo '</div>';
          echo '<div class="col-6"></div>';
          echo '</div>';
        }
      }
    }
  } else {
    echo "<script type='text/javascript'>alert('Unable to exe.');</script>" ;
  }
}

function insert_data($user1, $user2, $content, $mysqli) {
  $sql = "INSERT INTO Message (UserID_1, UserID_2, Content) VALUES (?, ?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("iis", $user1, $user2, $content);

  $result = $stmt->execute();

  if ($result) {
    return TRUE;
  } else {
    echo "<script type='text/javascript'>alert('Unable to send message at this time.');</script>" ;
    return FALSE;
  }
}

$usr1 = 2;
$usr2 = 3;
$content = $_POST["message"];

if (isset($_POST["MessageSend"]) || isset($_POST["key"])) {

  include("db_conn.php");

  if (insert_data($usr1, $usr2, $content, $mysqli)) {
    load_data($usr1, $usr2, $mysqli);
  }

  $mysqli->close();

  exit;
}


?>
