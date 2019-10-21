<?php

// Prepare token for "keep" login
function token_generator($username, $email) {
  $key = $email . $username;
  $token = strval(hash("sha256", $key));
  return $token;
}

// Mask password with sha256
function password_hash($password) {
  $encryped = strval(hash("sha256", $password));
  return $encryped;
}

?>
