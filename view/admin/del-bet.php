<!DOCTYPE html>
<html>
  <head>
    <title>Gérer paris visibles</title>

    <link rel="stylesheet" href="res/admin.css" />
  <head>
  <body>
    <a href="?admin&page=index">Retour à l'accueil admin</a>
    <h1>Gérer les paris visibles</h1>

    <h2>Paris de la page "Sélection"</h2>

    <form action="" method="post">
      <table>
        <tr>
          <th>Date</th>
          <th>Match</th>
          <th>Pari conseillé</th>
          <th>Auteur</th>
          <th>Visible</th>
          <th>Cacher / afficher</th>
          <th><b>Supprimer</b></th>
        </tr>
        <?php 
        //print_r($bets);
        foreach($bigBets as $bet) {
          $visibility = ($bet['visible'] == 1) ? 'oui' : 'non';
        ?>
        <tr class="match">
          <td><?php echo $bet['date']; ?></td>
          <td><?php echo $bet['hometeam'] . ' - ' . $bet['awayteam']; ?></td>
          <td><?php echo $bet['advice']; ?></td>
          <td><?php echo $bet['author']; ?></td>
          <td><?php echo $visibility; ?></td>
          <td><input type="checkbox" name="toggle_big[]" value="<?php echo $bet['id']; ?>" /></td>
          <td><input type="checkbox" name="delete_big[]" value="<?php echo $bet['id']; ?>" /></td>
        </tr>
        <?php } ?>
      </table>

      <input type="submit" value="Envoyer" />
    </form>

    <h2>Paris de la page "Matchs à venir"</h2>

    <form action="" method="post">
      <table>
        <tr>
          <th>Date</th>
          <th>Match</th>
          <th>Pari conseillé</th>
          <th>Cote</th>
          <th>Visible</th>
          <th>Cacher / afficher</th>
          <th><b>Supprimer</b></th>
        </tr>
        <?php 
        //print_r($bets);
        foreach($simpBets as $bet) {
          $visibility = ($bet['visible'] == 1) ? 'oui' : 'non';
        ?>
        <tr class="match">
          <td><?php echo $bet['date']; ?></td>
          <td><?php echo $bet['title']; ?></td>
          <td><?php echo $bet['advice']; ?></td>
          <td><?php echo $bet['odds']; ?></td>
          <td><?php echo $visibility; ?></td>
          <td><input type="checkbox" name="toggle_simp[]" value="<?php echo $bet['id']; ?>" /></td>
          <td><input type="checkbox" name="delete_simp[]" value="<?php echo $bet['id']; ?>" /></td>
        </tr>
        <?php } ?>
      </table>

      <input type="submit" value="Envoyer" />
    </form>
  </body>
</html>