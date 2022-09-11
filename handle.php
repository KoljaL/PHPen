<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//
// this code ist added before the code from the editor
// for displaying errors or whatever
$display_errors = <<<PHP
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
echo "<h1 style='color:#7175AA; margin:0;'>PHPen</h1>";
echo "<br>";
PHP;



//
// to execute code, get it from json input & save it in '_output.php'
//
if (isset($_GET['execute'])) {
    $data = json_decode(file_get_contents('php://input'));
    if ($_GET['execute'] !== '' && $_GET['execute'] !== 'default.php') {
        $newFile = $_GET['execute'];
        file_put_contents('./files/'.$newFile, $data);
    }
    // add a line break to empty lines
    $data = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\necho'<br>';\n", $data);
    $data = str_replace('<?php', $display_errors, $data);
    file_put_contents('./files/_output.php', $data);
    echo json_encode($data);
}



//
// read file content to fill in editor
//
if (isset($_GET['getContent'])) {
    if (is_file('./files/'.$_GET['getContent'])) {
        $file = $_GET['getContent'];
    } else {
        $file = 'default.php';
    }
    $fileContent = file_get_contents('./files/'.$file);
    echo json_encode($fileContent);
}


//
// delete file
//
if (isset($_GET['deleteFile'])) {
    $file = $_GET['deleteFile'];
    unlink('./files/'.$file);
    echo json_encode('deleted');
}



//
// create a fileList for DropDown
//
if (isset($_GET['fileList'])) {
    $fileList='';
    foreach (glob("./files/*") as $path) {
        if ($path === './files/_output.php') {
            continue;
        }
        $filename = basename($path);
        if ($filename === $_GET['fileList']) {
            $fileList .= "<option selected value='$filename'>$filename</option>\n";
        } else {
            $fileList .= "<option value='$filename'>$filename</option>\n";
        }
    }
    echo json_encode($fileList);
}
