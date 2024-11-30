<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
?>

<h2>Connexion</h2>
<form method="POST" action="">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label>Mot de passe:</label>
    <input type="password" name="mot_de_passe" required><br><br>
    
    <button type="submit">Se connecter</button>
</form>
