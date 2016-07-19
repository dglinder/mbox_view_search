<?php
//read the subjects of the demo mailbox
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set("include_path", '/home/linderor/php:' . ini_get("include_path") );

$include_success = 0;
#$inc_file = $_SERVER['DOCUMENT_ROOT']."/".$bin_path."/include.php";
$inc_file = "include.php";
include $inc_file;
if ($include_success == 0) {
	echo "<PRE>Failure to include files: ".$inc_file."</pre>";
	exit(1);
}

if ( isset($_POST["find_str"]) ) {
	$find_str = $_POST["find_str"];
} else {
	$find_str = "";
}

$match_count = 0;

echo '<html>';  # Start the page.

// Print the common search field on each page.
echo '<head><title>Form:'.$find_str.'</title></head><body>
<h1>Enter word to search for</h1>
	<form method="post" action="test_mail.php">
  	<input type="text" name="find_str" value="'.$find_str.'"/>
  	<input type="text" name="start_year" value="'.$start_year.'"/>
  	<input type="text" name="start_month" value="'.$start_month.'"/>
  	<input type="text" name="start_index" value="'.$start_index.'"/>

  	<input type="submit">
 </form>
</body>';

// Only search for the first word provided
list($find_str,) = explode(' ', $find_str);

if ( ! empty($find_str) ) {
	// Search for the word we're given.
	if ( isset($_POST["start_month"]) ) {
		$start_month = $_POST["start_month"] || -1;
	} else {
		$start_month = 1;
	}

	if ( isset($_POST["start_year"]) ) {
		$start_year  = $_POST["start_year"] || -1;
	} else {
		$start_year = $archive_start_year;
	}
	
	# Sanitize the year
	$start_year = sanitize_int($start_year, $archive_start_year, $archive_start_year, PHP_INT_MAX);
	$start_year = sprintf("%04d", $start_year);

	# Sanitize the month
	$start_month = sanitize_int($start_month, 1, 1, 12);
	$start_month = sprintf("%04d", $start_month);

	# Sanitize the index
	$start_index = sanitize_int($start_index, 0, 0, PHP_INT_MAX);
	$start_index = sprintf("%04d", $start_index);

echo '<PRE>YEAR: '.$start_year.' - MONTH: '.$start_month.' - INDEX: '.$start_index.'</PRE>';

}

echo '</html>
'; # end the page.
?>
