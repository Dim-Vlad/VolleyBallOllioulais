<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'dimitrigarrigues@gmail.com'; // Remplacez par votre email
    $subject = 'Nouveau message de contact';
    $message = 'Nom: ' . $_POST['lastname'] . "\n" .
                'Prénom: ' . $_POST['firstname'] . "\n" .
                'E-mail: ' . $_POST['mail'] . "\n\n" .
                'Objet: ' . $_POST['objet'] . "\n" .
                'Message: ' . $_POST['subject'];
    $headers = 'From: webmaster@votresite.com';

    if (mail($to, $subject, $message, $headers)) {
        echo 'Message envoyé avec succès';
    } else {
        http_response_code(500);
        echo 'Erreur lors de l\'envoi du message';
    }
}
?>
