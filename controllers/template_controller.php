<?php

class TemplateController{

    public function GetTemplate(){
        include "views/template.php";
    }

    public function GetTemplateStyles(){
        //Consulta a modelo

        $table = "template";

        $response = TemplateModel::GetTemplate($table);

        return $response;
    }

}

?>