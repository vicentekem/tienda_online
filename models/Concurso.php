<?php

require_once __DIR__ . "/../models/ModeloBase.php";


class Concurso
{
    private $model;

    public function __construct()
    {
        $this->model = new ModeloBase();
    }

    public function qryConcurso($data)
    {
        $where = Utilitario::generarFiltros($data,[
            "search" => "c.description like concat('%',:search,'%')"
        ]);

        return $this->model->getAllRows(
            "SELECT c.id,c.nombre,description,DATE_FORMAT(c.fecha,'%d/%m/%Y') fecha,c.monto_inscripcion,
            DATE_FORMAT(hora_inicio,'%h:%i %p') hora_inicio, DATE_FORMAT(hora_fin,'%h:%i %p') hora_fin,c.estado 
            FROM tbl_concurso $where limit :start,:length ", $data,
            "SELECT count(c.id) AS cant_rows FROM tbl_concurso c $where",["search" => $data["search"] ]
        );

    }

    public function getConcurso($data)
    {

        $where = Utilitario::generarFiltros($data,[
            "id" => "c.id = :id"
        ]);

        $result = $this->model->getRow( 
            "SELECT c.id,c.nombre,description,DATE_FORMAT(c.fecha,'%d/%m/%Y') fecha,c.monto_inscripcion,url_img,
                DATE_FORMAT(hora_inicio,'%h:%i %p') hora_inicio, DATE_FORMAT(hora_fin,'%h:%i %p') hora_fin,c.estado,
                direccion,resumen
            FROM tbl_concurso $where", $data
        );

        $result["preguntas"] = $this->model->getAllRows(
            "SELECT p.id,p.description FROM tbl_concurso c INNER JOIN tbl_pregunta p on c.id = p.id_concurso $where order by p.nro_orden", $data
        )["rows"];

        $result["opciones"] = $this->model->getAllRows( 
            "SELECT op.id,op.id_pregunta,op.description,op.es_correcto FROM tbl_concurso c 
            INNER JOIN tbl_pregunta p on p.id_concurso = c.id
            INNER JOIN tbl_opcion op on op.id_pregunta = p.id $where", $data
        )["rows"];

        return $result;
    }

    public function getUrlImgConcurso($data)
    {
        $where = Utilitario::generarFiltros($data,["id" => "c.id = :id"]);        
        return $this->model->getRow( 
            "SELECT c.id,c.url_img FROM tbl_concurso c $where", $data);
    }

    public function getDescConcurso($data)
    {
        $where = Utilitario::generarFiltros($data,["id" => "c.id = :id"]);        
        return $this->model->getRow(
            "SELECT c.id,c.description FROM tbl_concurso c $where", $data);
    }

    public function saveConcurso($action,$data){
        return $this->model->executeProcess(
            "call sp_concurso( '$action' ,:id,:description,:resumen,:fecha,:hora_inicio,:hora_fin,
            :direccion,:monto_inscripcion,:url_img,:preguntas,:opciones,:id_usuario)", $data,
            "Datos guardados exitosamente"
        );

    }

}