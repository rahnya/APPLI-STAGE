<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Mes discussions</title>
    <link rel="stylesheet" href="CSS/etudiscussion.css">
</head>
<body>
    <header>
        <div class="logo">LOGO</div>
        <nav>
            <a href="etustage.php">Stages</a>
            <a href="etudiscussion.php">Discussions</a>
            <a href= "#"><i class="fa-solid fa-right-from-bracket"></i></a>
        </nav>
    </header>

    <main>
        <section id="no-discussion">
            <h1>Vous n'avez pas encore de discussion...</h1>
            <button onclick="launchDiscussion()">Lancer une discussion !</button>
        </section>

        <section id="launch-discussion" style="display: none;">
            <h1>Lancer une discussion avec :</h1>
            <div class="stages-list">
            <div class="blocstage">
                <div class="stage-info">
                    <div class="iconestatut">
                    </div>
                    <span>Stage chez Swello - Mai 2024</span>
                </div>
                <div class="stage-btn">
                    <button class="btnmessage" onclick="showDiscussion()">
                        <i class="fa-solid fa-message"></i>
                    </button>  
                </div>
            </div>
            <div class="blocstage">
                <div class="stage-info">
                    <div class="iconestatut">

                    </div>
                    <span>Stage chez Swello - Janvier 2024</span>
                </div>
                <div class="stage-btn">
                    <button class="btnmessage" onclick="showDiscussion()">
                        <i class="fa-solid fa-message"></i>
                    </button>  
                </div>
            </div>
            <div class="blocstage">
                <div class="stage-info">
                    <div class="iconestatut">
                    </div>
                    <span>Stage chez JSPQUI - Octobre 2023</span>
                </div>
                <div class="stage-btn">
                    <button class="btnmessage" onclick="showDiscussion()">
                        <i class="fa-solid fa-message"></i>
                    </button> 
                </div>
            </div>
        </div>
        </section>

        <section id="discussion-active" style="display: none;">
            <h1>TUTEUR 2024</h1>
            <div class="discussion-container">
                <div class="sidebar">
                    <div class="search">
                        <input type="text" placeholder="Rechercher">
                    </div>
                    <div class="chat-list">
                        <div class="chat-item">Stage 2024</div>
                        <div class="chat-item">Stage 2023</div>
                    </div>
                </div>
                <div class="chat-content">
                    <div class="message received">Bonjour étudiant, avez-vous bien reçu les tâches pour le stage ?</div>
                    <div class="message sent">Oui merci beaucoup, étudiant ravi par ailleurs.</div>
                    <div class="message-input">
                        <input type="text" placeholder="Message...">
                        <button>Envoyer</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function launchDiscussion() {
            document.getElementById('no-discussion').style.display = 'none';
            document.getElementById('launch-discussion').style.display = 'block';
        }
        function showDiscussion() {
            document.getElementById('launch-discussion').style.display = 'none';
            document.getElementById('discussion-active').style.display = 'block';
        }
    </script>
</body>
</html>
