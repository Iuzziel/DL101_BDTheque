<?php

				try {
								$sql = 'SELECT * FROM bandesdessinees ORDER BY bd_titre ASC';
								$result = Connexion::select($sql, PDO::FETCH_OBJ);
				} catch (MySQLException $e) {
								die($e->retourneErreur());
				}
				echo json_encode($result, JSON_FORCE_OBJECT);
				
?>

