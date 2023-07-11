<?php
class Productos extends Conectar
{
    public function get_producto()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_alumnos;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'matricula' => (int)$d->matricula, 'nombre' => $d->nombre,
                'fecha_nac' => $d->fecha_nac, 'direccion' => $d->direccion,
                'telefono' => (int)$d->telefono, 'foto' => $d->foto
            ];
        }
        return $Array;
    }

    public function get_productos_x_id($matricula_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_alumnos WHERE matricula = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $matricula_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'matricula' => (int)$resultado->matricula, 'nombre' => $resultado->nombre,
            'fecha_nac' => $resultado->fecha_nac, 'direccion' => $resultado->direccion,
            'telefono' => (int)$resultado->telefono, 'foto' => $resultado->foto
        ] : [];
        return $Array;
    }

    public function insert_producto($matricula, $nombre, $fecha_nac, $direccion, $telefono, $foto)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tbl_alumnos`(`matricula`, `nombre`, `fecha_nac`, `direccion`, `telefono`, `foto`) VALUES (?,?,?,?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $matricula);
        $sql->bindValue(2, $nombre);
        $sql->bindValue(3, $fecha_nac);
        $sql->bindValue(4, $direccion);
        $sql->bindValue(5, $telefono);
        $sql->bindValue(6, $foto);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['matricula'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_producto($matricula, $nombre, $fecha_nac, $direccion, $telefono, $foto)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_alumnos` SET `nombre`= ?, `fecha_nac`= ?, `direccion`= ?, `telefono`= ?, `foto`= ? WHERE matricula = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $fecha_nac);
        $sql->bindValue(3, $direccion);
        $sql->bindValue(4, $telefono);
        $sql->bindValue(5, $foto);
        $sql->bindValue(6, $matricula);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_producto($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `producto` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    /* -------------- Obtener Materias --------------- */
    public function get_materias()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_materia;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id_materia' => (int)$d->id_materia, 'nombre' => $d->nombre,
                'creditos' => (int)$d->creditos, 'descripcion' => $d->descripcion
            ];
        }
        return $Array;
    }
    /* -------------- Insertar Materias --------------- */
    public function insert_materia($nombre, $creditos, $descripcion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        if(isset($nombre)){
        $sql = "INSERT INTO `tbl_materia`(`nombre`, `creditos`, `descripcion`) VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $creditos);
        $sql->bindValue(3, $descripcion);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        }
        return $resultado;
    }

    /* -------------- Obtener Materias x ID -------------- */

    public function get_materias_x_id($id_materia)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tbl_materia WHERE id_materia = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_materia);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id_materia' => (int)$resultado->id_materia, 'nombre' => $resultado->nombre,
            'creditos' => (int)$resultado->creditos, 'descripcion' => $resultado->descripcion
        ] : [];
        return $Array;
    }

    /* --------------- Actualizar Materia ----------------- */

    public function update_materia($id_materia, $nombre, $creditos, $descripcion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `tbl_materia` SET `nombre`= ?, `creditos`= ?, `descripcion`= ? WHERE id_materia = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $creditos);
        $sql->bindValue(3, $descripcion);
        $sql->bindValue(4, $id_materia);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    /* -------------------- Eliminar Materia --------------------- */

    public function delete_materia($id_materia)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_materia` WHERE id_materia = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_materia);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    /* ---------------- Asignar Alumno a Materia ----------------- */
    public function asignar_mat($matricula, $id_materia)
    {
        $conectar = parent::conexion();
        parent::set_names();
        if(isset($matricula)){
        $sql = "INSERT INTO `tbl_alumnos_has_tbl_materia`(`matricula`, `id_materia`) VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $matricula);
        $sql->bindValue(2, $id_materia);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        }
        return $resultado;
    }

    public function get_alumnos_x_materia($id_materia)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT a.matricula, a.nombre, a.telefono, m.id FROM `tbl_alumnos_has_tbl_materia` AS m INNER JOIN tbl_alumnos AS a ON a.matricula = m.matricula WHERE m.id_materia = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_materia);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        foreach ($resultado as $r) {
            $Array[] = [
                'matricula' => $r->matricula, 'nombre' => $r->nombre,
                'telefono' => $r->telefono, 'id' => $r->id
            ];
        }
        return $Array;
    }

    /* -------------------- Eliminar Asignacion --------------------- */

    public function delete_asignacion($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `tbl_alumnos_has_tbl_materia` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    /* ---------------------- Calificaciones ------------------------ */

    public function get_alumnos_x_matricula($matricula)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT id_materia FROM `tbl_alumnos_has_tbl_materia` WHERE matricula = ? GROUP BY id_materia";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $matricula);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);

        $materias = [];
        $data = [];

        foreach ($resultado as $key => $value) {

            $materias[$key] = $value->id_materia;
            
        }

        for ($i=0; $i < count($materias); $i++) { 

            $sql = "SELECT tahmi.id_materia,c.parciales_id_parciales, c.calificacion FROM `calificaciones` c INNER JOIN tbl_alumnos_has_tbl_materia tahmi ON c.tbl_alumnos_has_tbl_materia_id = tahmi.id 
            WHERE tahmi.matricula = ? AND tahmi.id_materia = $materias[$i]";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $matricula);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);

            $Array = [];
            $parcial1 = "";
            $parcial2 = "";
            $parcial3 = "";
            $materia = "";

            foreach ($resultado as $value) {

                $materia = $value->id_materia;

                if ($value->parciales_id_parciales == "1") {
                    $parcial1 = $value->calificacion;
                }elseif ($value->parciales_id_parciales == "2") {
                    $parcial2 = $value->calificacion;
                }else {
                    $parcial3 = $value->calificacion;
                }
                
            }

            $sql = "SELECT nombre FROM `tbl_materia` WHERE id_materia = ?";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $materia);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);

            $Array = [
                'materia' => $resultado[0]->nombre,
                'parcial1' => $parcial1,
                'parcial2' => $parcial2,
                'parcial3' => $parcial3,
            ];

            $data[$i] = $Array;

        }


        /* $sql = "SELECT tahmi.id_materia,c.parciales_id_parciales, c.calificacion FROM `calificaciones` c INNER JOIN tbl_alumnos_has_tbl_materia tahmi ON c.tbl_alumnos_has_tbl_materia_id = tahmi.id WHERE tahmi.matricula = ?;";

        $parcial1 = "";
        $parcial2 = "";
        $parcial3 = "";
        $materia = "";

        foreach ($resultado as $value) {

            $materia = $value->id_materia;
            if ($value->parciales_id_parciales == "1") {
                $parcial1 = $value->calificacion;
            }elseif ($value->parciales_id_parciales == "2") {
                $parcial2 = $value->calificacion;
            }else {
                $parcial3 = $value->calificacion;
            }
            
        }

        $Array[] = [
            'materia' => $materia,
            'parcial1' => $parcial1,
            'parcial2' => $parcial2,
            'parcial3' => $parcial3,
        ]; */
        
        return $data;
        /* return $resultado; */
    }
}
