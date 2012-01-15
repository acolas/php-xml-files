<?php

$adresse = "/Users/Anthony/Desktop/dev/xml/"; //a modifier
$dossierOut = "/Users/Anthony/Desktop/dev/xml/out/"; //a modifier, repertoire cree automatiquement
$dossier = Opendir($adresse); 

if (!is_dir($dossierOut)){
    mkdir($dossierOut, 0700);
}

while ($Fichiers = readdir($dossier)) {
    if ($Fichiers != "." && $Fichiers != ".." && 
            $Fichiers != ".DS_Store" && $Fichiers != "out" ) {

        $fichier = $adresse . $Fichiers;
    
        if (!file_exists($fichier)) {
            exit('Impossible de lire ' + $fichier);
        }
        
        $root = simplexml_load_file($fichier);

        foreach ($root->children()->Item as $child) {
            $deustch = $child->Deutsch;
            $child->French = $deustch;
        }
        
        $fp = fopen($dossierOut.$Fichiers,"w+");
        if ($fp){
            fputs($fp, $root->asXML());
            echo $dossierOut.$Fichiers.' : <b style="color:green;"> OK</b ><br />'; 
        }
        else{
            echo $dossierOut.$Fichiers.' : <b style="color:red;"> KO</b ><br />'; 
        }

    }
}
closedir($dossier);
?>