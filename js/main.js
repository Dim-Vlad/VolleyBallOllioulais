// Fonction pour charger dynamiquement un fichier HTML dans un élément de la page
function loadHTML(file, elementId) {
  fetch(file)
    .then(response => {
      // Vérifie si la réponse est correcte
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      // Retourne le contenu du fichier sous forme de texte
      return response.text();
    })
    .then(data => {
      // Insère le contenu du fichier dans l'élément spécifié
      document.getElementById(elementId).innerHTML = data;
      // Si le menu est chargé, rebind le toggle function
      if (elementId === 'menu') {
        document.querySelector('.navbar-toggler').addEventListener('click', toggleMenu);
      }
    })
    .catch(error => {
      // Affiche une erreur en cas de problème avec l'opération de fetch
      console.error('There has been a problem with your fetch operation:', error);
    });
}

// Fonction pour basculer le menu burger
function toggleMenu() {
  const navbarLinks = document.getElementById('navbarLinks');
  navbarLinks.classList.toggle('show'); // Ajoute ou supprime la classe 'show' pour afficher/cacher les liens
}

// Ajoute un écouteur d'événements sur le bouton burger
document.addEventListener('DOMContentLoaded', () => {
  document.querySelector('.navbar-toggler').addEventListener('click', toggleMenu);
});
