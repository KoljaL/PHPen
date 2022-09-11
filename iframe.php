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

echo "<!DOCTYPE html>";
echo "<style>
    ::-webkit-scrollbar {
      display: none;
    }

    * {
      -ms-overflow-style: none;
      scrollbar-width: none;
      box-sizing: border-box;
    }
    body{
      background-color: rgb(30, 30, 30);
      color: rgb(174, 175, 173);
      font-family: monospace;
      font-size: 16px;
      white-space: pre-wrap;
    }
    h1{
      color:#7175AA; 
      margin-top:1rem; 
      margin-bottom:1rem; 
      border-bottom: 1px solid #7175AA;
    }
    h2,h3{
      color:#569cd6;
      margin-top:1rem; 
      margin-bottom:1rem; 
    }
  </style>";


// load some functions for the iframe
include 'functions.php';  

// load php file to display in iframe
include 'files/_output.php';  
