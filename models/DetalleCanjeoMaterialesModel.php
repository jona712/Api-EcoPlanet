<?php
class DetalleCanjeoMaterialesModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM detalle_canjeomateriales";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function get($id)
    {
        try {

            $vSql = "SELECT dcm.id, dcm.idcanjeo, m.nombre as material, m.descripcion, m.color, dcm.cantidad, dcm.precio
            FROM detalle_canjeomateriales dcm, material m
            WHERE dcm.idCanjeo = $id AND dcm.idmaterial = m.id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getCanjeoMaterialesByIdUsuario($id)
    {
        try {

            //Consulta sql
            $vSql = "SELECT cm.id, cm.fecha, cm.usuario, u.nombre, cm.centroacopio, cm.totalEcomonedas
            FROM canjeomateriales cm, usuario u
            WHERE cm.usuario = u.id AND cm.usuario = $id ORDER BY cm.id ASC";

            $vResultado = $this->enlace->executeSQL($vSql);

            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function create($objeto)
    {
        try {
            //Consulta sql
            //Identificador autoincrementable

            $vSql = "Insert into genre (title) Values ('$objeto->title')";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);
            // Retornar el objeto creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function update($objeto)
    {
        try {
            //Consulta sql
            $vSql = "Update genre SET title ='$objeto->title' Where id=$objeto->id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);
            // Retornar el objeto actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}