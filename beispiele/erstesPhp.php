<?php
echo "Erstes PHP Skript <br>";
//phpinfo();
$arr = [1, "zwei", 3.3, "vier"];
$i = 0;
while($i < count($arr)) {
      echo $arr[$i];
      $i++;
}