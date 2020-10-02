<!DOCTYPE html>
<html>
  <head>
    <title>Ajouter pari / gérer équipes</title>

    <link rel="stylesheet" href="res/admin.css" />
    <meta name="viewport" content= "user-scalable=no">
  <head>
  <body>
    <a href="?admin&page=index">Retour à l'accueil admin</a>
    <h1>Ajouter pari / gérer équipes</h1>

    <h2>Ajouter pari</h2>

    <ul>
      <li>Si vous spécifiez des conseils détaillés pour le pari, il apparaîtra directement dans la section "La sélection de [auteur]"</li>
      <li>Pour le noms des équipes, ajoutez soit le nom complet (bien orthographié) soit l'acronyme (PAS LES DEUX)</li>
      <li>Avant d'ajouter un pari détaillé soyez sûrs que les deux équipes sont bien dans la liste !
      </li>
      <li><b>S'il ne s'agit pas d'un pari détaillé, l'usage d'acronymes n'est pas possible, vous devez donner les noms complets.</b>
    </ul>

    <form action="" method="post">
        
        <input type="text" minlength="3" maxlength="20" placeholder="Domicile" name="teams[]" required />
        <input type="text" minlength="3" maxlength="20" placeholder="Extérieur" name="teams[]" required /><br />
        <input type="hidden" name="author" value="<?php echo $_SESSION['username']; ?>" />

        <input type="number" min="1.01" step="any" placeholder="Cote" name="odds" required />
        <input type="date" name="date" required />
        <input type="time" name="time" required />

        <br />
        <input type="text" minlength="3" maxlength="25" name="advice" placeholder="Conseil court" required  /><br />

        <textarea name="homeadvice" minlength="12" placeholder="Conseils détaillés équipe domicile, séparés par un retour à la ligne"></textarea>
        <textarea name="awayadvice" minlength="12" placeholder="Conseils détaillés équipe extérieur, séparés par un retour à la ligne"></textarea>
        <br/>

        <input type="submit" value="Ajouter pari" />
    </form>

    <?php if(isset($formError)) {  echo '<strong>' . $formError . '</strong>'; } ?>

    <h2>Gérer équipes</h2>

    <p>ATTENTION !, par sécurité, supprimer une équipe cache tous les paris dans lesquels elle est impliquée</p>

    <form enctype="multipart/form-data" action="" method="post">
      <input type="text" minlength="3" maxlength="20" placeholder="Nom équipe" name="newname" required /><br />
      <input type="text" minlength="3" maxlength="3" placeholder="Acroynme équipe" name="newacronym" required /><br />

      <input type="hidden" name="MAX_FILE_SIZE" value="800000" />
      <label for="newlogo">Logo format PNG (max 800ko)</label>
      <input name="newlogo" type="file" required/>

      <input type="submit" value="Ajouter équipe" />
    </form>

    <form action="" method="post">
      <table>
        <?php 
        
        $i = 0;
        foreach($teams as $team) {
          if($i % 3 == 0) { 
        
        ?>
        <tr>
          <td>
              <a href="<?php echo 'res/logo/'. $team['acronym'] . '.png'; ?>">
                <img src="<?php echo 'res/logo/'. $team['acronym'] . '.png'; ?>" />
                <?php echo $team['teamname'] . ' / ' . $team['acronym']; ?>
              </a>
              <input type="checkbox" name="delteam[]" value="<?php echo $team['acronym']; ?>" />
          </td>
          <?php } ?>

          <?php if($i % 3 == 1) { ?>
          <td>
              <a href="<?php echo 'res/logo/'. $team['acronym'] . '.png'; ?>">
                <img src="<?php echo 'res/logo/'. $team['acronym'] . '.png'; ?>" />
                <?php echo $team['teamname'] . ' / ' . $team['acronym']; ?>
              </a>
            <input type="checkbox" name="delteam[]" value="<?php echo $team['acronym']; ?>" />
          </td>
          <?php } ?>

          <?php if($i % 3 == 2) { ?>
          <td>
            <a href="<?php echo 'res/logo/'. $team['acronym'] . '.png'; ?>">
              <img src="<?php echo 'res/logo/'. $team['acronym'] . '.png'; ?>" />
              <?php echo $team['teamname'] . ' / ' . $team['acronym']; ?>
            </a>
            <input type="checkbox" name="delteam[]" value="<?php echo $team['acronym']; ?>" />
          </td>
        </tr>
        <?php
        
          }

          $i++;
        }
        ?>
      </table>

      <input type="submit" value="Supprimer équipes" />
    </form>
  </body>
</html>