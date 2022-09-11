<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ini_set("log_errors", 1);
// if (is_file('./error.log')) {
//     // unlink('./error.log');
// }
// ini_set("error_log", "./error.log");
// ------------ //
echo "<h1>PHPen</h1>";
echo "<br>";
echo'<br>';
h1('Überschrift in groß');
echo date("l jS of F Y h:i:s A");
echo'<br>';
$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";
echo'<br>';
h2($txt1);
print "Study PHP at " . $txt2 . "<br>";
echo'<br>';
$colors = array("red", "green", "blue", "yellow"); 
h2('Colors');
foreach ($colors as $value) {
  echo "$value <br>";
}
echo'<br>';
$movies =array(
"comedy" => array("Pink Panther", "John English", "See no evil hear no evil"),
"action" => array("Die Hard", "Expendables"),
"epic" => array("The Lord of the rings"),
"Romance" => array("Romeo and Juliet")
);
echo'<br>';
h2('Nice Array printing');
print_r($movies);