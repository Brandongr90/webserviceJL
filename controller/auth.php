<?php
require_once("../config/conexion.php");
require_once("../models/_auth.php");
$auth = new _auth();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "sign_up_pds":
        echo json_encode($auth->sign_up_pds($body));
        break;

    case "sign_up_cont":
        echo json_encode($auth->sign_up_cont($body));
        break;

    case "sign_in":
        echo json_encode($auth->sign_in($body));
        break;
}
