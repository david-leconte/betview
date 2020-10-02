<h2>
  <?php echo $pageTitle; ?>
  <i class="material-icons menuIcon addGame" id="<?php echo "id-" . $bet['id']; ?>">add</i>
</h2>

<main class="centralSection">
  <table id="teamsTable">
      <tr>
        <td class="caseTeam"><img src="res/logo/<?php echo $homeAcronym; ?>.png"></td>
        <td class="caseTeam" id="gameDetails"><?php echo $bet['date']; ?></td>
        <td class="caseTeam"><img src="res/logo/<?php echo $awayAcronym; ?>.png"></td>
      </tr>
  </table>

  <em>Conseillé : <?php echo $bet['advice']; ?> (cote <?php echo $bet['odds']; ?>)</em>

  <table id="adviceTable">
      <tr>
          <td> 
            <ul>
              <?php foreach($bet['homeadvices'] as $advice) { ?>
                <li><?php echo $advice['text']; ?></li>
              <?php } ?>
            </ul>
          </td>
          <td>
            <ul>
              <?php foreach($bet['awayadvices'] as $advice) { ?>
                <li><?php echo $advice['text']; ?></li>
              <?php } ?>
            </ul>
          </td>
      </tr>
  </table>

  <?php 

    if($_SESSION['logged'] && !$gameOver && !$hasVoted) {

  ?>

  <table class="votesTable">
    <tr>
      <td><a href="match-<?php echo $bet['id']; ?>-1" class="button">Victoire de l'équipe à domicile</a></td>
      <td><a href="match-<?php echo $bet['id']; ?>-2" class="button">Match nul</a></td>
      <td><a href="match-<?php echo $bet['id']; ?>-3" class="button">Victoire de l'équipe à l'extérieur</a></td>
    </tr>
  </table>

  <?php }

  elseif($_SESSION['logged'] && $gameOver) { ?>

  <strong class="error">Match terminé, il n'est plus possible de voter !</strong>
  
  <?php }
  
  elseif($_SESSION['logged'] && $hasVoted) { ?>

    <table class="votesChart">
      <tr>
        <td>Domicile : <?php echo $percentages['home']; ?>%</td>
        <td>Nul : <?php echo $percentages['draw']; ?>%</td>
        <td>Extérieur : <?php echo $percentages['away']; ?>%</td>
      </tr>
    </table>

  <?php }
  
  else { ?>

  <strong class="good"><a href="members">Connectez vous pour pouvoir voter sur ce match !</a></strong>

  <?php
  }
  ?>
</main>
