<?php
chdir('/home/dh_ij9i3a/hugo.ssdp.org');
$output_log = '/home/dh_ij9i3a/hugo.ssdp.org/hugo_webhook.txt';
$handle = fopen($output_log, 'w') or die('Cannot open file:  '.$output_log); //implicitly creates file
$git_pull_output = shell_exec("git pull 2>&1");
fwrite($handle, $git_pull_output . "\n")
// We'll need to run gulp here as well, but for now we're getting errors
// It's not mission-critical, since people won't likely be editing scss
$hugo_output = shell_exec("../hugo 2>&1");
fwrite($handle, $hugo_output . "\n")
?>
