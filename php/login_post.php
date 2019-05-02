<?php
session_start();  // démarrer une session

// verification données du formulaire ok
if (isset($_POST['login']) && isset($_POST['mdp'])) {
    require 'fonction.php';
            $bdd = getBdd();
    // sert à récupérer l'utilisateur depuis la BD
            $requete = "SELECT * FROM utilis WHERE LoginUtil=? AND PassUtil=?";
            $resultat = $bdd->prepare($requete);
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];

            $resultat->execute(array($login, $mdp));
if         ($resultat->rowCount() == 1) {
        // l'utilisateur existe ds la table
    
            $_SESSION['login'] = $login;
            $_SESSION['mdp'] = $mdp;
        // cette variable indique que l'authentification a bien marché
            $authOK = true;
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Résultat de l'authentification</title>
</head>
<body>
    <h1>Résultat de l'authentification</h1>
    <?php
if (isset($authOK)) {
        echo "<p>Vous avez été reconnu(e) en tant que " . escape($login) . "</p>";
        echo '<a href="liste.php">continuer vers la page d\'accueil</a>';
    }
    else { ?>
        <p>Vous n'avez pas été reconnu(e)</p>
        <p><a href="index.php">Essayer à nouveau</p>
    <?php } ?>
</body>
</html>