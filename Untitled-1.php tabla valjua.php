<?php
include("../includes/conexion.php");

$jugadores = $conexion->query(
"SELECT * FROM jugadores"
);
?>

<table border="1">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Deporte</th>
<th>Equipo</th>
<th>Estadística</th>
</tr>

<?php while($j = $jugadores->fetch_assoc()){ ?>

<tr>
<td><?= $j['id']; ?></td>
<td><?= $j['nombre']; ?></td>
<td><?= $j['deporte']; ?></td>
<td><?= $j['equipo']; ?></td>
<td><?= $j['estadistica']; ?></td>
</tr>

<?php } ?>

</table>