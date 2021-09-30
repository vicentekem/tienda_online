<?php
/**
 * Created by PhpStorm.
 * User: ACER
 * Date: 18/03/2019
 * Time: 08:34 AM
 */

require_once __DIR__ . "/../../models/Concurso.php";
require_once __DIR__ . "/../../utilitario/Utilitario.php";

class ConcursoValidator
{
    private $model;
    public function __construct()
    {
        $this->model = new Concurso();
    }
    
    public function qryConcurso()
    {
        $result = [ "error" => "" ];
        $data["start int"] = isset($_GET["start"]) ? $_GET["start"] : null;
        $data["length int"] = isset($_GET["length"]) ? $_GET["length"] : null;

        $data["search"] =  Utilitario::getParam("search");

        $result = $result["error"] === "" ? $this->model->qryConcurso($data) : $result;

        return $result;
    }

    public function getConcurso()
    {
        $result = [ "error" => "" ];
        $data["id int"] =  Utilitario::getParam("id");

        $result = $result["error"] === "" ? $this->model->getConcurso($data) : $result;
        return $result;
    }

    public function getDescConcurso()
    {
        $result = [ "error" => "" ];
        $data["id int"] =  Utilitario::getParam("id");

        $result = $result["error"] === "" ? $this->model->getDescConcurso($data) : $result;
        return $result;
    }
    
    public function saveConcurso($action){

        $result = [ "error" => "" ];

        $data["id int"] = Utilitario::getIntParam("id");
        $data["description"] = Utilitario::getParam("description");
        $data["resumen"] = Utilitario::getParam("resumen");
        $data["fecha"] = Utilitario::getParam("fecha");
        $data["hora_inicio"] = Utilitario::getParam("hora_inicio");
        $data["hora_fin"] = Utilitario::getParam("hora_fin");
        $data["direccion"] = Utilitario::getParam("direccion");
        $data["monto_inscripcion"] = Utilitario::getParam("monto_inscripcion");
        
        $data["preguntas"] = Utilitario::getParam("preguntas",false);
        $data["opciones"] = Utilitario::getParam("beneficios",false);

        $data["id_usuario"] = $_SESSION["usuario_academia"]["id"];

        $url_img = Utilitario::getParam("url_img",false);

        $fl_img = isset($_FILES["fl_img"]) ? $_FILES["fl_img"] : null;
        
        $url_img_old = "";
        $file_tmp = "";
        $url_img_new = "";

        if($action === 'upd_bp' && $fl_img){
            $url_img_old = $this->model->getUrlImgConcurso(["id int" => $data["id int"]])["row"]["url_img"];
        }

        if($fl_img){
            $file_name = $_FILES['fl_img']['name'];
            $file_tmp  = $_FILES['fl_img']['tmp_name'];
            $explode = explode('.',$_FILES['fl_img']['name']);
            $file_ext=strtolower(end($explode));
            $file_name_db = uniqid() . "." . $file_ext;
            $url_img_new = __DIR__ . "/../../public/img/concurso/" . $file_name_db;
            $data["url_img"] = "public/img/concurso/" . $file_name_db;            
        }else{
            $data["url_img"] = $url_img;
        }
        
        $result = $result["error"] === "" ? $this->model->saveConcurso($data) : $result;
        
        if($result["error"] === ""){
            if($url_img_old !== "public/img/default.png" && $url_img_old != "" && $url_img_old != null && file_exists($url_img_old)){
                $url_img_old = __DIR__ . "/../../" . $url_img_old;
                unlink( $url_img_old );
            }
            move_uploaded_file($file_tmp,$url_img_new);
        }

        return $result;

    }


}


