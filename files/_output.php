<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("log_errors", 1);
if (is_file('./error.log')) {
    // unlink('./error.log');
}
ini_set("error_log", "./error.log");
// ------------ //
echo "<h1 style='color:#7175AA;'>PHPen</h1>";
echo "<br>";
echo'<br>';
echo "<h3>just the date & time</h3>";
echo'<br>';
echo date("l jS  F Y h:i:s");