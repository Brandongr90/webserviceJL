<?php
require_once("../config/conexion.php");
require_once("../models/Productos.php");
$productos = new Productos();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAlumnos":
        $datos = $productos->get_producto();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $productos->get_productos_x_id($body["matricula_id"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $productos->insert_producto($body["matricula"], $body["nombre"], $body["fecha_nac"], $body["direccion"], $body["telefono"], $body["foto"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $productos->update_producto($body["matricula"], $body["nombre"], $body["fecha_nac"], $body["direccion"], $body["telefono"], $body["foto"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $productos->delete_producto($body["id"]);
        echo json_encode($datos);
        break;


    /* ----------------------------- MATERIAS ----------------------------- */
    case "GetMaterias":
        $datos = $productos->get_materias();
        echo json_encode($datos);
        break;

    case "InsertM":
        $datos = $productos->insert_materia($body["nombre"], $body["creditos"], $body["descripcion"]);
        echo json_encode($datos);
        break;

    case "GetIdMateria":
        $datos = $productos->get_materias_x_id($body["id_materia"]);
        echo json_encode($datos);
        break;

    case "UpdateM":
        $datos = $productos->update_materia($body["id_materia"], $body["nombre"], $body["creditos"], $body["descripcion"]);
        echo json_encode($datos);
        break;

    case "DeleteM":
        $datos = $productos->delete_materia($body["id_materia"]);
        echo json_encode($datos);
        break;


    /* ----------------------------- Asignar Materias ----------------------------- */

    case "InsertAsignacion":
        $datos = $productos->asignar_mat($body["matricula"], $body["id_materia"]);
        echo json_encode($datos);
        break;

    case "GetAlumnosR":
        $datos = $productos->get_alumnos_x_materia($body["id_materia"]);
        echo json_encode($datos);
        break;

    case "DeleteA":
        $datos = $productos->delete_asignacion($body["id"]);
        echo json_encode($datos);
        break;


    /* --------------------------- Calificaciones ------------------------ */

    case "GetAlumnosM":
        $datos = $productos->get_alumnos_x_matricula($body["matricula"]);
        echo json_encode($datos);
        break;
}
