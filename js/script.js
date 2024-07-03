// Fonction pour basculer le menu burger
function toggleMenu() {
  const navbarLinks = document.getElementById('navbarLinks');
  navbarLinks.classList.toggle('show'); // Ajoute ou supprime la classe 'show' pour afficher/cacher les liens
}

// Ajoute un écouteur d'événements sur le bouton burger
document.addEventListener('DOMContentLoaded', () => {
  document.querySelector('.navbar-toggler').addEventListener('click', toggleMenu);
});
