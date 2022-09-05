<?php


if (isset($_GET['execute'])) {
    $data = json_decode(file_get_contents('php://input'));
    file_put_contents('./files/default.php', $data);
    echo json_encode($data);
}