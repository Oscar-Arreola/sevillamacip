<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
 $CONSULTA1 = $CONEXION -> query("SELECT * FROM clientes WHERE estatus = 1");
 $CONSULTA2 = $CONEXION -> query("SELECT * FROM empresas WHERE estatus = 1");
 $CONSULTA3	= $CONEXION -> query("SELECT * FROM configuracion LIMIT 1");
 $row_CONSULTA3 = $CONSULTA3 -> fetch_assoc();
 $mision = $row_CONSULTA3['about2'];
 $vision = $row_CONSULTA3['about3'];
   

?>


<section>
	<div class="padding-h-40 padding-v-40 bg-secondary">
		<div class="border-white">
			<img src="img/design/fondo_mancha.png" alt="" style="position: absolute; top: 0; right: 0; z-index: -1">

		</div>
	</div>
</section>


<?=$footer?>



</body>
</html>