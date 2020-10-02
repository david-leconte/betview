<?php

if(empty($bet['odds'])) $bet['odds'] = 1;
if(empty($bet['title'])) $bet['title'] = "Non disponible";
if(empty($bet['date'])) $bet['date'] = "00/00/0000";
if(empty($bet['advice'])) $bet['advice'] = "None"; 

?>

{
  "odds": <?php echo $bet['odds']; ?>,
  "title": "<?php echo $bet['title']; ?>",
  "date": "<?php echo $bet['date']; ?>",
  "bet": "<?php echo $bet['advice']; ?>"
}

