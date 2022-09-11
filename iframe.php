<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ini_set("log_errors", 1);
// if (is_file('./error.log')) {
//     // unlink('./error.log');
// }

// write error to file
ini_set("error_log", "./error.log");

// include & start external error reporting
// https://tqdev.com/2021-php-7-error-handling-class
include 'ErrorReporting.php';
ErrorReporting::start(true); // false for production

// load php file to display in iframe
include 'files/_output.php'; // some file with a PHP error
