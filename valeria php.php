<?php

class Deportista {

    private $archivo = "../data/deportistas.json";

    public function obtenerTodos() {
        $datos = file_get_contents($this->archivo);
        return json_decode($datos, true);
    }

    public function guardar($nuevo) {

        $datos = $this->obtenerTodos();

        $nuevo['id'] = count($datos) + 1;

        $datos[] = $nuevo;

        file_put_contents(
            $this->archivo,
            json_encode($datos, JSON_PRETTY_PRINT)
        );
    }

    public function actualizar($id, $datosNuevos){

        $datos = $this->obtenerTodos();

        foreach($datos as &$d){

            if($d['id'] == $id){

                $d['nombre'] = $datosNuevos['nombre'];
                $d['deporte'] = $datosNuevos['deporte'];
                $d['estadistica'] = $datosNuevos['estadistica'];
            }
        }

        file_put_contents(
            $this->archivo,
            json_encode($datos, JSON_PRETTY_PRINT)
        );
    }
}
?>