<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html><html>
  <head>
    <meta charset="UTF-8" />
    <title>index</title>
    <link type="text/css" rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div id="tswcsstabs">
      <ul>
        <li><a href="action_FR.php" >Movies</a></li>
        <li><a href="series.php" class="active">Series</a></li>
        <li><a href="documentary.php">Documentary</a></li>
        <li><a href="cartoon.php">Cartoon</a></li>
        <li><a href="music.php">Music</a></li>
        <li><a href="concerts.php">Concerts</a></li>
      </ul>
    </div>
    <div id="conteneur">
      <div class="element"> <span><b>French Series</b> </span>
        <ul>
          <li><a href="series.php">Action</a></li>
          <li><a href="drama_series_FR.php">Drama</a></li>
          
        </ul>
        <span><b>English Series</b> </span>
        <ul>
          <li class="active"><a href="policier_thriller_series_EN.php">Policier/Thriller</a></li>
          <li><a href="tragedy_series_EN.php">Tragedy</a></li>
          <li><a href="comedy_series_EN.php">Comedy</a></li>
        </ul>
      </div>
      <div class="element">
            <?php
            header( 'content-type: text/html; charset=utf-8' );
      try
      {
          $bdd = new PDO('mysql:host=localhost;dbname=vod', 'root', '');
      }
      catch(Exception $e)
      {
          echo 'Echec de la connexion à la base de données';
          exit();
      }

      // --------------------------------
// $NbrCol : le nombre de colonnes
// $NbrLigne : calcul automatique a la FIN
$NbrCol = 5;	// (par exemple)
// --------------------------------
// La requete (exemple) : classe par ordre alphabétique.
$query = "SELECT * FROM series WHERE  CATEGORIES='Policier/Thriller' AND LANGUAGES='anglais' ORDER BY NOMS";
  try {
  $pdo_select = $bdd->prepare($query);
  $pdo_select->bindParam (":NOMS", $NOMS, PDO::PARAM_STR);
  $pdo_select->bindParam (":ACTORS", $ACTORS, PDO::PARAM_STR);
  $pdo_select->bindParam (":YEAR", $YEAR, PDO::PARAM_STR);
  $pdo_select->bindParam (":DIRECTORS", $DIRECTORS, PDO::PARAM_STR);
  $pdo_select->bindParam (":UPDATES", $UPDATES, PDO::PARAM_STR);
	$pdo_select->execute(array($NOMS, $ACTORS, $YEAR, $DIRECTORS, $UPDATES));
	$NbreData = $pdo_select->rowCount();	// nombre de cellules à remplir
	$rowAll = $pdo_select->fetchAll();
  } catch (PDOException $e){ echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
// --------------------------------
// affichage
$NbrLigne = 0;
if ($NbreData != 0) {
	$j = 1;
?>
         <table style="width: 100%;" cellspacing="0" cellpadding="0" border="1">
          <tbody>
            <tr>
              <th>NOMS<br />
              </th>
              <th>ACTORS<br />
              </th>
              <th>YEAR<br />
              </th>
              <th>DIRECTORS<br />
              </th>
              <th>UPDATES<br />
              </th>
            </tr>
            <?php
	foreach ( $rowAll as $row ) 
	{
		if ($j%$NbrCol == 1) {
			$NbrLigne++;
			$fintr = 0;
?>		
<?php		}
?>
      <tr>
			<td>
<?php			// -------------------------
      // DONNEES A AFFICHER dans la cellule
      
   		echo '<a href='.$row['LIENS'].'>'.$row['NOMS'].'</a>';
              ?>
              </td>
             			<td>
<?php			// -------------------------
      // DONNEES A AFFICHER dans la cellule
      echo $row['ACTORS'];
      
              ?>
              </td>
              			<td>
<?php			// -------------------------
      // DONNEES A AFFICHER dans la cellule
      echo $row['YEAR'];
   
              
              ?>
              </td>
              			<td>
<?php			// -------------------------
      // DONNEES A AFFICHER dans la cellule
      echo $row['DIRECTORS'];
    
              
              ?>
              </td>
              			<td>
<?php			// -------------------------
      // DONNEES A AFFICHER dans la cellule
      echo $row['UPDATES'];
   
              
              ?>
              </td>

  <?php		if ($j%$NbrCol == 0) {
			$fintr = 1;
?>		</tr>
<?php		}
		$j++;
	} // fin while
	// fermeture derniere balise /tr
	if ($fintr!=1) {
?>		
<?php	} ?>
          </tbody>
        </table>
        <?php
} else { ?>
	pas de données à afficher
<?php
}
?>
    
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
