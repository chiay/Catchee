<?php

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'chiay-db';
$dbuser = 'chiay-db';
$dbpass = 'kxJB1VjEf97X9cWJ';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>
