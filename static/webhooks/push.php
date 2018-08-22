<?php
chdir('/home/dh_ij9i3a/hugo.ssdp.org');
$git_pull_output = shell_exec('git pull');
// Need to run gulp just once here, too.
$hugo_output = shell_exec('../hugo');
?>
