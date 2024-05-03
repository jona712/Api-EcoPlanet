<?php
class UsuarioModel
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
            $vSql = "SELECT * FROM usuario;";

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
            $vSql = "SELECT * FROM usuario where id=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto

            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getUsuarioForm($id)
    {
        try {

            $tipoUsuario = new TipoUsuarioModel();
            $provincia = new ProvinciaModel();
            $canton = new CantonModel();
            $distrito = new DistritoModel();

            //Consulta sql
            $vSql = "SELECT * FROM usuario where id=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                $ListadoTipoUsuario = $tipoUsuario->get($vResultado->TipoUsuario);
                $vResultado->TipoUsuario = $ListadoTipoUsuario[0];

                $ListadoProvincias = $provincia->get($vResultado->Provincia);
                $vResultado->Provincia = $ListadoProvincias[0];

                $listadoCantones = $canton->get($vResultado->Canton);
                $vResultado->Canton = $listadoCantones[0];

                $listadoDistrito = $distrito->get($vResultado->Distrito);
                $vResultado->Distrito = $listadoDistrito[0];
            }
            // Retornar el objeto

            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getUsuarioCentroAcopio($idCentroAcopio)
    {
        try {
            //Consulta sql
            $vSql = "SELECT u.id, u.nombre, u.correo, u.telefono, u.contrasena, u.tipousuario, u.provincia, u.canton, u.distrito
            FROM usuario u, centroacopio c
            WHERE c.usuario = u.id and c.id = $idCentroAcopio
            ";

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