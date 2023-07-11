<?php
require_once("../config/conexion.php");
require_once("../models/_auth.php");
$auth = new _auth();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "sign_up":
        echo json_encode($auth->sign_up($body));
        break;

    case "sign_in":
        echo json_encode($auth->sign_in($body));
        break;
}
