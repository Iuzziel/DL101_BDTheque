function callDB() {
				//document.getElementById('listVille').innerHTML =
				//                '<span>Recherche sur ' + codPost + '</span>';
				var xhr = new XMLHttpRequest();

				//GET// xhr.open('GET', '../ctl/ctl_ajax.php');
				xhr.open('POST', '../ctl/ctl_ajax.php');
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

				xhr.onreadystatechange = function() { // On gère ici une requête asynchrone
								if (xhr.readyState === 4 && xhr.status === 200) { // Si le fichier est chargé sans erreur
												var reponse = '';
												//document.write('<br>-xhr.responseText-----<br>' + xhr.responseText);

												if (xhr.responseText === 'null') {
																reponse = 'Pas de ville correspondante !'
												} else {
																// On transforme le JSON en tableau d'objet
																var tableauObjet = JSON.parse(xhr.responseText);

																for (node in tableauObjet) {
																				reponse = reponse + tableauObjet[node].nom + ' ' + tableauObjet[node].codpost + '<br>';
																}
												}

												document.getElementById('listVille').innerHTML = '<span>' + reponse + '</span>'; // Et on affiche !
												
								} else if (xhr.readyState === 4 && xhr.status !== 200) { // En cas d'erreur !
									alert('Une erreur est survenue !\n\nCode :' + xhr.status +
											'\nTexte : ' + xhr.statusText);
								}
				}
}