<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
 

 $CONSULTA5 = $CONEXION -> query("SELECT * FROM galeriaspic WHERE producto = 4 LIMIT 1");
   
 $query3 = "SELECT * FROM galeriaspic WHERE producto = 2 ORDER BY orden";
 $query4 = "SELECT * FROM galeriaspic WHERE producto = 3 ORDER BY orden";
?>

<!-- Productos de muestra -->

<div class="uk-container-expand">
	<div class="bg-primary uk-contrainer">
		<div>
</div>

	</div>

</div>




</body>
</html>