<?php

$include_success = 0;
$inc_file = $_SERVER['DOCUMENT_ROOT']."/".$bin_path."/include.php";
include $inc_file;
if ($include_success == 0) {
	echo "<PRE>Failure to include files: ".$inc_file."</pre>";
	exit(1);
}

$find_str = $_POST["find_str"] || "";
$match_count = 0;

echo '<html>';  # Start the page.

// Print the common search field on each page.
echo '<head><title>Form:'.$find_str.'</title></head><body>
<h1>Enter word to search for</h1>
	<form method="post" action="test_mail.php">
  	<input type="text" name="find_str">'.$find_str.'</input>
  	<input type="submit">
 </form>
</body>';

// Only search for the first word provided
list($find_str,) = explode(' ', $find_str);

if ( ! empty($find_str) ) {
	// Search for the word we're given.
	$start_month = $_POST["start_month"] || -1;
	$start_year  = $_POST["start_year"] || -1;
	
	# Sanitize the year
	if (is_int( (int)$start_year )) {
		// We know this is an integer so massage it into what we need.
		$start_year = (int)$start_year;
		if ($start_year < $archive_start_year) {
			$start_year = $archive_start_year;
		}
	} else {
		// Set a sane value
		$start_year = $archive_start_year;
	}
	$start_year = sprintf("%04d", $start_year);

	# Sanitize the month
	if (is_int( (int)$start_month )) {
		// We know this is an integer so massage it into what we need.
		$start_month = (int)$start_month;
		if ( ($start_month < 1) or ($start_month > 12) ) {
			$start_month = 1;
		}
	} else {
		// Set a sane value
		$start_month = 1;
	}
	$start_month = sprintf("%04d", $start_month);

	# Sanitize the index
	if (is_int( (int)$start_index )) {
		// We know this is an integer so massage it into what we need.
		$start_index = (int)$start_index;
		if ($start_index < 1) {
			$start_index = 1;
		}
	} else {
		// Set a sane value
		$start_index = 1;
	}
	$start_index = sprintf("%04d", $start_index);


	
}


echo '</html>'; # end the page.
?>
