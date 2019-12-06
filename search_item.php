<?php

include("db_conn.php");

<<<<<<< HEAD
$item_name = $_POST['search_phrase'];

=======
$item_name = $_POST['item_name'];
>>>>>>> 863915973a69b1667831272773a48cdb1353a34e
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
<<<<<<< HEAD
            return "Transportation";
=======
            return "Transporation";
>>>>>>> 863915973a69b1667831272773a48cdb1353a34e
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
<<<<<<< HEAD
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

//            echo '<div class="row">';
//            echo '<div class="col">';
//
//            echo '</div>';
//            echo '<div class="col">';
//            echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" class="card-img-top" alt="" height="200" width="200" align="left">';
//            echo '<p><b>Product Name       : </b>' . $name . '</p> ';
//            echo '<p><b>Product Description: </b>' . $description . '</p> ';
//            echo '<p><b>Product Category   : </b>' . $tag . '</p> ';
//            echo '<p><b>Price              : </b>' . '$' . $price . '</p> ';
//            echo '</div>';
//            echo '<br></br>';
//            echo '<br></br>';
//        }
//        echo '</div>';
//    } else {
//        echo "0 result";
//        }
//    }
//}

=======
        echo '<div class="container mt-5">';

        while ($stmt->fetch()) {
            $tag = tag_code_to_tag($tag_code);
            echo '<div class="row">';
            echo '<div class="column">';

            echo '</div>';
            echo '<div class="column">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" class="card-img-top" alt="" height="200" width="200" align="left">';
            echo '<p><b>Product Name       : </b>' . $name . '</p> ';
            echo '<p><b>Product Description: </b>' . $description . '</p> ';
            echo '<p><b>Product Category   : </b>' . $tag . '</p> ';
            echo '<p><b>Price              : </b>' . '$' . $price . '</p> ';
            echo '</div>';
            echo '<br></br>';
            echo '<br></br>';
        }
        echo '</div>';
    } else {
        echo "0 result";
    }
}

>>>>>>> 863915973a69b1667831272773a48cdb1353a34e
$mysqli->close();

?>

