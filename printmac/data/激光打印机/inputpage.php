<?php
	$fn = "./printer.txt";
	$f= fopen($fn, "r");
	$line = fgets($f);
	ob_start();
	fpassthru($f);
	fclose($f);
	file_put_contents($fn, ob_get_clean());
?>


<form method="post" action="fetch.php">
<input type="text" name="id" value="0" />
<input type="text" name="url"  value="<?php echo $line;?>" />
<input type="submit" name="ok" />
</form>