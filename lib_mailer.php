<?php
require 'libs/phpmailer/src/PHPMailer.php';
require 'libs/phpmailer/src/Exception.php';
require 'libs/phpmailer/src/SMTP.php';

include ('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function envoyerMail() {
    global $bdd; 

    try {
        // pour récupérer les stages validés et l'email des entreprises associées
        $requete = " SELECT stage_convention.stage_convention_id_convention, stage_convention.stage_convention_nom_entreprise, stage_convention.stage_convention_email_entreprise, noyau_utilisateur.noyau_utilisateur__nom, noyau_utilisateur.noyau_utilisateur__prenom
        FROM stage_convention, noyau_utilisateur 
        WHERE stage_convention.stage_convention_etat = 'validée'
        AND stage_convention.stage_convention_etudiant_id = noyau_utilisateur.noyau_utilisateur__id";

        $stmt = $bdd->query($requete); /
        $stagesValidés = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Vérifier si des stages sont validés
        if (empty($stagesValidés)) {
            echo "Aucun stage validé trouvé.";
            return;
        }

        // parcourir les stages validés et envoyer un email pour chaque entreprise
        foreach ($stagesValidés as $stage) {
            $nomEntreprise = $stage['stage_convention_nom_entreprise'];
            $emailEntreprise = $stage['stage_convention_email_entreprise'];
            $nomEtudiant = $stage['noyau_utilisateur__nom'];
            $prenomEtudiant = $stage['noyau_utilisateur__prenom'];
            $idConvention = $stage['stage_convention_id_convention'];

            // Config du mail
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ton serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'ab.miriame@gmail.com'; // Ton email
            $mail->Password = 'wmni wktg njif hnwz'; // Ton mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinataires
            $mail->setFrom('ab.miriame@gmail.com', "L'équipe de jegeremonstage.fr");
            $mail->addAddress($emailEntreprise); // Email de l'entreprise

            // Sujet et contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = "Signature convention pour {$nomEtudiant} {$prenomEtudiant}";
            $mail->Body = "
                Bonjour,<br><br>
                La convention pour le stage de <strong>{$nomEtudiant} {$prenomEtudiant}</strong> au sein de votre entreprise <strong>{$nomEntreprise}</strong> a été validée.<br>
                Merci de cliquer sur le lien ci-dessous pour signer électroniquement la convention :<br>
                <a href='http://tonsite.com/signer_convention.php?id_convention={$idConvention}'>Signer la convention</a><br><br>
                Cordialement,<br>
                L'équipe de jegeremonstage.fr
            ";

            // Envoyer l'email
            $mail->send();
            echo "Email envoyé avec succès à {$emailEntreprise} pour la convention {$idConvention}.<br>";
        }

    } catch (Exception $e) {
        echo "Erreur lors de l'envoi des emails : {$e->getMessage()}";
    }
}

// fonction pour envoyer les mails
envoyerMail();
?>