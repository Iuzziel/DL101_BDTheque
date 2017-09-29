<?php
	// Fonction : debug
	// Desc : affiche un message suivant la valeur de la variable DEBUG
	// IN : le booleen DEBUG, un message, un tableau éventuel
	// OUT : RAZ
    function debug($sDebug,$sMsg,$sTab){
         if ($sDebug){
            echo "<br />[DEB]" . $sMsg . "[FIN]<br />";
            echo "<pre>";
            print_r($sTab);
            echo "</pre>";
        }
    }
?>