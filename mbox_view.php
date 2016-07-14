<?php

$include_success = 0;
$inc_file = $_SERVER['DOCUMENT_ROOT']."/".$bin_path."/include.php";
include $inc_file;
if ($include_success == 0) {
	echo "<PRE>Failure to include files: ".$inc_file."</pre>";
	exit(1);
}

$find_str = $_POST["find_str"];
$match_count = 0;

echo '<html>';  # Start the page.

// Print the common search field on each page.
echo '<head><title>Form:'.$find_str.'</title></head><body>
<h1>Enter word to search for</h1>
	<form method="post" action="test_mail.php">
  	<input type="text" name="find_str">
  	<input type="submit">
 </form>
</body>';

list($find_str,) = explode(' ', $find_str);

echo '</html>'; # end the page.
?>
