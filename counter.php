<?php
$counter_file = "count.dat";
if(file_exists($counter_file)) {
if(!($fp = fopen($counter_file, "r+")))
die("Cannot open $counter_file");
$counter = (int) fread($fp, filesize($counter_file));
$counter++;
echo "<b style='float:left;'>Total Visits: ".$counter." </b>";
rewind($fp);
}
else {
if(!($fp = fopen($counter_file, "w")))
die("Cannot open $counter_file");
echo "Visited. $counter.";
}
fwrite($fp, $counter);
fclose($fp);
?>