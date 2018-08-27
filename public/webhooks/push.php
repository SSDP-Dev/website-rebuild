<?php
chdir('/home/dh_ij9i3a/hugo.ssdp.org');
$git_pull_output = shell_exec("git pull 2>&1");
// We'll need to run gulp here as well, but for now we're getting errors
// It's not mission-critical, since people won't likely be editing scss
$hugo_output = shell_exec("../hugo 2>&1");
?>
