<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html><html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>index</title>
    <link type="text/css" rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div id="tswcsstabs">
      <ul>
        <li><a href="action_FR.php" class="active">Movies</a></li>
        <li><a href="series.php">Series</a></li>
        <li><a href="documentary.php">Documentary</a></li>
        <li><a href="cartoon.php">Cartoon</a></li>
        <li><a href="music.php">Music</a></li>
        <li><a href="concerts.php">Concerts</a></li>
      </ul>
    </div>
    <div id="conteneur">
      <div class="element"> <span><b>French Movies</b> </span>
        <ul>
          <li><a href="action_FR.php">Action</a></li>
          <li><a href="adventure_FR.php">Adventure</a></li>
          <li><a href="arts_martiaux_FR.php">Art Martiaux</a></li>
          <li><a href="biopic_FR.php">Biopic</a></li>
          <li><a href="comedy_FR.php">Comedy</a></li>
          <li><a href="drama_FR.php">Drama</a></li>
          <li><a href="fantasy_FR.php">Fantasy</a></li>
          <li><a href="horror_FR.php">Horror</a></li>
          <li><a href="policier_thriller_FR.php">Policier/Thriller</a></li>
          <li><a href="romance_FR.php">Romance</a></li>
          <li class="active"><a href="Science_fiction_FR.php">Science_fiction</a></li>
          <li><a href="western_FR.php">Western</a></li>
        </ul>
        <span><b>English Movies</b> </span>
        <ul>
          <li><a href="action_EN.php">Action</a></li>
          <li><a href="adventure_series_EN.html">Adventure</a></li>
          <li><a href="arts_martiaux_EN.php">Art Martiaux</a></li>
          <li><a href="biopic_EN.php">Biopic</a></li>
          <li><a href="comedy_EN.php">Comedy</a></li>
          <li><a href="drama_EN.php">Drama</a></li>
          <li><a href="fantasy_EN.php">Fantasy</a></li>
          <li><a href="horror_EN.php">Horror</a></li>
          <li><a href="policier_thriller_EN.php">Policier/Thriller</a></li>
          <li><a href="romance_EN.html">Romance</a></li>
          <li><a href="Science_fiction_EN.php">Science_fiction</a></li>
          <li><a href="western_EN.php">Western</a></li>
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
$query = "SELECT * FROM movies WHERE  CATEGORIES='Sci-Fi' AND LANGUAGES='francais' ORDER BY NOMS";
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
              <th>MOVIES<br />
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
