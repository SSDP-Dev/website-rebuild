<?php

$configs = include('config.php');

// define variables and set to empty values
$first_name = $last_name = $email = $mobile_number = $signup_email_opt_in = "test";
$signup_mobile_opt_in = $phone_number = $signup_submitted_address = "test";
$signup_is_volunteer = $signup_activity_is_private = "test";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $email = test_input($_POST["email"]);
  $mobile_number = test_input($_POST["mobile_number"]);
  $signup_email_opt_in = test_input($_POST["signup_email_opt_in"]);
  $signup_mobile_opt_in = test_input($_POST["signup_mobile_opt_in"]);
  $phone_number = test_input($_POST["phone_number"]);
  $signup_submitted_address = test_input($_POST["signup_submitted_address"]);
  $signup_is_volunteer = test_input($_POST["signup_is_volunteer"]);
  $signup_activity_is_private = test_input($_POST["signup_activity_is_private"]);

  echo($first_name);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
