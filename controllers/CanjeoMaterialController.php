<?php
//Clase Controlador Pelicula
class CanjeoMateriales
{
    //GET Listar 
    public function index($id)
    {
        //Instancia del modelo
        $CanjeoMaterial = new CanjeoMaterialesModel();
        //Acción del modelo a ejecutar
        $response = $CanjeoMaterial->all($id);
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
        $CanjeoMaterial = new CanjeoMaterialesModel();
        //Acción del modelo a ejecutar
        $response = $CanjeoMaterial->get($id);
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

    public function getAdmin($id)
    {
        //Instancia del modelo
        $CanjeoMaterial = new CanjeoMaterialesModel();
        //Acción del modelo a ejecutar
        $response = $CanjeoMaterial->getAdmin($id);
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
        $CanjeoMaterial = new CanjeoMaterialesModel();
        $json = array(
            'status' => 400,
            'results' => "Solicitud sin identificador"
        );
        //Verificar párametro
        if (isset($id) && !empty($id) && $id !== 'undefined' && $id !== 'null') {
            //Acción del modelo a ejecutar
            $response = $CanjeoMaterial->getForm($id);
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
        $CanjeoMaterial = new CanjeoMaterialesModel();
        //Acción del modelo a ejecutar
        $response = $CanjeoMaterial->getCountByGenre($param);
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
    /*public function getCanjeoMaterialsbyGenre($param){
        //Instancia del modelo
        $genre=new GenreModel();
        //Acción del modelo a ejecutar
        $response=$genre->getCanjeoMaterialsbyGenre($param);
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
        $CanjeoMaterial = new CanjeoMaterialesModel();
        //Acción del modelo a ejecutar
        $response = $CanjeoMaterial->create($object);
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
    /*public function update()
    {
        //Obtener json enviado
        $inputJSON = file_get_contents('php://input');
        //Decodificar json
        $object = json_decode($inputJSON);
        //Instancia del modelo
        $CanjeoMaterial = new CanjeoMaterialesModel();
        //Acción del modelo a ejecutar
        $response = $CanjeoMaterial->update($object);
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
    }*/
   
}