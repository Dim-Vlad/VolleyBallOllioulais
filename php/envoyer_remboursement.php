<?php
// Vérifier si les données sont bien envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$nom || !$email) {
        echo "<script>alert('Veuillez remplir tous les champs correctement.'); window.history.back();</script>";
        exit;
    }

    // Gestion du fichier
    if (!isset($_FILES['fichier']) || $_FILES['fichier']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Erreur lors du téléchargement du fichier.'); window.history.back();</script>";
        exit;
    }

    $fichier_tmp = $_FILES['fichier']['tmp_name'];
    $fichier_nom = basename($_FILES['fichier']['name']);
    $fichier_type = $_FILES['fichier']['type'];

    // Limiter aux PDF
    if ($fichier_type !== 'application/pdf') {
        echo "<script>alert('Seuls les fichiers PDF sont autorisés.'); window.history.back();</script>";
        exit;
    }

    // Contenu du message
    $message = "Nom : $nom\n";
    $message .= "Email : $email\n";

    // Destinataire
    $destinataire = "dimitrigarrigues@gmail.com; arron7_330@hotmail.com";
    $sujet = "Formulaire avec fichier PDF - $nom";

    // Frontière unique
    $boundary = md5(uniqid(mt_rand(), true));

    // Entêtes
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Corps du mail
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n\r\n";

    // Lecture du fichier
    $fichier_content = file_get_contents($fichier_tmp);
    $fichier_content = chunk_split(base64_encode($fichier_content));

    // Pièce jointe
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: application/pdf; name=\"$fichier_nom\"\r\n";
    $body .= "Content-Disposition: attachment\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= $fichier_content . "\r\n";
    $body .= "--$boundary--\r\n";

    // Envoi du mail
    if (mail($destinataire, $sujet, $body, $headers)) {
        echo "<script>alert('Message envoyé avec succès !'); window.location.href='../index.html';</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'envoi du message.'); window.history.back();</script>";
    }
}