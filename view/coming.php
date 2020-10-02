<h2>Matchs à venir</h2>
<main class="centralSection indexSection">
  <table class="tableHomepage">
    <tr>
      <th>Date</th>
      <th>Match</th>
      <th>Pari conseillé</th>
      <th>Cote</th>
    </tr>
    <?php 
    //print_r($bets);
    foreach($bets as $bet) {
      if($bet['visible'] == 1) {
    ?>
    <tr class="match">
      <td><?php echo $bet['date']; ?></td>
      <td><?php echo $bet['title']; ?></td>
      <td><?php echo $bet['advice']; ?></td>
      <td>@<?php echo $bet['odds']; ?></td>
      <td>
        <i class="material-icons menuIcon addGame" id="<?php echo "id-" . $bet['id']; ?>">add</i>
      </td>
    </tr>
    <?php
    }  
  } ?>
  </table>
  <p><i>L2M = les deux équipes marquent, 1 = Victoire de l'équpe à domicile, N = nul(N) et 2 = Victoire de l'équipe à l'extérieur, 1/N = 1 ou nul</i></p>
</main>