<?php
session_start();
require_once 'db.php';

// Vérification de l'authentification
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

// Récupérer les conventions pour un étudiant
function getUserConventions($userId) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT sc.stage_convention_id_convention, sc.stage_convention_nom_entreprise
        FROM stage_convention sc
        WHERE sc.stage_convention_etudiant_id = :userId
    ");
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer les conventions pour un tuteur (conventions des étudiants qu'il encadre)
function getTutorConventions($userId) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT sc.stage_convention_id_convention, sc.stage_convention_nom_entreprise
        FROM stage_convention sc
        WHERE sc.stage_convention_tuteur_id = :userId
    ");
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer les messages associés à une convention spécifique
function getMessages($conventionId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT sm.stage_message_id_message, sm.stage_message_id_auteur_message, sm.stage_message_contenu_message, nu.noyau_utilisateur__nom, nu.noyau_utilisateur__prenom 
                           FROM stage_message sm
                           JOIN noyau_utilisateur nu ON sm.stage_message_id_auteur_message = nu.noyau_utilisateur__id
                           WHERE sm.stage_message_stage_id = :conventionId
                           ORDER BY sm.stage_message_id_message ASC");
    $stmt->execute(['conventionId' => $conventionId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ajouter un message
function addMessage($authorId, $content, $conventionId) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO stage_message (stage_message_id_auteur_message, stage_message_contenu_message, stage_message_stage_id) 
                           VALUES (:authorId, :content, :conventionId)");
    $stmt->execute([
        'authorId' => $authorId,
        'content' => $content,
        'conventionId' => $conventionId
    ]);
}

// Récupérer les conventions de l'utilisateur
if ($user['noyau_utilisateur__sigle'] == 'etudiant') {
    $conventions = getUserConventions($user['noyau_utilisateur__id']);
} elseif ($user['noyau_utilisateur__sigle'] == 'tuteur_de_stage') {
    $conventions = getTutorConventions($user['noyau_utilisateur__id']);
}

$messages = [];
$currentConventionId = null;

// Gestion des actions utilisateur (afficher messages ou envoyer message)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['view_conversation'])) {
        $currentConventionId = $_POST['convention_id'];
        $messages = getMessages($currentConventionId);
    } elseif (isset($_POST['send_message']) && isset($_POST['convention_id'])) {
        $currentConventionId = $_POST['convention_id'];
        $messageContent = trim($_POST['message_content']);
        if (!empty($messageContent)) {
            addMessage($user['noyau_utilisateur__id'], $messageContent, $currentConventionId);
        }
        $messages = getMessages($currentConventionId);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url(root.css);

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: var(--foncé);
    color: var(--blanc);
}

main {
    padding: 20px;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    margin-top: 20px;
}

button {
    background-color: var(--blanc);
    color: var(--foncé);
    border: none;
    padding: 10px 10px;
    border-radius: 100px;
    cursor: pointer;
}
button:hover {
    background-color: var(--bleuclair);
    color: var(--blanc);
}

.discussion-list .discussion-item {
    background-color: var(--bleupastel);
    color: var(--foncé);
    margin: 10px 0;
    padding: 10px;
    border-radius: 15px;
}

.stages-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.blocstage {
    background-color: var(--bleupastel);
    color:var(--foncé);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    border-radius: 15px;
}

.stage-info {
    display: flex;
    align-items: center;
}

.iconestatut {
    width: 20px;
    height: 20px;
    background-color: var(--vert);
    margin-right: 10px;
    border-radius: 3px;
}






.discussion-container {
    display: flex;
    height: 400px;
}

.sidebar {
    background-color: #F0F0F0;
    padding: 20px;
    width: 25%;
}

.search input {
    width: 100%;
    padding: 5px;
    margin-bottom: 20px;
}

.chat-list .chat-item {
    margin-bottom: 10px;
}

.chat-content {
    background-color: #001B48;
    padding: 20px;
    width: 75%;
    position: relative;
}

.message {
    background-color: #A8C6E5;
    padding: 10px;
    margin: 10px 0;
    border-radius: 15px;
}

.message.sent {
    text-align: right;
    background-color: #00509E;
}

.message-input {
    position: absolute;
    bottom: 10px;
    width: 100%;
    display: flex;
    justify-content: space-between;
}

.message-input input {
    width: 80%;
    padding: 10px;
}

.message-input button {
    width: 15%;
    padding: 10px;
    background-color: #00509E;
    color: white;
    border: none;
}

    </style>
    <title>Mes Discussions</title>
</head>
<body>
    <header>
        <div class="logo">LOGO</div>
        <nav>
            <a href="etustage.php">Stages</a>
            <a href="discussion.php">Discussions</a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
        </nav>
    </header>

    <main>
        <?php if (!$currentConventionId): ?>
            <section id="launch-discussion">
                <h1>Vos discussions</h1>
                <div class="stages-list">
                    <?php foreach ($conventions as $convention): ?>
                        <div class="blocstage">
                            <div class="stage-info">
                                <div class="iconestatut"></div>
                                <span><?= htmlspecialchars($convention['stage_convention_nom_entreprise']) ?></span>
                            </div>
                            <div class="stage-btn">
                                <form method="POST">
                                    <input type="hidden" name="convention_id" value="<?= $convention['stage_convention_id_convention'] ?>">
                                    <button type="submit" name="view_conversation" class="btnmessage">
                                        <i class="fa-solid fa-message"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php else: ?>
            <section id="discussion-active">
                <h1>Discussion avec <?= htmlspecialchars($conventions[array_search($currentConventionId, array_column($conventions, 'stage_convention_id'))]['stage_convention_nom_entreprise']) ?></h1>
                <div class="discussion-container">
                    <div class="sidebar">
                        <div class="search">
                            <input type="text" placeholder="Rechercher">
                        </div>
                        <div class="chat-list">
                            <?php foreach ($conventions as $convention): ?>
                                <form method="POST">
                                    <input type="hidden" name="convention_id" value="<?= $convention['stage_convention_id_convention'] ?>">
                                    <button type="submit" name="view_conversation" class="chat-item <?= $currentConventionId == $convention['stage_convention_id_convention'] ? 'active' : '' ?>">
                                        <?= htmlspecialchars($convention['stage_convention_nom_entreprise']) ?>
                                    </button>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="chat-content">
                        <?php foreach ($messages as $message): ?>
                            <div class="message <?= $message['stage_message_id_auteur_message'] == $user['noyau_utilisateur__id'] ? 'sent' : 'received' ?>">
                                <?= htmlspecialchars($message['stage_message_contenu_message']) ?>
                            </div>
                        <?php endforeach; ?>
                        <form method="POST" class="message-input">
                            <input type="hidden" name="convention_id" value="<?= $currentConventionId ?>">
                            <input type="text" name="message_content" placeholder="Message..." required>
                            <button type="submit" name="send_message">Envoyer</button>
                        </form>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
