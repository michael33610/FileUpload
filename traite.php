
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="screen">
        <title>FILEINPUT</title>
    </head>

    <body>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        /*f count($_FILES['telechargement']['name']>0){
            echo "<h1> Transfert d'images</h1>";   
        }*/

    if (count($_FILES)>0){
        for ($i=0 ; $i < count($_FILES['telechargement']['name']) ; $i++){
            $errNo=$_FILES['telechargement']['error'][$i];
            // pb utilisation errno dans condition suivante
            $ficTemp=$_FILES['telechargement']['tmp_name'][$i];
            $extension=$_FILES['telechargement']['type'][$i];
            $nomFic=$_FILES['telechargement']['name'][$i];
            if ($_FILES['telechargement']['error'][$i] == "0"){
                //echo $i." Telechargement de  ".$_FILES['telechargement']['name'][$i]."<br>"; 
                $uploadDir="tamp";
                //Verification existence fichier temporaire
                if (isset($ficTemp)){
                    //Verification du type de fichier bien qu'il ai deja ete fait lors de la selection et enlever le jpeg que je laisse passer a la selection
                    if (in_array(strtolower(substr($extension,6)), ['jpg','jpeg','gif','png'])){
                        //Creation fichier cible si abscent
                        if (!is_dir($uploadDir)){
                            mkdir($uploadDir,0777);
                        }
                        //Transfert en destination
                        //$ficDest=$uploadDir."/".$nomFic;
                        $dt=time();
                        $ficDest=$uploadDir."/image".$dt.$nomFic;
                        if (move_uploaded_file($ficTemp,$ficDest )){
                            if ($i%2 == 0){
                                echo "<div class='ligTransOk1' >".$nomFic." a ete telecharge en ".$ficDest."</div>";
                                //echo "<h3 style='background-color:cyan'>".$nomFic." a ete telecharge en ".$ficDest."</h3>";
                            } else {
                                echo "<div class='ligTransOk2'>".$nomFic." a ete telecharge en ".$ficDest."</div>";
                                //echo "<h3 style='background-color:yellow'>".$nomFic." a ete telecharge en ".$ficDest."</h3>";
                            }
                        }
                    } else {
                        echo '<div class="ligTransKo">Echec telechargement de  '.$_FILES['telechargement']['name'][$i]."<br>Format non traite</div>";
                    }

                }
            } else {
                $errNo--;
                $errMsg = array(
                    "La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini",
                    "La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML",
                    " Le fichier n'a été que partiellement téléchargé.",
                    "Aucun fichier n'a été téléchargé.",
                    "Un dossier temporaire est manquant.",
                    "Échec de l'écriture du fichier sur le disque",
                    "Une extension PHP a arrêté l'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L'examen du phpinfo() peut aider."
                    );

                echo '<div class="ligTransKo">Echec telechargement de  '.$_FILES['telechargement']['name'][$i]."<br>(".$errMsg[$errNo].")</div>";
                //echo '<h3 style="background-color:red">Echec telechargement de  '.$_FILES['telechargement']['name'][$i]."<br>(".$errMsg[$errNo].")<br></h3>";
            }

        }
    }
        ?>
        <!--
        <div class="center-align">
            <input  class="btn waves-effect waves-light" type="button" value="Liste images" onclick="document.location='visu.php'">
        </div>
        -->
   </body>
</html>