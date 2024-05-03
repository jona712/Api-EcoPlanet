<?php
//Clase Controlador Pelicula
class Canton
{
    //GET Listar 
    public function index()
    {
        //Instancia del modelo
        $canton = new CantonModel();
        //Acción del modelo a ejecutar
        $response = $canton->all();
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        //Escribir respuesta JSON con código de estado HTTP
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
    //GET Obtener 
    public function get($id)
    {
        //Instancia del modelo
        $canton = new CantonModel();
        //Acción del modelo a ejecutar
        $response = $canton->get($id);
        //Verificar respuesta
        if (isset($response) && !empty($response)) {
            //Armar el JSON respuesta satisfactoria
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            //JSON respuesta negativa
            $json = array(
                'status' => 400,
                'results' => "No existe el recurso solicitado"
            );
        }
        //Escribir respuesta JSON con código de estado HTTP
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }

    
    //GET Obtener con formato para formulario
    /*public function getForm($id)
    {
        //Instancia del modelo     
        $canton = new CantonModel();
        $json = array(
            'status' => 400,
            'results' => "Solicitud sin identificador"
        );
        //Verificar párametro
        if (isset($id) && !empty($id) && $id !== 'undefined' && $id !== 'null') {
            //Acción del modelo a ejecutar
            $response = $canton->getForm($id);
            //Verificar respuesta
            if (isset($response) && !empty($response)) {
                //Armar el json
                $json = array(
                    'status' => 200,
                    'results' => $response
                );
            } else {
                $json = array(
                    'status' => 400,
                    'results' => "No existe el recurso solicitado"
                );
            }

        }
        //Escribir respuesta JSON con código de estado HTTP
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
    */

    /*
    public function getCountByGenre($param)
    {
        //Instancia del modelo
        $canton = new CantonModel();
        //Acción del modelo a ejecutar
        $response = $canton->getCountByGenre($param);
        //Verificar respuesta
        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        //Escribir respuesta JSON con código de estado HTTP
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
    */
    /*public function getcantonsbyGenre($param){
        //Instancia del modelo
        $genre=new GenreModel();
        //Acción del modelo a ejecutar
        $response=$genre->getcantonsbyGenre($param);
        //Si hay respuesta
        if(isset($response) && !empty($response)){
            //Armar el json
            $json=array(
                'status'=>200,
                'results'=>$response
            );
        }else{
            $json=array(
                'status'=>400,
                'results'=>"No hay registros"
            );
        }
        echo json_encode($json,
                http_response_code($json["status"])
            );
    }*/
    //POST Crear
    /*public function create()
    {
        //Obtener json enviado
        $inputJSON = file_get_contents('php://input');
        //Decodificar json
        $object = json_decode($inputJSON);
        //Instancia del modelo
        $canton = new CantonModel();
        //Acción del modelo a ejecutar
        $response = $canton->create($object);
        //Verificar respuesta
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => 'Peliculada creada'
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No se creo el recurso"
            );
        }
        //Escribir respuesta JSON con código de estado HTTP
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }*/
    //PUT actualizar
    public function update()
    {
        //Obtener json enviado
        $inputJSON = file_get_contents('php://input');
        //Decodificar json
        $object = json_decode($inputJSON);
        //Instancia del modelo
        $canton = new CantonModel();
        //Acción del modelo a ejecutar
        $response = $canton->update($object);
        //Verificar respuesta
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => "Pelicula actualizada"
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No se actualizo el recurso"
            );
        }
        //Escribir respuesta JSON con código de estado HTTP
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
}