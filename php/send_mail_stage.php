<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "dimitrigarrigues@gmail.com";
    $subject = "Pré-inscription stage VBO";

    // Récupération des informations du formulaire
    $nomStagiaire = $_POST['nomStagiaire'];
    $prenomStagiaire = $_POST['prenomStagiaire'];
    $categorie = $_POST['categorie'];
    $genre = $_POST['genre'];
    $licencieVBO = $_POST['licencieVBO'];
    $nomResponsable = $_POST['nomResponsable'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Récupération des informations du fichier
    $fileTmpPath = $_FILES['fichier']['tmp_name'];
    $fileName = $_FILES['fichier']['name'];
    $fileSize = $_FILES['fichier']['size'];
    $fileType = $_FILES['fichier']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Lecture du fichier
    $handle = fopen($fileTmpPath, "r");
    $content = fread($handle, $fileSize);
    fclose($handle);
    $encodedContent = chunk_split(base64_encode($content));

    // Création d'une frontière unique
    $boundary = md5(time());

    // En-têtes
    $headers = "From: webmaster@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";

    // Construction du message
    $message = "--" . $boundary . "\r\n";
    $message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= "Nom du stagiaire: $nomStagiaire\n";
    $message .= "Prénom du stagiaire: $prenomStagiaire\n";
    $message .= "Catégorie: $categorie\n";
    $message .= "Genre: $genre\n";
    $message .= "Licencié VBO: $licencieVBO\n";
    $message .= "Nom et prénom du responsable: $nomResponsable\n";
    $message .= "Email: $email\n";
    $message .= "Téléphone: $telephone\n\r\n";

    // Ajout du fichier en pièce jointe
    $message .= "--" . $boundary . "\r\n";
    $message .= "Content-Type: $fileType; name=\"" . $fileName . "\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"" . $fileName . "\"\r\n\r\n";
    $message .= $encodedContent . "\r\n";
    $message .= "--" . $boundary . "--";

    // Envoi de l'email
    if (mail($to, $subject, $message, $headers)) {
        echo "Formulaire envoyé avec succès.";
    } else {
        echo "Échec de l'envoi du formulaire.";
    }
}
?>
