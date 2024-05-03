<?php
class ProvinciaModel
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
            $vSql = "SELECT * FROM provincia;";

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
            //Consulta sql
            $vSql = "SELECT * FROM provincia where id=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getProvinciaCentroAcopio($idCentroAcopio)
    {
        try {
            //Consulta sql
            $vSql = "SELECT p.id,p.descripcion 
            FROM provincia p, centroAcopio c
            WHERE p.id = c.provincia AND c.id=$idCentroAcopio";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getMoviesbyGenre($param)
    {
        try {
            $vResultado = null;
            if (!empty($param)) {
                $vSql = "SELECT m.id, m.lang, m.time, m.title, m.year
				FROM movie_genre mg, movie m
				where mg.movie_id=m.id and mg.genre_id=$param";
                $vResultado = $this->enlace->ExecuteSQL($vSql);
            }
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