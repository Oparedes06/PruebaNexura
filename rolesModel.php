<?php
require_once 'conexion.php';
class rolesModel
{
    private $pdo;

    public $nombre;

    public function __construct()
    {
        try {
            $this->pdo = conexion::Conectar();
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    public function listar()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM roles");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    public function obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM roles WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    public function asignarEmpleado(int $rol, int $empleado)
    {
        try {
            $sql = "INSERT INTO empleado_rol (empleado_id, rol_id)
            VALUES (?, ?)";

            $stm = $this->pdo->prepare($sql)->execute(array(
                $empleado,
                $rol
            ));
            return $this->pdo->lastInsertId();
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

}

?>