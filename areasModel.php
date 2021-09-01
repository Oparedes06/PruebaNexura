<?php
require_once 'conexion.php';
class areasModel
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
            $stm = $this->pdo->prepare("SELECT * FROM areas");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

    public function obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM areas WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $th) {
            die($th->getMessage());
        }
    }

}

?>