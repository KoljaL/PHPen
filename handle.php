<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['execute'])) {
    $data = json_decode(file_get_contents('php://input'));
    // add a line break to empty lines
    $data = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\necho'<br>';\n", $data);
    file_put_contents('./files/_output.php', $data);
    echo json_encode($data);
}

if (isset($_GET['getContent'])) {
    $file = $_GET['getContent'];
    $fileContent = file_get_contents('./files/'.$file);
    echo json_encode($fileContent);
}


if (isset($_GET['fileList'])) {
    $fileList='';
    foreach (glob("./files/*") as $path) {
        if ($path === './files/_output.php') {
            continue;
        }
        $filename = basename($path);
        $fileList .= "<option value='$filename'>$filename</option>\n";
    }
    echo json_encode($fileList);
}