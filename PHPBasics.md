#Tips on PHP usage

## Types ##
**PHP is dynamically typed** Arrays remember iterator pos, and are not reindexed in deletion/addition

Standard types
```
<?php
$a = 23; //ints
$b = -24;
$c = 1.234; // float
$d = 'Alasdair'; //string (will not expand variables)
$e = "Alasdair likes $pref_fruit"; //string (WILL expand pref_fruit var)
?>
```