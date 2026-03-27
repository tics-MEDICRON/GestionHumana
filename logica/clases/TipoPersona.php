<?php

class TipoPersona
{
    private $codigo;

    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getNombre()
    {
        switch ($this->codigo) {
            case 'Administrador':
                $nombre = 'Administrador';
                break;
            case 'Colaborador':
                $nombre = 'Colaborador';
                break;
            case 'Contrato de Servicio':
                $nombre = 'Contrato de Servicio';
                break;
            default:
                $nombre = 'Desconocido';
                break;
        }
        return $nombre;
    }


    public function __toString()
    {
        return $this->getNombre();
    }
}
