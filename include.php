<?php

# The $pattern variable defines the email addresses we'll sanitize.
$pattern = "/([^@\s]*)@[^@\s]*\.[^@\s]*/";

# If the php is not in the same path as the mbox.txt files, add it here.
$bin_path="OldSiteArchives";

# The $replacement defines what to replace it with when found.
$replacement = "[removed]";

$baseurl = "http://corvette-resto.com/OldSiteArchives/";
$filebase = "/home/linderor/public_html/corvette-resto.com/private_files/crpl";
$view_email = "view_email.php";

# Set a lower boundary for searching
$archive_start_year = 2000;

$match_count = 50;

$find_str = "nonsense_text_for_base_search";

$include_success = 1;

// Setup basic error reporting and include paths/files.
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set("include_path", '/home/linderor/php:' . ini_get("include_path") ); 

// Include modules for the project.
require_once 'Mail/Mbox.php';
require_once 'HTTP/Request2.php';

function sanitize_int($in, $sane, $min, $max) {
  if (is_int( (int)$in )) {
		// We know this is an integer so massage it into what we need.
		$in = (int)$in;
		if ( ($in < $min) or ($in > $max) ) {
			$in = $sane;
		}
	} else {
		// Set a sane value
		$in = $sane;
	}
    return $in;
}

?>
