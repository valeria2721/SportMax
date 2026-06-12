<?php

$conexion = new mysqli(
"localhost",
"root",
"",
"sportstats"
);

if($conexion->connect_error){
die("Error de conexión");
}