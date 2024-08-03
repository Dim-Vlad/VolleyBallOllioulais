<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture et nettoie les données du formulaire
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = htmlspecialchars(trim($_POST['mail']));
    $subject = htmlspecialchars(trim($_POST['subject']));

    // Adresse email de destination
    $to = 'dimitrigarrigues@gmail.com';

    // Sujet de l'email
    $email_subject = "Nouveau message de $firstname $lastname";

    // Corps du message
    $email_body = "Nom: $firstname\nPrénom: $lastname\nEmail: $email\n\nMessage:\n$subject";

    // En-têtes de l'email
    $headers = "From: $email";

    // Envoi de l'email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Une erreur est survenue, veuillez réessayer.";
    }
}
?>
