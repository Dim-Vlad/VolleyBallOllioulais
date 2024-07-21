// Fonction pour afficher ou masquer le menu burger
function toggleMenu() {
  const menu = document.querySelector('.navbar-links');
  const toggler = document.querySelector('.navbar-toggler');
  if (menu) {
      menu.classList.toggle('show');
      toggler.classList.toggle('close');
  }
}

// Fonction pour fermer le menu si on clique à l'extérieur
function closeMenu(event) {
  const menu = document.querySelector('.navbar-links');
  const toggler = document.querySelector('.navbar-toggler');
  if (menu && !menu.contains(event.target) && !toggler.contains(event.target)) {
      menu.classList.remove('show');
      toggler.classList.remove('close');
  }
}

// Initialisation des événements
function initializeMenu() {
  const navbarToggler = document.querySelector('.navbar-toggler');
  if (navbarToggler) {
      navbarToggler.addEventListener('click', toggleMenu);
  }

  // Ajouter un écouteur d'événement pour fermer le menu lorsqu'on clique en dehors
  document.addEventListener('click', closeMenu);
}

// Fonction pour afficher la modale
function openModal(title, imageUrl, bodyText, linkUrl) {
  const modal = document.getElementById('infoModal');
  document.getElementById('modal-title').innerText = title;
  document.getElementById('modal-image').src = imageUrl;
  document.getElementById('modal-body').innerText = bodyText;
  document.getElementById('modal-link').href = linkUrl;
  modal.style.display = 'block';
}

// Fonction pour fermer la modale
function closeModal(event) {
  const modal = document.getElementById('infoModal');
  if (event) {
      event.stopPropagation();
  }
  modal.style.display = 'none';
}

// Ajout d'un écouteur pour fermer la modale si on clique à l'extérieur du contenu
document.getElementById('infoModal').addEventListener('click', function(event) {
  if (event.target === this) {
      closeModal();
  }
});

// Optionnel: fermeture de la modale en appuyant sur la touche "Échap"
document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape') {
      closeModal();
  }
});


// Charge les contenus HTML
function loadHTML(url, elementId) {
  fetch(url)
      .then(response => response.text())
      .then(data => {
          document.getElementById(elementId).innerHTML = data;
          if (elementId === 'menu') {
              initializeMenu(); // Initialiser les événements du menu burger
          }
      })
      .catch(error => console.error('Erreur de chargement:', error));
}

// Chargement des contenus HTML
loadHTML('../commun/menu.html', 'menu');
loadHTML('../commun/footer.html', 'footer');
