document.addEventListener("DOMContentLoaded", () => {
    const etapes = document.querySelectorAll(".etape");
    const boutonsSuivant = document.querySelectorAll(".suivant");
    const boutonsPrecedent = document.querySelectorAll(".precedent");
    const etapeListe = document.querySelectorAll("#etape ol li");

    let etapeActuelle = 0;

    function afficherEtape(index) {
        etapes.forEach((etape, i) => {
            if (i === index) {
                etape.classList.add("active");
                etapeListe[i].classList.add("actif");
            } else {
                etape.classList.remove("active");
                etapeListe[i].classList.remove("actif");
            }
        });
    }

    boutonsSuivant.forEach((bouton) => {
        bouton.addEventListener("click", () => {
            if (etapeActuelle < etapes.length - 1) {
                etapeActuelle++;
                afficherEtape(etapeActuelle);
            }
        });
    });

    boutonsPrecedent.forEach((bouton) => {
        bouton.addEventListener("click", () => {
            if (etapeActuelle > 0) {
                etapeActuelle--;
                afficherEtape(etapeActuelle);
            }
        });
    });

    afficherEtape(etapeActuelle);
});
