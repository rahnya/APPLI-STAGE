<?php
session_start();
require_once '../config.php';
require('../fpdf186/fpdf.php');

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}

$user = $_SESSION['user'];
$userId = $user['noyau_utilisateur__id'];

// Récupération et sécurisation des données POST
$siret = htmlspecialchars($_POST['siret'] ?? '');
$ape = htmlspecialchars($_POST['ape'] ?? '');
$nom_entreprise = htmlspecialchars($_POST['nom_entreprise'] ?? '');
$tel_entreprise = htmlspecialchars($_POST['tel_entreprise'] ?? '');
$lieu_entreprise = htmlspecialchars($_POST['lieu_entreprise'] ?? '');
$nom_maitre_stage = htmlspecialchars($_POST['nom_maitre_stage'] ?? '');
$prenom_maitre_stage = htmlspecialchars($_POST['prenom_maitre_stage'] ?? '');
$tel_maitre_stage = htmlspecialchars($_POST['tel_maitre_stage'] ?? '');
$email_maitre_stage = htmlspecialchars($_POST['email_maitre_stage'] ?? '');
$sujet_stage = htmlspecialchars($_POST['sujet_stage'] ?? '');
$date_debut = htmlspecialchars($_POST['date_debut'] ?? '');
$date_fin = htmlspecialchars($_POST['date_fin'] ?? '');
$gratification = htmlspecialchars($_POST['gratification'] ?? '');
$commentaire_stage = htmlspecialchars($_POST['commentaire_stage'] ?? '');
$etat = 'non soumise'; // Par défaut, la convention n'est pas encore validée

// Insertion des données dans la BDD
$stmt = $pdo->prepare("INSERT INTO stage_convention 
    (stage_convention_siret, stage_convention_ape, stage_convention_nom_entreprise, 
    stage_convention_tel_entreprise, stage_convention_lieu_entreprise, stage_convention_nom_maitre_stage, 
    stage_convention_prenom_maitre_stage, stage_convention_tel_maitre_stage, stage_convention_email_maitre_stage, 
    stage_convention_sujet_stage, stage_convention_date_debut, stage_convention_date_fin, 
    stage_convention_gratification, stage_convention_commentaire_stage, stage_convention_etudiant_id, stage_convention_etat) 
    VALUES (:siret, :ape, :nom_entreprise, :tel_entreprise, :lieu_entreprise, :nom_maitre_stage, 
    :prenom_maitre_stage, :tel_maitre_stage, :email_maitre_stage, :sujet_stage, :date_debut, :date_fin, 
    :gratification, :commentaire_stage, :userId, :etat)");

$stmt->execute([
    'siret' => $siret,
    'ape' => $ape,
    'nom_entreprise' => $nom_entreprise,
    'tel_entreprise' => $tel_entreprise,
    'lieu_entreprise' => $lieu_entreprise,
    'nom_maitre_stage' => $nom_maitre_stage,
    'prenom_maitre_stage' => $prenom_maitre_stage,
    'tel_maitre_stage' => $tel_maitre_stage,
    'email_maitre_stage' => $email_maitre_stage,
    'sujet_stage' => $sujet_stage,
    'date_debut' => $date_debut,
    'date_fin' => $date_fin,
    'gratification' => $gratification,
    'commentaire_stage' => $commentaire_stage,
    'userId' => $userId,
    'etat' => $etat
]);

$stageId = $pdo->lastInsertId();

// Initialisation du PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Génération du PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Convention de Stage', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Nom de l'entreprise : $nom_entreprise", 0, 1);
$pdf->Cell(0, 10, "Sujet du stage : $sujet_stage", 0, 1);
$pdf->Cell(0, 10, "Date de début : $date_debut", 0, 1);
$pdf->Cell(0, 10, "Date de fin : $date_fin", 0, 1);
$pdf->Ln(10);
// Génération du PDF
$pdf->Output('I', "convention_stage_$stageId.pdf");
exit;
?>
