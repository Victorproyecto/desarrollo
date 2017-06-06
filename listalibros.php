
<?php

include('/config/index.php');

	
	$cons = 'SELECT * FROM libros';
	// Create the query and asign the result to a variable call $result
	$result = $connection->query($cons);
	// Extract the values from $result
	$rows = $result->fetchAll();
	// Since the values are an associative array we use foreach to extract the values from $rows
	foreach ($rows as $row) {
		echo 'id: '.$row['id'].'<br/>';
		echo 'titulo: '.$row['titulo'].'<br/>';
		echo 'autor: '.$row['autor'].'<br/>';
		echo 'paginas: '.$row['paginas'].'<br/>';
		echo "<hr/>";
	}
        
        echo 'Quieres registrar otro libro ?? <a href="formlibros.php">Registrar mas!</a> ';
        echo '</br>';
        echo '</br>';
        echo 'O prefieres cerrar sesion?  <a href="logout.php">Cerrar sesión.</a>' ;
 ?>