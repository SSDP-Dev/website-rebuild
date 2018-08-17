<?php

$configs = include('config.php');
// NationBuilder configuration
$NB_ACCESS_TOKEN = $configs['token'];
$NATION_SLUG = $configs['slug'];

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

  // Construct person array with data
  // Convert array to JSON
  // Send JSON to NationBuilder person endpoint

}

function test_input($data) {
  // Test input for any nefarious activity
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function nationbuilderPost($endpoint, $body) {
  // Make the curl request
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFILES => $body,
    CURLOPT_HTTPHEADER => array(
      'Content-Type:application/json'
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  $response = json_decode($response, true); //because of true, it's in an array

  return $response;
}

?>
