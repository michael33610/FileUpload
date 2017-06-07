


    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>File Upload</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.css" />
      <link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="screen">
    </head>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        //var_dump($_POST);


        require_once "traite.php";

        if (isset($_POST['efface'])){
          $aSupprimer=$_POST['efface'];
          if (file_exists($aSupprimer)){
            unlink($aSupprimer);
          }
        } 
        
        ?>

    <body >

        <div class="row">
          <?php
            $iterator = new FilesystemIterator('tamp/');
            if (iterator_count($iterator)>0){
               foreach ($iterator as $fileinfo) {
            ?>
                  <div class="col l3">
                      <img class="images" src="<?php  echo $fileinfo ?>"></img>
                      <?php echo $fileinfo->getFilename(). "\n";?>

                      <form action="visu.php" method="post">
                          <input type="hidden" name="efface" value="<?php echo $fileinfo ?>">
                          <button lass="waves-effect waves-light btn" type="submit"><i class="material-icons">delete</i></button>
                      </form>
                  </div>
            <?php
                }
            } else {
              echo "<h3> Pas de fichier dans tamp</h3>";
            }

          ?>
  
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

    </body>
    </html>