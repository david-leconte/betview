<?php

$path = basename(getcwd(), "\\");

$seed = random_int(1, 100);
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>
      <?php

        if(!isset($pageTitle)) {
          echo $config['sitename'];
        }

        else echo $pageTitle;
      ?>
    </title>
    <meta charset="utf-8">
    <meta name="Description" content="<?php echo $config['sitename']; ?> rassemble les meilleurs paris sportifs du moment, succès et retours garantis par notre équipe expérimentée de parieurs !">
    <meta name="theme-color" content="#06123a">
    <link href="res/default.css?seed=<?php echo $seed; ?>" rel="stylesheet">
    <link href="res/favicon.png?seed=<?php echo $seed; ?>" rel="icon">
  </head>
  <body>
    <header>
      <h1>
        <i class="material-icons menuIcon">format_list_bulleted</i> 
        <a href="index">
        <i class="material-icons logoIcon">sports_soccer</i>  <?php echo $config['sitename']; ?>
        </a>
      </h1>
      <table id="headerTable">
        <tr>
          <td class="headerButton headerOptions">
            <a href="index">
            <i class="material-icons">thumb_up</i> Sélections de nos parieurs
            </a>
          </td>
          <td class="headerButton headerOptions">
            <a href="coming">
            <i class="material-icons">whatshot</i> Matchs à venir
            </a>
          </td>
          <td class="headerButton" id="premiumLink">
            <a href="support-us">
            <i class="material-icons">star</i> Vos codes promos
            </a>
          </td>
          <td class="headerButton">
            <a href="members">
            <i class="material-icons">person</i> Espace membres
            </a>
          </td>
        </tr>
      </table>
    </header>
    <nav>
  <table>
    <tr>
      <td>Cote totale <?php echo $config['bookmaker']; ?> @<i class="total">1.00</i></td>
    </tr>
    </tr>
    <tr class="mySelection">
      <td>Ma sélection</td>
    </tr>
  </table>
</nav>

