<?php

echo "<h1>PHPen</h1>";

echo date("l jS of F Y h:i:s A");


$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";
$x = 5;
$y = 4;

print "<h2>" . $txt1 . "</h2>";
print "Study PHP at " . $txt2 . "<br>";
print $x + $y;

$colors = array("red", "green", "blue", "yellow"); 
print "<h2>Colors</h2>";
foreach ($colors as $value) {
  echo "$value <br>";
}

$movies =array(
"comedy" => array("Pink Panther", "John English", "See no evil hear no evil"),
"action" => array("Die Hard", "Expendables"),
"epic" => array("The Lord of the rings"),
"Romance" => array("Romeo and Juliet")
);
print "<h2>Nice Array printing</h2>";
print_r($movies);