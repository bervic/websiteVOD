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
        <li><a href="series.php">Series</a></li>
        <li><a href="documentary.php" class="active">Documentary</a></li>
        <li><a href="cartoon.php">Cartoon</a></li>
        <li><a href="music.php">Music</a></li>
        <li><a href="concerts.php">Concerts</a></li>
      </ul>
    </div>
    <div id="conteneur">
      <div class="element"> <span><b>French Documentary</b> </span>
        <ul>
          <li class="active"><a href="documentary.php">Science</a></li>
          <li><a href="histoire.php">histoire</a></li>
          <li><a href="Geographie.php">Geographie</a></li>
          <li><a href="societe.php">Société</a></li>
        </ul>
        <span><b>English Documentary</b> </span>
        <ul>
          <li><a href="discovery.php">Discovery</a></li>
          <li><a href="history.php">History</a></li>
          <li><a href="society.php">Society</a></li>
          <li><a href="nature_people.php">Nature/People</a></li>
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
$query = "SELECT * FROM documentary WHERE CATEGORIES='Science' AND LANGUAGES='Francais' ORDER BY NOMS";
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
