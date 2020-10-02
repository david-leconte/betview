<!DOCTYPE html>
<html>
  <head>
    <title>Ajouter admin / gérer liste admins</title>

    <link rel="stylesheet" href="res/admin.css" />
    <meta name="viewport" content= "user-scalable=no">
  <head>
  <body>
    <a href="?admin&page=index">Retour à l'accueil admin</a>
    <h1>Ajouter admin / gérer liste admins</h1>

    <?php if(isset($msg)) { ?>
      <strong>Message : <?php echo $msg; ?></strong>
    <?php } ?>

    <h2>Ajouter admin</h2>

    <p>Il s'agit ici de donner les privilèges administrateur à un utilisateur déjà existant !</p>

    <form action="" method="POST">
      <input type="hidden" value="addadmin" name="addadmin" />
      <input type="text" placeholder="Nom utilisateur" name="admtoadd" required min="4" max="25" />
      <input type="submit" value="Passer admin" />
    </form>

    <h2>Gérer liste des admins</h2>

    <p>Par sécurité, il n'est pas autorisé de supprimer plus d'un administrateur à la fois.</p>

    <form action="" method="POST">
      <input type="hidden" name="deladmin" value="deladmin" />
      <ul>
        <?php foreach($adminsList as $admUsername) { ?>
          <li>
            <?php echo $admUsername; ?> 
            <input type="radio" name="admtodel" value="<?php echo $admUsername; ?>" />
          </li>
        <?php } ?>
      </ul>

      <input type="submit" value="Supprimer admins sélectionnés" />
    </form>
  </body>
</html>

