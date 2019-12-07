<?php

include("db_conn.php");


$item_name = $_POST['search_phrase'];
$item_name = strtolower($item_name);

function tag_code_to_tag($tag_code) {
    switch ($tag_code) {
        case 1:
            return "Books";
        case 2:
            return "Clothes/Shoes";
        case 3:
            return "Electronic";
        case 4:
            return "Furniture";
        case 5:
            return "Toy";
        case 6:
            return "Transportation";
        default:
            return "Others";
    }
}

$sql = "SELECT ItemID, Name, Tag, Price, Description, GPS, PostTime, Address, ImageData FROM Item as i WHERE LOWER(i.Name) like '%$item_name%'";

$stmt = $mysqli->prepare($sql);
$result_exe = $stmt->execute();

$stmt->store_result();

if ($result_exe) {
    $result_bind = $stmt->bind_result($id, $name, $tag_code, $price, $description, $gps, $posttime, $address, $image_data);
    if ($result_bind) {

//        echo '<div class="container mt-5">';

        while ($stmt->fetch()) {
            $tag = tag_code_to_tag($tag_code);
            $return_arr[] = array(
                "name" => $name,
                "description" => $description,
                "tag" => $tag,
                "price" => $price,
                "image" => base64_encode($image_data)
            );
        }
        echo json_encode($return_arr);
    }
}



$mysqli->close();

?>
