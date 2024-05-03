<?php
class CentroAcopioModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    /**
     * Listar peliculas
     * @param 
     * @return $vresultado - Lista de objectos
     */
    //
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM centroAcopio order by id asc;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /**
     * Obtener una pelicula
     * @param $id de la pelicula
     * @return $vresultado - Objeto pelicula
     */
    //

    public function get($id)
    {
        try {

            $provincia = new ProvinciaModel();
            $canton = new CantonModel();
            $usuario = new UsuarioModel();
            $material_CentroAcopio = new Material_CentroAcopioModel();

        
            $vSql = "SELECT * from centroAcopio where id = $id";

            //Ejecutar la consulta sql
            $vResultado = $this->enlace->executeSQL($vSql);
            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                $ListadoProvincias = $provincia->getProvinciaCentroAcopio($id);
                $vResultado->provincia = $ListadoProvincias[0];

                $listadoCantones = $canton->getCantonCentroAcopio($id);
                $vResultado->canton = $listadoCantones[0];

                $ListadoUsuarios = $usuario->getUsuarioCentroAcopio($id);
                $vResultado->usuario = $ListadoUsuarios[0];

                $ListadoMateriales_CentroAcopio = $material_CentroAcopio->getmaterial_centroAcopio($id);
                $vResultado->materiales = $ListadoMateriales_CentroAcopio;
            }
            //Retornar la respuesta
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getCentroAcopio($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM centroacopio where id=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto

            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtener pelicula para mostrar información en Formulario
     * @param $id de la pelicula
     * @return $vresultado - Objeto pelicula
     */
    //
    public function getForm($id)
    {
        try {

            //Consulta sql
            $vSql = "SELECT * FROM centroAcopio where id=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            $vResultado = $vResultado[0];

            // Retornar el objeto
            return $vResultado;

        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function getCountByGenre($param)
    {
        try {
            $vResultado = null;
            //Consulta sql
            $vSql = "SELECT count(mg.genre_id) as 'Cantidad', g.title as 'Genero'
			FROM genre g, centroAcopio_genre mg, centroAcopio m
			where mg.centroAcopio_id=m.id and mg.genre_id=g.id
			group by mg.genre_id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /**
     * Crear pelicula
     * @param $objeto pelicula a insertar
     * @return $this->get($idcentroAcopio) - Objeto pelicula
     */
    //
    public function create($objeto)
    {
        try {
            //Consulta sql
            //Identificador autoincrementable

            $sql = "Insert into centroAcopio (title, year, time, lang, director_id)" .
                "Values ('$objeto->title','$objeto->year','$objeto->time','$objeto->lang', $objeto->director_id)";

            //Ejecutar la consulta
            //Obtener ultimo insert
            $idcentroAcopio = $this->enlace->executeSQL_DML_last($sql);
            //--- Generos ---
            //Crear elementos a insertar en generos
            foreach ($objeto->genres as $genre) {
                $dataGenres[] = array($idcentroAcopio, $genre);
            }
            /* $dataGenres=array(
                array(1,7),
                array(1,8)
                ); */

            foreach ($dataGenres as $row) {

                $valores = implode(',', $row);
                $sql = "INSERT INTO centroAcopio_genre(centroAcopio_id,genre_id) VALUES(" . $valores . ");";
                $vResultado = $this->enlace->executeSQL_DML($sql);
            }
            //--- Actores ---
            //Crear elementos a insertar en actores
            foreach ($objeto->actors as $row) {
                $sql = "INSERT INTO centroAcopio_cast(centroAcopio_id,actor_id,role) VALUES($idcentroAcopio, $row->actor_id,'$row->role')";
                $vResultado = $this->enlace->executeSQL_DML($sql);
            }
            //Retornar pelicula
            return $this->get($idcentroAcopio);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /**
     * Actualizar pelicula
     * @param $objeto pelicula a actualizar
     * @return $this->get($idcentroAcopio) - Objeto pelicula
     */
    //
    public function update($objeto)
    {
        try {
            //Consulta sql

            $sql = "Update centroAcopio SET title ='$objeto->title'," .
                "year ='$objeto->year',time ='$objeto->time',lang ='$objeto->lang'," .
                "director_id=$objeto->director_id" .
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);
            //--- Generos ---
            //Borrar Generos existentes asignados

            $sql = "Delete from centroAcopio_genre Where centroAcopio_id=$objeto->id";
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Crear elementos a insertar en generos
            foreach ($objeto->genres as $genre) {
                $dataGenres[] = array($objeto->id, $genre);
            }

            foreach ($dataGenres as $row) {

                $valores = implode(',', $row);
                $sql = "INSERT INTO centroAcopio_genre(centroAcopio_id,genre_id) VALUES(" . $valores . ");";
                $vResultado = $this->enlace->executeSQL_DML($sql);

            }
            //--- Actores ---

            $sql = "Delete from centroAcopio_cast Where centroAcopio_id=$objeto->id";
            $cResults = $this->enlace->executeSQL_DML($sql);
            //Crear elementos a insertar en actores
            foreach ($objeto->actors as $row) {
                $dataActors[] = array($objeto->id, $row->actor_id, $row->role);
            }
            foreach ($dataActors as $row) {

                $sql = "INSERT INTO centroAcopio_cast(centroAcopio_id,actor_id,role) VALUES($row[0],$row[1],'$row[2]');";
                $vResultado = $this->enlace->executeSQL_DML($sql);

            }
            //Retornar pelicula
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}