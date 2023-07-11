<?php
class _auth extends Conectar
{
    public function sign_up($REQUEST)
    {
        $db = parent::conexion();
        parent::set_names();
        /* Query */
        $sql = "INSERT INTO usuario (nombre, apellido, correo, password, descripcion, habilidades, tipo_usuario_id) VALUES (?,?,?,?,?,?,?)";

        $sql = $db->prepare($sql);
        $sql->bindValue(1, $REQUEST['nombre']);
        $sql->bindValue(2, $REQUEST['apellido']);
        $sql->bindValue(3, $REQUEST['correo']);
        $sql->bindValue(4, $REQUEST['password']);
        $sql->bindValue(5, $REQUEST['descripcion']);
        $sql->bindValue(6, $REQUEST['habilidades']);
        $sql->bindValue(7, $REQUEST['tipo_usuario_id']);
        $resultado['estatus'] =  $sql->execute();
        return $resultado;
    }

    public function sign_in($REQUEST)
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM usuario WHERE correo = ? AND password = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $REQUEST['correo']);
        $sql->bindValue(2, $REQUEST['password']);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id_usuario' => (int)$d->id_usuario,
                'nombre' => $d->nombre,
                'apellido' => $d->apellido,
                'tipo_usuario_id' => $d->tipo_usuario_id,
            ];
        }
        return $Array;
    }
}