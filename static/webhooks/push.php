<?php
$date = new DateTime();

$log_file = 'hugo_webhook.txt';
$handle = fopen($log_file, 'w') or die('Cannot open file:  '.$log_file); //implicitly creates file

chdir('/home/dh_ij9i3a/hugo.ssdp.org');
$fetch_time = $date->getTimestamp();
$git_fetch_output = shell_exec("git fetch --all 2>&1");
fwrite($handle, $fetch_time . ": " . $git_fetch_output . "\n");
chdir('/home/dh_ij9i3a/hugo.ssdp.org');
$reset_time = $date->getTimestamp();
$git_reset_output = shell_exec("git reset --hard 2>&1");
fwrite($handle, $reset_time . ": " . $git_reset_output. "\n");

// We'll need to run gulp here as well, but for now we're getting errors
// It's not mission-critical, since people won't likely be editing scss
chdir('/home/dh_ij9i3a/hugo.ssdp.org');
$hugo_time = $date->getTimestamp();
$hugo_output = shell_exec("/home/dh_ij9i3a/hugo 2>&1");
fwrite($handle, $hugo_time . ": " . $hugo_output. "\n");
echo($hugo_output);
?>
