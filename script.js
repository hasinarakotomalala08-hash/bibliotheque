// Validation du formulaire d'ajout de livre
function verifierLivre() {
    const titre = document.getElementById("titre").value.trim();
    const auteur = document.getElementById("auteur").value.trim();
    const nb = document.getElementById("nb_exemplaires").value;

    if (titre === "" || auteur === "") {
        alert("Tous les champs sont obligatoires.");
        return false;
    }

    if (nb <= 0) {
        alert("Le nombre d'exemplaires doit être positif.");
        return false;
    }

    return true;
}

// Confirmation avant emprunt
function confirmerEmprunt() {
    return confirm("Confirmer l'emprunt de ce livre ?");
}
