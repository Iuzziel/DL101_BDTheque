var selectBD = document.querySelector("#selectBD");

selectBD.addEventListener("change", function () {
				console.log('select activé ' + selectBD.options[selectBD.options.selectedIndex].value);
				callDB();
});

/**
	* Fonction qui appel la bdd, et renvoie les intitulées de themes associes a la bd 
	* @param {int} id_bd
	* @returns {undefined}
	*/
function callDB() {
				var xhr = new XMLHttpRequest();

				//GET// xhr.open('GET', '../svc/svc_ajax.php');
				xhr.open('POST', '../svc/svc_ajax.php');
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

				xhr.onreadystatechange = function () { // On gère ici une requête asynchrone
								if (xhr.readyState === 4 && xhr.status === 200) { // Si le fichier est chargé sans erreur
												var reponse = '';
												//document.write('<br>-xhr.responseText-----<br>' + xhr.responseText);

												if (xhr.responseText === 'null') {
																reponse = 'Pas de thème associé !'
																document.querySelector("#selectTheme").innerHTML = '<option>' + reponse + '</option>';
												} else {
																// On transforme le JSON en tableau d'objet
																var tableauObjet = JSON.parse(xhr.responseText);
																
																var optionTheme = '';
																for (node in tableauObjet) {
																				optionTheme = optionTheme + '<option value="' + node + '">' + node + '</option>'; // Et on affiche !
																}
																document.querySelector("#selectTheme").innerHTML = optionTheme;
												}


								} else if (xhr.readyState === 4 && xhr.status !== 200) { // En cas d'erreur !
												alert('Une erreur est survenue !\n\nCode :' + xhr.status +
																				'\nTexte : ' + xhr.statusText);
								}
				}
				xhr.send('req=themes&id_bd=' + selectBD.options[selectBD.options.selectedIndex].value);

}