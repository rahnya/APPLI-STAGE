<?php
require('..fpdf186/fpdf.php');

// Récupération des données POST avec vérification
$siret = isset($_POST['siret']) ? htmlspecialchars($_POST['siret']) : '';
$ape = isset($_POST['ape']) ? htmlspecialchars($_POST['ape']) : '';
$nom_entreprise = isset($_POST['nom_entreprise']) ? htmlspecialchars($_POST['nom_entreprise']) : '';
$tel_entreprise = isset($_POST['tel_entreprise']) ? htmlspecialchars($_POST['tel_entreprise']) : '';
$lieu_entreprise = isset($_POST['lieu_entreprise']) ? htmlspecialchars($_POST['lieu_entreprise']) : '';
$nom_maitre_stage = isset($_POST['nom_maitre_stage']) ? htmlspecialchars($_POST['nom_maitre_stage']) : '';
$prenom_maitre_stage = isset($_POST['prenom_maitre_stage']) ? htmlspecialchars($_POST['prenom_maitre_stage']) : '';
$numero_telephone_maitre_stage = isset($_POST['numero_telephone_maitre_stage']) ? htmlspecialchars($_POST['numero_telephone_maitre_stage']) : '';
$encadrement_stage = isset($_POST['encadrement_stage']) ? htmlspecialchars($_POST['encadrement_stage']) : '';
$nom_signataire_entreprise = isset($_POST['nom_signataire_entreprise']) ? htmlspecialchars($_POST['nom_signataire_entreprise']) : '';
$prenom_signataire = isset($_POST['prenom_signataire']) ? htmlspecialchars($_POST['prenom_signataire']) : '';
$poste_signataire_entreprise = isset($_POST['poste_signataire_entreprise']) ? htmlspecialchars($_POST['poste_signataire_entreprise']) : '';
$service_entreprise = isset($_POST['service_entreprise']) ? htmlspecialchars($_POST['service_entreprise']) : '';
$email_entreprise = isset($_POST['email_entreprise']) ? htmlspecialchars($_POST['email_entreprise']) : '';
$lieu_stage = isset($_POST['lieu_stage']) ? htmlspecialchars($_POST['lieu_stage']) : '';
$poste_maitre_stage = isset($_POST['poste_maitre_stage']) ? htmlspecialchars($_POST['poste_maitre_stage']) : '';
$tel_maitre_stage = isset($_POST['tel_maitre_stage']) ? htmlspecialchars($_POST['tel_maitre_stage']) : '';
$email_maitre_stage = isset($_POST['email_maitre_stage']) ? htmlspecialchars($_POST['email_maitre_stage']) : '';
$numero_etudiant = isset($_POST['numero_etudiant']) ? htmlspecialchars($_POST['numero_etudiant']) : '';
$nom_etudiant = isset($_POST['nom_etudiant']) ? htmlspecialchars($_POST['nom_etudiant']) : '';
$prenom_etudiant = isset($_POST['prenom_etudiant']) ? htmlspecialchars($_POST['prenom_etudiant']) : '';
$sexe = isset($_POST['sexe']) ? htmlspecialchars($_POST['sexe']) : '';
$date_naissance_etudiant = isset($_POST['date_naissance_etudiant']) ? htmlspecialchars($_POST['date_naissance_etudiant']) : '';
$adresse_etudiant = isset($_POST['adresse_etudiant']) ? htmlspecialchars($_POST['adresse_etudiant']) : '';
$tel_etudiant = isset($_POST['tel_etudiant']) ? htmlspecialchars($_POST['tel_etudiant']) : '';
$email_etudiant = isset($_POST['email_etudiant']) ? htmlspecialchars($_POST['email_etudiant']) : '';
$email_perso_etudiant = isset($_POST['email_perso_etudiant']) ? htmlspecialchars($_POST['email_perso_etudiant']) : '';
$cpam_etudiant = isset($_POST['cpam_etudiant']) ? htmlspecialchars($_POST['cpam_etudiant']) : '';
$sujet_stage = isset($_POST['sujet_stage']) ? htmlspecialchars($_POST['sujet_stage']) : '';
$date_debut = isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : '';
$date_fin = isset($_POST['date_fin']) ? htmlspecialchars($_POST['date_fin']) : '';
$repartition = isset($_POST['repartition']) ? htmlspecialchars($_POST['repartition']) : '';
$semaines_stage = isset($_POST['semaines_stage']) ? htmlspecialchars($_POST['semaines_stage']) : '';
$nb_jours_stage = isset($_POST['nb_jours_stage']) ? htmlspecialchars($_POST['nb_jours_stage']) : '';
$heures_par_jour_stage = isset($_POST['heures_par_jour_stage']) ? htmlspecialchars($_POST['heures_par_jour_stage']) : '';
$heures_par_semaine_stage = isset($_POST['heures_par_semaine_stage']) ? htmlspecialchars($_POST['heures_par_semaine_stage']) : '';
$nb_conges = isset($_POST['nb_conges']) ? htmlspecialchars($_POST['nb_conges']) : '';
$commentaire_stage = isset($_POST['commentaire_stage']) ? htmlspecialchars($_POST['commentaire_stage']) : '';
$activites_stage = isset($_POST['activites_stage']) ? htmlspecialchars($_POST['activites_stage']) : '';
$competences_stage = isset($_POST['competences_stage']) ? htmlspecialchars($_POST['competences_stage']) : '';
$gratification = isset($_POST['gratification']) ? htmlspecialchars($_POST['gratification']) : '';
$avantages_5bis = isset($_POST['avantages_5bis']) ? htmlspecialchars($_POST['avantages_5bis']) : '';
$avantages_5ter = isset($_POST['avantages_5ter']) ? htmlspecialchars($_POST['avantages_5ter']) : '';
$signature_stagiaire = isset($_POST['signature_stagiaire']) ? htmlspecialchars($_POST['signature_stagiaire']) : '';



// Initialisation du PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Titre
$pdf->Cell(0, 10, 'Convention de Stage', 0, 1, 'C');
$pdf->Ln(10);

// Organisme d'accueil
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(1, 10, "1. Organisme d'accueil", 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "SIRET : $siret", 0, 1);
$pdf->Cell(0, 10, "Nom de l'organisme : $nom_entreprise", 0, 1);
$pdf->Cell(0, 10, "Numéro de téléphone : $tel_entreprise", 0, 1);
$pdf->Cell(0, 10, "Adresse : $lieu_entreprise", 0, 1);
$pdf->Cell(0, 10, "Nom du maitre de stage : $nom_maitre_stage", 0, 1);
$pdf->Cell(0, 10, "Prénom du maitre de stage : $prenom_maitre_stage", 0, 1);
$pdf->Cell(0, 10, "Numéro de téléphone du maître de stage $numero_telephone_maitre_stage", 0, 1);
$pdf->Cell(0, 10, "Modalités d'encadrement : $encadrement_stage", 0, 1);
$pdf->Cell(0, 10, "Nom du signataire de la convention : $nom_signataire_entreprise", 0, 1);
$pdf->Cell(0, 10, "Prénom du signataire de la convention : $prenom_signataire", 0, 1);
$pdf->Cell(0, 10, "Qualité du représentant : $poste_signataire_entreprise", 0, 1);
$pdf->Cell(0, 10, ">Service dans lequel le stage sera effectué : $service_entreprise", 0, 1);
$pdf->Cell(0, 10, "Adresse mail de l'entreprise : $email_entreprise", 0, 1);
$pdf->Cell(0, 10, ">Lieu du stage (si différent de celle de l’organisme) : $lieu_stage", 0, 1);
$pdf->Cell(0, 10, ">Poste du maître de stage : $poste_maitre_stage", 0, 1);
$pdf->Cell(0, 10, ">Numéro de téléphone du maître de stage : $tel_maitre_stage", 0, 1);
$pdf->Cell(0, 10, ">Adresse mail du maître de stage  : $email_maitre_stage", 0, 1);
$pdf->Cell(0, 10, ">Votre numéro étudiant : $numero_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre nom : $nom_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre prénom : $prenom_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre sexe : $sexe", 0, 1);
$pdf->Cell(0, 10, ">Votre date de naissance : $date_naissance_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre adresse : $adresse_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre numéro de téléphone : $tel_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre adresse mail étudiante : $email_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre adresse mail personnelle : $email_perso_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Votre caisse primaire d'assurance maladie : $cpam_etudiant", 0, 1);
$pdf->Cell(0, 10, ">Sujet du stage : $sujet_stage", 0, 1);
$pdf->Cell(0, 10, ">date_debut : $date_debut", 0, 1);
$pdf->Cell(0, 10, ">date_fin : $date_fin", 0, 1);
$pdf->Cell(0, 10, ">Répartition discontinue : $repartition", 0, 1);
$pdf->Cell(0, 10, ">semaines de stage : $semaines_stage", 0, 1);
$pdf->Cell(0, 10, ">jours de présence en stage : $nb_jours_stage", 0, 1);
$pdf->Cell(0, 10, ">heures de présence par jour : $heures_par_jour_stage", 0, 1);
$pdf->Cell(0, 10, ">heures de présence par semaine: $heures_par_semaine_stage", 0, 1);
$pdf->Cell(0, 10, ">jours de congés autorisés : $nb_conges", 0, 1);
$pdf->Cell(0, 10, ">Commentaires : $commentaire_stage", 0, 1);
$pdf->Cell(0, 10, ">Activités confiées : $activites_stage", 0, 1);
$pdf->Cell(0, 10, ">Compétences à acquerir/développer : $competences_stage", 0, 1);
$pdf->Cell(0, 10, ">montant de la gratification par mois: $gratification", 0, 1);
$pdf->Cell(0, 10, ">Avantages - Accés aux droits des salariés  : $avantages_5bis", 0, 1);
$pdf->Cell(0, 10, ">Avantages - Accés aux droits des agents  : $avantages_5ter", 0, 1);
$pdf->Cell(0, 10, ">Je signe et certifie l'exactitude de ces informations. $signature_stagiaire", 0, 1);

$pdf->Ln(10);

// Génération du PDF
$pdf->Output('I', 'convention_stage.pdf');
exit;
?>
