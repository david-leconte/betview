<?php

$initCount = count($authorsList);

foreach($bets as $testBet) {
  if($testBet['visible'] == 1 && ($key = array_search($testBet['author'], $authorsList)) !== false) {
    $curdate = new DateTime();
    $betdate = new DateTime(str_replace('/', '-', $testBet['date']));

    if($curdate < $betdate) unset($authorsList[$key]);
  }
}

$anyComingBets = (count($authorsList) != $initCount);

if($anyComingBets) {
  foreach($bets as $betX) { 
    if(!in_array($betX['author'], $authorsList)) { ?>

    <h2 class="selectionTitle">La sélection de <?php echo $betX['author']; ?></h2>
    <section class="centralSection">
      <table class="tableSelection">

      <?php 
      
      foreach($bets as $betY) {
        $curdate = new DateTime();
        $betdate = new DateTime(str_replace('/', '-', $betY['date']));

        if($betX['author'] == $betY['author'] && $betY['visible'] == 1 && $curdate < $betdate) { ?>

        <tr>
          <td><?php echo $betY['date']; ?></td>
          <td><a href="match-<?php echo $betY['id']; ?>"><?php echo $betY['hometeam'] . ' - ' . $betY['awayteam']; ?></a></td>
        </tr>

        <?php
        }
      } 
      ?>

      </table>
    </section>
    <?php 

    array_push($authorsList, $betX['author']);
    } 
  }
}

$totalPastBets = 0;

foreach($bets as $testPastBet) {
  $curdate = new DateTime();
  $betdate = new DateTime(str_replace('/', '-', $testPastBet['date']));

  if($testPastBet['visible'] == 1 && $curdate > $betdate) {
    $pastBet = $testPastBet;
    
    if($totalPastBets == 0) { ?>
      <h2 class="selectionTitle">Nos idées de paris dans le passé !</h2>
      <section class="centralSection">
        <table class="tableSelection">
    <?php } ?>
        <tr>
          <td><?php echo $pastBet['date']; ?></td>
          <td><a href="match-<?php echo $pastBet['id']; ?>"><?php echo $pastBet['hometeam'] . ' - ' . $pastBet['awayteam']; ?></a></td>
        </tr>

    <?php 
      $totalPastBets++;
    }

} ?>

      </table>
    </section>

<?php if(!$anyComingBets && $totalPastBets == 0) { ?>
  <h2 class="selectionTitle">Désolé, pas de paris disponibles ici !</h2>
<?php } ?>