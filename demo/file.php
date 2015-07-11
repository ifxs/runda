<?php
$fp = fopen("./b.txt",'r');
echo ftell($fp);
// fwrite($fp,'slfjlsdfjldsjf11111111111ldsjlfjdslf');
echo fread($fp,2);