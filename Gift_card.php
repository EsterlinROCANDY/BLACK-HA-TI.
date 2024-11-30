<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

<h2>Achetez une carte cadeau</h2>
<form method="POST" action="">
    <label>ID utilisateur:</label>
    <input type="text" name="id_utilisateur" required><br><br>
    
    <label>Montant de la carte cadeau:</label>
    <input type="number" name="montant" required><br><br>
    
    <button type="submit">Acheter</button>
</form>

<h3>Instructions de paiement</h3>
<p>Pour compléter votre achat, veuillez nous contacter via WhatsApp au <strong>44218865</strong> pour obtenir les informations de paiement MonCash.</p>
