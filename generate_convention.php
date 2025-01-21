<?php
require('fpdf186/fpdf.php');

// Récupération des données POST avec vérification
$siret = isset($_POST['siret']) ? htmlspecialchars($_POST['siret']) : '';
$APE = isset($_POST['APE']) ? htmlspecialchars($_POST['APE']) : '';
$nom_organisme = isset($_POST['nom_organisme']) ? htmlspecialchars($_POST['nom_organisme']) : '';
$numero_telephone_organisme = isset($_POST['numero_telephone_organisme']) ? htmlspecialchars($_POST['numero_telephone_organisme']) : '';
$adresse_organisme = isset($_POST['adresse_organisme']) ? htmlspecialchars($_POST['adresse_organisme']) : '';
$nom_maitre_stage = isset($_POST['nom_maitre_stage']) ? htmlspecialchars($_POST['nom_maitre_stage']) : '';
$numero_telephone_maitre_stage = isset($_POST['numero_telephone_maitre_stage']) ? htmlspecialchars($_POST['numero_telephone_maitre_stage']) : '';
$modalites = isset($_POST['modalites']) ? htmlspecialchars($_POST['modalites']) : '';
$nom_signataire = isset($_POST['nom_signataire']) ? htmlspecialchars($_POST['nom_signataire']) : '';
$qualite_representant = isset($_POST['qualite_representant']) ? htmlspecialchars($_POST['qualite_representant']) : '';
$service_stage = isset($_POST['service_stage']) ? htmlspecialchars($_POST['service_stage']) : '';
$email_entreprise = isset($_POST['email_entreprise']) ? htmlspecialchars($_POST['email_entreprise']) : '';
$lieu_stage = isset($_POST['lieu_stage']) ? htmlspecialchars($_POST['lieu_stage']) : '';
$poste_maitre_stage = isset($_POST['poste_maitre_stage']) ? htmlspecialchars($_POST['poste_maitre_stage']) : '';
$numero_telephone_maitre_stage = isset($_POST['numero_telephone_maitre_stage']) ? htmlspecialchars($_POST['numero_telephone_maitre_stage']) : '';
$email_maitre_stage = isset($_POST['email_maitre_stage']) ? htmlspecialchars($_POST['email_maitre_stage']) : '';
$numero_etudiant = isset($_POST['numero_etudiant']) ? htmlspecialchars($_POST['numero_etudiant']) : '';
$nom_etudiant = isset($_POST['nom_etudiant']) ? htmlspecialchars($_POST['nom_etudiant']) : '';
$prenom_etudiant = isset($_POST['prenom_etudiant']) ? htmlspecialchars($_POST['prenom_etudiant']) : '';
$adresse_etudiant = isset($_POST['adresse_etudiant']) ? htmlspecialchars($_POST['adresse_etudiant']) : '';
$date_naissance_etudiant = isset($_POST['date_naissance_etudiant']) ? htmlspecialchars($_POST['date_naissance_etudiant']) : '';
$numero_telephone_etudiant = isset($_POST['numero_telephone_etudiant']) ? htmlspecialchars($_POST['numero_telephone_etudiant']) : '';
$email_etudiant = isset($_POST['email_etudiant']) ? htmlspecialchars($_POST['email_etudiant']) : '';
$email_perso_etudiant = isset($_POST['email_perso_etudiant']) ? htmlspecialchars($_POST['email_perso_etudiant']) : '';
$caisse_assurance_maladie_etudiant = isset($_POST['caisse_assurance_maladie_etudiant']) ? htmlspecialchars($_POST['caisse_assurance_maladie_etudiant']) : '';
$sujet_stage = isset($_POST['sujet_stage']) ? htmlspecialchars($_POST['sujet_stage']) : '';
$date_debut_stage = isset($_POST['date_debut_stage']) ? htmlspecialchars($_POST['date_debut_stage']) : '';
$date_fin_stage = isset($_POST['date_fin_stage']) ? htmlspecialchars($_POST['date_fin_stage']) : '';
$nb_semaines_stage = isset($_POST['nb_semaines_stage']) ? htmlspecialchars($_POST['nb_semaines_stage']) : '';
$nb_jours_stage = isset($_POST['nb_jours_stage']) ? htmlspecialchars($_POST['nb_jours_stage']) : '';
$nb_heures_par_jour_stage = isset($_POST['nb_heures_par_jour_stage']) ? htmlspecialchars($_POST['nb_heures_par_jour_stage']) : '';
$nb_heures_par_semaine_stage = isset($_POST['nb_heures_par_semaine_stage']) ? htmlspecialchars($_POST['nb_heures_par_semaine_stage']) : '';
$nb_heures_par_jour_stage = isset($_POST['nb_heures_par_jour_stage']) ? htmlspecialchars($_POST['nb_heures_par_jour_stage']) : '';
$nb_heures_par_semaine_stage = isset($_POST['nb_heures_par_semaine_stage']) ? htmlspecialchars($_POST['nb_heures_par_semaine_stage']) : '';
$commentaires_stage = isset($_POST['commentaires_stage']) ? htmlspecialchars($_POST['commentaires_stage']) : '';



// Initialisation du PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Titre
$pdf->Cell(0, 10, 'Convention de Stage', 0, 1, 'C');
$pdf->Ln(10);

// Organisme d'accueil
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, "1. Organisme d'accueil", 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "SIRET : $siret", 0, 1);
$pdf->Cell(0, 10, "Nom de l'organisme : $nom_organisme", 0, 1);
$pdf->Cell(0, 10, "Adresse : $adresse_organisme", 0, 1);
$pdf->Cell(0, 10, "Nom du maitre de stage : $nom_maitre_stage", 0, 1);
$pdf->Cell(0, 10, "Telephone : $numero_telephone_maitre_stage", 0, 1);
$pdf->Cell(0, 10, "Mail : $email_entreprise", 0, 1);
$pdf->Cell(0, 10, "Lieu de stage : $lieu_stage", 0, 1);
$pdf->Cell(0, 10, "Poste du maitre de stage : $poste_maitre_stage", 0, 1);
$pdf->Cell(0, 10, ">Numéro de téléphone du maître de stage : $numero_telephone_maitre_stage", 0, 1);
$pdf->Cell(0, 10, "Email du maitre de stage : $email_maitre_stage", 0, 1);
$pdf->Cell(0, 10, ">Numéro etudiant : $numero_etudiant", 0, 1);
$pdf->Cell(0, 10, ">nom_etudiant : $nom_etudiant", 0, 1);
$pdf->Cell(0, 10, ">prenom_etudiant : $prenom_etudiant", 0, 1);
$pdf->Cell(0, 10, ">adresse_etudiant : $adresse_etudiant", 0, 1);
$pdf->Cell(0, 10, ">date_naissance_etudiant : $date_naissance_etudiant", 0, 1);
$pdf->Cell(0, 10, ">numero_telephone_etudiant : $numero_telephone_etudiant", 0, 1);
$pdf->Cell(0, 10, ">email_etudiant : $email_etudiant", 0, 1);
$pdf->Cell(0, 10, ">email_perso_etudiant : $email_perso_etudiant", 0, 1);
$pdf->Cell(0, 10, ">caisse_assurance_maladie_etudiant : $caisse_assurance_maladie_etudiant", 0, 1);
$pdf->Cell(0, 10, ">date_debut_stage : $date_debut_stage", 0, 1);
$pdf->Cell(0, 10, ">date_fin_stage : $date_fin_stage", 0, 1);
$pdf->Cell(0, 10, ">nb_semaines_stage : $nb_semaines_stage", 0, 1);
$pdf->Cell(0, 10, ">nb_jours_stage : $nb_jours_stage", 0, 1);
$pdf->Cell(0, 10, ">nb_heures_par_jour_stage : $nb_heures_par_jour_stage", 0, 1);
$pdf->Cell(0, 10, ">nb_heures_par_semaine_stage : $nb_heures_par_semaine_stage", 0, 1);
$pdf->Cell(0, 10, ">commentaires_stage : $commentaires_stage", 0, 1);

$pdf->Ln(10);

// Génération du PDF
$pdf->Output('I', 'convention_stage.pdf');
exit;
?>
