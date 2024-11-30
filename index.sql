CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255)
);

CREATE TABLE cartes_cadeaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    montant DECIMAL(10, 2),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);
