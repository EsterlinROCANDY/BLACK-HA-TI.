<?php
include('db.php');

// Inscription
if (isset($_POST['inscription'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $query = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe) VALUES (:nom_utilisateur, :email, :mot_de_passe)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->execute();

    echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
}

// Connexion
if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $query = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        echo "Connexion réussie!";
        // Rediriger l'utilisateur vers la page des cartes cadeaux
        header("Location: gift_card.php");
    } else {
        echo "Email ou mot de passe incorrect!";
    }
}

// Achat de carte cadeau
if (isset($_POST['achat'])) {
    $id_utilisateur = $_POST['id_utilisateur'];
    $montant = $_POST['montant'];

    // Sauvegarde de l'achat dans la base de données
    $query = "INSERT INTO cartes_cadeaux (id_utilisateur, montant) VALUES (:id_utilisateur, :montant)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->bindParam(':montant', $montant);
    $stmt->execute();

    echo "Achat de carte cadeau réussi ! Veuillez procéder au paiement via WhatsApp.";
}
?>

<h2>Inscription</h2>
<form method="POST" action="">
    <label>Nom d'utilisateur:</label>
    <input type="text" name="nom_utilisateur" required><br><br>
    
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label>Mot de passe:</label>
    <input type="password" name="mot_de_passe" required><br><br>
    
    <button type="submit" name="inscription">S'inscrire</button>
</form>

<h2>Connexion</h2>
<form method="POST" action="">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label>Mot de passe:</label>
    <input type="password" name="mot_de_passe" required><br><br>
    
    <button type="submit" name="connexion">Se connecter</button>
</form>

<h2>Achetez une carte cadeau</h2>
<form method="POST" action="">
    <label>ID utilisateur:</label>
    <input type="text" name="id_utilisateur" required><br><br>
    
    <label>Montant de la carte cadeau:</label>
    <input type="number" name="montant" required><br><br>
    
    <button type="submit" name="achat">Acheter</button>
</form>

<h3>Instructions de paiement</h3>
<p>Pour compléter votre achat, veuillez nous contacter via WhatsApp au <strong>44218865</strong> pour obtenir les informations de paiement MonCash.</p>
<a href="https://wa.me/44218865?text=Bonjour,%20je%20souhaite%20effectuer%20un%20paiement%20MonCash%20pour%20une%20carte%20cadeau." target="_blank">
    <button>Contacter via WhatsApp pour payer</button>
</a>
