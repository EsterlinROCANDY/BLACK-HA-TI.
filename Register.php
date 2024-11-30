<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
?>

<h2>Inscription</h2>
<form method="POST" action="">
    <label>Nom d'utilisateur:</label>
    <input type="text" name="nom_utilisateur" required><br><br>
    
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label>Mot de passe:</label>
    <input type="password" name="mot_de_passe" required><br><br>
    
    <button type="submit">S'inscrire</button>
</form>
