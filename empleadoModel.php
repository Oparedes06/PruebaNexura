<?php
require_once 'conexion.php';
class empleadoModel
{
    private $pdo;

    public $nombre;
    public $email;
    public $sexo;
    public $area;
    public $boletin;
    public $descripcion;

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
            $stm = $this->pdo->prepare("SELECT empleados.*, areas.nombre AS area FROM empleados INNER JOIN areas ON areas.id = empleados.area_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    public function obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM empleados WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    public function guardar()
    {
        try {
            $sql = "INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion)
            VALUES (?, ?, ?, ?, ?, ?)";

            $stm = $this->pdo->prepare($sql)->execute(array(
                $this->nombre,
                $this->email,
                $this->sexo,
                $this->area,
                $this->boletin,
                $this->descripcion
            ));
            return $this->pdo->lastInsertId();
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    public function eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM empleados WHERE id = ?");
            $stm->execute(array($id));
        } catch (\Exception $exc) {
            die($exc->getMessage());
        }
    }

    public function actualizar($id)
    {
        try {
            $sql = "UPDATE empleados SET 
            nombre = ?,
            email = ?,
            sexo = ?,
            area_id = ?,
            boletin = ?,
            descripcion = ? 
            WHERE id = ?";

            $this->pdo->prepare($sql)->execute(array(
                $this->nombre,
                $this->email,
                $this->sexo,
                $this->area,
                $this->boletin,
                $this->descripcion,
                $id
            ));
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }
}

?>