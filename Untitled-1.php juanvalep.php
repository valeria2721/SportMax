SportStatsPro/
│
├── assets/
│   ├── css/
│   │   └── style.css
│
├── includes/
│   └── conexion.php
│
├── pages/
│   ├── login.php
│   ├── registro.php
│   ├── dashboard.php
│   ├── jugadores.php
│   ├── crear_jugador.php
│   ├── editar_jugador.php
│   └── eliminar_jugador.php
│
├── database/
│   └── sportstats.sql
│
└── index.php

CREATE DATABASE sportstats;
USE sportstats;

CREATE TABLE usuarios(
 id INT AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(100),
 correo VARCHAR(100) UNIQUE,
 password VARCHAR(255),
 rol ENUM('Administrador','Entrenador')
);

CREATE TABLE jugadores(
 id INT AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(100),
 deporte VARCHAR(50),
 equipo VARCHAR(100),
 estadistica VARCHAR(100)
);

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
?>

<?php
session_start();
include("../includes/conexion.php");

if(isset($_POST['ingresar'])){

$correo=$_POST['correo'];
$password=$_POST['password'];

$sql="SELECT * FROM usuarios
WHERE correo='$correo'
AND password='$password'";

$resultado=$conexion->query($sql);

if($resultado->num_rows>0){

$usuario=$resultado->fetch_assoc();

$_SESSION['usuario']=$usuario['nombre'];
$_SESSION['rol']=$usuario['rol'];

header("Location: dashboard.php");
}
}
?>

<form method="POST">

<h2>Iniciar Sesión</h2>

<input type="email"
name="correo"
placeholder="Correo">

<br><br>

<input type="password"
name="password"
placeholder="Contraseña">

<br><br>

<button name="ingresar">
Ingresar
</button>

</form>

<?php
session_start();

if(!isset($_SESSION['usuario'])){
 header("Location: login.php");
}
?>

<h1>SportStats Pro</h1>

<h2>
Bienvenido
<?php echo $_SESSION['usuario']; ?>
</h2>

<a href="jugadores.php">
Gestionar Jugadores
</a>

<?php
include("../includes/conexion.php");

if($_POST){

$nombre=$_POST['nombre'];
$deporte=$_POST['deporte'];
$equipo=$_POST['equipo'];
$estadistica=$_POST['estadistica'];

$sql="INSERT INTO jugadores
(nombre,deporte,equipo,estadistica)
VALUES
('$nombre','$deporte',
'$equipo','$estadistica')";

$conexion->query($sql);

header("Location: jugadores.php");
}
?>

<form method="POST">

<input name="nombre"
placeholder="Nombre">

<input name="deporte"
placeholder="Deporte">

<input name="equipo"
placeholder="Equipo">

<input name="estadistica"
placeholder="Estadística">

<button>
Guardar
</button>

</form>

<?php
include("../includes/conexion.php");

$datos=$conexion->query(
"SELECT * FROM jugadores"
);
?>

<h2>Jugadores</h2>

<a href="crear_jugador.php">
Nuevo Jugador
</a>

<table border="1">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Deporte</th>
<th>Equipo</th>
<th>Estadística</th>
</tr>

<?php while($fila=$datos->fetch_assoc()){ ?>

<tr>

<td><?= $fila['id']; ?></td>
<td><?= $fila['nombre']; ?></td>
<td><?= $fila['deporte']; ?></td>
<td><?= $fila['equipo']; ?></td>
<td><?= $fila['estadistica']; ?></td>

</tr>

<?php } ?>

</table>