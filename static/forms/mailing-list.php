<?php

$configs = include('config.php');

// NationBuilder configuration
$NB_ACCESS_TOKEN = $configs['token'];
$NATION_SLUG = $configs['slug'];

// Set up new person endpoint
$endpoint = "https://" . $NATION_SLUG . ".nationbuilder.com/api/v1/people?access_token=" . $NB_ACCESS_TOKEN;

// define variables and set to empty values
$first_name = $last_name = $email = $mobile_number = $signup_email_opt_in = "test";
$signup_mobile_opt_in = $signup_submitted_address = "test";
$signup_is_volunteer = "test";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $email = test_input($_POST["email"]);
  $mobile_number = test_input($_POST["mobile_number"]);
  if (test_input($_POST["email_opt_in"]) == 1){
    $signup_email_opt_in = true;
  }
  else {
    $signup_email_opt_in = false;
  }
  $signup_mobile_opt_in = test_input($_POST["mobile_opt_in"]);
  if (test_input($_POST["mobile_opt_in"]) == 1){
    $signup_mobile_opt_in = true;
  }
  else {
    $signup_mobile_opt_in = false;
  }
  $signup_submitted_address = test_input($_POST["submitted_address"]);
  if (test_input($_POST["is_volunteer"]) == 1){
    $signup_is_volunteer = true;
  }
  else {
    $signup_is_volunteer = false;
  }


  // Construct person array with data
  $body = array(
    "first_name" => $first_name,
    "last_name" => $last_name,
    "email" => $email,
    "mobile" => $mobile_number,
    "email_opt_in" => $signup_email_opt_in,
    "mobile_opt_in" => $signup_mobile_opt_in,
    "submitted_address" => $signup_submitted_address,
    "is_volunteer" => $signup_is_volunteer,
    "tags" => ["mailing-list-signup"],
  );

  // Encode array to JSON
  $body = json_encode($body);

  // Format for NationBuilder API
  $body = '{
    "person" : '. $body . '
  }';

  // Send JSON to NationBuilder person endpoint
  // Retrieve response in $result as json_decoded array using TRUE arg

  $result = json_decode(nationbuilderPost($endpoint, $body), TRUE);
  $result_code = $result['code'];

  // Check what the result code was
  // If it wwas 'validation_failed' - we send them to error page
  if ($result_code == 'validation_failed'){
    header("Location: /signup-failure"); /* Redirect browser to signup-failed page */
    exit();
  }
  elseif ($result['person']) {
    header("Location: /signup-success"); /* Redirect browser to signup-failed page */
    exit();
  }
  else {
    header("Location: /signup-failure"); /* Redirect browser to signup-failed page */
    exit();
  }
}

function test_input($data) {
  // Test input for any nefarious activity
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function nationbuilderPost($endpoint, $body) {
  //create a new cURL resource
  $ch = curl_init($endpoint);
  $payload = $body;
  //attach encoded JSON string to the POST fields
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

  //set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

  //return response instead of outputting
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  //execute the POST request
  $result = curl_exec($ch);

  //close cURL resource
  curl_close($ch);

  return $result;
}

?>
