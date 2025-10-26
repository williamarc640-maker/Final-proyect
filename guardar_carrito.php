<?php
session_start();
$input = file_get_contents("php://input");
$data = json_decode($input, true);
if (isset($data["car"]) && is_array($data["car"])) {
    $_SESSION["car"] = $data["car"];
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Datos inválidos"]);
}
?>