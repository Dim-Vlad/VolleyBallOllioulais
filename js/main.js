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

/* Carte NOS EQUIPES */
let items = document.querySelectorAll('.item');
console.log(items);
items.forEach(item => {
  item.addEventListener('mousemove', (e) => {
      // Utilisation correcte de l'objet événement 'e'
      let positionPx = e.x - item.getBoundingClientRect().left;
      let positionX = (positionPx / item.offsetWidth) * 100;

      let positionPy = e.y - item.getBoundingClientRect().top;
      let positionY = (positionPy / item.offsetHeight) * 100;

      item.style.setProperty('--rX', (0.5) * (50 - positionY) + 'deg');
      item.style.setProperty('--rY', -(0.5) * (50 - positionX) + 'deg');
  });

  item.addEventListener('mouseout', () => {
      item.style.setProperty('--rX', '0deg');
      item.style.setProperty('--rY', '0deg');
  });
});


/* Cartes galerie */
