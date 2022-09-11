<?php
 

h1('Überschrift in groß');
echo date("l jS of F Y h:i:s A");
 



$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";
 
 
h2($txt1);
print "Study PHP at " . $txt2 . "<br>";

$colors = array("red", "green", "blue", "yellow"); 
h2('Colors');
foreach ($colors as $value) {
  echo "$value <br>";
}

$movies =array(
"comedy" => array("Pink Panther", "John English", "See no evil hear no evil"),
"action" => array("Die Hard", "Expendables"),
"epic" => array("The Lord of the rings"),
"Romance" => array("Romeo and Juliet")
);

h2('Nice Array printing');
print_r($movies);