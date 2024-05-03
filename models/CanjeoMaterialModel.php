<?php
class CanjeoMaterialesModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    public function all($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT cm.id, cm.fecha, ca.nombre as centroacopio, cm.totalEcomonedas
            FROM canjeomateriales cm, centroacopio ca
            WHERE cm.usuario = $id AND cm.centroacopio = ca.id";

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
            $Usuario = new UsuarioModel();
            $CentroAcopio = new CentroAcopioModel();
            $Detalles_CanjeoMateriales = new DetalleCanjeoMaterialesModel();

            //Consulta sql
            $vSql = "SELECT * FROM canjeomateriales where id =$id";

            //Ejecutar la consulta

            $vResultado = $this->enlace->executeSQL($vSql);
            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                $ListadoUsuario = $Usuario->get($vResultado->usuario);
                $vResultado->usuario = $ListadoUsuario[0];

                $ListadoCentroAcopio = $CentroAcopio->getCentroAcopio($vResultado->centroAcopio);
                $vResultado->centroAcopio = $ListadoCentroAcopio[0];

                $ListadoDeatalles_CanjeoMateriales = $Detalles_CanjeoMateriales->get($id);
                $vResultado->detalles = $ListadoDeatalles_CanjeoMateriales;
            }
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
            $vSql = "SELECT cm.id, cm.fecha, cm.usuario, u.nombre, cm.centroacopio as idCentroAcopio, ca.nombre as centroacopio,  cm.totalEcomonedas
            FROM canjeomateriales cm, usuario u, centroacopio ca
            WHERE cm.usuario = u.id AND cm.centroacopio = ca.id AND cm.usuario = $id ORDER BY cm.id ASC";

            $vResultado = $this->enlace->executeSQL($vSql);

            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getAdmin($id)
    {
        try {

            //Consulta sql
            $vSql = "SELECT cm.id, cm.Fecha, cm.usuario AS cliente, 
            us.nombre AS NombreCliente, cm.CentroAcopio, 
            cm.TotalEcoMonedas, cp.nombre, p.descripcion AS provincia, 
            c.descripcion AS canton, cp.Usuario AS idAmin, 
            us_admin.nombre AS nombreAdmin
            FROM canjeomateriales cm
            JOIN usuario us ON us.id = cm.Usuario
            JOIN centroacopio cp ON cm.CentroAcopio = cp.id
            JOIN provincia p ON cp.Provincia = p.id
            JOIN canton c ON cp.Canton = c.id
            JOIN usuario us_admin ON cp.Usuario = us_admin.id
            WHERE us_admin.id <> cm.Usuario AND cp.Usuario = 1";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSql);

            // Retornar el objeto
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