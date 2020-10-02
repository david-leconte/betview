<?php 

if($detailedBets == 1) {
  if(!$config['hidepastbets']) $bets = $db->query('SELECT * FROM bets ORDER BY author')->fetch_all(dbres);
  else {
    $bets = $db->query('SELECT * FROM bets WHERE date > CURDATE() ORDER BY author')->fetch_all(dbres);
  }

  for($i = 0; $i < count($bets); $i++) {
    $homeAcronym = substr($bets[$i]['id'], 0, 3);
    $awayAcronym = substr($bets[$i]['id'], 4, 3);
  
    $bets[$i]['hometeam'] = $db->query('SELECT teamname FROM teams WHERE acronym = "' . $homeAcronym . '"')->fetch_array(dbres)['teamname'];
    $bets[$i]['awayteam'] = $db->query('SELECT teamname FROM teams WHERE acronym = "' . $awayAcronym . '"')->fetch_array(dbres)['teamname'];

    $bets[$i]['title'] = $bets[$i]['hometeam'] . ' - ' . $bets[$i]['awayteam'];
  }
}

elseif($detailedBets == 0) {
  if(!$config['hidepastbets']) $bets = $db->query('SELECT * FROM simplebets')->fetch_all(dbres);
  else {
    $bets = $db->query('SELECT * FROM simplebets WHERE date > CURDATE()')->fetch_all(dbres);
  }
}

for($i = 0; $i < count($bets); $i++) {
  $date = new DateTime($bets[$i]['date']);
  $bets[$i]['date'] = $date->format("d/m/Y");
}

?>