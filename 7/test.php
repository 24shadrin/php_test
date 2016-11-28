<?php
$handle = opendir('small');
			if ($handle != false)
			{

					while (false !== ($file = readdir($handle)))
						
					if ($file != '.' && $file != '..')
					{
						$fpath = "small/"."$file"; 
						echo "<img src=$fpath>";
					}
						closedir($handle);
			}
						
?>