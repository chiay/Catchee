<?php

assert_options(ASSERT_ACTIVE, true);
assert_options(ASSERT_BAIL, false); // set 'true' to stop after first assert failure
assert_options(ASSERT_WARNING, false);
assert_options(ASSERT_CALLBACK, 'assert_failed');

function assert_failed($file, $line, $code) {
    echo "Assertion Failed at $file:$line: $code";
    echo "<br />";
}

function set_double($p) {
  $price = $p % 10;

  if ($price == 0) {
    return $p + 0.00;
  } else {
    return $p;
  }
}

function load_data($mysqli) {
  $sql = "SELECT * FROM Bid";

  $stmt = $mysqli->prepare($sql);

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
  return $r;
}

/* $flag == 1 for insert
 * $flag == 2 for update_data
 * $flag == 3 for delete
 */
function manipulate_data($flag, $iid, $uid, $price, $bid, $mysqli) {
  $price = set_double($price);

  if ($flag == 1) {
    $sql = "INSERT INTO Bid (ItemID, UserID, Price) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iid", $iid, $uid, $price);
  } else if ($flag == 2) {
    $sql = "UPDATE Bid SET Price = ? WHERE BidID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("di", $price, $bid);
  } else if ($flag == 3) {
    // Be careful here for deleting all data
    $sql = "DELETE FROM Bid; ";
    $stmt = $mysqli->prepare($sql);
  }

  $result = $stmt->execute();

  if ($result) {
    return true;
  }
  return false;
}

function alter_table_var($mysqli) {
  $sql = "ALTER TABLE Bid AUTO_INCREMENT = 1; ";
  $stmt = $mysqli->prepare($sql);
  $result = $stmt->execute();
}



include("db_conn.php");

$data = load_data($mysqli);
$len = sizeof($data);

/* Example: */
//assert('$data[0]["BidID"] == 1');
//assert('2 < 1');
//assert('$data[0]["BidID"] == 3');

echo "Insert Assertion <br/>";
// Insert
assert('manipulate_data(1, 1, 3, 0.99, 0, $mysqli)');
assert('manipulate_data(1, 1, 4, 1.99, 0, $mysqli)');
assert('manipulate_data(1, 1, 5, 2.00, 0, $mysqli)');
assert('manipulate_data(1, 1, 6, 3, 0, $mysqli)');

// Insert Error
assert('manipulate_data(1, 1, 11, 3, 0, $mysqli)');
assert('manipulate_data(1, 21, 6, 3, 0, $mysqli)');
assert('manipulate_data(1, 1, 20, .01, 0, $mysqli)');
assert('manipulate_data(1, 100, 6, 99999, 0, $mysqli)');

echo "Update Assertion <br/>";
// Update
assert('manipulate_data(2, 1, 0, 99.99, 1, $mysqli)');
assert('manipulate_data(2, 2, 0, 88.99, 2, $mysqli)');
assert('manipulate_data(2, 3, 0, 990.99, 3, $mysqli)');
assert('manipulate_data(2, 4, 0, 550.99, 4, $mysqli)');

// Update Error
assert('manipulate_data(2, 200, 0, 10088.99, 200, $mysqli)');


// Change 'assert_options(ASSERT_BAIL, false);' at line 4 to run the following line
// Clear all data
//assert('manipulate_data(3, 0, 0, 0, 0, $mysqli)');
//alter_table_var($mysqli);
$mysqli->close();
?>
