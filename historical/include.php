<?php

# The $pattern variable defines the email addresses we'll sanitize.
$pattern = "/([^@\s]*)@[^@\s]*\.[^@\s]*/";

# The $replacement defines what to replace it with when found.
$replacement = "[removed]";

$baseurl = "http://corvette-resto.com/OldSiteArchives/";
$filebase = "/home/linderor/public_html/corvette-resto.com/private_files/crpl";
$view_email = "view_email.php";

$match_count = 50;

$find_str = "nonsense_text_for_base_search";

$include_success = 1;

?>
