<?php

class Cargos{


    public function getCargos(){

    $cadenaSQL = "select * from cargos";
    $campo[] = ConectorBD::ejecutaryQuery($cadenaSQL,PDO::FETCH_ASSOC);
    return $campo;

    }
}



?>