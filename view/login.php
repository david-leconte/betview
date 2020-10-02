<h2>Se connecter / s'inscrire</h2>
<main class="centralSection">
  <?php if(isset($err)) { ?>
    <strong class="error">Erreur : <?php echo $err; ?></strong>
  <?php } ?>
  <table class="formTable">
    <tr>
      <td class="login">
        <h3>Si vous avez déjà un compte</h3>
        <form action="" method="POST">
          <input type="hidden" name="login">

          <label for="username">Pseudo :</label>
          <input id="username" type="text" min="4" max="25" name="username" required /><br />

          <label for="password">Mot de passe :</label>
          <input id="password" type="password" min="5" max="25" name="password" required /><br />

          <input class="button" type="submit" value="Se connecter" />
        </form>
      </td>
      <td class="register">
        <h3>Pourquoi pas vous inscrire ?</h3>
        <form action="" method="POST">
          <input type="hidden" name="register">

          <label for="regusername">Choisir pseudo :</label>
          <input id="regusername" type="text" min="4" max="25" name="regusername" required /><br />

          <label for="regpassword">Mot de passe :</label>
          <input id="regpassword" type="password" min="5" max="25" name="regpassword" required /><br />

          <label for="confpassword">Confirmer mot de passe :</label>
          <input id="confpassword" type="password" min="5" max="25" name="confpassword" required /><br />

          <label for="email">Adresse e-mail :</label>
          <input id="email" type="email" min="9" max="25" name="email" required /><br />

          <input id="over18" type="checkbox" name="over18" required />
          <label for="over18">En vous inscrivant, vous confirmez sur l'honneur que, conformément aux lois françaises concernant les paris sportifs, vous avez plus de 18 ans.</label><br />

          <input class="button" type="submit" value="S'inscrire" />
        </form>
      </td>
    </tr>
  </table>
</main>