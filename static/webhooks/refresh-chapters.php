<?php

$chapter_string = file_get_contents("./sample-chapter-data.json");
$chapter_json = json_decode($chapter_string, true);

var_dump($chapter_json);

// Sort the chapter json into an array for each state
// For each school in each state
 ?>
