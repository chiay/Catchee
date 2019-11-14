<?php

function load_data($user1, $user2, $mysqli) {
  $sql = "SELECT c.ChatroomID, u1.UserName, u2.UserName, m.Content, m.PostTime
    FROM (((Chatroom c
    INNER JOIN User u1 ON c.UserID_1 = u1.UserID)
    INNER JOIN User u2 ON c.UserID_2 = u2.UserID)
    INNER JOIN Message m ON c.ChatroomID = m.ChatroomID)
    WHERE (c.UserID_1 = ? AND c.UserID_2 = ?) OR (c.UserID_1 = ? AND c.UserID_2 = ?)";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("iiii", $user1, $user2, $user2, $user1);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($chatroomid, $u1name, $u2name, $msg, $postTime);
    if ($result_bind) {
      while ($stmt->fetch()) {
        $return_arr[] = array(
          "chatroomid" => $chatroomid,
          "username1" => $u1name,
          "username2" => $u2name,
          "msg" => $msg,
          "postTime" => $postTime
        );
      }
      echo json_encode($return_arr);
    }
  } else {
    echo "<script type='text/javascript'>alert('Unable to exe.');</script>" ;
  }
}

function load_recipients($mysqli) {
  $sql = "SELECT c.ChatroomID, u1.UserName, u2.UserName
    FROM ((Chatroom c
    INNER JOIN User u1 ON c.UserID_1 = u1.UserID)
    INNER JOIN User u2 ON c.UserID_2 = u2.UserID)";

  $stmt = $mysqli->prepare($sql);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($chatroomid, $u1name, $u2name);
    if ($result_bind) {
      while ($stmt->fetch()) {
        $return_arr[] = array(
          "chatroomid" => $chatroomid,
          "username1" => $u1name,
          "username2" => $u2name
        );
      }
      echo json_encode($return_arr);
    }
  } else {
    echo "<script type='text/javascript'>alert('Unable to exe.');</script>" ;
  }
}

/*function load_data($user1, $user2, $mysqli) {
  $sql = "SELECT UserID_1, UserID_2, Content, PostTime FROM Message WHERE (UserID_1 = ? AND UserID_2 = ?) OR (UserID_1 = ? AND UserID_2 = ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("iiii", $user1, $user2, $user2, $user1);

  $result_exe = $stmt->execute();

  if ($result_exe) {
    $result_bind = $stmt->bind_result($userid1, $userid2, $msg, $postTime);
    if ($result_bind) {
      while ($stmt->fetch()) {
        $return_arr[] = array(
          "userid1" => $userid1,
          "userid2" => $userid2,
          "msg" => $msg,
          "postTime" => $postTime
        );
      }
      echo json_encode($return_arr);
    }
  } else {
    echo "<script type='text/javascript'>alert('Unable to exe.');</script>" ;
  }
}*/

function get_chatroomid($username1, $username2, $mysqli) {
  $sql = "SELECT c.ChatroomID FROM ((Chatroom c
    INNER JOIN User u1 ON c.UserID_1 = u1.UserID)
    INNER JOIN User u2 ON c.UserID_2 = u2.UserID)
    WHERE u1.UserName = ? AND u2.UserName = ?";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $username1, $username2);

  $result = $stmt->execute();

  if ($result) {
    $result_bind = $stmt->bind_result($chatroomid);
    if ($result_bind) {
      while($stmt->fetch()) {
        return $chatroomid;
      }
    }
  }
}


function insert_data($username1, $username2, $content, $mysqli) {

  $chatrid = get_chatroomid($username1, $username2, $mysqli);

  $sql = "INSERT INTO Message (ChatroomID, Content) VALUES (?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("is", $chatrid, $content);

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
$usrn1 = "test";
$usrn2 = "wefweg";
$content = $_POST["message"];

if (isset($_POST["MessageSend"]) || (isset($_POST["flag"]) && $_POST["flag"] == 1))  {

  include("db_conn.php");

  if (insert_data($usrn1, $usrn2, $content, $mysqli)) {
    load_data($usr1, $usr2, $mysqli);
  }

  $mysqli->close();

  exit;
}

if (isset($_POST["flag"]) && $_POST["flag"] == 0) {
  include("db_conn.php");
  load_data($usr1, $usr2, $mysqli);
  $mysqli->close();
  exit;
}

if (isset($_POST["flag"]) && $_POST["flag"] == 2) {
  include("db_conn.php");
  load_recipients($mysqli);
  $mysqli->close();
  exit;
}


?>
