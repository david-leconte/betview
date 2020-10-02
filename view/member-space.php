<h2>
  Espace membres : bonjour <?php echo $_SESSION['username']; ?> !
</h2>

<main class="centralSection">
  <?php if(isset($err)) { ?>
    <strong class="error">Erreur : <?php echo $err; ?></strong>
  <?php } ?>

  <?php if(isset($good)) { ?>
    <strong class="good">Opération réussie !</strong>
  <?php } ?>

  <a class="button" href="log-out">Se déconnecter</a>

  <table class="formTable">
    <tr>
      <td class="passchange">
        <h3>Changer ton mot de passe</h3>
        <form action="" method="POST">
          <input type="hidden" name="passchange">

          <label for="oldpassword">Ancien mot de passe :</label>
          <input id="oldpassword" type="password" min="5" max="25" name="oldpassword" required /><br />

          <label for="newpassword">Nouveau mot de passe :</label>
          <input id="newpassword" type="password" min="5" max="25" name="newpassword" required /><br />

          <label for="confpassword">Confirmer nouveau mot de passe :</label>
          <input id="confpassword" type="password" min="5" max="25" name="confpassword" required /><br />

          <input class="button" type="submit" value="Changer de mot de passe" />
        </form>
      </td>
      <td class="emailchange">
        <h3>Changer d'email</h3>
        <form action="" method="POST">
          <input type="hidden" name="emailchange">

          <label for="password">Confirmer mot de passe :</label>
          <input id="password" type="password" min="5" max="25" name="password" required /><br />

          <label for="email">Adresse e-mail :</label>
          <input id="email" type="email" min="9" max="25" name="email" required /><br />

          <input class="button" type="submit" value="Changer d'email" />
        </form>
      </td>
    </tr>
  </table>
</main>

