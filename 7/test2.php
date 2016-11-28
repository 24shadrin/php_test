<?php
$filelist = array();

	if ($handle = opendir("small")) {

	    while ($entry = readdir($handle)) {

	        if (is_file($entry)) {

	            $filelist[] = $entry;
				echo "$entry";
	        }
		}

	    closedir($handle);
	}

	print_r($filelist);
?>