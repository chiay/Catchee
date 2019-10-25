<?php

include("db_conn.php");

$sql = "SELECT * FROM Item";

$stmt = $mysqli->prepare($sql);
//$stmt->bind_param("d", $price);

$result_exe = $stmt->execute();

$stmt->store_result();
$count = 0;

if ($result_exe) {
  $result_bind = $stmt->bind_result($iid, $uid, $name, $tag, $price, $description, $gps, $image_data, $image_name, $postTime, $address);
  if ($result_bind) {
    echo '<div class="container mt-5">';
    echo '<div class="row">';


    while ($stmt->fetch()) {
      //echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" class="" alt="">';
      echo '<div class="col-4">';

      echo '<div class="card m-3" style="width: 18rem;">';
      echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" class="card-img-top" alt="">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $name . '</h5>';
      echo '<p class="card-text">' . $description . '</p>';
      echo '<a href="#" class="btn btn-primary">Go somewhere</a>';
      echo '</div></div>';

      echo '</div>';
      $count += 1;
      if ($count == 3) {
        echo '</div>';
        echo '<div class="row">';
        $count = 0;
      }
    }

    echo '</div></div>';

  }
} else {
  echo "Unable to execute sql query.";
}

$mysqli->close();

?>
