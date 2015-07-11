<?php
	$pos = strrpos("E:/lamp/Apache24/htdocs/runda/Content/image/usinesslicense/20150412/20150412143527280.jpg","Content");
	echo $pos."<br />";
	$rest = substr("E:/lamp/Apache24/htdocs/runda/Content/image/usinesslicense/20150412/20150412143527280.jpg",$pos);   
	echo "/".$rest."<br />";
?>