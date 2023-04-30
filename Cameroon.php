<?php
require("connection.php");
require("control-session.php");
?>

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
        <li><a href="action_FR.php">Movies</a></li>
        <li><a href="series.php">Series</a></li>
        <li><a href="documentary.php">Documentary</a></li>
        <li><a href="cartoon.php">Cartoon</a></li>
        <li><a href="music.php" class="active">Music</a></li>
        <li><a href="concerts.php">Concerts</a></li>
      </ul>
    </div>
    <div id="conteneur">
      <div class="element"> <span><b>French Movies</b> </span>
        <ul>
          <li><a href="music.php">Oldies Cameroon</a></li>
          <li><a href="Africa.php">Africa</a></li>
          <li class="active"><a href="Cameroon.php">Cameroon</a></li>
          <li><a href="US.php">U.S</a></li>
          <li><a href="jazz.php">Jazz</a></li>
          <li><a href="gospel.php">Gospel</a></li>
          <li><a href="variety.php">Variety</a></li>
          
        </ul>
      </div>
      <div class="element">
            <?php

      // --------------------------------
// $NbrCol : le nombre de colonnes
// $NbrLigne : calcul automatique a la FIN
$NbrCol = 5;	// (par exemple)
// --------------------------------
// La requete (exemple) : classe par ordre alphabétique.
$query = "SELECT * FROM musics WHERE CATEGORIES='Cameroon' ORDER BY NOMS";
  try {
  $pdo_select = $db->prepare($query);
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
