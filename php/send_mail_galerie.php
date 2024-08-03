<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photos'])) {
    $to = 'dimitrigarrigues@gmail.com';
    $subject = 'Photos pour la Galerie';
    $message = "Bonjour,\n\nVous avez reçu de nouvelles photos pour la galerie.\n";

    $headers = "From: webmaster@votresite.com"; // Remplacez par votre domaine

    $files = $_FILES['photos'];
    $boundary = md5(time());

    $headers .= "\nMIME-Version: 1.0\n" .
                "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";

    $body = "--{$boundary}\n" .
            "Content-Type: text/plain; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
            $message . "\n";

    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] == UPLOAD_ERR_OK) {
            $fileContent = file_get_contents($files['tmp_name'][$i]);
            $fileName = $files['name'][$i];

            $body .= "--{$boundary}\n" .
                    "Content-Type: {$files['type'][$i]}; name=\"{$fileName}\"\n" .
                    "Content-Disposition: attachment; filename=\"{$fileName}\"\n" .
                    "Content-Transfer-Encoding: base64\n\n" .
                    chunk_split(base64_encode($fileContent)) . "\n";
        }
    }

    $body .= "--{$boundary}--";

    if (mail($to, $subject, $body, $headers)) {
        echo "Email envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'email.";
    }
} else {
    echo "Aucune photo sélectionnée.";
}
?>
