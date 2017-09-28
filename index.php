<?php 
				require_once	'./Voiture.class.php'; 
				require_once	'./dao/Connexion.php';
				require_once	'./exception/MYSQLException.php';

				try{
								$sql = 'SELECT * FROM voiture';
								Connexion::getConnexion();
								$rs1 = Connexion::select($sql, PDO::FETCH_ASSOC);
				} catch (Exception $ex) {
								$ex->getMessage();
				}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
								<link rel="Stylesheet" type="text/css" media="screen" href="css.css" />
        <title>Index</title>
    </head>
    <body>
								<header>
												<h1>Test Php PDO :</h1>
								</header>
								<section>
												<?= var_dump($rs1); ?>
												<a href="testRequete.php">Clique Test Requete</a>
								</section>
    </body>
</html>
<!--

-->